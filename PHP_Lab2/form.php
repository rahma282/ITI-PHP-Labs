<?php
require_once "../PHP_Lab2/helpers/utils.php";
require_once "../PHP_Lab2/helpers/helper.php";

$registerData = validateData($_POST);
$registerErrors = $registerData['errors'];
$oldValidData = $registerData['valid_data'];

if (count($registerErrors)>0){
    $errors = json_encode($registerErrors);
    $queryString = "errors={$errors}";
    $oldData = json_encode($oldValidData);
    if ($oldData){
        $queryString .= "&old={$oldData}";
    }
    header("location:register.php?{$queryString}");
    exit();
}


else{
$id = generateID();
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$address = $_POST["address"];
$gender = $_POST["gender"];
$department = $_POST["department"];
$country = $_POST["country"];
$username = $_POST["username"];
$skills = $_POST["skills"]?? [];
$name = $firstname.' '.$lastname;
$title = (strtolower($gender) === "male") ? "Mr." : "Miss.";
// var_dump($_POST);

$info = "{$id}:{$firstname}:{$lastname}:{$address}:{$country}:{$gender}:".implode(",", $skills).":{$username}:{$department}\n";
$saved = appendDataTofile("customer.txt", $info);
$message = $saved
    ? '<h4 class="text-success">🎉Data Saved Successfully!🎉</h4>'
    : '<h4 class="text-danger">🚫 No Permission to Save Data! 🚫</h4>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <link rel="stylesheet" href="../PHP_Lab2/helpers/php.css">
</head>
<body>
<div class="container mt-5">
    <div id="resultCard" class="d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-body">
                <?php echo $message; ?>
                <h3 class="text-center">Thank You, <?php echo "$title $name"; ?>!</h3>
                <hr>
                <h5 class="mb-3">Please Review Your Information</h5>
            <p><strong>Name:</strong> <span id="displayName">
                    <?php echo $name;?>
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
            <?php if ($saved): ?>
                <a class="btn btn-secondary mt-4 rounded-pill px-4 py-2 fw-bold" href="table.php"
                style="background-color: #1e1e1e; color: white; font-weight: bold; padding: 12px 18px; border-radius: 12px; text-decoration: none; transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out; box-shadow: 0px 5px 15px rgba(255, 255, 255, 0.15); text-align: center; margin-top: 10px;display: inline-block;">
                    view All Customers Data
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</body>
</html>
