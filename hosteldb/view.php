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

// Delete record from the Admission table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_admission'])) {
    $admissionIdToDelete = $_POST['delete_admission'];
    $deleteAdmissionQuery = "DELETE FROM admission WHERE id = '$admissionIdToDelete'";
    mysqli_query($data, $deleteAdmissionQuery);
    header("Refresh:0");
}

// Delete record from the Fees table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_fees'])) {
    $feesIdToDelete = $_POST['delete_fees'];
    $deleteFeesQuery = "DELETE FROM fees WHERE feesid = '$feesIdToDelete'";
    mysqli_query($data, $deleteFeesQuery);
    header("Refresh:0");
}

// Delete record from the Furniture table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_furniture'])) {
    $furnitureIdToDelete = $_POST['delete_furniture'];
    $deleteFurnitureQuery = "DELETE FROM furniture WHERE furnitureid = '$furnitureIdToDelete'";
    mysqli_query($data, $deleteFurnitureQuery);
    header("Refresh:0");
}

// Delete record from the Rooms table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_rooms'])) {
    $roomNumberToDelete = $_POST['delete_rooms'];
    $deleteRoomsQuery = "DELETE FROM rooms WHERE roomnumber = '$roomNumberToDelete'";
    mysqli_query($data, $deleteRoomsQuery);
    header("Refresh:0");
}

// Delete record from the Student table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_student'])) {
    $studentIdToDelete = $_POST['delete_student'];
    $deleteStudentQuery = "DELETE FROM student WHERE studentid = '$studentIdToDelete'";
    mysqli_query($data, $deleteStudentQuery);
    header("Refresh:0");
}

// Delete record from the User table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_fees'])) {
    $feesIdToDelete = $_POST['delete_fees'];
    $deleteFeesQuery = "DELETE FROM fees WHERE feesid = '$feesIdToDelete'";
    mysqli_query($data, $deleteFeesQuery);
    header("Refresh:0");
}

// Delete record from the Visitors table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_visitors'])) {
    $visitIdToDelete = $_POST['delete_visitors'];
    $deleteVisitorsQuery = "DELETE FROM visitors WHERE visitid = '$visitIdToDelete'";
    mysqli_query($data, $deleteVisitorsQuery);
    header("Refresh:0");
}

// Query for Admission table
$sqlAdmission = "SELECT * FROM admission";
$resultAdmission = mysqli_query($data, $sqlAdmission);

// Query for Fees table
$sqlFees = "SELECT * FROM fees";
$resultFees = mysqli_query($data, $sqlFees);

// Query for Furniture table
$sqlFurniture = "SELECT * FROM furniture";
$resultFurniture = mysqli_query($data, $sqlFurniture);

// Query for Rooms table
$sqlRooms = "SELECT * FROM rooms";
$resultRooms = mysqli_query($data, $sqlRooms);

// Query for Student table
$sqlStudent = "SELECT * FROM student";
$resultStudent = mysqli_query($data, $sqlStudent);

// Query for User table
$sqlFees = "SELECT * FROM fees";
$resultFees = mysqli_query($data, $sqlFees);

// Query for Visitors table
$sqlVisitors = "SELECT * FROM visitors";
$resultVisitors = mysqli_query($data, $sqlVisitors);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">

    <?php
    include 'admin_css.php';
    ?>
</head>

<body>

    <?php
    include 'admin_sidebar.php';
    ?>

    <div class="content">

       <h1>Furniture</h1>
