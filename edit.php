<?php
session_start();

if (!isset($_SESSION["authenticated"]) || !$_SESSION["authenticated"]) {
    header("Location: login.php");
    exit;
}

include "db_params.php";
include "mail_box.php";

$mail_box_db = new mail_box($db_host, $db_user, $db_pass, $db_name);

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $mailbox = $mail_box_db->getMailboxById($id);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    //הגנה מפני התקפת CSRF
    if (!empty($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $box_number = $_POST["box_number"];
        $phone = $_POST["phone"];
        $result = $mail_box_db->updateMailbox($id, $name, $box_number, $phone);

        if ($result) {
            header("Location: view_mail_box_data.php");
            exit;
        } else {
            $error_message = "שגיאה בעדכון המרצה.";
        }
    } else {
        $error_message ="שגיאה בעדכון המרצה.";;
    }
} else {
    header("Location: view_mail_box_data.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>עריכת מרצה</title>
</head>
<body>
<h2>עריכת מרצה</h2>

<form method="post" >
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <input type="hidden" name="id" value="<?php echo $mailbox["id"]; ?>">
    <label for="name">שם מרצה:</label>
    <input type="text" id="name" name="name" value="<?php echo $mailbox["name"]; ?>" required>
    <br>
    <label for="box_number">מספר תיבה:</label>
    <input type="number" id="box_number" name="box_number" value="<?php echo $mailbox["box_number"]; ?>" required>
    <br>
    <label for="phone">מספר טלפון:</label>
    <input type="number" id="phone" name="phone" value="<?php echo $mailbox["phone"]; ?>" required>
    <br>
    <button type="submit" name="update">שמור</button>
</form>
<?php if (isset($error_message)) { ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php } ?>
</body>
</html>
