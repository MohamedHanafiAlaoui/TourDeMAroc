<?php
class Cyclist extends User
{
    private $nationality;
    private $birthdate;
    private $points_awarded;
    private $approved;
    private $team;

    private $total_time;

    function __construct($id = null, $first_name = null, $last_name = null, $email = null, $password = null, $role_id = null, $created_at = null, $password_token_hash = null, $password_token_expires_at = null, $photo = null,
                                $nationality = null, $birthdate = null, $approved = null, $team = null
                            )
    {
        parent::__construct($id, $first_name, $last_name, $email, $password, $role_id, $created_at, $password_token_hash, $password_token_expires_at, $photo);
        $this->nationality = $nationality;
        $this->birthdate = $birthdate;
        $this->approved = $approved;
        $this->team = $team;
    }
    
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    public function setPointsAwarded($points_awarded)
    {
        $this->points_awarded = $points_awarded;
    }

    public function setTotalTime($total_time)
    {
        $this->total_time = $total_time;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
    }
    
    public function setTeam($team)
    {
        $this->team = $team;
    }

    public function getNationality()
    {
        return $this->nationality;
    }


    public function getPointsAwarded()
    {
        return $this->points_awarded;
    }

    public function getBirthdate()
    {
        $date = new DateTime($this->birthdate);
        return $date->format('F j, Y');
    }

    public function getApproved()
    {
        return $this->approved;
    }
    
    public function getTeam()
    {
        return $this->team;
    }

    public function getAge()
    {
        $dob = new DateTime($this->birthdate);
        $now = new DateTime();
        $difference = $now->diff($dob);
        return $difference->y;
    }

    public function getTotalTime()
    {
        $date = DateTime::createFromFormat('H:i:s', preg_replace('/^\d+ day[s]? /', '', $this->total_time));
    
        return (preg_match('/^(\d+) day[s]?/', $this->total_time, $d) ? "{$d[1]}d " : "") . $date->format('G\h i\m');
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
                    birthdate = :birthdate,
                    nationality = :nationality,
                    photo = :photo,
                    team = :team,
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
        self::$db->bind(':birthdate', $this->birthdate);
        self::$db->bind(':nationality', $this->nationality);
        self::$db->bind(':photo', $this->photo);
        self::$db->bind(':team', $this->team);
        self::$db->bind(':id', $this->id);

        return self::$db->execute();
    }

    public static function all()
    {
        $sql = "SELECT * FROM cyclists";
        self::$db->query($sql);
        $result = self::$db->results();

        $cyclists = [];

        foreach ($result as $row) {
            $cyclists[] = new self(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['password'],
                $row['role_id'],
                $row['created_at'],
                $row['password_token_hash'],
                $row['password_token_expires_at'],
                $row['photo'],
                $row['nationality'],
                $row['birthdate'],
                $row['approved'],
                $row['team']
            );
        }

        return $cyclists; 
    }

    public static function approvedCyclists()
    {
        $sql = "SELECT * FROM cyclists WHERE approved = TRUE";
        self::$db->query($sql);
        $result = self::$db->results();

        $cyclists = [];

        foreach ($result as $row) {
            $cyclists[] = new self(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['password'],
                $row['role_id'],
                $row['created_at'],
                $row['password_token_hash'],
                $row['password_token_expires_at'],
                $row['photo'],
                $row['nationality'],
                $row['birthdate'],
                $row['approved'],
                $row['team']
            );
        }

        return $cyclists; 
    }
    
    public static function getTopCyclists($limit = null)
    {
        $sql = "SELECT 
                    c.id, 
                    c.first_name, 
                    c.last_name, 
                    c.photo, 
                    c.team AS team_name, 
                    SUM(ra.points_awarded) AS total_points,
                    justify_interval(SUM(ra.total_time)) AS total_time
                FROM cyclists c
                JOIN ranking ra ON c.id = ra.cyclist_id
                GROUP BY c.id, c.first_name, c.last_name, c.photo, c.team
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
        );
        $cyclist->setPointsAwarded($row['total_points']);
        $cyclist->setTotalTime($row['total_time']);
        $cyclist->setTeam($row['team_name']);

        $cyclists[] = $cyclist;
    }

    return $cyclists;
}

    public static function findCyclist($id)
    {
        $sql = "SELECT * FROM cyclists WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $id);

        $result = self::$db->single();

        if (self::$db->rowCount() > 0) {
            return self::mappingCyclist($result);
        } else {
            return null;
        }
    }

    public static function mappingCyclist($result)
    {
        return new self($result["id"], $result["first_name"], $result["last_name"], $result["email"], $result["password"], $result["role_id"], $result["created_at"], $result["password_token_hash"], $result["password_token_expires_at"], $result['photo'],
        $result['nationality'], $result['birthdate'], $result['approved'], $result["team"]);
    }
    public static function unverifiedCyclists(){
        $cyclists=[];
        $sql = "SELECT * FROM cyclists WHERE approved = FALSE";
        self::$db->query($sql);
        $results = self::$db->results();
        foreach ($results as $result) {
            $cyclist = new self($result["id"], $result["first_name"], $result["last_name"], $result["email"], $result["password"], $result["role_id"], $result["created_at"], $result["password_token_hash"], $result["password_token_expires_at"], $result['photo'],
            $result['nationality'], $result['birthdate'], $result['approved'], $result["team"]);
            $cyclists[] = $cyclist;
        }
        return $cyclists;
    }

}
