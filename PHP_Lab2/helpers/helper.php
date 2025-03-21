<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../PHP_Lab2/helpers/php.css">
</head>
<body></body>
<?php
function validateData($data){
    $errors = [];
    $valid_data = [];
    foreach($data as $key => $value) {
        if (!isset($value) || empty($value)) {
            $errors[$key] = ucfirst("{$key} is required");
        } else {
            if (is_array($value)) {
                $valid_data[$key] = $value;
            } else {
                $valid_data[$key] = trim($value);
            }
        }
    }
    return ["errors" => $errors, "valid_data" => $valid_data];
}
function appendDataTofile($filename, $data){
    $fileobject= fopen($filename, "a");
    if ($fileobject) {
        fwrite($fileobject, $data);
        fclose($fileobject);
        return true;
    }

    return false;

}
function generateID(){
    if(file_exists("ids.txt")){
        $id=  file_get_contents("ids.txt");
        $id = (int)$id + 1;
    }else{
        $id  =1 ;
    }
    file_put_contents("ids.txt", $id);
    return $id;
}

function drawTable($header, $tableData) {

    echo '<div class="table-container">
            <table class="custom-table">
            <thead>
            <tr>';
    foreach ($header as $value) {
        echo "<th>$value</th>";
    }
    echo "</tr></thead><tbody>";

    foreach ($tableData as $row) {
        echo "<tr>";
        foreach ($row as  $field) {
            echo "<td>{$field}</td>";
        }
        echo "</tr>";
    }

    echo "</tbody></table></div> </div>";

}
?>