<?php
class CyclistController extends BaseController {

    public function index()
    {
        $this->render("cyclists/index");
    }

    public function show($id)
    {
        $this->render("cyclists/show");
    }

    public function profile()
    {
        $this->render("profile/index");
    }
}