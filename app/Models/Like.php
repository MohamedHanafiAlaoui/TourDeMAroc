<?php

class Like extends BaseModel
{
    private $id;
    private $id_fan;
    private $stage_id;

    public function __construct($id = null, $id_fan = null, $stage_id = null)
    {
        $this->id = $id;
        $this->id_fan = $id_fan;
        $this->stage_id = $stage_id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdFan($id_fan)
    {
        $this->id_fan = $id_fan;
    }

    public function setIdStage($stage_id)
    {
        $this->stage_id = $stage_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdFan()
    {
        return $this->id_fan;
    }

    public function getIdStage() {
        return $this->stage_id;
    }

    public function isLikedByFan()
    {
        $sql ="SELECT COUNT(*) FROM stage_likes WHERE id_fan = ? AND stage_id = ?";
        self::$db->query($sql, [$this->id_fan, $this->stage_id]);
        return self::$db->fetchColumn() > 0;
    }
    
    public function save()
    {
        if(!$this->isLikedByFan()) {
            $sql = "INSERT INTO stages_likes (id_fan, stage_id) VALUES (?, ?)";
            self::$db->query($sql, [$this->id_fan, $this->stage_id]);
            return self::$db->execute();
        }
        return false;
    }

    public function remove()
    {
        $sql = "DELETE FROM stage_likes WHERE id_fan = ? AND stage_id = ?";
        self::$db->query($sql, [$this->id_fan, $this->stage_id]);
        return self::$db->execute();
    }

    public static function getFanLikes($id_fan)
    {
        $sql = "SELECT * FROM stage_likes WHERE id_fan = ?";
        self::$db->query($sql, [$id_fan]);
        $result = self::$db->results();

        $likes = [];
        foreach ($result as $row) {
            $likes[] = new self($row['id'], $row['id_fan'], $row['stage_id']);
        }
        return $likes;
    }

    
}
