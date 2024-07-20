<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'student') {
    header("location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "hosteldb";
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch furniture data for dropdown
$selectFurnitureQuery = "SELECT furnitureid, ftype FROM furniture";
$furnitureResult = mysqli_query($data, $selectFurnitureQuery);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_room'])) {
    $capacity = $_POST['capacity'];
    $occupancy = $_POST['occupancy'];
    $furnitureId = $_POST['furnitureid'];

    // Insert new room record
    $insertRoomQuery = "INSERT INTO rooms (capacity, occupancy, furnitureid) VALUES ('$capacity', '$occupancy', '$furnitureId')";
    mysqli_query($data, $insertRoomQuery);
    // Redirect to view.php or any other desired page
    header("location: view.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Add Room</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Include any additional stylesheets or scripts -->
<style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg {
            background-color: lightpink;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>

    <?php
    include 'admin_css.php';
    ?>
</head>

<body>

    <?php
    include 'admin_sidebar.php';
    ?>
<div class="content">
    <center>
    <h1>Add Room</h1>
    <div class="div_deg">
    <form action="#" method="POST">
        <label for="capacity">Capacity:</label>
        <input type="text" id="capacity" name="capacity" required><br>
        <label for="occupancy">Occupancy:</label>
        <input type="text" id="occupancy" name="occupancy" required><br>
        <label for="furnitureid">Furniture:</label>
        <select id="furnitureid" name="furnitureid" required>
            <option value="">Select Furniture</option>
            <?php while ($row = mysqli_fetch_assoc($furnitureResult)) { ?>
                <option value="<?php echo $row['furnitureid']; ?>"><?php echo $row['ftype']; ?></option>
            <?php } ?>
        </select><br>
         <input type="submit" class="btn btn-primary" name="add_room" value="Add Room">
    </form>
</div>
</center>
</div>
</body>
</html>
