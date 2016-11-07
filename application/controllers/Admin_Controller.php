<?php
include_once 'application/core/Controller.php';
if ($_SERVER['REQUEST_URI'] == '/admin/signin') {
    Connection::connect();
}

class Admin_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new Admin_Model();
    }

    public function index_action()
    {

        $this->view->generate('adminheader_view.php', 'admin_view.php', 'templateadmin_view.php');
    }

    public function signin_action()
    {
        if (!empty($_POST)) {
            echo $_POST['login'];
            if (!empty($_POST['login'])) {
                $login = mysqli_real_escape_string(Connection::$conn, $_POST['login']);
            }

            if (!empty($_POST['password'])) {
                $password = mysqli_real_escape_string(Connection::$conn, $_POST['password']);
            }
            $t = $this->model->checkAuth($login, $password);
            echo $login;
            echo $password;
            var_dump($t);
            if (!(empty($t))) {

                $_SESSION ['isRoot'] = $t[0]['id'];
                $_SESSION ['login'] = $login;
                if (!empty($_SESSION['isRoot'])) {
                    header('Location:../../admin/index');
                }
            } else {

                $this->view->generate('signin_header_view.php', 'signin_view.php', 'templateadmin_view.php');
            }
        } else {
            $this->view->generate('signin_header_view.php', 'signin_view.php', 'templateadmin_view.php');
        }

    }

    public function logout_action()
    {
        unset ($_SESSION['isRoot'], $_SESSION ['login']);

        header("location: ../../admin/index");
    }

    public function section_action()
    {
        {
            $this->model = new Section_Model();
            $data = Section_Model::getAllSections();
            $this->view->generate('adminheader_view.php', 'admin_sectionedit_view.php', 'templateadmin_view.php', $data);
        }
    }

    public function sections_action($id)
    {

        $data = Section_Model::showById($id);

        $this->view->generate('adminheader_view.php', 'admin_sectionsedit_view.php', 'templateadmin_view.php', $data);
        // обработка апдейта формы
        if (!empty($_POST)) {
            if (!empty($_POST['delete'])) {
                $result = Section_Model::deleteSection($id);
                if ($result) {
                    echo "Раздел успешно удален.";
                }
            }

            if (!empty($_POST['name'])) {
                $name = mysqli_real_escape_string(Connection::$conn, $_POST['name']);
            }
            if (!empty($_POST['user_id'])) {
                $user_id = mysqli_real_escape_string(Connection::$conn, $_POST['user_id']);
            }
            $result = Section_Model::updateSection($id, $name, $user_id);
            if ($result) {
                echo "<script> alert('Данные раздела успешно изменены.');</script>";
            }
        }
    }


    public function topics_action()
    {
        {
            $this->view->generate('adminheader_view.php', 'admin_topics_view.php', 'templateadmin_view.php');
        }
    }

    public function topic_action($id)
    {
        $data = Topic_Model::getTopicById($id)[0];
        $this->view->generate('adminheader_view.php', 'admin_topic_view.php', 'templateadmin_view.php', $data);

        if (!empty($_POST)) {
            if (!empty($_POST['delete'])) {
                $res = Topic_Model::deleteTopic($id);
                if ($res) {
                    echo "<script> alert('Тема успешно удалена.');</script>";
                }
            } else {
                if (!empty($_POST['name'])) {
                    $name = mysqli_real_escape_string(Connection::$conn, $_POST['name']);
                }
                if (!empty($_POST['user_id'])) {
                    $user_id = mysqli_real_escape_string(Connection::$conn, $_POST['user_id']);
                }
                if (!empty($_POST['section_id'])) {
                    $section_id = mysqli_real_escape_string(Connection::$conn, $_POST['section_id']);
                }

                $result = Topic_Model::updateTopic($id, $name, $user_id, $section_id);
                if ($result) {
                    echo "<script> alert('Данные темы успешно изменены.');</script>";
                }
            }
        }

    }

    public function users_action()
    {
        $this->view->generate('adminheader_view.php', 'admin_users_view.php', 'templateadmin_view.php');
    }

    public function user_action($id)
    {
        $data = Account_Model::GetUserByID($id)[0];
        $this->view->generate('adminheader_view.php', 'admin_user_view.php', 'templateadmin_view.php', $data);

        if (!empty($_POST)) {
            if (!empty($_POST['delete'])) {
                $result = Account_Model::deleteUser($id);
                if ($result) {
                    echo "<script> alert('Пользователь успешно удален.');</script>";
                }
            } else {
                if (!empty($_POST['login'])) {
                    $login = mysqli_real_escape_string(Connection::$conn, $_POST['login']);
                }
                if (!empty($_POST['name'])) {
                    $name = mysqli_real_escape_string(Connection::$conn, $_POST['name']);
                }
                if (!empty($_POST['email'])) {
                    $email = mysqli_real_escape_string(Connection::$conn, $_POST['email']);
                }
                if (!empty($_POST['password'])) {
                    $password = mysqli_real_escape_string(Connection::$conn, $_POST['password']);
                    $password = md5($password);
                } else {
                    $password = $data['password'];
                }

                $result = Account_Model::updateUser($id, $login, $name, $email, $password);
                if ($result) {
                    echo "<script> alert('Данные пользователя успешно изменены.');</script>";
                }
            }
        }
    }
}