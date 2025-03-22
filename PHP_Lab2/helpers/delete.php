<?php
var_dump($_POST);
$filename = "../customer.txt";

if (!file_exists($filename)) {
    echo"<script>alert('Error: Data file not found!')</script>";
    header("Location:../table.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $deleteId = $_POST['id'];
    $updatedData = [];

    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
    foreach ($lines as $line) {
        $data = explode(":", $line);
        if ($data[0] !== $deleteId) {
            $updatedData[] = $line;
        }
    }

    if (!empty($updatedData)) {
        file_put_contents($filename, implode("\n", $updatedData) . "\n");
    } else {
        file_put_contents($filename, "");
    }

    echo "<script>alert('Record deleted successfully!');</script>";
    header("Location:../table.php");
    exit();
} else {
    echo "<script>alert('Invalid request!');</script>";
    header("Location:../table.php");
    exit();
}
?>
