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

// Update record in the Admission table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_admission'])) {
    $admissionIdToUpdate = $_POST['update_admission'];
    // Retrieve the updated data from the form
    $updatedName = mysqli_real_escape_string($data, $_POST['updated_name']);
    $updatedEmail = mysqli_real_escape_string($data, $_POST['updated_email']);
    $updatedPhone = mysqli_real_escape_string($data, $_POST['updated_phone']);
    $updatedMessage = mysqli_real_escape_string($data, $_POST['updated_message']);

    // Update the Admission table
    $updateAdmissionQuery = "UPDATE admission SET name = '$updatedName', email = '$updatedEmail',
                            phone = '$updatedPhone', message = '$updatedMessage' WHERE id = '$admissionIdToUpdate'";
    mysqli_query($data, $updateAdmissionQuery);
    header("location: view.php");
}

// Retrieve the data for the selected record from the Admission table
if (isset($_GET['admission_id'])) {
    $admissionIdToEdit = $_GET['admission_id'];
    $getAdmissionQuery = "SELECT * FROM admission WHERE id = '$admissionIdToEdit'";
    $resultAdmission = mysqli_query($data, $getAdmissionQuery);
    $admissionData = mysqli_fetch_assoc($resultAdmission);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Update Record</h1>
<!-- Form for updating Admission record -->
<form method="post" action="update.php">
    <!-- Add input fields for each field in the Admission table -->
    Name: <input type="text" name="updated_name" value="<?php echo $admissionData['name']; ?>"><br>
    Email: <input type="text" name="updated_email" value="<?php echo $admissionData['email']; ?>"><br>
    Phone: <input type="text" name="updated_phone" value="<?php echo $admissionData['phone']; ?>"><br>
    Message: <input type="text" name="updated_message" value="<?php echo $admissionData['message']; ?>"><br>
    <input type="hidden" name="update_admission" value="<?php echo $admissionIdToEdit; ?>">
    <input type="submit" value="Update">
</form>
</body>
</html>
