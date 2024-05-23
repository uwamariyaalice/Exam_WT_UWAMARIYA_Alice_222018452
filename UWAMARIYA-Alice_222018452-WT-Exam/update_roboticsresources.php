<?php
include('database_connection.php');

// Check if ResourceID is set
if(isset($_REQUEST['ResourceID'])) {
    $resourceID = $_REQUEST['ResourceID'];
    
    $stmt = $connection->prepare("SELECT * FROM roboticsresources WHERE ResourceID = ?");
    $stmt->bind_param("i", $resourceID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ResourceID'];
        $y = $row['Title'];
        $z = $row['URL'];
        $v = $row['Description'];
    } else {
        echo "Resource not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Robotics Resource</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Form of Robotics Resource</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="Title">Title:</label>
            <input type="text" name="Title" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="URL">URL:</label>
            <input type="text" name="URL" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="Description">Description:</label>
            <textarea name="Description"><?php echo isset($v) ? $v : ''; ?></textarea>
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
    $URL = $_POST['URL'];
    $Description = $_POST['Description'];

    // Update the robotics resource in the database
    $stmt = $connection->prepare("UPDATE roboticsresources SET Title=?, URL=?, Description=? WHERE ResourceID=?");
    $stmt->bind_param("sssi", $Title, $URL, $Description, $resourceID);
    $stmt->execute();
    
    // Redirect to roboticsresources.php
    header('Location: roboticsresources.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
