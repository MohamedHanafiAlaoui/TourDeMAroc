<?php
class Admin extends User {
    public function __construct($id = null, $first_name = null, $last_name = null, $email = null, $password = null, $role_id = null, $created_at = null) {
        parent::__construct($id, $first_name, $last_name, $email, $password , $role_id, $created_at);
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
    public static function platformStatiscs() {
        // Total approved cyclists
        $query = "SELECT count(*) as totalCyclest FROM cyclists WHERE approved = TRUE";
        self::$db->query($query);
        $totaleApprovedCyclests = self::$db->single()["totalCyclest"] ?? 0;
    
        // Total number of users
        $query = "SELECT count(*) as totalUsers FROM users";
        self::$db->query($query);
        $totalUsers = self::$db->single()["totalUsers"] ?? 0;
    
        // Team with the most number of approved cyclists
        $query = "SELECT t.name FROM teams t 
                  JOIN cyclists c ON c.team_id = t.id 
                  WHERE c.approved = TRUE 
                  GROUP BY t.name 
                  ORDER BY count(*) DESC 
                  LIMIT 1";
        self::$db->query($query);
        $teamWithMostPlayers = self::$db->single()["name"] ?? false;
    
        // Unresolved reports
        $query = "SELECT count(*) as totalUnresolved FROM reports WHERE is_archived = FALSE";
        self::$db->query($query);
        $unresolvedReports = self::$db->single()["totalUnresolved"] ?? 0;
    
        return [
            "totalApprovedCyclests" => $totaleApprovedCyclests,
            "totalUsers" => $totalUsers,
            "teamWithMostPlayers" => $teamWithMostPlayers,
            "unresolvedReports" => $unresolvedReports
        ];
    }
    
}