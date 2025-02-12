<?php
class StagesController extends BaseController {

    public function index()
    {
        $categorys = Category::All();
        $this->render("/stages/index", compact("categorys"));
    }

    public function show($id)
    {
        $this->render("/stages/show");
    }

    // public function fetchStages()
    // {
    //     $search = $_GET['search'] ?? null;

    //     $teams = Team::fetchTeam($search);
    //     $FormerTeams = array_map(function($team) {
    //         return [
    //             'id_team' => $team->getId(),
    //             'name_Team' => $team->getName(),
    //             'country' => $team->getCountry(),
    //         ];
    //     }, $teams);

    //     echo json_encode($FormerTeams);
    // }
}