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
    if (!file_exists($filename)) {
        echo "<p>File does not exist.. Creating an empty file</p>";
        file_put_contents($filename, "");
        $data = "";
    } 
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

function drawTable($header, $tableData,$deleteUrl="../PHP_Lab2/helpers/delete.php") {
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
        echo "
            <td> <form method='post' action='{$deleteUrl}'> 
            <input type='hidden' name='id' value='{$row[0]}'>
            <input type='submit' class='btn btn-danger' value='Delete'>
            </form> </td>";
        echo "</tr>";
    }
    echo "</tbody></table></div> </div>";
}
function deleteFile(){
    $file = "customer.txt";
    if (!file_exists($file)) {
        echo "<script>alert('File already deleted!');</script>";
        return;
    }

    if (!unlink($file)) {
        echo "<script>alert('Failed to delete file.');</script>";
    } else {
        echo "<script>alert('File deleted successfully!');</script>";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deleteFileBtn"])) {
deleteFile();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../PHP_Lab2/helpers/table.css">
    <title>Customer Records</title>
</head>
<body>
    <form method="POST" action="">
    <button type="submit" class="deletebtn" name="deleteFileBtn">Delete All Records</button>
</form>
</body>
</html>