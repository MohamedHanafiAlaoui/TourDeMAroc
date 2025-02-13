<?php
class CyclistController extends BaseController {

    public function index()
    {
        $this->render("fan/cyclists/index");
    }

    public function show($id)
    {
        $this->render("fan/cyclists/show");
    }

    public function profile()
    {
        $informations = Cyclist::findCyclist(1);
        $this->render("cyclist/profile/index", compact("informations"));
    }

    public function unverifiedCyclists()
    {
        $this->render("admin/unverified-cyclists/index");
    }
}