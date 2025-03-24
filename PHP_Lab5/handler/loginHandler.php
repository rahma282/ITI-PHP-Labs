<?php
session_start();
require_once "../DB/connectToDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $errors = [];
    $pdo = connect_to_db();

    $statement = $pdo->prepare("SELECT name, email, hashedPassword, roomNo, ext FROM users WHERE email = ?");
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

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
