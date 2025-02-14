<?php

    class Like extends BaseModel
    {
        protected $id;
        protected $fan_id;
        protected $stage_id;

        public function __construct($id = null, $fan_id = null, $stage_id = null)
        {
            $this->id = $id;
            $this->fan_id = $fan_id;
            $this->stage_id = $stage_id;
        }

        public function getId()
        {
            return $this->stage_id;
        }

        public function getStageId()
        {
            return $this->stage_id;
        }

        public function getFanId()
        {
            return $this->fan_id;
        }

        public function save()
        {
            $query = "INSERT INTO stage_likes (id_fan, stage_id) VALUES (:fan_id, :stage_id) RETURNING id";
            self::$db->query($query);
            self::$db->bind(':fan_id', $this->fan_id);
            self::$db->bind(':stage_id', $this->stage_id);

            $result = self::$db->single();

            $this->id = $result["id"];
            return true;
        }
    
        public function delete()
        {
            $sql = "DELETE FROM stage_likes WHERE id = :id";
            self::$db->query($sql);
            self::$db->bind(':id', $this->id);
            return self::$db->execute();
        }

        public static function find($fan_id, $stage_id)
        {
            $sql = "SELECT * FROM stage_likes WHERE id_fan = :fan_id AND stage_id = :stage_id";
            self::$db->query($sql);
            self::$db->bind(':fan_id', $fan_id);
            self::$db->bind(':stage_id', $stage_id);

            $result = self::$db->single();

            if ($result) {
                return new self( $result["id"], $result["id_fan"], $result["stage_id"]);
            }
            return null; // Return null if like not found
        }
    }