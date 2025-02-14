<?php
class Cyclist extends User {
    private $nationality;
    private $birthdate;
    private $points_awarded;
    private $approved;
    private $team;

    function __construct($id = null, $first_name = null, $last_name = null, $email = null, $password = null, $role_id = null, $created_at = null, $password_token_hash = null, $password_token_expires_at = null, $photo = null,
                                $nationality = null, $birthdate = null, $total_point = null, $approved = null, $team = null
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
        return $this->birthdate;
    }

    public function getApproved()
    {
        return $this->approved;
    }
    
    public function getTeam()
    {
        return $this->team;
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

    public static function TopCyclists($LIMIT = null)
    {
        $sql = "SELECT c.id, c.first_name, c.last_name, c.photo, c.team AS team_name , SUM(st.points_awarded) As Total
                FROM cyclists c LEFT JOIN stage_points st ON st.id_cyclist = c.id
                GROUP BY c.id, c.first_name, c.last_name, c.photo, t.id, t.name 
                ORDER BY Total DESC ";
        self::$db->query($sql);

        if ($LIMIT) {
            $sql .= " LIMIT :LIMIT";
            self::$db->bind(':LIMIT', $LIMIT);
        }
        

        $result = self::$db->results();

        $cyclests = [];

        foreach ($result as $key => $value) {
            $cyclist = new self($value['id'], $value['first_name'], $value['last_name'], $value['photo']);
            $cyclist->setPointsAwarded($value['team']);
            $cyclist->setTeam($value['team_name'] ?? '-------');

            $cyclests[] = $cyclist;
        }
        return $cyclests;
    }

    public static function findCyclist($id)
    {
        $sql = "SELECT * FROM cyclists WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $id);
        
        $result = self::$db->single();

        if (self::$db->rowCount() > 0) {
            $nationality = $result['approved'] ? $result['nationality'] : '------';
            $points_awarded = $result['approved'] ? $result['points_awarded'] : '------';
            $team = $result['approved'] ? $result['team'] : '------';

            $cyclist = new Cyclist($result["id"], $result["first_name"], $result["last_name"], $result["email"], $result["password"], $result["role_id"], $result["created_at"], $result["password_token_hash"], $result["password_token_expires_at"], $result['photo'],
                                    $nationality, $result['birthdate'], $points_awarded, $result['approved'], $team);
            return $cyclist;
        } else {
            return null;
        }
    }
}