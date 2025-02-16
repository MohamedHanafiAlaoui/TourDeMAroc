<?php
class CommentController extends BaseController {

    public function pendingComments()
    {
        $comments = Comment::pendingcomment();
        $data= ["comments"=>$comments];
        $this->render("admin/pending-comments/index",$data);
    }

    public function store()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = [
            'stage_id' => trim($_POST['stage_id']),
            'comment' => trim($_POST['comment']),
        ];

        $errors = [
            'stage_err' => '',
            'comment_err' => '',
        ];

        $stage = Stage::find($data['stage_id']);
        if (!$stage) {
            $errors['stage_err'] = 'Stage not found.';
        }
        // validate password
        if (empty($data['comment'])) {
            $errors['comment_err'] = 'Please enter the reason comment.';
        }

        // Make sure errors are empty (There's no errors)
        if(empty($errors['stage_err']) && empty($errors['comment_err']) ){
            $comment = new Comment(null, user()->getId(), $stage->getId(), $data["comment"]);

            if ($comment->save()) {
                flash("success", "Submited, wait for the adminstrator to publish your comment.");
            }else{
                flash("error", "Something went wrong.");
            }
            back();
        }
        else{
            // Load view with errors
            flash("error", array_first_not_null_value($errors));
            back();
        }
    }

}