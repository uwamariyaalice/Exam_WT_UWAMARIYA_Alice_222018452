<?php
include('database_connection.php');

// Check if AttendeeID is set
if(isset($_REQUEST['AttendeeID'])) {
    $attendeeID = $_REQUEST['AttendeeID'];
    
    $stmt = $connection->prepare("SELECT * FROM attendees WHERE AttendeeID = ?");
    $stmt->bind_param("i", $attendeeID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['UserID'];
    } else {
        echo "Attendee not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Attendee</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Attendee Form</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="UserID">User ID:</label>
            <input type="number" name="UserID" value="<?php echo isset($userID) ? $userID : ''; ?>">
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
    $userID = $_POST['UserID'];
    // Update the attendee in the database
    $stmt = $connection->prepare("UPDATE attendees SET UserID=? WHERE AttendeeID=?");
    $stmt->bind_param("ii", $userID, $attendeeID);
    $stmt->execute();
    
    // Redirect to attendees.php
    header('Location: attendees.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
