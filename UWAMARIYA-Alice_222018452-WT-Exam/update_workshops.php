<?php
include('database_connection.php');

// Check if WorkshopID is set
if(isset($_REQUEST['WorkshopID'])) {
    $workshopID = $_REQUEST['WorkshopID'];
    
    $stmt = $connection->prepare("SELECT * FROM workshops WHERE WorkshopID = ?");
    $stmt->bind_param("i", $workshopID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['WorkshopID'];
        $y = $row['Title'];
        $z = $row['Description'];
        $v = $row['StartDate'];
        $w = $row['EndDate'];
        $instructorID = $row['InstructorID'];
    } else {
        echo "Workshop not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workshop</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Workshop Form</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="Title">Title:</label>
            <input type="text" name="Title" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="Description">Description:</label>
            <textarea name="Description"><?php echo isset($z) ? $z : ''; ?></textarea>
            <br><br>

            <label for="StartDate">Start Date:</label>
            <input type="date" name="StartDate" value="<?php echo isset($v) ? $v : ''; ?>">
            <br><br>
            
            <label for="EndDate">End Date:</label>
            <input type="date" name="EndDate" value="<?php echo isset($w) ? $w : ''; ?>">
            <br><br>

            <label for="InstructorID">Instructor ID:</label>
            <input type="number" name="InstructorID" value="<?php echo isset($instructorID) ? $instructorID : ''; ?>">
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
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $InstructorID = $_POST['InstructorID'];
    // Update the workshop in the database
    $stmt = $connection->prepare("UPDATE workshops SET Title=?, Description=?, StartDate=?, EndDate=?, InstructorID=? WHERE WorkshopID=?");
    $stmt->bind_param("sssiii", $Title, $Description, $StartDate, $EndDate, $InstructorID, $workshopID);
    $stmt->execute();
    
    // Redirect to workshops.php
    header('Location: workshops.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
