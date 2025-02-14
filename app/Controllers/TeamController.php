<?php 
    class TeamController extends BaseController 
    {
        public function fetchTeam()
        {
            $search = $_GET['search'] ?? null;
            $teams = Team::fetchTeam($search);
            $FormerTeams = array_map(function($team) {
                return [
                    'id_team' => $team->getId(),
                    'name_Team' => $team->getName(),
                ];
            }, $teams);
            echo json_encode($FormerTeams);
        }
    }