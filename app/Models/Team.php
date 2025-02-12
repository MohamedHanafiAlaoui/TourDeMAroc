<?php

    class Team extends BaseModel 
    {
        private $id;
        private $name;
        private $country;

        public function __construct($id = null, $name = null, $country = null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->country = $country;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        
        public function setName($name)
        {
            $this->id = $name;
        }
        
        public function setCountry($country)
        {
            $this->id = $country;
        }
        
        public function getId()
        {
            return $this->id;
        }
        
        public function getName()
        {
            return $this->name;
        }
        
        public function getCountry()
        {
            return $this->country;
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
