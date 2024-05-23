<?php
include('database_connection.php');

// Check if InstructorID is set
if(isset($_REQUEST['InstructorID'])) {
    $instructorID = $_REQUEST['InstructorID'];
    
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE InstructorID = ?");
    $stmt->bind_param("i", $instructorID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['InstructorID'];
        $y = $row['UserID'];
        $z = $row['Bio'];
    } else {
        echo "Instructor not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Instructor</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Form of Instructor</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="UserID">UserID:</label>
            <input type="number" name="UserID" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="Bio">Bio:</label>
            <textarea name="Bio"><?php echo isset($z) ? $z : ''; ?></textarea>
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
    $UserID = $_POST['UserID'];
    $Bio = $_POST['Bio'];

    // Update the instructor in the database
    $stmt = $connection->prepare("UPDATE instructors SET UserID=?, Bio=? WHERE InstructorID=?");
    $stmt->bind_param("isi", $UserID, $Bio, $instructorID);
    $stmt->execute();
    
    // Redirect to instructors.php
    header('Location: instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
