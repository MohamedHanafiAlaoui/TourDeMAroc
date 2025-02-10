<?php
class CyclistsController extends BaseController {

    public function index()
    {
        $this->render("/cyclists/index");
    }

    public function show($id)
    {
        $this->render("/cyclists/show");
    }
}