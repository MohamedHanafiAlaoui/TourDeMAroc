<?php
class DashboardController extends BaseController {

    public function index()
    {
        $PlatfromStatistics = Admin::platformStatiscs();
        $curentStage  =  stage::curentStage();
        $upcomingStages =  Stage::NextStages();
        $data=["PlatfromStatistics"=>$PlatfromStatistics,"curentStage"=>$curentStage,"nextStages"=>$upcomingStages];
        $this->render("admin/index",$data);
    }
}