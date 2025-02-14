<?php

    class Team extends BaseModel 
    {
        private $id;
        private $name;

        public function __construct($id = null, $name = null)
        {
            $this->id = $id;
            $this->name = $name;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        
        public function setName($name)
        {
            $this->id = $name;
        }
        
        public function getId()
        {
            return $this->id;
        }
        
        public function getName()
        {
            return $this->name;
        }
        
        public static function fetchTeam($search = null)
        {
            $sql = "SELECT * FROM teams";
            self::$db->query($sql);
            
            if ($search) {
                $sql .= " WHERE name ILIKE :name";
                self::$db->query($sql);
                self::$db->bind(":name", "%$search%");
            }

            $result = self::$db->results();

            $teams = [];
            foreach ($result as $value) {
                $teams[] = new self($value['id'], $value['name'], $value['country']);
            }
            return $teams;
        }
    
    }
