<?php
class Experience extends BaseModel
{
    private $id;
    private $photo;
    private $tour;
    private $start_date;
    private $end_date;
    private $rank;
    private $description;
    private $cyclist_id;


    public function __construct($id = null, $photo = null, $tour = null, $start_date = null, $end_date = null, $rank = null, $description = null, $cyclist_id = null)
    {
        $this->id = $id;
        $this->photo = $photo;
        $this->tour = $tour;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->rank = $rank;
        $this->description = $description;
        $this->cyclist_id = $cyclist_id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function setTour($tour)
    {
        $this->tour = $tour;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCyclistId($cyclist_id)
    {
        $this->cyclist_id = $cyclist_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPhoto()
    {
        return URLASSETS . "images/photos/" . $this->photo;
    }

    public function getTour()
    {
        return $this->tour;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function getRank()
    {
        return $this->rank;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCyclistId()
    {
        return $this->cyclist_id;
    }

    public static function All($cyclist_id)
    {
        $sql = "SELECT * FROM experience WHERE cyclist_id = :cyclist_id";

        self::$db->query($sql);
        self::$db->bind(':cyclist_id', $cyclist_id);
        $result = self::$db->results();

        $Experience = [];
        foreach ($result as $value) {
            $Experience[] = new self($value['id'], $value['photo'], $value['tour'], $value['start_date'], $value['end_date'], $value['rank'], $value['description']);
        }
        return $Experience;
    }

    public function save()
    {
        $query = "INSERT INTO experience (photo, tour, start_date, end_date, rank, description, cyclist_id) VALUES (:photo, :tour, :start_date, :end_date, :rank, :description, :cyclist_id)";
        self::$db->query($query);
        self::$db->bind(':photo', $this->photo);
        self::$db->bind(':tour', $this->tour);
        self::$db->bind(':start_date', $this->start_date);
        self::$db->bind(':end_date', $this->end_date);
        self::$db->bind(':rank', $this->rank);
        self::$db->bind(':description', $this->description);
        self::$db->bind(':cyclist_id', $this->cyclist_id);
        $status = self::$db->execute();
        return $status;
    }

    public function delete()
    {
        $query = "DELETE FROM experience WHERE id = :id";
        self::$db->query($query);
        self::$db->bind(':id', $this->id);
        return self::$db->execute();
    }



}