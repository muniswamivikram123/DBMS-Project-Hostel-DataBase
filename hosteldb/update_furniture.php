<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location: login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "hosteldb";

$data = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update Furniture record
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_furniture'])) {
    $furnitureIdToUpdate = $_POST['update_furniture'];
    $newFurnitureType = $_POST['new_furniture_type'];
    $newFurnitureCondition = $_POST['new_furniture_condition'];

    $updateFurnitureQuery = "UPDATE furniture SET ftype = '$newFurnitureType', fcondition = '$newFurnitureCondition' WHERE furnitureid = '$furnitureIdToUpdate'";
    mysqli_query($data, $updateFurnitureQuery);
    header("location: view.php");
}

// Retrieve Furniture details
if (isset($_GET['furnitureid'])) {
    $furnitureId = $_GET['furnitureid'];
    $selectFurnitureQuery = "SELECT * FROM furniture WHERE furnitureid = '$furnitureId'";
    $resultFurniture = mysqli_query($data, $selectFurnitureQuery);
    $furnitureInfo = mysqli_fetch_assoc($resultFurniture);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Furniture</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h2>Update Furniture</h2>

    <form method="post">
        <label for="new_furniture_type">New Furniture Type:</label>
        <input type="text" name="new_furniture_type" value="<?php echo isset($furnitureInfo['ftype']) ? $furnitureInfo['ftype'] : ''; ?>" required>

        <label for="new_furniture_condition">New Furniture Condition:</label>
        <input type="text" name="new_furniture_condition" value="<?php echo isset($furnitureInfo['fcondition']) ? $furnitureInfo['fcondition'] : ''; ?>" required>

        <button type="submit" name="update_furniture" value="<?php echo isset($furnitureInfo['furnitureid']) ? $furnitureInfo['furnitureid'] : ''; ?>">Update Furniture</button>
    </form>

</body>

</html>

