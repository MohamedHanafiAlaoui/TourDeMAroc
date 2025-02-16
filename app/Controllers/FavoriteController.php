<?php
class FavoriteController extends BaseController {

    public function favorite()
    {
        $favorite = new Favorite(user()->getId(), $_POST['favorite']);
        $favorite->save();
        redirect("cyclists/".$_POST['favorite']);
    }
}