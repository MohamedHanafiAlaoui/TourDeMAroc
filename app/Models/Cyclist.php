<?php
class Cyclist extends User {
    private $nationality;
    private $birthdate;
    private $total_points;
    private $approved;
    private $team_id;

    private $team_name;

    function __construct($id = null, $first_name = null, $last_name = null, $email = null, $password = null, $role_id = null, $created_at = null, $password_token_hash = null, $password_token_expires_at = null, $photo = null,
                                $nationality = null, $birthdate = null, $total_point = null, $approved = null, $team_id = null
                            )
        {
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

    public function Team()
    {
        if ($this->team_id) {
            $sql = "SELECT * FROM teams WHERE id = :id";
            self::$db->query($sql);
            self::$db->bind(':id', $this->team_id);
            
            $result = self::$db->single();

            return new Team($result["id"], $result["name"]);
        } else {
            return new Team('--', '------');
        }
        
        
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

            $cyclist = new Cyclist($result["id"], $result["first_name"], $result["last_name"], $result["email"], $result["password"], $result["role_id"], $result["created_at"],null, null, $result['photo'],
                                    $nationality, $result['birthdate'], $total_points, $result['approved'], $result['team_id']);
            return $cyclist;
        } else {
            return null;
        }
    }

    public function updateInfor()
    {
        $sql = "UPDATE cyclists 
                SET email = :email, 
                    birthdate = :birthdate,
                    nationality = :nationality,
                    photo = :photo,
                    team_id = team_id,
                WHERE id = :id";
    
        self::$db->query($sql);
        self::$db->bind(':email', $this->email);
        self::$db->bind(':birthdate', $this->birthdate);
        self::$db->bind(':nationality', $this->nationality);
        self::$db->bind(':photo', $this->photo);
        self::$db->bind(':team_id', $this->team_id);
        self::$db->bind(':id', $this->id);
    
        return self::$db->execute();
    }
}