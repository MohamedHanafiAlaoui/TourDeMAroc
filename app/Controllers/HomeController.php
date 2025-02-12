<?php
class HomeController extends BaseController {

    public function index()
    {
        $this->render("/fan/index");
    }

    public function details()
    {
        $this->render("/fan/tour/index");
    }
}