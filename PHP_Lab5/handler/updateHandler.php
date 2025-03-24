<?php
require_once "../includes/utils.php";
require_once "../validation/validation.php";
require_once "../validation/imageValidation.php";
require_once "../DB/database.php";

$errors = [];
$oldData = [];
$allowedExtensions = ["jpg", "jpeg", "png", "gif"];

function handleGetRequest() {
    $errors = isset($_GET["errors"]) ? json_decode($_GET["errors"], true) : [];
    $oldData = isset($_GET["old"]) ? json_decode($_GET["old"], true) : [];
    return ["errors" => $errors, "oldData" => $oldData];
}

function handlePostRequest() {
    global $allowedExtensions;
    if (!isset($_POST["id"]) || empty($_POST["id"])) {
        die("User ID is required.");
    }

    $id = $_POST["id"];

    $registerData = validateData($_POST);
    $registerErrors = $registerData['errors'];
    $oldValidData = $registerData['valid_data'];

    $fileValidation = validateUploadedFile($_FILES["image"], $allowedExtensions);
    $fileErrors = $fileValidation["errors"];
    $fileValidData = $fileValidation["valid_data"];
   # var_dump($_FILES); 

    $errors = array_merge($registerErrors, $fileErrors);

    if (!empty($errors)) {
        $errors = json_encode($errors);
        $oldData = json_encode($oldValidData);
        header("location: ../app/updateForm.php?id={$id}&errors={$errors}&old={$oldData}");
        exit();
    }

    updateUserData($_POST, $fileValidData, $oldValidData,$id);

    header("location: ../app/usersTable.php");
    exit();
}

function updateUserData($data, $fileValidData, $oldValidData, $id) {
    $imageFileName = $fileValidData["tmp_name"] . "." . $fileValidData["extension"];

    $destination = "../upload/" . $imageFileName;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
            echo "File uploaded successfully to: $destination";
    } else {
            echo "File upload failed. Check permissions or file data.";
            var_dump($_FILES["image"]);
    }

    $condition = ["id" => $id];


    $userData = [
        "name" => $oldValidData['name'],
        "email" => $oldValidData['email'],
        "roomNO" => $oldValidData['roomNO'],
        "ext" => $oldValidData['ext'],
        "image" => $imageFileName
    ];
    $db = new DataBase();
    $db->update("users", $userData,$condition);
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    extract(handleGetRequest());
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    handlePostRequest();
}
?>