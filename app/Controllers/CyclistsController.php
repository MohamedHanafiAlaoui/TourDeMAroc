<?php
class CyclistsController extends BaseController {

    public function index()
    {
        $this->render("/cyclists/index");
    }

    public function profile()
    {
        $this->render("/cyclist/profile/index");
    }

    public function show($id)
    {
        $this->render("/cyclists/show");
    }
}