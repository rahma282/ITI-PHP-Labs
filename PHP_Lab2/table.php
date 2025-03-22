<?php
   require_once "../PHP_Lab2/helpers/utils.php";
   require_once "../PHP_Lab2/helpers/helper.php";

   if (!file_exists("customer.txt")) {
    echo "<p style='color: red;'>No records found.</p>";
    } else {
        $lines = file("customer.txt");
        $table  =[];
        if ($lines) {
            foreach ($lines as $line) {
                $line = trim($line);
                $line = explode(":", $line);
                $table[] = $line; 
            }
        }
    }

    $headers = ["ID", "First Name", "Last Name", "Address", "Country","Gender","Skills","UserName","Department"];

    if (!empty($table)) {
        drawTable($headers, $table);
    }
?>
