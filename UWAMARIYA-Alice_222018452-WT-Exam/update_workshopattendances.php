<?php
include('database_connection.php');

// Check if AttendanceID is set
if(isset($_REQUEST['AttendanceID'])) {
    $attendanceID = $_REQUEST['AttendanceID'];
    
    $stmt = $connection->prepare("SELECT * FROM workshopattendance WHERE AttendanceID = ?");
    $stmt->bind_param("i", $attendanceID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['AttendanceID'];
        $y = $row['WorkshopID'];
        $z = $row['AttendeeID'];
        $v = $row['AttendanceDate'];
    } else {
        echo "Attendance record not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workshop Attendance</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Form of Workshop Attendance</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="WorkshopID">Workshop ID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="AttendeeID">Attendee ID:</label>
            <input type="number" name="AttendeeID" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="AttendanceDate">Attendance Date:</label>
            <input type="date" name="AttendanceDate" value="<?php echo isset($v) ? $v : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $WorkshopID = $_POST['WorkshopID'];
    $AttendeeID = $_POST['AttendeeID'];
    $AttendanceDate = $_POST['AttendanceDate'];

    // Update the workshop attendance record in the database
    $stmt = $connection->prepare("UPDATE workshopattendance SET WorkshopID=?, AttendeeID=?, AttendanceDate=? WHERE AttendanceID=?");
    $stmt->bind_param("iisi", $WorkshopID, $AttendeeID, $AttendanceDate, $attendanceID);
    $stmt->execute();
    
    // Redirect to workshopattendance.php
    header('Location: workshopattendances.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
