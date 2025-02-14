<?php

class LikeController extends BaseController
{
    public function toggleLike()
    {
        if (!isset($_SESSION['fan_id'])) {
            echo json_encode(['error' => 'User not authenticated']);
            return;
        }

        $id_fan = $_SESSION['fan_id'];
        $stage_id = $_POST['stage_id'] ?? null;

        if (!$stage_id) {
            echo json_encode(['error' => 'Missing stage ID']);
            return;
        }

        $like = new Like(null, $id_fan, $stage_id);

        if ($like->isLikedByFan()) {
            $like->remove();
            $liked = false;
        } else {
            $like->save();
            $liked = true;
        }

        $likeCount = Like::countLikes($stage_id);

        echo json_encode([
            'liked' => $liked,
            'likeCount' => $likeCount
        ]);
    }

    public function getLikeCount($params)
    {
        $stage_id = $params['id'] ?? null;

        if (!$stage_id) {
            echo json_encode(['error' => 'Missing stage ID']);
            return;
        }

        $likeCount = Like::countLikes($stage_id);
        echo json_encode(['likeCount' => $likeCount]);
    }
}
?>