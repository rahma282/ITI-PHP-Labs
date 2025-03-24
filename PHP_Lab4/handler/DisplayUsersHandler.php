<?php
require_once "../DB/selete.php";
require_once "../DB/delete.php";
require_once "../DB/update.php";
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
        foreach ($row as  $index=>  $field) {
            if($index==5){
                $imagePath = "../upload/{$field}";
                //echo "<td>{$imagePath}</td>";
                if (!file_exists($imagePath) || empty($field)) {
                    $imagePath = "../upload/default.png";
                }
                echo "<td><img src='{$imagePath}' width='100' height='100'></td>";
            }else{
                echo "<td>{$field}</td>";
            }
        }
        echo "
            <td>
                <form method='post' action='../DB/delete.php'> 
                    <input type='hidden' name='id' value='{$row[0]}'>
                    <input type='submit' class='btn btn-danger' value='Delete'>
                </form> 
            </td>
            <td>
                <a href='../app/updateForm.php?id={$row[0]}' class='btn btn-warning'>Edit</a>
            </td>";
        echo "</tr>";
    }
    echo "</tbody></table></div>";
}
    $table  = select('users');
    $headers = ["ID", "Name", "Email", "Room No", "Ext", "Image", "Edit", "Delete"];

    drawTable($headers, $table);
?>