<?php

require_once('application/common/Connection.php');
Connection::connect();

class Message_Model extends Model
{
    private $text;
    private $user_id;
    private $topic_id;
    private $section_id;
    private $user;


    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }


    public function getTopicId()
    {
        return $this->topic_id;
    }


    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;
    }


    public function getSectionId()
    {
        return $this->section_id;
    }


    public function setSectionId($section_id)
    {
        $this->section_id = $section_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getUser()
    {
        $sql = "SELECT * FROM Users WHERE id = " . $this->getUserId();
        $user = Connection::makeQuery($sql, false);
        $this->setUser($user);
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function showAllByTopicId($id)
    {
        $sql = "SELECT Messages.text, Messages.created_at, Users.name FROM Messages, Users WHERE topic_id=" . $id . " AND Users.id = Messages.user_id";
        return Connection::makeQuery($sql);
    }

    public function create($text, $topicId, $userId)
    {
        $text = mysqli_real_escape_string(Connection::$conn, $text);
        $sql = "INSERT INTO Messages (user_id, created_at, topic_id, text) VALUES ('" . $userId . "', NOW(),'" . $topicId . "','" . $text . "')";
        $rows = Connection::makeQuery($sql, false);
    }

    static public function DeleteMsgIdBySection($id)
    {
        $sql = "SELECT id FROM `topics` WHERE section_id =" . $id;
        echo $sql;
        $r = Connection::makeQuery($sql, true);
        while ($row = mysqli_fetch_row($r)) {
            var_dump($row);
            $res = implode("", $row);
            $sql = "DELETE FROM `Messages` WHERE topic_id =" . $res;
            Connection::makeQuery($sql, false);
        }

    }
}

?>

