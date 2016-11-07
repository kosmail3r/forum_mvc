<?php

require_once('application/models/topic_model.php');

class Message_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Message_Model();
    }

    public function create_action()
    {
        $topicId = "";
        if ((isset($_POST['id']) && (isset($_POST['text'])))) {
            $topicId = $_POST['id'];
            $text = $_POST['text'];
            $userId = $_SESSION['isAuthenticated'];
            $this->model->create($text, $topicId, $userId);
        }
        header("Location: ../message/index/{$topicId}");
    }

    public function index_action($id)
    {
        $rows = $this->model->showAllByTopicId($id);
        $topicModel = new Topic_Model();
        $section_id = $topicModel->getById($id)['section_id'];
        $data = array('id' => $id, 'sectionId' => $section_id, 'rows' => $rows);
        $this->view->generate('messagesheader_view.php', 'messages_view.php', 'template_view.php', $data);
    }
}