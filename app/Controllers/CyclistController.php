<?php
class CyclistController extends BaseController
{

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
        $cyclist = Cyclist::findCyclist(1);
        $this->render("cyclist/profile/index", compact("cyclist"));
    }

    public function unverifiedCyclists()
    {
        $this->render("admin/unverified-cyclists/index");
    }

    public function ranking()
    {
        $topCyclists = Cyclist::getTopCyclists(3);  

        $allCyclists = Cyclist::getTopCyclists(); 

        $this->render("/fan/ranking/index", compact("topCyclists", "allCyclists"));
    }
}
