<?php

require_once "../DB/connectToDB.php";

require_once "../DB/connectToDB.php";

function update($tableName, $data, $conditions) {
    try {
        $connection = connect_to_db();

        if (empty($tableName) || empty($data) || empty($conditions)) {
            throw new Exception("Table name, data, and conditions cannot be empty.");
        }

        $setClauses = array_map(fn($col) => "`$col` = :$col", array_keys($data));
        $setQuery = implode(", ", $setClauses);

        $whereClauses = array_map(fn($col) => "`$col` = :cond_$col", array_keys($conditions));
        $whereQuery = implode(" AND ", $whereClauses);

        $update_query = "UPDATE `$tableName` SET $setQuery WHERE $whereQuery";
        
        $stmt = $connection->prepare($update_query);

        $executeArray = [];
        foreach ($data as $key => $value) {
            $executeArray[$key] = $value;
        }
        foreach ($conditions as $key => $value) {
            $executeArray["cond_" . $key] = $value;
        }

        $res = $stmt->execute($executeArray);

        if ($res) {
            $affected_rows = $stmt->rowCount();
            echo "Updated successfully, affected rows: $affected_rows";
        }

        unset($stmt);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
