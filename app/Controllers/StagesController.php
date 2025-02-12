<?php
class StagesController extends BaseController {

    public function index()
    {
        $NumberPagination = Stage::Pagination(3);
        $categorys = Category::All();
        $this->render("fan/stages/index", compact("categorys", "NumberPagination"));
    }

    public function show($id)
    {
        $this->render("fan/stages/show");
    }

    public function fetchStages()
    {
        $search = $_GET['search'] ?? null;
        $type = $_GET['type'] ?? null;
        $distance = $_GET['distance'] ?? null;
        $NbPage = $_GET['NbPage'] ?? 0;

        $stages = Stage::fetchStage($search, $type, $distance);
        
        $rows = []; 
        if ($stages) {
            $i = 0;
            $b = 0;
            foreach($stages as $stage) {
                $rows[$i][] = $stage;
                $b++;
                if ($b >= 3) {
                    $b = 0;
                    $i++;
                }
            }
            $formerStages = array_map(function($row) use ($stages){
                return [
                    'id' => $row->getId(),
                    'Stage_name' => $row->getName(),
                    'start_location' => $row->getStLocation(),
                    'end_location' => $row->getEnLocation(),
                    'distance_km' => $row->getDistance(),
                    'start_date' => $row->getStDate(),
                    'end_date' => $row->getEnDate(),
                    'nameCategory' => $row->getNameCategory(),
                    'page_stage' => ceil(count($stages)/3)
                ];
            },$rows[$NbPage]);
            echo json_encode($formerStages);
        } else {
            echo json_encode([]);
        }
    }
}