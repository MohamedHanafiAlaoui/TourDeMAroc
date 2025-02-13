<?php
    class Cycliste extends User
    {
        private $nationality;
        private $birthdate;
        private $total_point;
        private $aproved;
        private $id_team;
        
        function __construct($id = null, $name = null, $email = null, $password = null,$photo = null, $created_at = null,
                                $nationality = null, $birthdate = null, $total_point = null, $aproved = null, $id_team = null
                            )
        {
            parent::__construct($id, $name, $email, $password,$photo, $created_at);
            $this->nationality = $nationality;
            $this->birthdate = $birthdate;
            $this->total_point = $total_point;
            $this->aproved = $aproved;
            $this->id_team = $id_team;
        }
        
    }