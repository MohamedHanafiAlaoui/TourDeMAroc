<?php

    class Category extends BaseModel
    {
        protected $id_category;
        protected $name;

        public function __construct($id_category = null, $name = null)
        {
            $this->id_category = $id_category;
            $this->name = $name;
        }

        public function setIdCategory($id_category)
        {
            $this->id_category = $id_category;
        }
        public function setNameCategory($name)
        {
            $this->name = $name;
        }

        public function getId()
        {
            return $this->id_category;
        }
        public function getName()
        {
            return $this->name;
        }
        public function save()
    {
        $query = "INSERT INTO categories (name) VALUES (:name) RETURNING id";
        self::$db->query($query);
        self::$db->bind(":name", $this->name);
        $result = self::$db->single();
        $this->id_category = $result["id"];
        $this->name= $result["name"];
        return true;
    }
    
    public static function find(int $id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $id);

        $result = self::$db->single();

        if ($result) {
            return new self( $result["id"], $result["name"]);
        }
        return null; // Return null if category not found
    }
    public function delete()
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        self::$db->query($sql);
        self::$db->bind(':id', $this->id_category);
        return self::$db->execute();
    }
        public static function All()
        {
            $sql = "SELECT * FROM categories";

            self::$db->query($sql);
            $result = self::$db->results();

            $categorys = [];
            foreach ($result as $value) {
                $categorys[] = new self($value['id'], $value['name']);
            }
            return $categorys;
        }
    }