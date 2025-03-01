<?php
    class Comment extends BaseModel
    {
        protected $id;
        protected $fan_id;
        protected $stage_id;
        protected $content;
        protected $created_at;

        protected $author;
        protected $stage;
        
        public function __construct($id = null, $fan_id = null, $stage_id = null, $content = null, $created_at = null, $author = null , $stage = null)
        {
            $this->id = $id;
            $this->fan_id = $fan_id;
            $this->stage_id = $stage_id;
            $this->content = $content;
            $this->created_at = $created_at;
            $this->author = $author;
            $this->stage = $stage;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getStageId()
        {
            return $this->stage_id;
        }

        public function getFanId()
        {
            return $this->fan_id;
        }

        public function getContent()
        {
            return $this->content;
        }

        public function getCreatedAt()
        {
            return $this->created_at;
        }

        public function getAuthor()
        {
            return $this->author;
        }
        public function getStage()
        {
            return $this->stage;
        }

        public function setFanId($fan_id)
        {
            $this->fan_id = $fan_id;
        }

        public function setStageId($stage_id)
        {
            $this->stage_id = $stage_id;
        }

        public function setContent($content)
        {
            $this->content = $content;
        }

        public function setAuthor($author)
        {
            $this->author = $author;
        }

        public function save()
        {
            $query = "INSERT INTO comments (id_fan, stage_id, content) VALUES (:fan_id, :stage_id, :content) RETURNING id";
            self::$db->query($query);
            self::$db->bind(':fan_id', $this->fan_id);
            self::$db->bind(':stage_id', $this->stage_id);
            self::$db->bind(':content', $this->content);

            $result = self::$db->single();

            $this->id = $result["id"];
            return true;
        }

        public static function find($id)
        {
            $sql = "SELECT * FROM comments WHERE id = :id";
            self::$db->query($sql);
            self::$db->bind(':id', $id);

            $result = self::$db->single();

            if ($result) {
                $user = fan::find($result["id_fan"]);
                $stage = stage::find($result["stage_id"]);
                $comment = new self($result["id"], $result["id_fan"], $result["stage_id"], $result["content"], $result["created_at"],$user,$stage);
                return $comment;
            }
            return null; // Return null if like not found
        }

        public static function comment_count(int $id)
        {
            $sql = "SELECT COUNT(*) AS comment_count 
                    FROM comments 
                    WHERE id_fan = :id_fan";
            self::$db->query($sql);
            
            self::$db->bind(':id_fan', $id);
            $result = self::$db->single();
            $count =$result;
            return $count["comment_count"];   
        }
        public function publish(){
            $sql = "UPDATE comments SET validated = true WHERE id = :id";
            self::$db->query($sql);
            self::$db->bind(':id', $this->id);
            self::$db->execute();
            return true;
        }
        public function delete(){
            $sql = "DELETE from comments WHERE id = :id";
            self::$db->query($sql);
            self::$db->bind(':id', $this->id);
            self::$db->execute();
            return true;
        }
        public static function pendingcomment(){
            $sql = "SELECT * FROM comments WHERE validated = FALSE";
            self::$db->query($sql);
            $results = self::$db->results();
            $comments = [];
            foreach ($results as $result) {
                $user = fan::find($result["id_fan"]);
                $stage = stage::find($result["stage_id"]);
                $comment = new self($result["id"], $result["id_fan"], $result["stage_id"], $result["content"], $result["created_at"],$user,$stage);
                $comments[] = $comment;
            }
            return $comments;
        }
    }
