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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_rooms'])) {
    $roomNumberToUpdate = $_POST['update_rooms'];
    // Fetch the existing data for the selected room
    $selectRoomQuery = "SELECT * FROM rooms WHERE roomnumber = '$roomNumberToUpdate'";
    $resultRoom = mysqli_query($data, $selectRoomQuery);
    $roomData = mysqli_fetch_assoc($resultRoom);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_update_rooms'])) {
    $roomNumberToUpdate = $_POST['update_rooms'];
    // Retrieve updated data from the form
    $newCapacity = $_POST['new_capacity'];
    $newOccupancy = $_POST['new_occupancy'];
    $newFurnitureId = $_POST['new_furnitureid'];

    // Update the record in the rooms table
    $updateRoomsQuery = "UPDATE rooms SET capacity = '$newCapacity', occupancy = '$newOccupancy', furnitureid = '$newFurnitureId' WHERE roomnumber = '$roomNumberToUpdate'";
    mysqli_query($data, $updateRoomsQuery);
    header("location: view.php"); // Redirect to the view page after updating
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Update Rooms</title>
    <link rel="stylesheet" href="styles.css">
    <?php include 'admin_css.php'; ?>
</head>

<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <h1>Update Rooms</h1>
        <form method="post" action="">
            <label for="new_capacity">New Capacity:</label>
            <input type="text" id="new_capacity" name="new_capacity" value="<?php echo isset($roomData['capacity']) ? $roomData['capacity'] : ''; ?>" required>

            <label for="new_occupancy">New Occupancy:</label>
            <input type="text" id="new_occupancy" name="new_occupancy" value="<?php echo isset($roomData['occupancy']) ? $roomData['occupancy'] : ''; ?>" required>

            <label for="new_furnitureid">New Furniture ID:</label>
            <input type="text" id="new_furnitureid" name="new_furnitureid" value="<?php echo isset($roomData['furnitureid']) ? $roomData['furnitureid'] : ''; ?>" required>

            <input type="hidden" name="update_rooms" value="<?php echo isset($roomData['roomnumber']) ? $roomData['roomnumber'] : ''; ?>">

            <button type="submit" name="submit_update_rooms">Update</button>
        </form>
    </div>
</body>

</html>
