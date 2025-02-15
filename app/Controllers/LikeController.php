<?php
class LikeController extends BaseController {

    public function like()
    {
        $id = $_POST["stage_id"];

        $stage = Stage::find($id);

        if(! $stage){
            flash("error", "This stage not found.");
            back();
        }

        $fan_id = user()->getId();

        $like = Like::find($fan_id, $stage->getId());
        
        if($like){
            $like->delete();
        }else{
            $newLike = new Like(null, $fan_id, $stage->getId());
            $newLike->save();
        }

        back();
    }
}

