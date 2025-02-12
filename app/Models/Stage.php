<?php

    class Stage extends BaseModel
    {
        private $id_stage;
        private $name;
        private $start_location;
        private $end_location;
        private $distance_km;
        private $start_date;
        private $end_date;
        private $id_region;
        private $difficulty_level;
        private $id_category;
        
        private $nameCategory;
        private $nameRegion;
        private $photo;
        public function __construct($id_stage = null, $name = null, $start_location = null, $end_location = null, $distance_km = null, $start_date = null, $end_date = null, $id_region = null, $difficulty_level = null, $id_category = null,$photo=null)
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
            $this->photo = $photo;
        }

        public function setId($id_stage)
        {
            $this->id_stage = $id_stage;
        }

        public function setName($name)
        {
            $this->name = $name;
        }
        
        public function setStLocation($start_location)
        {
            $this->start_location = $start_location;
        }
        
        public function setEnLocation($end_location)
        {
            $this->end_location = $end_location;
        }
        
        public function setDistance($distance_km)
        {
            $this->distance_km = $distance_km;
        }
        
        public function setStDate($start_date)
        {
            $this->start_date = $start_date;
        }
        
        public function setEnDate($end_date)
        {
            $this->end_date = $end_date;
        }
        
        public function setIdRegion($id_region)
        {
            $this->id_region = $id_region;
        }
        
        public function setDiffcLevel($difficulty_level)
        {
            $this->difficulty_level = $difficulty_level;
        }

        public function setIdCategory($id_category)
        {
            $this->id_category = $id_category;
        }

        public function setNameCategory($nameCategory)
        {
            $this->nameCategory = $nameCategory;
        }

        public function setNameRegion($nameRegion)
        {
            $this->nameRegion = $nameRegion;
        }
        

        public function getId()
        {
            return $this->id_stage;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getStLocation()
        {
            return $this->start_location;
        }
        
        public function getEnLocation()
        {
            return $this->end_location;
        }
        
        public function getDistance()
        {
            return $this->distance_km;
        }
        
        public function getStDate()
        {
            return $this->start_date;
        }
        
        public function getEnDate()
        {
            return $this->end_date;
        }
        
        public function getIdRegion()
        {
            return $this->id_region;
        }
        
        public function getDiffcLevel()
        {
            return $this->difficulty_level;
        }

        public function getIdCategory()
        {
            return $this->id_category;
        }

        public function getNameCategory()
        {
            return $this->nameCategory;
        }

        public function getNameRegion()
        {
            return $this->nameRegion;
        }

        public static function All()
        {
            $sql = "SELECT * FROM stages";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];
            foreach ($result as $value) {
                $stages[] = new self($value['id'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['region_id'], $value['difficulty_level'], $value['category_id']);
            }
            return $stages;
        }

        public static function NextStages()
        {
            $sql = "SELECT s.*, r.id, r.name AS name_region FROM stages s JOIN regions r ON s.region_id = r.id ORDER BY s.start_date DESC LIMIT 3";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];

            foreach ($result as $key => $value) {
                $class = new self($value['id'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['region_id'], $value['difficulty_level'], $value['category_id']);
                $class->setNameCategory($value['name_region']);

                $stages[] = $class; 
            }
            return $stages;
        }

        public static function show()
        {
            $sql = "SELECT s.*, c.name AS categoryname FROM stages s JOIN categories c ON s.category_id = c.id ORDER BY s.start_date DESC";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];
            foreach ($result as $value) {
                $class = new self($value['id'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['id_region'], $value['difficulty_level'], $value['category_id']);
                $class->setNameCategory($value['categoryname']);
                
                $stages[] = $class;
            }
            return $stages;
        }

        public static function fetchStage($search = null, $categoryFilter = null, $distanceFilter = null)
        {
            $sql = "SELECT s.*, c.id AS category_id, c.name AS category_name FROM stages s 
                    JOIN categories c ON c.id= s.id WHERE 1 = 1"; 
            self::$db->query($sql);        

            if ($search) {
                $sql .= " AND s.name LIKE :name";
                self::$db->bind(':name', $search);
            }
            if ($categoryFilter) {
                $sql .= " AND s.category_name = :id";
                self::$db->bind(':id', $categoryFilter);
            }
            if ($distanceFilter) {
                switch ($distanceFilter) {
                    case "short":
                        $sql .= " AND s.distance_km < 100";
                        self::$db->bind(':distance_km', $categoryFilter);
                        break;
                    
                    case "medium":
                        $sql .= " AND s.distance_km >= 100 AND s.distance_km <= 200 ";
                        break;
                
                    case "long":
                        $sql .= " AND s.distance_km >200 ";
                        break;
                }
            }

            $sql .= " ORDER BY s.start_date DESC";
            $result = self::$db->result();
            $stages = [];

            foreach ($result as $key => $value) {
                $class = new self($value['id'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['region_id'], $value['difficulty_level'], $value['category_id']);
                $class->setNameCategory($value['nameCategory']);

                $stages[] = $class; 
            }
            return $stages;
        }
        public function createStage($name,$start_location,$end_location,$distance_km,$start_date,$end_date,$id_region,$difficulty_level,$id_category,$photo){
            $query = "INSERT INTO stages (name, start_location, end_location,distance_km,start_date , end_date,category_id,region_id, region_id,difficulty_level,photo) VALUES (:name ,:start_location,:end_location,:distance_km,:start_date,:end_date,:category_id,:region_id,:difficulty_level,:photo)";
            self::$db->query($query);
            self::$db->bind(':name', $name);
            self::$db->bind(':start_location', $start_location);
            self::$db->bind(':end_location', $end_location);
            self::$db->bind(':distance_km', $distance_km);
            self::$db->bind(':start_date', $start_date);
            self::$db->bind(':end_date', $end_date);
            self::$db->bind(':category_id', $id_category);
            self::$db->bind(':region_id', $id_region);
            self::$db->bind(':difficulty_level', $difficulty_level);
            self::$db->bind(':photo', $photo);
            $status = self::$db->execute();
            return $status;
        }

    }