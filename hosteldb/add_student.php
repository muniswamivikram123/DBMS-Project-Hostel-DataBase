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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $contactnumber = $_POST['contactnumber'];
    $roomnumber = $_POST['roomnumber'];
    $admissionid = $_POST['admissionid'];
    $userid = $_POST['userid'];

    // Insert new student record
    $insertStudentQuery = "INSERT INTO student (name, gender, contactnumber, roomnumber, admissionid, userid) VALUES ('$name', '$gender', '$contactnumber', '$roomnumber', '$admissionid', '$userid')";
    mysqli_query($data, $insertStudentQuery);
    // Redirect to view.php or any other desired page
    header("location: view.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
    <title>Add Student</title>
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
    <h1>Add Student</h1>
    <div class="div_deg">
    <form action="#" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" required><br>
        <label for="contactnumber">Contact Number:</label>
        <input type="text" id="contactnumber" name="contactnumber" required><br>
        <label for="roomnumber">Room Number:</label>
        <input type="text" id="roomnumber" name="roomnumber" required><br>
        <label for="admissionid">Admission ID:</label>
        <input type="text" id="admissionid" name="admissionid" required><br>
        <label for="userid">User ID:</label>
        <input type="text" id="userid" name="userid" required><br>
         <input type="submit" class="btn btn-primary" name="add_student" value="Add Student">
    </form>
</div>
</center>
</div>
</body>
</html>
