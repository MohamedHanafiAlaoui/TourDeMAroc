<?php

    class Report extends BaseModel
    {
        protected $id;
        protected $fan_id;
        protected $stage_id;
        protected $message;
        protected $created_at;

        public function __construct($id = null, $fan_id = null, $stage_id = null, $message = null, $created_at = null)
        {
            $this->id = $id;
            $this->fan_id = $fan_id;
            $this->stage_id = $stage_id;
            $this->message = $message;
            $this->created_at = $created_at;
        }

        public function setFanId($fan_id)
        {
            $this->fan_id = $fan_id;
        }

        public function setStageId($stage_id)
        {
            $this->stage_id = $stage_id;
        }

        public function setMessage($message)
        {
            $this->message = $message;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getFanId()
        {
            return $this->fan_id;
        }

        public function getStageId()
        {
            return $this->stage_id;
        }

        public function getMessage()
        {
            return $this->message;
        }

        public function getCreatedAt()
        {
            return $this->created_at;
        }

        public function save()
        {
            $query = "INSERT INTO reports (id_fan, stage_id, description) VALUES (:fan_id, :stage_id, :message) RETURNING id";
            self::$db->query($query);
            self::$db->bind(":fan_id", $this->fan_id);
            self::$db->bind(":stage_id", $this->stage_id);
            self::$db->bind(":message", $this->message);

            $result = self::$db->single();

            $this->id = $result["id"];
            return true;
        }

        public function delete()
        {
            $sql = "DELETE FROM reports WHERE id = :id";
            self::$db->query($sql);
            self::$db->bind(':id', $this->id);
            return self::$db->execute();
        }
        
        public static function find(int $id)
        {
            $sql = "SELECT * FROM reports WHERE id = :id";
            self::$db->query($sql);
            self::$db->bind(':id', $id);

            $result = self::$db->single();

            if ($result) {
                return new self($result["id"], $result["id_fan"], $result["stage_id"], $result["description"], $result["created_at"]);
            }
            return null; // Return null if category not found
        }

        public static function all()
        {
            $sql = "SELECT * FROM reports";

            self::$db->query($sql);
            $results = self::$db->results();

            $reports = [];
            foreach ($results as $result) {
                $reports[] = new self($result["id"], $result["id_fan"], $result["stage_id"], $result["description"], $result["created_at"]);
            }
            return $reports;
        }
    }