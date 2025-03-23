<?php
require_once "connectToDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $roomNo = trim($_POST["roomNo"]);
    $ext = trim($_POST["ext"]);

    $pdo = connect_to_db();
    $statement = $pdo->prepare("UPDATE users SET name=?, email=?, roomNo=?, ext=? WHERE id=?");
    
    if ($statement->execute([$name, $email, $roomNo, $ext, $id])) {
        header("Location: ../app/adminPanel.php?success=User Updated");
        exit();
    } else {
        header("Location: ../app/adminPanel.php?error=Failed to Update User");
        exit();
    }
}
?>
