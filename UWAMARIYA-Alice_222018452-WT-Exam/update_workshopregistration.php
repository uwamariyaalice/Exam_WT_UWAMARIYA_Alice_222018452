<?php
include('database_connection.php');

// Check if RegistrationID is set
if(isset($_REQUEST['RegistrationID'])) {
    $registrationID = $_REQUEST['RegistrationID'];
    
    $stmt = $connection->prepare("SELECT * FROM workshopregistration WHERE RegistrationID = ?");
    $stmt->bind_param("i", $registrationID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['RegistrationID'];
        $y = $row['WorkshopID'];
        $z = $row['UserID'];
        $v = $row['RegistrationDate'];
    } else {
        echo "Registration record not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workshop Registration</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Form of Workshop Registration</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="WorkshopID">Workshop ID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="UserID">User ID:</label>
            <input type="number" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="RegistrationDate">Registration Date:</label>
            <input type="date" name="RegistrationDate" value="<?php echo isset($v) ? $v : ''; ?>">
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
    $UserID = $_POST['UserID'];
    $RegistrationDate = $_POST['RegistrationDate'];

    // Update the workshop registration record in the database
    $stmt = $connection->prepare("UPDATE workshopregistration SET WorkshopID=?, UserID=?, RegistrationDate=? WHERE RegistrationID=?");
    $stmt->bind_param("iisi", $WorkshopID, $UserID, $RegistrationDate, $registrationID);
    $stmt->execute();
    
    // Redirect to workshopregistration.php
    header('Location: workshopregistration.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
