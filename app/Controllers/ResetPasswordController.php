<?php
class ResetPasswordController extends BaseController {

    public function index()
    {
        $this->render("forget-password");
    }

    public function reset()
    {
        $this->render("reset-password");
    }
}