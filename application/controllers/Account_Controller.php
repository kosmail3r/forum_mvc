<?php
include_once 'application/core/Controller.php';

class Account_Controller extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->model = new Account_Model();
    }

    public function index_action()
    {
        $userId = $_SESSION ['isAuthenticated'];
        if (!empty($_POST)) {
            if (!empty($_POST['name'])) {
                $name = mysqli_real_escape_string(Connection::$conn, $_POST['name']);
                $result = $this->model->editUserName($name, $userId);
                if ($result) {
                    echo "<script>
	alert('Имя пользователя успешно обновлено.');
</script>";
                }
            }

            if (!empty($_POST['oldpassword']) && !empty($_POST['password']) && !empty($_POST['reppassword'])) {
                $oldP = mysqli_real_escape_string(Connection::$conn, $_POST['oldpassword']);
                $newP = mysqli_real_escape_string(Connection::$conn, $_POST['password']);
                $repP = mysqli_real_escape_string(Connection::$conn, $_POST['reppassword']);
                $result = $this->model->editUserPass($oldP, $newP, $repP);
                if ($result) {
                    echo "<script>
	alert('Пароль пользователя успешно изменен.');
</script>";
                }
            }

        }

        $this->view->generate('header_view.php', 'account_view.php', 'template_view.php');
    }

    public function login_action()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['login'])) {
                $login = mysqli_real_escape_string(Connection::$conn, $_POST['login']);
            }

            if (!empty($_POST['password'])) {
                $password = mysqli_real_escape_string(Connection::$conn, $_POST['password']);
            }
            $t = $this->model->checkAuth($login, $password);
            var_dump($t);
            if (!(empty($t))) {

                $_SESSION ['isAuthenticated'] = $t[0]['id'];
                $_SESSION ['login'] = $login;
                if (!empty($_SESSION['isAuthenticated'])) {
                    header('Location:../../section/index');
                }
            } else {

                $this->view->generate('header_view.php', 'login_view.php', 'template_view.php', false);
            }

        } else {
            $this->view->generate('header_view.php', 'login_view.php', 'template_view.php');
        }

    }

    public function registration_action()
    {
        if (!empty($_POST)) {

            $arr = $_POST;
            $login = mysqli_real_escape_string(Connection::$conn, $arr['login']);
            $name = mysqli_real_escape_string(Connection::$conn, $arr['name']);
            $email = mysqli_real_escape_string(Connection::$conn, $arr['email']);
            $password = mysqli_real_escape_string(Connection::$conn, $arr['password']);
            $password2 = mysqli_real_escape_string(Connection::$conn, $arr['password2']);
            if ($password === $password2) {
                $this->model->register($login, $password, $name, $email);
                $_SESSION ['isAuthenticated'] = true;
                $_SESSION ['login'] = $login;
                header("location: ../../section/index");
            }


        } else {
            $this->view->generate('header_view.php', 'registration_view.php', 'template_view.php');
        }
    }

    public function logout_action()
    {
        unset ($_SESSION['isAuthenticated'], $_SESSION ['login']);

        header("location: ../../section/index");
    }
}



