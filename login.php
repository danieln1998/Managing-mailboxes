<?php
session_start();

// סיסמה קבועה
$correct_password = "AAA";

if (isset($_POST["password"])) {
    $password = $_POST["password"];
    if ($password === $correct_password) {
        $_SESSION["authenticated"] = true;
        header("Location: index.php");
        exit;
    } else {
        $error_message = "סיסמה שגויה, נסה שוב.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>התחברות</title>
</head>
<body>
<h2>התחברות</h2>
<?php if (isset($error_message)) { ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php } ?>
<form method="post">
    <label for="password">סיסמה:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">התחבר</button>
</form>
</body>
</html>
