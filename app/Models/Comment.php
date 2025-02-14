<?php



class Comment extends BaseModel
{

    public static function comment_count(int $id)
    {
        $sql = "SELECT COUNT(*) AS comment_count 
                FROM comments 
                WHERE id_fan = :id_fan";
        self::$db->query($sql);
        
        self::$db->bind(':id_fan', $id);
        $result = self::$db->single();
        $count =$result;
        return $count["comment_count"];   
    }
}