<?php
class ReportController extends BaseController
{

    public function index()
    {
        $allReports = Report::all();
        $data = ["allReports" => $allReports];
        $this->render("admin/reports/index", $data);
    }
    public function store()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = [
            'stage_id' => trim($_POST['stage_id']),
            'message' => trim($_POST['message']),
        ];

        $errors = [
            'stage_err' => '',
            'message_err' => '',
        ];

        $stage = Stage::find($data['stage_id']);
        if (!$stage) {
            $errors['stage_err'] = 'Stage not found.';
        }
        // validate password
        if (empty($data['message'])) {
            $errors['message_err'] = 'Please enter the reason message.';
        }

        // Make sure errors are empty (There's no errors)
        if (empty($errors['stage_err']) && empty($errors['message_err'])) {
            $report = new Report(null, user()->getId(), $stage->getId(), $data["message"]);

            if ($report->save()) {
                flash("success", "Your report has been submited successfully.");
            } else {
                flash("error", "Something went wrong.");
            }
            back();
        } else {
            // Load view with errors
            flash("error", array_first_not_null_value($errors));
            back();
        }
    }
    public function delete()
    {
        $report = Report::find($_POST['id']);
        if ($report->delete()) {
            flash("success", "Report has been deleted successfully.");
        } else {
            flash("error", "Something went wrong.");
        }
        back();
    }
}

