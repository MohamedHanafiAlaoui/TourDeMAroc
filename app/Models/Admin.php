<?php
class Admin extends User {

    public function update() 
    {
        $sql = "UPDATE admins 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    email = :email, 
                    password = :password, 
                    role_id = :role_id,
                    password_token_hash = :password_token_hash,
                    password_token_expires_at = :password_token_expires_at
                WHERE id = :id";
    
        self::$db->query($sql);
        self::$db->bind(':first_name', $this->first_name);
        self::$db->bind(':last_name', $this->last_name);
        self::$db->bind(':email', $this->email);
        self::$db->bind(':password', $this->password);
        self::$db->bind(':role_id', $this->role_id);
        self::$db->bind(':password_token_hash', $this->password_token_hash);
        self::$db->bind(':password_token_expires_at', $this->password_token_expires_at);
        self::$db->bind(':id', $this->id);

        return self::$db->execute();
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
        $query = "SELECT count(*) FROM cyclists WHERE approved = TRUE";
        self::$db->query($query);
        $totaleApprovedCyclests = self::$db->single()["count"] ?? 0;
    
        // Total number of users
        $query = "SELECT count(*) FROM users";
        self::$db->query($query);
        $totalUsers = self::$db->single()["count"] ?? 0;
    
        // Team with the most number of approved cyclists
        $query = "SELECT c.team FROM cyclists c
                  WHERE c.approved = TRUE 
                  GROUP BY c.team 
                  ORDER BY count(*) DESC 
                  LIMIT 1";
        self::$db->query($query);
        $teamWithMostPlayers = self::$db->single()["team"] ?? false;
    
        // Unresolved reports
        $query = "SELECT count(*) FROM reports WHERE is_archived = FALSE";
        self::$db->query($query);
        $unresolvedReports = self::$db->single()["count"] ?? 0;
    
        return [
            "totalApprovedCyclests" => $totaleApprovedCyclests,
            "totalUsers" => $totalUsers,
            "teamWithMostPlayers" => $teamWithMostPlayers,
            "unresolvedReports" => $unresolvedReports
        ];
    }
    
}