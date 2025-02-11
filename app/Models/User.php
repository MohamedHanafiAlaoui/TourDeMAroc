<?php
class User extends BaseModel
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;
    protected $role_id;
    protected $created_at;

    static public $adminRoleId = 1;
    static public $cyclistRoleId = 2;
    static public $fanRoleId = 3;

    public function __construct($id = null, $first_name = null, $last_name = null, $email = null, $password = null, $role_id = null, $created_at = null)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

     function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    public function getRoleId()
    {
        return $this->role_id;
    }
    
    public function getRoleName()
    {
        switch ($this->getRoleId()) {
            case self::$adminRoleId:
                return "admin";
            case self::$fanRoleId:
                return "fan";
            case self::$cyclistRoleId:
                return "cyclist";
            default:
                return "visitor";
        }
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function isAdmin()
    {
        return $this->getRoleId() == self::$adminRoleId;
    }

    public function isFan()
    {
        return $this->getRoleId() == self::$fanRoleId;
    }

    public function isCyclist()
    {
        return $this->getRoleId() == self::$cyclistRoleId;
    }
    

    public function save(){}

    public static function find($id): Fan | Cyclist | Admin | null
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $id);
        
        $result = self::$db->single();

        if (self::$db->rowCount() > 0) {
            switch ($result["role_id"]) {
                case self::$adminRoleId:
                    return new Admin($result["id"], $result["first_name"], $result["last_name"], $result["email"], $result["password"], $result["role_id"]);
                case self::$fanRoleId:
                    $fan = new Fan($result["id"], $result["first_name"], $result["last_name"], $result["email"], $result["password"], $result["role_id"]);
                    return $fan;
                case self::$cyclistRoleId:
                    $cyclist = new Cyclist($result["id"], $result["first_name"], $result["last_name"], $result["email"], $result["password"], $result["role_id"]);
                    return $cyclist;
            }
        } else {
            return null;
        }
    }

    public static function findUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        self::$db->query($sql);
        self::$db->bind(':email', $email);
        $result = self::$db->single();

        if (self::$db->rowCount() > 0) {
            return new self($result["id"], $result["first_name"], $result["last_name"], $result["email"], $result["password"], $result["role_id"]);
        } else {
            return false;
        }
    }
}