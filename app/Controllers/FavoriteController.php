<?php
class FavoriteController extends BaseController {

    public function favorite()
    {
        $id = $_POST['favorite'];
        $favorite = new Favorite(user()->getId(), $id);
        if (Favorite::find(user()->getId(), $id)) {
            $favorite->delete();
        } else {
            $favorite->save();
        }
        redirect("cyclists/".$id);
    }
}