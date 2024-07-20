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

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

$tableToUpdate = $_GET['table'];
$idToEdit = $_GET['id_to_edit'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updatedAmount = mysqli_real_escape_string($data, $_POST['updated_amount']);
    $updatedPaymentDate = mysqli_real_escape_string($data, $_POST['updated_paymentdate']);

    $updateQuery = "UPDATE fees SET amount = '$updatedAmount', paymentdate = '$updatedPaymentDate' WHERE feesid = '$idToEdit'";
    mysqli_query($data, $updateQuery);
    header("location: view.php");
}

$fetchRecordQuery = "SELECT * FROM fees WHERE feesid = '$idToEdit'";
$result = mysqli_query($data, $fetchRecordQuery);
$existingData = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Fees Record</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="content">
    <h1>Update Fees Record</h1>
    <form method="post">
        <label for="updated_amount">Amount:</label>
        <input type="text" name="updated_amount" value="<?php echo isset($existingData['amount']) ? $existingData['amount'] : ''; ?>">
        <label for="updated_paymentdate">Payment Date:</label>
        <input type="date" name="updated_paymentdate" value="<?php echo isset($existingData['paymentdate']) ? $existingData['paymentdate'] : ''; ?>">
        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>
</html>
