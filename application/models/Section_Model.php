<?php
require('application/common/Connection.php');
Connection::connect();

class Section_Model extends Model
{
    public function getAll()
    {
        $sql = "SELECT * FROM Section ORDER BY created_at";
        $rows = Connection::makeQuery($sql);
        return $rows;
    }

    public function getByID($id)
    {
        $sql = "SELECT * FROM Section WHERE id=$id";
        $rows = Connection::makeQuery($sql);
        return $rows[0]['name'];
    }

    static public function getAllSections()
    {
        $sql = "SELECT * FROM Section ORDER BY created_at";
        $rows = Connection::makeQuery($sql);
        return $rows;
    }

    static public function showById($id)
    {
        $sql = "SELECT * FROM Section WHERE id=$id";
        $rows = Connection::makeQuery($sql);
        return $rows[0];
    }

    public static function deleteSection($id)
    {
        Message_Model::DeleteMsgIdBySection($id);
        $sql = "DELETE FROM `Topics` WHERE section_id =" . $id;
        $sql .= "DELETE FROM `Section` WHERE id =" . $id;
        $result = Connection::makeQuery($sql, false);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateSection($id, $name, $user_id)
    {
        $sql = "UPDATE `Section` SET `name` = '" . $name . "', `user_id` = '" . $user_id . "' WHERE `section`.`id` =" . $id;
        $result = Connection::makeQuery($sql, false);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}