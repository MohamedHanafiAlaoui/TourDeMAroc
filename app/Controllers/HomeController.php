<?php
class HomeController extends BaseController {

    public function index()
    {
        $this->render("/");
    }

    public function details()
    {
        $this->render("/tour/index");
    }
}