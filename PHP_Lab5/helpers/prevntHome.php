<?php
function preventHome(){
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: home.php");
        exit();
    }
}
