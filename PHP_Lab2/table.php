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

    echo '<h1 class="text-center mt-5 fw-bold text-primary">🎉 Customers Data ! 🎉</h1>';
    $headers = ["ID", "First Name", "Last Name", "Address", "Country","Gender","Skills","UserName","Department"];

    drawTable($headers, $table);
?>
