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
        private $Description;
        private $order;

        private $nameCategory;
        private $nameRegion;
        private $photo;
        public function __construct($id_stage = null, $name = null, $start_location = null, $end_location = null, $distance_km = null, $start_date = null, $end_date = null, $id_region = null, $difficulty_level = null, $id_category = null,$photo=null , $Description=null,$order = null)
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
            $this->Description = $Description;
            $this->order = $order;
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

        public function setDescription($Description)
        {
            $this->Description = $Description;
        }
          
        public function setNameCategory($nameCategory)
        {
            $this->nameCategory = $nameCategory;
        }

        public function setNameRegion($nameRegion)
        {
            $this->nameRegion = $nameRegion;
        }

      
        public function setPhoto($photo)
        {
            $this->photo = $photo;
        }
        public function setOrder($order)
        {
            $this->order = $order;
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
            return number_format($this->distance_km);
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

        public function getDescription()
        {
            return $this->Description;
        }

        public function getNameCategory()
        {
            return $this->nameCategory;
        }

        public function getNameRegion()
        {
            return $this->nameRegion;
        }

        public function getPhoto()
        {
            return URLASSETS . "images/photos/" . ($this->photo ?? "defaultStage.png");
        }
            
        public function getOrder()
        {
            return $this->order;
        }

        public static function All()
        {
            $sql = "SELECT S.*, C.name AS category_name, R.name AS region_name
                        FROM stages S
                        JOIN categories C ON S.category_id = C.id
                        JOIN regions R ON S.region_id = R.id
                        ORDER BY S.stage_order";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];
            foreach ($result as $value) {
                $class = new self($value['id'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['region_id'], $value['difficulty_level'], $value['category_id'],$value['photo'],$value['description'],$value['stage_order']);
                $class->setNameCategory($value["category_name"]);
                $class->setNameRegion($value["region_name"]);
                $class->setOrder($value["stage_order"]);
                $stages[] = $class;
            }
            return $stages;
        }

        public function save(){
            $query = "INSERT INTO stages (name, start_location, end_location, distance_km, start_date, end_date, category_id, region_id, difficulty_level, photo, description,stage_order)
             VALUES (:name, :Start_location, :end_location, :distance_km, :start_date, :end_date, :category_id, :region_id, :difficulty_level, :photo, :description,:order)";
            self::$db->query($query);
            self::$db->bind(':name', $this->name);
            self::$db->bind(':Start_location', $this->start_location);
            self::$db->bind(':end_location', $this->end_location);
            self::$db->bind(':distance_km', $this->distance_km);
            self::$db->bind(':start_date', $this->start_date);
            self::$db->bind(':end_date', $this->end_date);
            self::$db->bind(':category_id', $this->id_category);
            self::$db->bind(':region_id', $this->id_region);
            self::$db->bind(':difficulty_level', $this->difficulty_level);
            self::$db->bind(':description', $this->Description);
            self::$db->bind(':photo', $this->photo);
            self::$db->bind(':order', $this->order);
            return self::$db->execute();
        }

        public static function NextStages()
        {
            $sql = "SELECT s.*, r.id, r.name AS name_region FROM stages s JOIN regions r ON s.region_id = r.id ORDER BY s.start_date LIMIT 3";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];

            foreach ($result as $key => $value) {
                $class = new self($value['id'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['region_id'], $value['difficulty_level'], $value['category_id'],$value['photo'],$value['description'],$value['stage_order']);
                $class->setNameCategory($value['name_region']);

                $stages[] = $class; 
            }
            return $stages;
        }

        public static function show()
        {
            $sql = "SELECT s.*, c.name AS categoryname FROM stages s JOIN categories c ON s.category_id = c.id ORDER BY s.start_date";

            self::$db->query($sql);
            $result = self::$db->results();

            $stages = [];
            foreach ($result as $value) {
                $class = new self($value['id'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['region_id'], $value['difficulty_level'], $value['category_id'],$value['photo'],$value['description'],$value['stage_order']);
                $class->setNameCategory($value['categoryname']);
                
                $stages[] = $class;
            }
            return $stages;
        }

        public static function fetchStage($search = null, $categoryFilter = null, $distanceFilter = null)
        {
            $sql = "SELECT s.*, c.id AS category_id, c.name AS category_name FROM stages s 
                    JOIN categories c ON c.id= s.category_id WHERE 1 = 1"; 
            self::$db->query($sql);        
            $params = array();

            if ($search) {
                $sql .= " AND s.name ILIKE :name";
                $params[':name'] = "%" . $search . "%";
            }
            if ($categoryFilter) {
                $sql .= " AND s.category_id = :category_id";
                $params[':category_id'] = $categoryFilter;
            }
            if ($distanceFilter) {
                switch ($distanceFilter) {
                    case "short":
                        $sql .= " AND s.distance_km < 100";
                        break;
                    
                    case "medium":
                        $sql .= " AND s.distance_km >= 100 AND s.distance_km <= 200 ";
                        break;
                
                    case "long":
                        $sql .= " AND s.distance_km > 200 ";
                        break;
                }
            }

            $sql .= " ORDER BY s.start_date DESC";

            self::$db->query($sql);
            foreach ($params as $key => $value) {
                self::$db->bind($key, $value);
            }
            $result = self::$db->results();
            
            $stages = [];

            foreach ($result as $key => $value) {
                $class = new self($value['id'], $value['name'], $value['start_location'], $value['end_location'], $value['distance_km'], $value['start_date'], $value['end_date'], $value['region_id'], $value['difficulty_level'], $value['category_id'],$value['photo'],$value['description'],$value['stage_order']);
                $class->setNameCategory($value['category_name']);

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

        //add find
        public static function find(int $id)
        {
            $sql = "SELECT s.*, c.name AS category_name, r.name AS region_name
                  
                    FROM stages s
                    LEFT JOIN categories c ON s.category_id = c.id
                    LEFT JOIN regions r ON s.region_id = r.id
                    WHERE s.id = :id";
            self::$db->query($sql);
            
            self::$db->bind(':id', $id);
            $result = self::$db->single();
            if (!$result) return null;
            $stage = new self($result['id'], $result['name'], $result['start_location'], $result['end_location'], $result['distance_km'], $result['start_date'], $result['end_date'], $result['region_id'], $result['difficulty_level'], $result['category_id'],$result['photo'],$result['description'],$result['stage_order']);
            $stage->setNameCategory($result['category_name']);
            $stage->setNameRegion($result['region_name']);
            $stage->setDescription($result['description']);
            return $stage;   
        }
        public static function CountSatges(){
            $sql = "SELECT COUNT(*) as totale FROM stages";
            self::$db->query($sql);
            $result = self::$db->single()["totale"];
            return $result;
        }
     
        public static function Pagination($NbPage) 
        {
            $sql = "SELECT COUNT(*) FROM stages";
            self::$db->query($sql);

            $result = self::$db->results();
            return ceil($result[0]['count'] / $NbPage);
        }
        public static function curentStage(){
            $query = "SELECT * FROM stages S WHERE CURRENT_DATE BETWEEN S.start_date AND S.end_date LIMIT 1";
            self::$db->query($query);
            $result = self::$db->single();
            if ($result) {
                $stage = new Stage($result['id'], $result['name'], $result['start_location'], $result['end_location'], $result['distance_km'], $result['start_date'], $result['end_date'], $result['region_id'], $result['difficulty_level'], $result['category_id'],$result['photo'],$result['description'],$result['stage_order']);
                return $stage;
            }
            else{
                return null;
            }
        }

        public function likesCount()
        {
            $sql = "SELECT COUNT(*) as likes_count
                    FROM stage_likes
                    WHERE stage_id = :id";

            self::$db->query($sql);
            self::$db->bind(':id', $this->id_stage);

            $result = self::$db->single();

            return $result["likes_count"];
        }

        public function comments()
        {
            $sql = "SELECT c.id as comment_id, c.created_at as comment_created_at, c.*, f.*
                    FROM comments c
                    JOIN fans f ON f.id = c.id_fan
                    WHERE c.stage_id = :stage_id
                    ORDER BY c.created_at DESC";

            self::$db->query($sql);
            self::$db->bind(':stage_id', $this->id_stage);

            $results = self::$db->results();

            $comments = [];

            foreach ($results as $result) {
                $comments[] = new Comment($result["comment_id"], $result["id_fan"], $result["stage_id"], $result["content"], $result["comment_created_at"], User::mapping($result));
            }

            return $comments;
        }
        public function delete($id){
            $query = "DELETE from stages where id = :id ";
            self::$db->query($query);
            self::$db->bind(":id", $id);
            return self::$db->execute();
        }
        
    public function rankings($id)
    {
        $sql = "select r.total_time as time , r.points_awarded as poin ,
                c.first_name as first_name , c.team as team ,
                c.last_name as last_name  from ranking r
                left join cyclists c on c.id =r.cyclist_id  
                where r.stage_id = :stage_id ORDER BY
                r.total_time ";

        self::$db->query($sql);
        self::$db->bind(':stage_id', $id);

        $results = self::$db->results();

        $ranking = [];

        foreach ($results as $result) {
            $class = new Ranking(  null, null,  null, $result["time"] , $result["poin"] , null);
            $class-> setlast_name($result["last_name"]);
            $class->setfirst_name($result["first_name"]);
            $class->setteam($result["team"]);
            $ranking[] = $class;
        }

        return $ranking;
    }
    }