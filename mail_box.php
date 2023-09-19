<?php
include "DatabaseConnection.php";

class mail_box {
    private $mysqli;
    private $conn;
    function __construct($host, $user, $password, $database) {
        $this->mysqli = new DatabaseConnection($host, $user, $password, $database);
        $this->mysqli->connect();
        $this->conn=$this->mysqli->getConn();
    }
    public function addMailbox($name, $box_number, $phone) {
        // השימוש ב-addslashes להגנה מפני SQL Injection
        $name = addslashes($name);
        $box_number = addslashes($box_number);
        $phone = addslashes($phone);

        $sql = "INSERT INTO mailbox_info (name, box_number, phone) VALUES ('$name', '$box_number', '$phone')";
        $result = $this->conn->query($sql);
    }

    public function getAllMailboxes() {
        $sql = "SELECT * FROM mailbox_info";
        $result = $this->conn->query($sql);
        $mailboxes = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mailboxes[] = $row;
            }
        }
        return $mailboxes;
    }

    public function updateMailbox($id, $name, $box_number, $phone) {
        // השימוש ב-addslashes להגנה מפני SQL Injection
        $name = addslashes($name);
        $box_number = addslashes($box_number);
        $phone = addslashes($phone);

        $sql = "UPDATE mailbox_info SET name='$name', box_number='$box_number', phone='$phone' WHERE id=$id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteMailbox($id) {
        // השימוש ב-(int) להגנה מפני SQL Injection
        $id = (int)$id;

        $sql = "DELETE FROM mailbox_info WHERE id=$id";
        $result = $this->conn->query($sql);
    }

    public function getMailboxById($id) {
        // השימוש ב-(int) להגנה מפני SQL Injection
        $id = (int)$id;

        $sql = "SELECT * FROM mailbox_info WHERE id = $id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function closeConnection() {
        $this->mysqli->disconnect();
    }
}
?>
