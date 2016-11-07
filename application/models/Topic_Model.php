<?php
require_once ('application/common/Connection.php');
Connection::connect();
class Topic_Model extends Model
{
    public function getAllBySectionId($id)
    {
        $sql = "SELECT * FROM Topics WHERE section_id=" . $id;
        return  Connection::makeQuery($sql);

    }
    public function addTopicToDb ($name, $user_id, $section_id)
    {
        $name= mysqli_real_escape_string(Connection::$conn, $name );
        $user_id=intval($user_id);
        $section_id=intval($section_id);
        $sql = "INSERT INTO Topics (name, user_id, section_id) VALUES ('$name', $user_id , $section_id)";
        Connection::makeQuery($sql, false);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM Topics WHERE id=" . $id;
        return  Connection::makeQuery($sql)[0];
    }

    public function NewTopic($userId, $sectionId, $name) {
        $sql = "INSERT INTO Topics (name, created_at, user_id, section_id) VALUES ('" . $name . "', NOW(),'" . $userId . "','" . $sectionId . "')";
        $result = Connection::makeQuery($sql, false);
        if ($result){
            return true;
        } else {
            return false;
        }
    }

    static public function showAllTopics ()
    {

        $sql = "SELECT id, name, user_id, section_id FROM Topics ";
        $rows = Connection::makeQuery($sql);

        foreach ($rows as $row) {
            echo "<tr><td>" . $row['name'] . "</td><td>" . $row['user_id'] . "</td>
            <td>" . $row['section_id'] . "</td><td><a href='../../admin/topic/" . $row['id'] . "'>Редактировать</a></td></tr>";
        }
    }

    static public function getTopicById ($topicID)
    {
        $sql = "SELECT * FROM Topics WHERE id='" . $topicID . "'";
        $rows = Connection::makeQuery($sql);
        return $rows;
    }

    static public function deleteTopic ($topicID)
    {
        $sql = "DELETE FROM `Topics` WHERE id =" . $topicID;
        $sql.= "DELETE FROM `Messages` WHERE topic_id =" . $topicID;
        $result = Connection::makeQuery($sql, false);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    static public function updateTopic($id, $name, $user_id, $section_id) {
        $sql = "UPDATE `topics` SET `name` = '". $name ."', `user_id` = '".$user_id."', `section_id` = '".$section_id."' WHERE `topics`.`id` =" . $id; // актуализировать запрос
        $result = Connection::makeQuery($sql, false);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
