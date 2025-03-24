<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    
    $db = new DataBase();
    $db->delete($id);
}
?>
