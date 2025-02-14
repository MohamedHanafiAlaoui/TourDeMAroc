<?php
class Cyclist extends User
{
    private $nationality;
    private $birthdate;
    private $total_points;
    private $approved;
    private $team_id;
    private $points_awarded;


    private $team_name;

    private $rank;
    private $total_time;


    function __construct(
        $id = null,
        $first_name = null,
        $last_name = null,
        $email = null,
        $password = null,
        $role_id = null,
        $created_at = null,
        $password_token_hash = null,
        $password_token_expires_at = null,
        $photo = null,
        $nationality = null,
        $birthdate = null,
        $total_point = null,
        $approved = null,
        $team_id = null
    ) {
        parent::__construct($id, $first_name, $last_name, $email, $password, $role_id, $created_at, $password_token_hash, $password_token_expires_at, $photo);
        $this->nationality = $nationality;
        $this->birthdate = $birthdate;
        $this->total_points = $total_point;
        $this->approved = $approved;
        $this->team_id = $team_id;
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    public function setTotalePoints($total_points)
    {
        $this->total_points = $total_points;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    public function setIdTeme($team_id)
    {
        $this->team_id = $team_id;
    }

    public function setTeme($team_name)
    {
        $this->team_name = $team_name;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getTotalePoints()
    {
        return $this->total_points;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getApproved()
    {
        return $this->approved;
    }

    public function getIdTeme()
    {
        return $this->team_id;
    }

    public function getTeam()
    {
        return $this->team_name;
    }

    public function getPointsAwarded()
    {
        return $this->points_awarded ?? 0;
    }




    public function setTotalTime($total_time)
    {
        $this->total_time = $total_time;
    }


    public function getTotalTime()
    {
        return $this->total_time;
    }



    public function save()
    {
        $sql = "INSERT INTO cyclists (first_name, last_name, email, password, role_id) VALUES (:first_name, :last_name, :email, :password, :role_id)";
        self::$db->query($sql);
        self::$db->bind(':first_name', $this->first_name);
        self::$db->bind(':last_name', $this->last_name);
        self::$db->bind(':email', $this->email);
        self::$db->bind(':password', $this->password);
        self::$db->bind(':role_id', $this->role_id);
        return self::$db->execute();
    }

    public function update()
    {
        $sql = "UPDATE cyclists 
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

    public static function TopCyclists($number)
    {
        $sql = "SELECT c.id, c.first_name, c.last_name, c.photo, t.id as team_id, t.name AS team_name 
                FROM cyclists c LEFT JOIN teams t ON c.id= t.id
                ORDER BY total_points DESC LIMIT :number";
        self::$db->query($sql);
        self::$db->bind(':number', $number);

        $result = self::$db->results();

        $cyclests = [];

        foreach ($result as $key => $value) {
            $cyclist = new self($value['id'], $value['first_name'], $value['last_name'], $value['photo']);
            $cyclist->setIdTeme($value['team_id']);
            $cyclist->setTeme($value['team_name'] ?? '-------');

            $cyclests[] = $cyclist;
        }
        return $cyclests;
    }

    // public static function getTopCyclists($limit = null)
    // {
    //     $sql = "SELECT c.id, c.first_name, c.last_name, c.photo, t.name AS team_name, 
    //                SUM(sp.points_awarded) AS total_points 
    //         FROM cyclists c
    //         JOIN stage_points sp ON c.id = sp.id_cyclist
    //         JOIN teams t ON c.team_id = t.id
    //         GROUP BY c.id, c.first_name, c.last_name, c.photo, t.name
    //         ORDER BY total_points DESC";

    //     if ($limit) {
    //         $sql .= " LIMIT :limit";
    //     }

    //     self::$db->query($sql);

    //     if ($limit) {
    //         self::$db->bind(':limit', $limit);
    //     }

    //     $result = self::$db->results();



    //     $cyclists = [];

    //     foreach ($result as $row) {
    //         $cyclist = new self(
    //             $row['id'],
    //             $row['first_name'],
    //             $row['last_name'],
    //             null,
    //             null,
    //             null,
    //             null,
    //             null,
    //             null,
    //             $row['photo'],
    //             null,
    //             null,
    //             $row['total_points'],
    //             null,
    //             null
    //         );
    //         $cyclist->setTeme($row['team_name']);

    //         $cyclists[] = $cyclist;
    //     }

    //     return $cyclists;
    // }

    
    public static function getTopCyclists($limit = null)
{
    $sql = "SELECT c.id, c.first_name, c.last_name, c.photo, t.name AS team_name, 
                   SUM(sp.points_awarded) AS total_points,
                   STRING_AGG(
                       EXTRACT(HOUR FROM sp.total_time) || 'h ' || 
                       EXTRACT(MINUTE FROM sp.total_time) || 'm', ', '
                   ) AS total_time
            FROM cyclists c
            JOIN stage_points sp ON c.id = sp.id_cyclist
            JOIN teams t ON c.team_id = t.id
            GROUP BY c.id, c.first_name, c.last_name, c.photo, t.name
            ORDER BY total_points DESC";
    
    if ($limit) {
        $sql .= " LIMIT :limit";
    }

    self::$db->query($sql);

    if ($limit) {
        self::$db->bind(':limit', $limit);
    }

    $result = self::$db->results();

    $cyclists = [];

    foreach ($result as $row) {
        $cyclist = new self(
            $row['id'],
            $row['first_name'],
            $row['last_name'],
            null, 
            null, 
            null,
            null,
            null, 
            null, 
            $row['photo'],
            null, 
            null, 
            $row['total_points'], 
            null, 
            null  
        );
        
        $cyclist->setTeme($row['team_name']);  
        $cyclist->setTotalTime($row['total_time']);

        $cyclists[] = $cyclist;
    }

    return $cyclists;
}


    
    public function team()
    {
        $sql = "SELECT * FROM teams t WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $this->team_id);

        $result = self::$db->single();

        return new Team($result["id"], $result["name"]);
    }

    public static function findCyclist($id)
    {
        $sql = "SELECT * FROM cyclists WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $id);

        $result = self::$db->single();

        if (self::$db->rowCount() > 0) {
            $nationality = $result['approved'] ? $result['nationality'] : '------';
            $total_points = $result['approved'] ? $result['total_points'] : '------';
            $team_id = $result['approved'] ? $result['team_id'] : '------';

            $cyclist = new Cyclist(
                $result["id"],
                $result["first_name"],
                $result["last_name"],
                $result["email"],
                $result["password"],
                $result["role_id"],
                $result["created_at"],
                null,
                null,
                $result['photo'],
                $nationality,
                $result['birthdate'],
                $total_points,
                $result['approved'],
                $team_id
            );
            return $cyclist;
        } else {
            return null;
        }
    }
}
