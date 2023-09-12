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
        $sql = "INSERT INTO mailbox_info (name, box_number, phone) VALUES ('$name', '$box_number', '$phone')";
        if ($this->conn->query($sql) === TRUE) {
            return "מרצה נוסף בהצלחה!";
        } else {
            return "שגיאה בהוספת המרצה: " . $this->conn->error;
        }
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
        $sql = "UPDATE mailbox_info SET name='$name', box_number='$box_number', phone='$phone' WHERE id=$id";
        if ($this->conn->query($sql) === TRUE) {
            return "פרטי המרצה עודכנו בהצלחה!";
        } else {
            return "שגיאה בעדכון פרטי המרצה: " . $this->conn->error;
        }
    }

    public function deleteMailbox($id) {
        $sql = "DELETE FROM mailbox_info WHERE id=$id";
        if ($this->conn->query($sql) === TRUE) {
            return "המרצה נמחק בהצלחה!";
        } else {
            return "שגיאה במחיקת המרצה: " . $this->conn->error;
        }
    }

    public function closeConnection() {
        $this->mysqli->disconnect();
    }

}
?>
