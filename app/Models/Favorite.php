<?php
class Favorite extends BaseModel {

    private $id_fan;

    private $id_cyclist;  
    private $last_name;  
    private $first_name;  
    private $name; 
    private $photo;
    private $count;
 

    public function __construct($id_fan = null, $id_cyclist = null) {
        $this->id_fan = $id_fan;
        $this->id_cyclist = $id_cyclist;
    }

    public function getFanId() {
        return $this->id_fan;
    }

    public function setFanId($id) {
        $this->id_fan = $id;
    }

    public function getCyclistId() {
        return $this->id_cyclist;
    }

    public function setCyclistId($id) {
        $this->id_cyclist = $id;
    }


    public function getfirst_name() {
        return $this->first_name;
    }

    public function setfirst_name($id) {
        $this->first_name = $id;
    }

    public function getlast_name() {
        return $this->last_name;
    }

    public function setlast_name($id) {
        $this->last_name = $id;
    }

    public function getname() {
        return $this->name;
    }

    public function setphoto($id) {
        $this->photo = $id;
    }
    public function getphoto() {
        return $this->photo;
    }


    public function getcount() {
        return $this->id_fan;
    }

    public function setcount($id) {
        $this->id_fan = $id;
    }

    

    public function save() {
        $sql = "INSERT INTO favorites (id_fan, id_cyclist)
                VALUES (:fan, :cyclist)
                ON CONFLICT DO NOTHING";
        
        self::$db->query($sql);
        self::$db->bind(':fan', $this->id_fan);
        self::$db->bind(':cyclist', $this->id_cyclist);
        
        return self::$db->execute();
    }

    public function delete() {
        $sql = "DELETE FROM favorites 
                WHERE id_fan = :fan 
                AND id_cyclist = :cyclist";
        
        self::$db->query($sql);
        self::$db->bind(':fan', $this->id_fan);
        self::$db->bind(':cyclist', $this->id_cyclist);
        
        return self::$db->execute();
    }

    public static function All($id)
    {
        $sql ="SELECT f.*, 
       c.first_name AS cyclist_first_name, 
       c.last_name AS cyclist_last_name,
        c.photo AS cyclist_photo,
        c.team AS cyclist_team
        FROM favorites f  
        LEFT JOIN cyclists c ON f.id_cyclist = c.id where f.id_fan=:id";

        self::$db->query($sql);
        self::$db->bind(':id', $id);

        $result = self::$db->results();

        $Favorites = [];
        foreach ($result as $value) {
            $class = new self($value['id_fan'], $value['id_cyclist'], );
            $class->setfirst_name($value['cyclist_first_name']);
            $class->setfirst_name($value['cyclist_last_name']);
            $class->setphoto($value['cyclist_photo']);
            $class->setname($value['cyclist_team']);
            $Favorites=$class;

        }
        return $Favorites;
    }

    public static function find($id_fan, $id_cyclist)
    {
        $sql ="SELECT * FROM favorites where id_fan=:id_fan AND id_cyclist = :id_cyclist";
        self::$db->query($sql);
        self::$db->bind(':id_fan', $id_fan);
        self::$db->bind(':id_cyclist', $id_cyclist);

        return self::$db->single();
    }


    public static function favorite_count(int $id)
    {
        $sql = "SELECT COUNT(*) AS favorite_count 
FROM favorites 
WHERE id_fan = :id_fan";
        self::$db->query($sql);
        
        self::$db->bind(':id_fan', $id);
        $result = self::$db->single();
        $count= $result;

        
        return $count['favorite_count'];   
    }
 


















}

