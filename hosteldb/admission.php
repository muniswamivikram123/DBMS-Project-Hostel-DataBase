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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_admission'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Insert new admission record
    $insertAdmissionQuery = "INSERT INTO admission (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
    mysqli_query($data, $insertAdmissionQuery);
    // Redirect to view.php or any other desired page
    header("location: view.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
 
    <meta charset="utf-8">
    <title>Add Admission</title>
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
    <h1>Add Admission</h1>
    <center>
    <div class="div_deg">
    <form action="#" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br>
        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea><br>
         <input type="submit" class="btn btn-primary" name="add_admission" value="Add Admission">
    </form>
</div>
</center>
</div>
</body>
</html>

