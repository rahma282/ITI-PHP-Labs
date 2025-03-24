<?php
    require_once "connectToDB.php";
class DataBase{
    public function __construct() {}
    public function createTable($tableName, $columns) {
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
    public function insert($tableName, $data) {
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

    public function select($tableName) {
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
    public function selectByCondition($tableName,$condtion) {
        $pdo = connect_to_db();
        $statement = $pdo->prepare("SELECT name, email, hashedPassword, roomNo, ext FROM users WHERE email = ?");
        $statement->execute([$condtion]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function update($tableName, $data, $conditions) {
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

    public function delete($id){
        $pdo = connect_to_db();

        $statement = $pdo->prepare("DELETE FROM users WHERE id = ?");
        if ($statement->execute([$id])) {
            header("Location: ../app/usersTable.php?success=User Deleted");
            exit();
        } else {
            header("Location: ../app/usersTable.php?error=Failed to Delete User");
            exit();
        }
    }
    
}