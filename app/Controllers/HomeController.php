<?php
class HomeController extends BaseController {

    public function index()
    {
        $nextStages = Stage::NextStages();
        $this->render("/", compact("nextStages"));
    }

    public function details()
    {
        $this->render("/tour/index");
    }
}