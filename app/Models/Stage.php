<?php

    class Stage extends BaseModel
    {
        protected $id_stage;
        protected $name;
        protected $start_location;
        protected $end_location;
        protected $distance_km;
        protected $start_date;
        protected $end_date;
        protected $id_region;
        protected $difficulty_level;
        protected $id_category;
        
        protected $nameCategory;
        public function __construct($id_stage = null, $name = null, $start_location = null, $end_location = null, $distance_km = null, $start_date = null, $end_date = null, $id_region = null, $difficulty_level = null, $id_category = null)
        {
            $this->id_stage = $id_stage;
            $this->name = $name;
            $this->start_location = $start_location;
            $this->end_location = $end_location;
            $this->distance_km = $distance_km;
            $this->start_date = $start_date;
            $this->end_date = $end_date;
            $this->id_region = $id_region;
            $this->difficulty_level = $difficulty_level;
            $this->id_category = $id_category;
        }

        public function setId($id_stage)
        {
            $this->id_stage = $id_stage;
        }

        public function setName($name)
        {
            $this->name = $name;
        }
        
        public function getStLocation($start_location)
        {
            $this->start_location = $start_location;
        }
        
        public function getEnLocation($end_location)
        {
            $this->end_location = $end_location;
        }
        
        public function getDistance($distance_km)
        {
            $this->distance_km = $distance_km;
        }
        
        public function get($name)
        {
            $this->name = $name;
        }
        
        public function ($name)
        {
            $this->name = $name;
        }
        
        public function ($name)
        {
            $this->name = $name;
        }
        
        public function ($name)
        {
            $this->name = $name;
        }
        
        public function ($name)
        {
            $this->name = $name;
        }
        

        public function getId()
        {
            return $this->id_stage;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getIdCategory()
        {
            return $this->id_category;
        }

        public function All()
        {
            $sql = "SELECT * FROM stage";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];
            foreach ($result as $value) {
                $stages[] = new self($value['id_stage'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['id_region'], $value['difficulty_level'], $value['id_category']);
            }
            return $stages;
        }

    }