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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_furniture'])) {
    $type = $_POST['type'];
    $condition = $_POST['condition'];

    // Insert new furniture record
    $insertFurnitureQuery = "INSERT INTO furniture (ftype, fcondition) VALUES ('$type', '$condition')";
    mysqli_query($data, $insertFurnitureQuery);
    // Redirect to view.php or any other desired page
    header("location: view.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>


    <meta charset="utf-8">
    <title>Add Furniture</title>
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
    <h1>Add Furniture</h1>
    <div class="div_deg">
    <form method="post">
        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required><br>
        <label for="condition">Condition:</label>
        <input type="text" id="condition" name="condition" required><br>
         <input type="submit" class="btn btn-primary" name="add_furniture" value="Add Furniture">
    </form>
</div>
</center>
</div>
</body>
</html>
