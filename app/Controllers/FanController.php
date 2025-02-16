<?php
class FanController extends BaseController {

    public function profile()
    {
        
        $Favorites = Favorite::All(user()->getId());
        $favorite_count = Favorite::favorite_count(user()->getId());
        $favorite_count = Comment::comment_count(user()->getId());
        $this->render("fan/profile/index", compact('Favorites','favorite_count','favorite_count'));
    }

    public function favorite()
    {
        $favorite = new Favorite(user()->getId(), $_POST['favorite']);
        $favorite->save();
        redirect("cyclists/".$_POST['favorite']);
    }
}