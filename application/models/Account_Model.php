<?php
require_once('application/common/Connection.php');
Connection::connect();

class Account_Model extends Model
{
    public $name;
    public $login;
    public $password;
    public $email;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function hashPassword($password)
    {
        $result = md5($password);
        return $result;
    }


    public function checkAuth($login, $password)
    {
        $sql = "SELECT * FROM Users WHERE login='" . $login . "' AND password='" . self::hashPassword($password) . "'";
        return Connection::makeQuery($sql, true);
    }

    public function prepareData($array)
    {
        if (!empty($array)) {
            if (!empty($array['login'])) {
                $login = mysqli_real_escape_string(Connection::$conn, $array['login']);
            }

            if (!empty($array['password'])) {
                $password = mysqli_real_escape_string(Connection::$conn, $array['password']);
            }
            $info = array(
                'login' => $login,
                'password' => $password
            );
            return $info;

        }
    }

    public function register($login, $password, $name, $email)
    {
        $sql = "INSERT INTO Users (login, name, email, password) VALUES 
        ('" . $login . "','" . $name . "','" . $email . "','" . self::hashPassword($password) . "')";
        return Connection::makeQuery($sql, false);

    }

    static public function GetUserByID($id)
    {
        $sql = "SELECT * FROM Users WHERE id=$id";
        $rows = Connection::makeQuery($sql);
        return $rows;
    }

    static public function getAllUser()
    {
        $sql = "SELECT id,name,login,email FROM Users ";
        $rows = Connection::makeQuery($sql);

        foreach ($rows as $row) {
            echo "<tr><td>" . $row['name'] . "</td><td>" . $row['login'] . "</td><td>" . $row['email'] . "</td><td><a href='../../admin/user/" . $row['id'] . "'>Редактировать</a></td></tr>";

        }
    }

    public function editUserPass($oldP, $newP, $repP)
    {
        if ($newP != $repP) {
            echo "<script>
	            alert('Новые пароли не совпадают!');
                </script>";
        } else {
            $sql = "SELECT id FROM Users WHERE password='" . self::hashPassword($oldP) . "'";
            $result = Connection::makeQuery($sql, false);
            if (!$result) {
                echo "<script>
	                alert('Введен неверный пароль!');
                    </script>";
            } else {
                $id = array_shift($result);
                if (!$result) {
                    $pas = "UPDATE `users` SET `password` ='" . self::hashPassword($newP) . "' WHERE id = '" . $id . "'";
                    $upPas = Connection::makeQuery($pas, false);
                    if ($upPas) {
                        return true;
                    }
                } else {
                    echo $id;
                    return false;
                }
            }
        }

    }

    public function editUserName($name, $userId)
    {
        $sql = "UPDATE `users` SET `name` ='" . $name . "' WHERE id =" . $userId;
        $result = Connection::makeQuery($sql, false);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    static public function newUser($arr)
    {
        $login = mysqli_real_escape_string(Connection::$conn, $arr['login']);
        $name = mysqli_real_escape_string(Connection::$conn, $arr['name']);
        $email = mysqli_real_escape_string(Connection::$conn, $arr['email']);
        $password = mysqli_real_escape_string(Connection::$conn, $arr['password']);
        $sql = "INSERT INTO Users (login, name, email, password) VALUES ('" . $login . "','" . $name . "','" . $email . "','" . self::hashPassword($password) . "')";
        $result = Connection::makeQuery($sql, false);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    static public function updateUser($userId, $login, $name, $email, $password)
    {
        $sql = "UPDATE `users` SET `name` = '" . $name . "', `login` = '" . $login . "', `email` = '" . $email . "', `password` = '" . $password . "' 
        WHERE `users`.`id` =" . $userId;
        $result = Connection::makeQuery($sql, false);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    static public function deleteUser($userId)
    {
        $sql = "DELETE FROM `users` WHERE id =" . $userId;
        $sql.= "UPDATE 'Messages' SET 'user_id'=10 WHERE 'messages'.'user_id'=". $userId;
        $result = Connection::makeQuery($sql, false);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}