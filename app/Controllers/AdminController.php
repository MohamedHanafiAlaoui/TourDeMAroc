<?php
class DashboardController extends BaseController {

    public function index()
    {
        $PlatfromStatistics = Admin::platformStatiscs();
        $this->render("admin/index",$PlatfromStatistics);
    }
}