<?php
class TimingController extends BaseController {

    public function index()
    {
        $cyclists = Cyclist::all();
        $stages = Stage::All();
        $rankings = Ranking::all();
        
        $this->render("admin/timing/index", compact("cyclists", "stages", "rankings"));
    }

    public function store()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        var_dump($_POST);

        $data = [
            'cyclist_id' => trim($_POST['cyclist_id']),
            'stage_id' => trim($_POST['stage_id']),
            'hours' => trim($_POST['hours']),
            'minutes' => trim($_POST['minutes']),
            'seconds' => trim($_POST['seconds']),
        ];

        $errors = [
            'cyclist_id_err' => '',
            'stage_id_err' => '',
            'hours_err' => '',
            'minutes_err' => '',
            'seconds_err' => '',
        ];

        
        // Validate Cyclist
        if (empty($data['cyclist_id'])) {
            $errors['cyclist_id_err'] = 'Please select a cyclist.';
        } elseif (!Cyclist::find($data['cyclist_id'])) {
            $errors['cyclist_id_err'] = 'Cyclist not found.';
        }

        // Validate Stage
        if (empty($data['stage_id'])) {
            $errors['stage_id_err'] = 'Please select a stage.';
        } elseif (!Stage::find($data['stage_id'])) {
            $errors['stage_id_err'] = 'Stage not found.';
        }
        
        // Validate Hours
        if (empty($data['hours'])) {
            $errors['hours_err'] = 'Please enter hours.';
        } elseif (!is_numeric($data['hours'])) {
            $errors['hours_err'] = 'Hours must be a number.';
        }

        // Validate Minutes
        if (empty($data['minutes'])) {
            $errors['minutes_err'] = 'Please enter minutes.';
        } elseif (!is_numeric($data['minutes'])) {
            $errors['minutes_err'] = 'Hours must be a number.';
        }

        // Validate Seconds
        if (empty($data['seconds'])) {
            $errors['seconds_err'] = 'Please enter seconds.';
        } elseif (!is_numeric($data['seconds'])) {
            $errors['seconds_err'] = 'Hours must be a number.';
        }
        if (!empty(array_filter($errors))) {
            // Load view with errors
            flash("error", array_first_not_null_value($errors));
            back();
        }
        
        // Make sure errors are empty (There's no errors)
        
        // Validate if already completed
        if (Ranking::findByCyclistAndStage($data['cyclist_id'], $data['stage_id'])) {
            $errors['cyclist_id_err'] = 'Cyclist already completed this stage.';
        }
        
        // Validate if it skip a stage
        if (!Ranking::isPreviousStageCompleted($data['cyclist_id'], $data['stage_id'])) {
            $errors['cyclist_id_err'] = 'Cyclist must complete the previous stage first.';
        }

        if (!empty(array_filter($errors))) {
            // Load view with errors
            flash("error", array_first_not_null_value($errors));
            back();
        }
        if(empty(array_filter($errors))){
            
            $total_time = sprintf('%02d:%02d:%02d', $data['hours'], $data['minutes'], $data['seconds']);
    
            // Create new Ranking
            $ranking = new Ranking(null, $data["cyclist_id"], $data["stage_id"], $total_time, null);
    
            if($ranking->save() && Ranking::refreshStagePoints($data['stage_id'])){
                // Register success
                flash('success', 'Stage completion created successfully.');
                back();
            }else{
                die('Something went wrong');
            }
        }
    }
}