<table class="clean-table">
    <tr>
        <th>Furniture ID</th>
        <th>Type</th>
        <th>Condition</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    while ($info = $resultFurniture->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo isset($info['furnitureid']) ? $info['furnitureid'] : ''; ?></td>
            <td><?php echo isset($info['ftype']) ? $info['ftype'] : ''; ?></td>
            <td><?php echo isset($info['fcondition']) ? $info['fcondition'] : ''; ?></td>
             <td>
                <a href="update_furniture.php?furnitureid=<?php echo isset($info['furnitureid']) ? $info['furnitureid'] : ''; ?>">Edit</a>
            </td>
            
            <td>
                <form method="post">
                    <button type="submit" name="delete_furniture" value="<?php echo isset($info['furnitureid']) ? $info['furnitureid'] : ''; ?>">Delete</button>
                </form>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<h1>Admission</h1>
        <table class="clean-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultAdmission->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['id']) ? $info['id'] : ''; ?></td>
                                        <td><?php echo isset($info['name']) ? $info['name'] : ''; ?></td>
                    <td><?php echo isset($info['email']) ? $info['email'] : ''; ?></td>
                    <td><?php echo isset($info['phone']) ? $info['phone'] : ''; ?></td>
                    <td><?php echo isset($info['message']) ? $info['message'] : ''; ?></td>
                    <td>
                <a href="update.php?admission_id=<?php echo isset($info['id']) ? $info['id'] : ''; ?>">Edit</a>
            </td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_admission" value="<?php echo isset($info['id']) ? $info['id'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

        <!-- Continue with the code for the remaining tables -->

        <h1>Rooms</h1>
        <table class="clean-table">
            <tr>
                <th>Room Number</th>
                <th>Capacity</th>
                <th>Occupancy</th>
                <th>Furniture ID</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultRooms->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['roomnumber']) ? $info['roomnumber'] : ''; ?></td>
                    <td><?php echo isset($info['capacity']) ? $info['capacity'] : ''; ?></td>
                    <td><?php echo isset($info['occupancy']) ? $info['occupancy'] : ''; ?></td>
                    <td><?php echo isset($info['furnitureid']) ? $info['furnitureid'] : ''; ?></td>
                     <td>
                <a href="update_rooms.php?roomnumber=<?php echo isset($info['roomnumber']) ? $info['roomnumber'] : ''; ?>">Edit</a>
            </td>
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_rooms" value="<?php echo isset($info['roomnumber']) ? $info['roomnumber'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

        <h1>Student</h1>
        <table class="clean-table">
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <!-- Add other fields as needed -->
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultStudent->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['studentid']) ? $info['studentid'] : ''; ?></td>
                    <td><?php echo isset($info['name']) ? $info['name'] : ''; ?></td>
                     <td>
                <a href="update_student.php?student_id_to_edit=<?php echo isset($info['studentid']) ? $info['studentid'] : ''; ?>">Edit</a>
            </td>
                    <!-- Add other cells as needed -->
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_student" value="<?php echo isset($info['studentid']) ? $info['studentid'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

        <h1>Fees</h1>
<table class="clean-table">
    <tr>
        <th>Fees Id</th>
        <th>Student id</th>
        <th>Amount</th>
        <th>Payment Date</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    while ($info = $resultFees->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo isset($info['feesid']) ? $info['feesid'] : ''; ?></td>
            <td><?php echo isset($info['studentid']) ? $info['studentid'] : ''; ?></td>
            <td><?php echo isset($info['amount']) ? $info['amount'] : ''; ?></td>
            <td><?php echo isset($info['paymentdate']) ? $info['paymentdate'] : ''; ?></td>
             <td>
                <a href="updatefee.php?table=fees&id_to_edit=<?php echo isset($info['feesid']) ? $info['feesid'] : ''; ?>">Edit</a>
            </td>
            <td>
                <form method="post">
                    <button type="submit" name="delete_fees" value="<?php echo isset($info['feesid']) ? $info['feesid'] : ''; ?>">Delete</button>
                </form>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<!-- Continue with the code for the remaining tables -->


<!-- ... (Previous code remains unchanged) ... -->

        <h1>Visitors</h1>
        <table class="clean-table">
            <tr>
                <th>Visit ID</th>
                <th>Student ID</th>
                <!-- Add other fields as needed -->
                <th>Delete</th>
            </tr>
            <?php
            while ($info = $resultVisitors->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo isset($info['visitid']) ? $info['visitid'] : ''; ?></td>
                    <td><?php echo isset($info['studentid']) ? $info['studentid'] : ''; ?></td>
                    <!-- Add other cells as needed -->
                    <td>
                        <form method="post">
                            <button type="submit" name="delete_visitors" value="<?php echo isset($info['visitid'])

                    ? $info['visitid'] : ''; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

</body>

</html>
