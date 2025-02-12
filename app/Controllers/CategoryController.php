<?php
class CategoryController extends BaseController {

    public function index()
    {
        $this->render("admin/categories/index");
    }
}