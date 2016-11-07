<?php

class Users
{
    private $name;
    private $login;
    private $password;
    private $email;


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
        return $this->name;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    static public function hashPassword($password)
    {
        $result = md5($password);
        return $result;
    }

    static public function checkAuth($login, $password)
    {
        $sql = "SELECT id FROM Users WHERE login='" . $login . "' AND password='" . self::hashPassword($password) . "'";
        return Connection::makeQuery($sql, false);
    }

    static public function getUserId($login)
    {
        $sql = "SELECT id FROM Users WHERE login='" . $login . "'";
        $rows = Connection::makeStr($sql);
        $result = array_shift($rows);
        return $result;
    }

    static public function getUserName($login)
    {
        $sql = "SELECT name FROM Users WHERE login='" . $login . "'";
        $rows = Connection::makeStr($sql);
        $result = array_shift($rows);
        return $result;
    }

    static public function getUserNameById($userID)
    {
        $sql = "SELECT name FROM Users WHERE id='" . $userID . "'";
        $rows = Connection::makeStr($sql);
        $result = array_shift($rows);
        return $result;
    }

    static public function newUser($arr)
    {
        $login = mysqli_real_escape_string(Connection::$conn, $arr['login']);
        $name = mysqli_real_escape_string(Connection::$conn, $arr['name']);
        $email = mysqli_real_escape_string(Connection::$conn, $arr['email']);
        $password = mysqli_real_escape_string(Connection::$conn, $arr['password']);
        $sql = "INSERT INTO Users (login, name, email, password) VALUES ('" . $login . "','" . $name . "','" . $email . "','" . self::hashPassword($password) . "')";
        $result = Connection::addToDB($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    static public function editUserName($name, $userId)
    {
        $sql = "UPDATE `users` SET `name` ='" . $name . "' WHERE id =" . $userId;
        $result = Connection::addToDB($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    static public function editUserPass($oldP, $newP, $repP)
    {
        if ($newP != $repP) {
            echo "<marquee width=\"51%\" direction=\"up\" behavior=\"alternate\"><marquee direction=\"right\" behavior=\"alternate\"><h3>Новые пароли не совпадают!</h3></marquee></marquee>";
        } else {
            $sql = "SELECT id FROM Users WHERE password='" . self::hashPassword($oldP) . "'";
            $result = Connection::makeStr($sql);
            if (!$result) {
                echo "<marquee width=\"51%\" direction=\"up\" behavior=\"alternate\"><marquee direction=\"right\" behavior=\"alternate\">
                <h3>Введен неверный пароль!</h3></marquee></marquee>";
            } else {
                $id = array_shift($result);
                if (!$result) {
                    $pas = "UPDATE `users` SET `password` ='" . self::hashPassword($newP) . "' WHERE id = '" . $id . "'";
                    $upPas = Connection::addToDB($pas);
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

}