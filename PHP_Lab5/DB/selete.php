<?php

require_once "../DB/connectToDB.php";

function select($tableName) {
    try {
        $connection = connect_to_db();

        if (empty($tableName)) {
            throw new Exception("Table name cannot be empty.");
        }

        $select_query = "SELECT id, name, email, roomNo, ext, image FROM `$tableName`";
        $statment = $connection->prepare($select_query);
        $statment->execute();

        $data = $statment->fetchAll(PDO::FETCH_NUM);

        //print_r($data);

        $connection = null;

        return $data;

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
