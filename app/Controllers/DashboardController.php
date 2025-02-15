<?php
class DashboardController extends BaseController {

    public function index()
    {
        $PlatfromStatistics = Admin::platformStatiscs();
        $curentStage  =  stage::curentStage();
        $upcomingStages =  Stage::NextStages();
        $TopCyclist = Cyclist::TopCyclists(3);
        $data=["PlatfromStatistics"=>$PlatfromStatistics,"curentStage"=>$curentStage,"nextStages"=>$upcomingStages,"TopCyclists"=>$TopCyclist];
        $this->render("admin/index",$data);
    }
}