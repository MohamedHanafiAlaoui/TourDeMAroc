<?php
class ResetPasswordController extends BaseController {

    public function index()
    {
        $this->render("auth/forget-password");
    }

    public function reset()
    {
        $this->render("auth/reset-password");
    }
}