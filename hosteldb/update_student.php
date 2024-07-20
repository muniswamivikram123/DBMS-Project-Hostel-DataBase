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

// Fetch existing data from the student table
$studentIdToUpdate = $_GET['student_id_to_edit'];
$selectStudentQuery = "SELECT * FROM student WHERE studentid = '$studentIdToUpdate'";
$resultStudent = mysqli_query($data, $selectStudentQuery);
$existingData = mysqli_fetch_assoc($resultStudent);

// Update record in the student table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $studentIdToUpdate = $_POST['student_id'];
    $newName = $_POST['new_name'];
    // Add other fields as needed

    $updateStudentQuery = "UPDATE student SET name = '$newName' WHERE studentid = '$studentIdToUpdate'";
    mysqli_query($data, $updateStudentQuery);
    header("location: view.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Update Student</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="content">
        <h1>Update Student</h1>
        <form method="post">
            <input type="hidden" name="student_id" value="<?php echo isset($existingData['studentid']) ? $existingData['studentid'] : ''; ?>">
            <label for="new_name">New Name:</label>
            <input type="text" id="new_name" name="new_name" value="<?php echo isset($existingData['name']) ? $existingData['name'] : ''; ?>">
            <!-- Add other fields as needed -->

            <button type="submit" name="update">Update</button>
        </form>
    </div>

</body>

</html>
