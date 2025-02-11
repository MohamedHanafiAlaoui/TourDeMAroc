<?php 
class Admine extends User {
    public function __construct() {
    }
    public function __get($name){
        return $this->$name;
    }
    public function __set($name, $value){
        $this->$name = $value;
    }
    public function approveCyclest($id):bool{
        $query = "UPDATE cyclists SET approved = TRUE WHERE id = :id ";
        self::$db->query($query);
        self::$db->bind(':id', $id);
        self::$db->execute();
        return true;
    }
    public function platformStatiscs(){
        $query = "SELECT count(*) as totalCyclest FROM cyclists WHERE approved = TRUE ";
    }
}
?>