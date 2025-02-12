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
        $search = $_GET['search'] ?? null;
        $teams = Team::fetchTeam($search);
        $FormerTeams = array_map(function($team) {
            return [
                'id_team' => $team->getId(),
                'name_Team' => $team->getName(),
                'country' => $team->getCountry(),
            ];
        }, $teams);

        echo json_encode($FormerTeams);
    }
}