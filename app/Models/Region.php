<?php
class Region extends BaseModel
{
    protected $id_ragion;
    protected $name;

    public function __construct($id_ragion = null, $name = null)
    {
        $this->id_ragion = $id_ragion;
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }
    public function getId(){
        return $this->id_ragion;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setId($id_ragion){
        $this->id_ragion = $id_ragion;
    }
    public function save()
    {
        $query = "INSERT INTO regions (name) VALUES (:name) RETURNING id";
        self::$db->query($query);
        self::$db->bind(":name", $this->name);
        $result = self::$db->single();
        $this->id_ragion = $result["id"];
        $this->name= $result["name"];
        return true;
    }
    public static function find(int $id)
    {
        $sql = "SELECT * FROM regions WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $id);

        $result = self::$db->single();

        if ($result) {
            return new self( $result["id"], $result["name"]);
        }
        return null; 
    }
    public function delete()
    {
        $sql = "DELETE FROM regions WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $this->id_ragion);
        return self::$db->execute();
    }
        public static function All()
        {
            $sql = "SELECT * FROM regions";

            self::$db->query($sql);
            $result = self::$db->results();

            $categorys = [];
            foreach ($result as $value) {
                $categorys[] = new self($value['id'], $value['name']);
            }
            return $categorys;
        }
        public static function countRagion(){
            $sql = "SELECT COUNT(*) as totale FROM regions ";
            self::$db->query($sql);
            $result = self::$db->single();
            return $result['totale'];
        }
}