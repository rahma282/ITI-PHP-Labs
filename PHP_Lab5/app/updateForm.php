<?php
    require_once "../handler/updateHandler.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="padding-top:10px;">
    <div class="form-container">
        <h3 class="text-center mb-4">Update User</h3>
        <form action="../handler/updateHandler.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                    type="text"
                    class="form-control" 
                    name="name" 
                    id="name" 
                    value='<?php echo isset($oldData["name"]) ? $oldData["name"]: ""  ?>'>
                    <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["name"]) ? "{$errors['name']}" : ""; ?>
                    </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="text"
                    class="form-control" 
                    id="email" 
                    name="email"
                    value='<?php echo isset($oldData["email"]) ? $oldData["email"]: ""  ?>'>
                    <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["email"]) ? "{$errors['email']}" : ""; ?>
                    </div>
            </div>
            <div class="mb-3">
                <label for="roomNO" class="form-label">Room NO</label>
                <select class="form-select" id="roomNO" name="roomNO" require> 
                    <option value="" disabled selected>Select your Room number</option>
                    <option value="App1" <?php echo (isset($oldData['roomNO']) && $oldData['roomNO'] == "App1") ? "selected" : ""; ?>>Application 1</option>
                    <option value="App2" <?php echo (isset($oldData['roomNO']) && $oldData['roomNO'] == "App2") ? "selected" : ""; ?>>Application 2</option>
                    <option value="Cloud" <?php echo (isset($oldData['roomNO']) && $oldData['roomNO'] == "Cloud") ? "selected" : ""; ?>>Cloud</option>
                </select>
                <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["roomNO"]) ? "{$errors['roomNO']}" : ""; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="ext" class="form-label">Ext</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="ext" 
                    value='<?php echo isset($oldData["ext"]) ? $oldData["ext"]: ""  ?>' 
                    name="ext" >
                    <div class="text-danger  font-weight-bold">
                        <?php  echo isset($errors["ext"]) ? "{$errors['ext']}" : ""; ?>
                   </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload An Image</label>
                <input 
                    type="file" 
                    class="form-control" 
                    id="image" 
                    name="image" 
                    >
                    <div class="text-danger font-weight-bold">
                        <?php echo isset($errors["image"]) ? "{$errors['image']}" : ""; ?>
                    </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-custom" id="submitBtn">Update</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>