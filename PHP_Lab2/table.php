<?php
   require_once "../PHP_Lab2/helpers/utils.php";
   require_once "../PHP_Lab2/helpers/helper.php";

    $lines = file("customer.txt");
    $table  =[];
    if ($lines) {
        foreach ($lines as $line) {
            $line = trim($line);
            $line = explode(":", $line);
            $table[] = $line; 
        }
    }

    $headers = ["ID", "First Name", "Last Name", "Address", "Country","Gender","Skills","UserName","Department"];

    drawTable($headers, $table);
?>
