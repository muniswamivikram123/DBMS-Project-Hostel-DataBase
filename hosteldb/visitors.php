<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "hosteldb";
$data = mysqli_connect($host, $user, $password, $db);

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); // Add exit to stop further execution
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit(); // Add exit to stop further execution
}

if (isset($_POST['visitors'])) {
    $visitid = isset($_POST['visitid']) ? mysqli_real_escape_string($data, $_POST['visitid']) : '';
    $studentid = isset($_POST['studentid']) ? mysqli_real_escape_string($data, $_POST['studentid']) : '';
    $visitorname = isset($_POST['visitorname']) ? mysqli_real_escape_string($data, $_POST['visitorname']) : '';
    $visitdate = isset($_POST['visitdate']) ? mysqli_real_escape_string($data, $_POST['visitdate']) : '';

    $sql = "INSERT INTO visitors (visitid, studentid, visitorname, visitdate) VALUES ('$visitid', '$studentid', '$visitorname', '$visitdate')";
    $result = mysqli_query($data, $sql);
    if ($result) {
        echo "<script type='text/javascript'>alert('Data uploaded successfully');</script>";
    } else {
        echo "Upload fail: " . mysqli_error($data);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
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
        <h1>Visitors</h1>
        <div class="div_deg">
            <form action="#" method="POST">
                <div>
                    <label>Visit ID:</label>
                    <input type="text" name="visitid" required>
                </div>
                <div>
                    <label>Student ID:</label>
                    <input type="number" name="studentid" required>
                </div>
                <div>
                    <label>Visitor Name:</label>
                    <input type="text" name="visitorname" required>
                </div>
                <div>
                    <label>Visit Date:</label>
                    <input type="date" name="visitdate" required>
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" name="visitors" value="Add Visitor">
                </div>
            </form>
        </div>
    </center>
</div>
</body>
</html>
