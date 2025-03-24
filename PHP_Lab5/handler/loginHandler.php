<?php
session_start();
require_once "../DB/database.php";
$db = new DataBase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $errors = [];

    $user = $db->selectByCondition("users",$email);

    if ($user) {
        if (password_verify($password, $user["hashedPassword"])) {
            $_SESSION["user"] = $user["name"];
            $_SESSION["email"] = $user["email"];
            unset($_SESSION["errors"]);

            header("Location: ../app/home.php");
            exit();
        } else {
            $errors["password"] = "Incorrect password";
        }
    } else {
        $errors["email"] = "Email not found";
    }

    if (empty($errors)) {
        $errors["email"] = "Email not found";
    }

    $_SESSION["errors"] = $errors;
    header("Location: ../app/login.php?error=Invalid Email or Password");
    exit();
}
?>
