<?php
class StagesController extends BaseController {

    public function index()
    {
        $this->render("/stages/index");
    }

    public function show($id)
    {
        $this->render("/stages/show");
    }
}