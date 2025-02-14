<?php
class CommentController extends BaseController {

    public function pendingComments()
    {
        $this->render("admin/pending-comments/index");
    }
}