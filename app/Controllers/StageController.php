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
        $stage = Stage::find($id);
        $likes = $stage->likesCount();
        $isLiked = !!(Like::find(user()->getId(), $stage->getId()));

        $comments = $stage->comments();
        
        $this->render("fan/stages/show",compact("stage", "likes", "isLiked", "comments"));
    }

    public function notify($id)
    {
        $stage = Stage::find($id);

        if (!$stage) {
            flash("error", "Stage not found.");
            back();
        }

        $mail = new sendMail();

        try {
            $mail->send(user()->getEmail(), user()->getFullName(), "Stage Details", $this->notifyStageMail(user(), $stage));
            
            flash("success", "We sent you an email about the stage.");

        } catch (\Throwable $th) {
            flash("error", "Something went wrong.");
        }finally{
            back();
        }
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

    private function notifyStageMail($user, $stage)
    {
        $link = url("stages/" . $stage->getId());
    
        $html = <<<END
            <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Tour De Maroc - Stage Notification</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #f9f9f9;
                        }
                        .header {
                            background-color: #004D40;
                            color: white;
                            padding: 20px;
                            text-align: center;
                        }
                        .content {
                            background-color: white;
                            padding: 20px;
                            border-radius: 5px;
                            margin-top: 20px;
                        }
                        .stage-details {
                            margin: 20px 0;
                            padding: 15px;
                            background-color: #f0f0f0;
                            border-radius: 5px;
                        }
                        .button {
                            display: inline-block;
                            padding: 10px 20px;
                            background-color: #004D40;
                            color: white;
                            text-decoration: none;
                            border-radius: 5px;
                            margin-top: 15px;
                        }
                        .footer {
                            text-align: center;
                            margin-top: 20px;
                            padding: 20px;
                            font-size: 12px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="header">
                            <h1>Tour De Maroc</h1>
                            <p>Stage Notification</p>
                        </div>
                        
                        <div class="content">
                            <h2>Hello {$user->getFullName()},</h2>
                            
                            <p>The stage you are following is coming up soon!</p>
                            
                            <div class="stage-details">
                                <h3>{$stage->getName()}</h3>
                                <p><strong>Date:</strong> {$stage->getStDate()}</p>
                                <p><strong>Start Time:</strong> {$stage->getEnDate()}</p>
                                <p><strong>Distance:</strong> {$stage->getDistance()} km</p>
                                <p><strong>Route:</strong> {$stage->getStLocation()} -> {$stage->getEnLocation()}</p>
                            </div>
                            
                            <p>Don't miss this exciting stage!</p>
                            
                            <a href="{$link}" class="button">Follow the stage live</a>
                        </div>
                        
                        <div class="footer">
                            <p>Tour De Maroc - Follow the passion of cycling</p>
                        </div>
                    </div>
                </body>
            </html>
        END;
    
        return $html;
    }
    
}