<?php
    $errors=[];
    $oldData =[];
    if(isset($_GET["errors"])){
        $errors = $_GET["errors"];
        $errors = json_decode($errors, true);
    }
    if(isset($_GET["old"])){
        $oldData = $_GET["old"];
        $oldData = json_decode($oldData,true);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../PHP_Lab2/helpers/style.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="padding-top:50px;">
    <div class="form-container">
        <h3 class="text-center mb-4">Registrations</h3>
        <form action="form.php" method="post">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input 
                    type="text"
                    class="form-control" 
                    name="firstname" 
                    id="firstname" 
                    value='<?php echo $oldData["firstname"] ? $oldData["firstname"]: ""  ?>'
                    placeholder="Enter your first name">
                    <!-- required -->
                    <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["firstname"]) ? "{$errors['firstname']}" : ""; ?>
                    </div>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="lastname" 
                    name="lastname"
                    value='<?php echo $oldData["lastname"] ? $oldData["lastname"]: ""  ?>'
                    placeholder="Enter your last name">
                    <!-- required -->
                    <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["lastname"]) ? "{$errors['lastname']}" : ""; ?>
                    </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea 
                    class="form-control"
                    id="address" 
                    name="address" 
                    rows="3"
                    placeholder="Your Address"><?php echo $oldData['address'] ? $oldData['address']: ""?></textarea>
                    <!-- required -->
                    
                <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["address"]) ? "{$errors['address']}" : ""; ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country"> 
                    <!-- required> -->
                    <option value="" disabled selected>Select your country</option>
                    <option value="US" <?php echo (isset($oldData['country']) && $oldData['country'] == "US") ? "selected" : ""; ?>>United States</option>
                    <option value="UK" <?php echo (isset($oldData['country']) && $oldData['country'] == "UK") ? "selected" : ""; ?>>United Kingdom</option>
                    <option value="CA" <?php echo (isset($oldData['country']) && $oldData['country'] == "CA") ? "selected" : ""; ?>>Canada</option>
                    <option value="AU" <?php echo (isset($oldData['country']) && $oldData['country'] == "AU") ? "selected" : ""; ?>>Australia</option>
                    <option value="IN" <?php echo (isset($oldData['country']) && $oldData['country'] == "IN") ? "selected" : ""; ?>>India</option>
                    <option value="EG" <?php echo (isset($oldData['country']) && $oldData['country'] == "EG") ? "selected" : ""; ?>>Egypt</option>
                    <option value="DE" <?php echo (isset($oldData['country']) && $oldData['country'] == "DE") ? "selected" : ""; ?>>Germany</option>
                    <option value="FR" <?php echo (isset($oldData['country']) && $oldData['country'] == "FR") ? "selected" : ""; ?>>France</option>
                    <option value="JP" <?php echo (isset($oldData['country']) && $oldData['country'] == "JP") ? "selected" : ""; ?>>Japan</option>
                    <option value="CN" <?php echo (isset($oldData['country']) && $oldData['country'] == "CN") ? "selected" : ""; ?>>China</option>
                </select>
                <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["country"]) ? "{$errors['country']}" : ""; ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Gender</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo (isset($oldData["gender"]) && $oldData["gender"] == "male") ? "checked" : ""; ?> required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo (isset($oldData["gender"]) && $oldData["gender"] == "female") ? "checked" : ""; ?> required>
                     <!-- required> -->
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["gender"]) ? "{$errors['gender']}" : ""; ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Skills</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="php" name="skills[]" value="PHP">
                    <label class="form-check-label" for="php">PHP</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="mysql" name="skills[]" value="MySQL">
                    <label class="form-check-label" for="mysql">MySQL</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="postgresql" name="skills[]" value="PostgreSQL">
                    <label class="form-check-label" for="postgresql">PostgreSQL</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="j2se" name="skills[]" value="J2SE">
                    <label class="form-check-label" for="j2se">J2SE</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="username" 
                    value='<?php echo $oldData["username"] ? $oldData["username"]: ""  ?>' 
                    name="username" >
                    <!-- required> -->
                    <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["username"]) ? "{$errors['username']}" : ""; ?>
                   </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="department" 
                    name="department" 
                    value='<?php echo $oldData["department"] ? $oldData["department"]: ""  ?>' 
                    placeholder="OpenSource">
                     <!-- required> -->
                     <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["department"]) ? "{$errors['department']}" : ""; ?>
                   </div>
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <div class="d-flex justify-content-center">
                    <p>
                        <strong>Sh8734</strong> <span id="staticCode"></span>
                    </p>
                </div>
                <input type="text" class="form-control" id="code" name="code" required oninput="validateCode()">
                <p>Please enter the code below the box</p>
                <small class="text-danger" id="codeError" style="display: none;">Incorrect code, please try again.</small>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-custom" id="submitBtn" disabled>Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>
<script src="../PHP_Lab2/helpers/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
