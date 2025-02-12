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
                $stages[] = new self($value['id_stage'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['id_region'], $value['difficulty_level'], $value['id_category']);
            }
            return $stages;
        }

        public static function NextStages()
        {
            $sql = "SELECT s.*, r.id_region, r.name AS name_region FROM stages s JOIN regions r ON s.id_region = r.id_region ORDER BY s.start_date DESC LIMIT 3";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];

            foreach ($result as $key => $value) {
                $class = new self($value['id_stage'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['id_region'], $value['difficulty_level'], $value['id_category']);
                $class->setNameCategory($value['name_region']);

                $stages[] = $class; 
            }
            return $stages;
        }

        public static function show()
        {
            $sql = "SELECT s.*, c.name AS categoryname FROM stages s JOIN categories c ON s.id_category = c.id_category ORDER BY s.start_date DESC";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];
            foreach ($result as $value) {
                $class = new self($value['id_stage'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['id_region'], $value['difficulty_level'], $value['id_category']);
                $class->setNameCategory($value['categoryname']);
                
                $stages[] = $class;
            }
            return $stages;
        }

        public static function fetchStage($search = null, $categoryFilter = null, $distanceFilter = null)
        {
            $sql = "SELECT s.*, c.id_category, c.name AS category_name FROM stages s 
                    JOIN categories c ON c.id_category = s.id_category WHERE 1 = 1"; 
            self::$db->query($sql);        

            if ($search) {
                $sql .= " AND s.name LIKE :name";
                self::$db->bind(':name', $search);
            }
            if ($categoryFilter) {
                $sql .= " AND s.category_name = :id_category";
                self::$db->bind(':id_category', $categoryFilter);
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
                $class = new self($value['id_stage'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['id_region'], $value['difficulty_level'], $value['id_category']);
                $class->setNameCategory($value['nameCategory']);

                $stages[] = $class; 
            }
            return $stages;
        }

        public static function Pagination($NbPage) 
        {
            $sql = "SELECT COUNT(*) FROM stages";
            self::$db->query($sql);

            $result = self::$db->result();
            return ceil($result['COUNT(*)'] / $NbPage);
        }

    }