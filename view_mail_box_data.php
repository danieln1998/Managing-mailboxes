<?php
session_start();

if (!isset($_SESSION["authenticated"]) || !$_SESSION["authenticated"]) {
    header("Location: login.php");
    exit;
}

include "db_params.php";
include "mail_box.php";

$mail_box_db = new mail_box($db_host, $db_user, $db_pass, $db_name);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // הגנה מפני התקפת CSRF
    if (!empty($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        if (isset($_POST["add"])) {
            $name = $_POST["name"];
            $box_number = $_POST["box_number"];
            $phone = $_POST["phone"];
            $result = $mail_box_db->addMailbox($name, $box_number, $phone);
        } elseif (isset($_POST["delete"])) {
            $id = $_POST["id"];
            $result = $mail_box_db->deleteMailbox($id);
        }
    } else {
        $error_message = "שגיאה בהשלמת הפעולה.";
    }
}

$mailboxes = $mail_box_db->getAllMailboxes();

$mail_box_db->closeConnection();
?>


<!DOCTYPE html>
<html>
<head>
    <title>ניהול תיבות דואר</title>
</head>
<body>
<h2>ניהול תיבות דואר</h2>

<?php
if (isset($error_message)) {
    echo '<p style="color: red;">' . $error_message . '</p>';
}
?>

<h3>רשימת מרצים</h3>
<table border="1">
    <tr>
        <th>שם מרצה</th>
        <th>מספר תיבה</th>
        <th>מספר טלפון</th>
        <th>עריכה</th>
        <th>מחיקה</th>
    </tr>
    <?php foreach ($mailboxes as $mailbox) { ?>
        <tr>
            
            <td><?php echo htmlspecialchars($mailbox["name"]); //הגנה מפני stored xss ?> </td>
            <td><?php echo $mailbox["box_number"]; ?></td>
            <td><?php echo $mailbox["phone"]; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $mailbox["id"]; ?>">ערוך</a>
            </td>
            <td>
                <form method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="id" value="<?php echo $mailbox["id"]; ?>">
                    <button type="submit" name="delete">מחק</button>
                </form>
            </td>
        </tr>
    <?php } ?>

</table>
<h3>הוספת מרצה חדש</h3>
<form method="post">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <label for="name">שם מרצה:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="box_number">מספר תיבה:</label>
    <input type="number" id="box_number" name="box_number" required>
    <br>
    <label for="phone">מספר טלפון:</label>
    <input type="number" id="phone" name="phone" required>
    <br>
    <button type="submit" name="add">הוסף מרצה</button>
</form>
</body>
</html>
