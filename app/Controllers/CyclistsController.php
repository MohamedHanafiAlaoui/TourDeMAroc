<?php
class CyclistsController extends BaseController {

    public function index()
    {
        $this->render("/cyclists/index");
    }
}