<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "hosteldb";

$data = mysqli_connect($host, $user, $password, $db);

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
}

if (isset($_POST['student'])) {
    $studentid = mysqli_real_escape_string($data, $_POST['studentid']);
    $name = mysqli_real_escape_string($data, $_POST['name']);
    $gender = mysqli_real_escape_string($data, $_POST['gender']);
    $contactnumber = mysqli_real_escape_string($data, $_POST['contactnumber']);
    $roomnumber = mysqli_real_escape_string($data, $_POST['roomnumber']);
    $admissionid = mysqli_real_escape_string($data, $_POST['admissionid']);
    $userid = mysqli_real_escape_string($data, $_POST['userid']);

    $sql = "INSERT INTO student (studentid, name, gender, contactnumber, roomnumber, admissionid, userid) 
            VALUES ('$studentid', '$name', '$gender', '$contactnumber', '$roomnumber', '$admissionid', '$userid')";

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
            <h1>Add Student</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>Student ID</label>
                        <input type="number" name="studentid" required>
                    </div>
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div>
                        <label>Gender</label>
                        <input type="text" name="gender" required>
                    </div>
                    <div>
                        <label>Contact Number</label>
                        <input type="number" name="contactnumber" required>
                    </div>
                    <div>
                        <label>Room Number</label>
                        <input type="number" name="roomnumber" required>
                    </div>
                    <div>
                        <label>Admission ID</label>
                        <input type="number" name="admissionid" required>
                    </div>
                    <div>
                        <label>User ID</label>
                        <input type="number" name="userid" required>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="student" value="Add Student">
                    </div>
                </form>
            </div>
        </center>
    </div>

</body>

</html>
