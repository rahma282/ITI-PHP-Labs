<?php

require_once  "../DB/connectToDB.php";

function createTable($tableName, $columns) {
    try {
        $connection = connect_to_db();

        if (empty($tableName) || empty($columns)) {
            throw new Exception("Table name and columns cannot be empty.");
        }

        $create_query = "CREATE TABLE IF NOT EXISTS `$tableName` (";
        $create_query .= implode(", ", $columns);
        $create_query .= ");";

        $statment = $connection->prepare($create_query);
        $res = $statment->execute();
        var_dump($res);

        $connection = null;

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$columns = [
    "`id` INT AUTO_INCREMENT PRIMARY KEY",
    "`name` VARCHAR(30) NOT NULL",
    "`email` VARCHAR(30) UNIQUE",
    "`roomNo` VARCHAR(30)",
    "`ext` INT",
    "`hashedPassword` VARCHAR(255)",
    "`image` VARCHAR(255)"
];

createTable("users", $columns);
?>
