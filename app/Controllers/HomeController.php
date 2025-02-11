<?php
class HomeController extends BaseController {

    public function index()
    {
        $nextStages = Stage::NextStages();
        $TopCyclists = Cyclist::TopCyclists(4);
        $this->render("/", compact("nextStages", "TopCyclists"));
    }

    public function details()
    {
        $this->render("/tour/index");
    }
}