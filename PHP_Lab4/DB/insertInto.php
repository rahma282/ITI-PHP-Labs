<?php

require_once "../DB/connectToDB.php";

function insert($tableName, $data) {
    try {
        $connection = connect_to_db();

        if (empty($tableName) || empty($data)) {
            throw new Exception("Table name and data cannot be empty.");
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));

        $insert_query = "INSERT INTO `$tableName` ($columns) VALUES ($placeholders)";

        $statement = $connection->prepare($insert_query);
        $res = $statement->execute(array_values($data));

        if ($res) {
            $inserted_id = $connection->lastInsertId();
            echo "Inserted successfully, ID: $inserted_id";
        } else {
            print_r($statement->errorInfo()); 
        }

        $connection = null;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
