<?php
class StagesController extends BaseController {

    public function index()
    {
        $this->render("fan/stages/index");
    }

    public function show($id)
    {
        $this->render("fan/stages/show");
    }
}