<?php
require_once "utils.php";
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$address = $_POST["address"];
$gender = $_POST["gender"];
$department = $_POST["department"];
$skills = $_POST["skills"];
$gender= $_POST["gender"];
$title = (strtolower($gender) === "male") ? "Mr." : "Miss";
// var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <link rel="stylesheet" href="php.css">
</head>
<body>
<div class="container mt-5">
    <div id="resultCard" class="d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-body">
                <h3 class="text-center">Thank You, <?php echo "$title $firstname $lastname"; ?>!</h3>
                <hr>
                <h5 class="mb-3">Please Review Your Information</h5>
            <p><strong>Name:</strong> <span id="displayName">
                    <?php echo $firstname.' '.$lastname;?>
                </span></p>
            <p><strong>Address:</strong> <span id="displaySubject">
                    <?php echo $address;?>
                </span></p>
            <p><strong>Your Skills:</strong></p>
            <p id="displayMessage">
            <ul>
                <?php 
                    foreach ($skills as $skill) {
                        echo "<li>$skill</li>";
                    }?>
            </ul>
            </p>
            <p><strong>Department:</strong></p>
            <p id="displayMessage">
                <?php echo $department;?>
            </p>
        </div>
    </div>
</div>
</body>
</html>
