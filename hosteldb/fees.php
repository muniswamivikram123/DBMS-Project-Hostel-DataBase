<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "hosteldb";

$data = mysqli_connect($host, $user, $password, $db);

if (!isset($_SESSION['username'])) {
    header("location: login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location: login.php");
}

if (isset($_POST['add_fees'])) {
    $studentid = mysqli_real_escape_string($data, $_POST['studentid']);
    $amount = mysqli_real_escape_string($data, $_POST['amount']);
    $paymentdate = mysqli_real_escape_string($data, $_POST['paymentdate']);

    $sql = "INSERT INTO fees (studentid, amount, paymentdate) VALUES ('$studentid', '$amount', '$paymentdate')";
    $result = mysqli_query($data, $sql);

    if ($result) {
        echo "<script type='text/javascript'>alert('Fees information added successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($data);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  

    <meta charset="utf-8">
    <title>Add Fees</title>
    <link rel="stylesheet" href="styles.css">
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
        <h1>Add Fees Information</h1>
        <div class="div_deg">
        <form action="#" method="POST">
            <div>
                <label for="studentid">Student ID:</label>
                <input type="text" name="studentid" required>
            </div>
            <div>
                <label for="amount">Amount:</label>
                <input type="text" name="amount" required>
            </div>
            <div>
                <label for="paymentdate">Payment Date:</label>
                <input type="date" name="paymentdate" required>
            </div>
            <div>
                <input type="submit" class="btn btn-primary" name="add_fees" value="Add Fees">
            </div>
        </form>
    </div>
</center>
</div>
</body>
</html>
