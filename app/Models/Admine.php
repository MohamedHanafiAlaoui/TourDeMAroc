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
        self::$db->query($query);
        $totaleApprovedCyclests = self::$db->single();
        // totale number of users
        $query = "SELECT count(*) as totalUsers FROM users ";
        self::$db->query($query);
        $totaleUsers = self::$db->single();
        // team with the most number of approved cyclists
        $query = "SELECT t.name FROM teams t JOIN cyclists c ON c.id_team = t.id_team AND c.approved = TRUE GROUP BY t.name ORDER BY count(*) DESC LIMIT 1 ";
        self::$db->query($query);
        $teamWithMostPlayers = self::$db->single();
        // un resoved repportes 
        $query = "SELECT count(*) as totalUnresolved FROM reports WHERE is_archived = FALSE ";
        self::$db->query($query);
        $unresolvedReports = self::$db->single();
        return ["totalApprovedCyclests" => $totaleApprovedCyclests,"totalUsers" => $totaleUsers,"teamWithMostPlayers" => $teamWithMostPlayers,"unresolvedReports" => $unresolvedReports];
    }
}
?>