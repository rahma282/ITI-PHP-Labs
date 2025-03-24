<?php 
function preventlogin(){
    if (isset($_SESSION["user"])) {
        header("Location: home.php");
        exit();
    }
}
