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
        $query = "SELECT count(*) as totalCyclest FROM cyclists WHERE approved = TRUE";
        self::$db->query($query);
        $totaleApprovedCyclests = self::$db->single()["totalCyclest"] ?? 0;
    
        // Total number of users
        $query = "SELECT count(*) as totalUsers FROM users";
        self::$db->query($query);
        $totalUsers = self::$db->single()["totalUsers"] ?? 0;
    
        // Team with the most number of approved cyclists
        // $query = "SELECT t.name FROM teams t 
        //           JOIN cyclists c ON c.team_id = t.id 
        //           WHERE c.approved = TRUE 
        //           GROUP BY t.name 
        //           ORDER BY count(*) DESC 
        //           LIMIT 1";
        // self::$db->query($query);
        // $teamWithMostPlayers = self::$db->single()["name"] ?? false;
        // this part was removed
    
        // Unresolved reports
        $query = "SELECT count(*) as totalUnresolved FROM reports WHERE is_archived = FALSE";
        self::$db->query($query);
        $unresolvedReports = self::$db->single()["totalUnresolved"] ?? 0;
    
        return [
            "totalApprovedCyclests" => $totaleApprovedCyclests,
            "totalUsers" => $totalUsers,
            // "teamWithMostPlayers" => $teamWithMostPlayers,
            "unresolvedReports" => $unresolvedReports
        ];
    }
    
}