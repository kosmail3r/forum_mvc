<?php

class Admin_Model extends Model
{

    public function hashPassword($password)
    {
        $result = md5($password);
        return $result;
    }

    public function checkAuth($login, $password)
    {
        $sql = "SELECT id FROM Admins WHERE login='" . $login . "' AND password='" . self::hashPassword($password) . "'";
        return Connection::makeQuery($sql, true);
    }
}