<?php
class HomeController extends BaseController {

    public function index()
    {
        $nextStages = Stage::NextStages();
        $TopCyclists = Cyclist::TopCyclists();
        $this->render("fan/index", compact("nextStages", "TopCyclists"));
    }

    public function details()
    {
        $Stages = Stage::show();
        $this->render("fan/tour/index", compact("Stages"));
    }

    

    
}