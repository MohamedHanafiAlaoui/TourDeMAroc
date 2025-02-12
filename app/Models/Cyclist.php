<?php
class Cyclist extends User {
    private $nationality;
    private $birthdate;
    private $total_points;
    private $approved;
    private $id_team;

    private $nameTeam;

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
    
    public function setIdTeme($id_team)
    {
        $this->id_team = $id_team;
    }

    public function setNameTeme($nameTeam)
    {
        $this->nameTeam = $nameTeam;
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
        return $this->id_team;
    }

    public function getNameTeam()
    {
        return $this->nameTeam;
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

    public static function TopCyclists($number)
    {
        $sql = "SELECT c.id, c.first_name, c.last_name, c.photo, t.id_team, t.name AS teamname 
                FROM cyclists c JOIN teams t ON c.id_team = t.id_team
                ORDER BY total_points DESC LIMIT :number";
        self::$db->query($sql);
        self::$db->bind(':number', $number);

        $result = self::$db->results();

        $cyclests = [];

        foreach ($result as $key => $value) {
            $cyclist = new self($value['id'], $value['first_name'], $value['last_name'], $value['photo']);
            $cyclist->setIdTeme($value['id_team']);
            $cyclist->setNameTeme($value['teamname']);

            $cyclests[] = $cyclist;
        }
        return $cyclests;
    }
}