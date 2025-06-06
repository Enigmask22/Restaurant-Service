<?php 

class CommentController extends Controller {
    private $model_comment; private $comment; private $url;

    public function __construct() {
        $this->model_comment = $this->model('commentModel');
        $this->comment = json_decode($this->model_comment->getAll());
        $this->url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    }
    public function index() {
        $this->comment = json_decode($this->model_comment->getAll());
        $this->renderAdmin('layout', ['page' => 'tabs/comment/comment', 'comments' => $this->comment]);
    }
    public function viewData($data) {
        $this->renderAdmin('layout', ['page' => 'tabs/comment/data', 'result' => $data]);
    }
    public function deleteData($data) {
        $this->renderAdmin('layout', ['page' => 'tabs/comment/deleteData', 'result' => $data]);
    }

    public function addReply($comid) {
        if(isset($_POST['resSubmit'])) {
            $reply = $_POST['response'];
            $this->viewData($this->model_comment->addReply($comid, $reply));
        }
    }
    public function respond($comid = null) {
        if($comid == null) {
            header('Location:'. $this->url . "admin/comment");
        }
        $data = json_decode($this->model_comment->getAllByComID($comid));
        $this->renderAdmin('layout', ['page' => 'tabs/comment/reply', 'comment' => $data]);
    }
    public function delete($comid = null) {
        if($comid == null) {
            header('Location:' . $this->url . "admin/comment");
        }
        $this->viewData($this->model_comment->deleteComment($comid));
    }
}