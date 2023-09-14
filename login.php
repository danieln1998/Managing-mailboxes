<?php
session_start();


$correct_password = "AAA";
$max_attempts = 3;
#חסימה מפני התקפת brute force
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (isset($_POST["password"])) {
    $password = $_POST["password"];
    if ($_SESSION['login_attempts'] < $max_attempts && $password === $correct_password) {
            $_SESSION["authenticated"] = true;
            $_SESSION['login_attempts'] = 0;
            header("Location: index.php");
            exit;
    }
    else{
        $_SESSION['login_attempts']++;
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
