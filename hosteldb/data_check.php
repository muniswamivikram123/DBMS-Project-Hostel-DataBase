<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "hosteldb";

// Establish connection
$data = mysqli_connect($host, $user, $password, $db);

// Check if connection is successful
if ($data === false) {
    die("Connection error: " . mysqli_connect_error());
}

if (isset($_POST['apply'])) {
    // Sanitize user inputs to prevent SQL injection
    $data_name = mysqli_real_escape_string($data, $_POST['name']);
    $data_email = mysqli_real_escape_string($data, $_POST['email']);
    $data_phone = mysqli_real_escape_string($data, $_POST['phone']);
    $data_message = mysqli_real_escape_string($data, $_POST['message']);

    // Insert data into the admission table
    $sql = "INSERT INTO admission (name, email, phone, message) VALUES ('$data_name', '$data_email', '$data_phone', '$data_message')";

    // Execute the SQL query
    $result = mysqli_query($data, $sql);

    // Check if the query was successful
    if ($result) {
        // Set session message for successful application
        $_SESSION['message'] = "Your application was sent successfully";
        // Redirect to index.php after successful submission
        header("location: index.php");
        exit(); // Terminate script execution after redirection
    } else {
        echo "Apply Failed: " . mysqli_error($data);
    }
}
?>
