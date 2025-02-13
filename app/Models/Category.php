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

        public function getIdCategory()
        {
            return $this->id_category;
        }
        public function getNameCategory()
        {
            return $this->name;
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