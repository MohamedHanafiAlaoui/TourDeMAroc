<?php
class StageController extends BaseController {

    public function index()
    {
        $NumberPagination = Stage::Pagination(3);
        $categorys = Category::All();
        if (isLoggedIn() && user()->isAdmin()) {
            $this->render("admin/stages/index", ["categories" => $categorys]);
        }else{
            $this->render("fan/stages/index", compact("categorys", "NumberPagination"));
        }
    }

    public function show($id)
    {
        $details = Stage::find($id);
        $this->render("fan/stages/show",compact("details"));
    }

    public function fetchStages()
    {
        $search = $_GET['search'] ?? null;
        $type = $_GET['type'] ?? null;
        $distance = $_GET['distance'] ?? null;
        $NbPage = $_GET['NumberPage'] ?? 0;

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