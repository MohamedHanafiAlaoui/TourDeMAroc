<?php
class StageController extends BaseController {

    public function index()
    {
        $categorys = Category::All();

        if (isLoggedIn() && user()->isAdmin()) {
            $this->render("admin/stages/index", ["categories" => $categorys]);
        }else{
            $this->render("fan/stages/index", compact("categorys"));
        }
    }

    public function show($id)
    {
        $this->render("fan/stages/show");
    }
}