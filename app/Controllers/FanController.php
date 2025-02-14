<?php
class FanController extends BaseController {

    public function profile()
    {
        
        $Favorites = FanFavorite::All(user()->getId());
        $favorite_count = FanFavorite::favorite_count(user()->getId());
        $favorite_count = Comment::comment_count(user()->getId());
        $this->render("fan/profile/index", compact('Favorites','favorite_count','favorite_count'));
    }
}