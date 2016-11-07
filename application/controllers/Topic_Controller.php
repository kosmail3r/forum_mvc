<?php
include_once 'application/core/Controller.php';

class Topic_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->model = new Topic_Model();
    }
    public function create_action()
    {
        if ((isset($_POST['id']) && (isset($_POST['text'])))) {
            $topicId = $_POST['id'];
            $text = $_POST['text'];
            $userId = $_SESSION['isAuthenticated'];

            $this->model->create($text, $topicId, $userId);
        }
        if (!empty($_POST)) {
            if (!empty($_POST['name'])) {
                $name = mysqli_real_escape_string(Connection::$conn, $_POST['name']);
            }
            $userId = $_SESSION['isAuthenticated'];
            $sectionId = $_POST['id'];
            $result = $this->model->NewTopic($userId, $sectionId, $name);
            if ($result) {
                echo "Тема успешно добавлена.";
            }
            header("Location: ../topic/index/{$sectionId}");
        }
    }
        public function index_action($id)
        {
            $rows = $this->model->getAllBySectionId($id);
            $data = array('id' => $id, 'rows' => $rows);
            $this->view->generate('topicheader_view.php', 'topics_view.php', 'template_view.php', $data);
        }
}