<?php
class Ranking extends BaseModel
{
    private $id;
    private $cyclist_id;
    private $stage_id;
    private $total_time;
    private $points_awarded;
    private $created_at;

    private Cyclist $cyclist;
    private Stage $stage;

    public function __construct($id = null, $cyclist_id = null, $stage_id = null, $total_time = null, $points_awarded = null, $created_at = null)
    {
        $this->id = $id;
        $this->cyclist_id = $cyclist_id;
        $this->stage_id = $stage_id;
        $this->total_time = $total_time;
        $this->points_awarded = $points_awarded;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getCyclistId()
    {
        return $this->cyclist_id;
    }

    public function getStageId()
    {
        return $this->stage_id;
    }

    public function getTotalTime()
    {
        return $this->total_time;
    }

    public function getPointsAwarded()
    {
        return $this->points_awarded;
    }

    public function getCyclist()
    {
        return $this->cyclist;
    }

    public function getStage()
    {
        return $this->stage;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCyclistId($cyclist_id)
    {
        $this->cyclist_id = $cyclist_id;
    }

    public function setStageId($stage_id)
    {
        $this->stage_id = $stage_id;
    }

    public function setTotalTime($total_time)
    {
        $this->total_time = $total_time;
    }

    public function setPointsAwarded($points_awarded)
    {
        $this->points_awarded = $points_awarded;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setCyclist($cyclist)
    {
        $this->cyclist = $cyclist;
    }

    public function setStage($stage)
    {
        $this->stage = $stage;
    }

    // Save method
    public function save()
    {
        $sql = "INSERT INTO ranking (cyclist_id, stage_id, total_time, points_awarded) 
                VALUES (:cyclist_id, :stage_id, :total_time, :points_awarded)";
        
        self::$db->query($sql);
        self::$db->bind(':cyclist_id', $this->cyclist_id);
        self::$db->bind(':stage_id', $this->stage_id);
        self::$db->bind(':total_time', $this->total_time);
        self::$db->bind(':points_awarded', $this->points_awarded);
        
        return self::$db->execute();
    }


    // Get rankings with the cyclist first name and last name and photo and the stage start location and end location and stage order and distance
    public static function all()
    {
        $sql = "SELECT 
                    ra.id as ranking_id, 
                    ra.cyclist_id, 
                    ra.stage_id, 
                    ra.total_time, 
                    ra.points_awarded, 
                    ra.created_at as created_at_rank, 
                    c.*, 
                    s.start_location, 
                    s.end_location, 
                    s.stage_order, 
                    s.distance_km
                FROM ranking ra
                JOIN cyclists c ON ra.cyclist_id = c.id
                JOIN stages s ON ra.stage_id = s.id
                ORDER BY s.stage_order DESC, ra.points_awarded DESC";
        
        self::$db->query($sql);
        
        $results = self::$db->results();
        $rankings = [];
        
        foreach($results as $result) {
            $ranking = new self(
                $result['id'],
                $result['cyclist_id'],
                $result['stage_id'],
                $result['total_time'],
                $result['points_awarded'],
                $result['created_at_rank']
            );
            
            $cyclist = Cyclist::mappingCyclist($result);
            
            $stage = new Stage();
            $stage->setId($result['stage_id']);
            $stage->setStLocation($result['start_location']);
            $stage->setEnLocation($result['end_location']);
            $stage->setDistance($result['distance_km']);
            $stage->setOrder($result['stage_order']);
            
            $ranking->setCyclist($cyclist);
            $ranking->setStage($stage);
            
            $rankings[] = $ranking;
        }
        
        return $rankings;   
    }

    // Utility method to find ranking by cyclist and stage
    public static function findByCyclistAndStage($cyclist_id, $stage_id)
    {
        $sql = "SELECT * FROM ranking WHERE cyclist_id = :cyclist_id AND stage_id = :stage_id";
        self::$db->query($sql);
        self::$db->bind(':cyclist_id', $cyclist_id);
        self::$db->bind(':stage_id', $stage_id);
        
        $result = self::$db->single();
        
        if($result) {
            return new self(
                $result['id'],
                $result['cyclist_id'],
                $result['stage_id'],
                $result['total_time'],
                $result['points_awarded']
            );
        }
        return null;
    }

    public static function isPreviousStageCompleted($cyclist_id, $stage_id)
    {
        if ($stage_id == 1) return true;

        $sql = "SELECT * FROM ranking WHERE cyclist_id = :cyclist_id AND stage_id = :stage_id";
        self::$db->query($sql);
        self::$db->bind(':cyclist_id', $cyclist_id);
        self::$db->bind(':stage_id', $stage_id - 1);
        
        $result = self::$db->single();
        
        return $result ? true : false;
    }

    // Get all rankings for a specific stage
    public static function getRankingsByStage($stage_id)
    {
        $sql = "SELECT * FROM ranking WHERE stage_id = :stage_id ORDER BY total_time ASC";
        self::$db->query($sql);
        self::$db->bind(':stage_id', $stage_id);
        
        $results = self::$db->results();
        $rankings = [];
        
        foreach($results as $result) {
            $rankings[] = new self(
                $result['id'],
                $result['cyclist_id'],
                $result['stage_id'],
                $result['total_time'],
                $result['points_awarded']
            );
        }
        
        return $rankings;
    }

    // Refresh stage points
    public static function refreshStagePoints($stage_id)
    {
        $rankings = self::getRankingsByStage($stage_id);
        
        if (empty($rankings)) {
            return;
        }
        
        $stage = Stage::find($stage_id);
        if (!$stage) {
            return;
        }
        
        $distance = $stage->getDistance();

        $difficultyMultiplier = 1 + ($distance / 10);
        
        $totalRankings = count($rankings);
        
        foreach ($rankings as $index => $ranking) {

            $basePoints = $totalRankings - $index;
            
            $pointsAwarded = round($basePoints * $difficultyMultiplier);
            
            $ranking->setPointsAwarded($pointsAwarded);
            
            $sql = "UPDATE ranking SET points_awarded = :points_awarded WHERE id = :id";
            self::$db->query($sql);
            self::$db->bind(':points_awarded', $pointsAwarded);
            self::$db->bind(':id', $ranking->getId());
            self::$db->execute();
        }

        return true;
    }
}