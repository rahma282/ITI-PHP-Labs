<?php
require_once "connectToDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $pdo = connect_to_db();

    $statement = $pdo->prepare("DELETE FROM users WHERE id = ?");
    if ($statement->execute([$id])) {
        header("Location: ../app/usersTable.php?success=User Deleted");
        exit();
    } else {
        header("Location: ../app/usersTable.php?error=Failed to Delete User");
        exit();
    }
}
?>
