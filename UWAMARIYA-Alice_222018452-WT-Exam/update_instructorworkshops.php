<?php
include('database_connection.php');

// Check if InstructorWorkshopID is set
if(isset($_REQUEST['InstructorWorkshopID'])) {
    $iwID = $_REQUEST['InstructorWorkshopID'];
    
    $stmt = $connection->prepare("SELECT * FROM instructorworkshops WHERE InstructorWorkshopID = ?");
    $stmt->bind_param("i", $iwID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['InstructorWorkshopID'];
        $y = $row['InstructorID'];
        $z = $row['WorkshopID'];
    } else {
        echo "Instructor workshop not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Instructor Workshop</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Form of Instructor Workshop</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="InstructorID">InstructorID:</label>
            <input type="number" name="InstructorID" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="WorkshopID">WorkshopID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($z) ? $z : ''; ?>">
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
    $InstructorID = $_POST['InstructorID'];
    $WorkshopID = $_POST['WorkshopID'];

    // Update the instructor workshop in the database
    $stmt = $connection->prepare("UPDATE instructorworkshops SET InstructorID=?, WorkshopID=? WHERE InstructorWorkshopID=?");
    $stmt->bind_param("iii", $InstructorID, $WorkshopID, $iwID);
    $stmt->execute();
    
    // Redirect to instructorworkshops.php
    header('Location: instructorworkshops.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
