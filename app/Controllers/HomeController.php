<?php
class HomeController extends BaseController {

    public function index()
    {
        $nextStages = Stage::NextStages();
        $TopCyclists = Cyclist::TopCyclists(4);
        $this->render("/", compact("nextStages", "TopCyclists"));
    }

    public function details()
    {
        $Stages = Stage::show();
        $this->render("/tour/index", compact("Stages"));
    }

    public function fetchTeam()
    {
        $teams = Team::fetchTeam();
        $FormerTeams = array_map(function($team) {
            return [
                'id_team' => $team->getId(),
                'name_Team' => $team->getId(),
                'country' => $team->getId(),
            ];
        }, $teams);

        echo json_encode($FormerTeams);
    }
}