<?php
include('database_connection.php');

// Check if FeedbackID is set
if(isset($_REQUEST['FeedbackID'])) {
    $feedbackID = $_REQUEST['FeedbackID'];
    
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE FeedbackID = ?");
    $stmt->bind_param("i", $feedbackID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['FeedbackID'];
        $y = $row['UserID'];
        $z = $row['WorkshopID'];
        $v = $row['Rating'];
        $w = $row['Comment'];
        $u = $row['FeedbackDate'];
    } else {
        echo "Feedback not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Feedback</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Form of Feedback</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="UserID">UserID:</label>
            <input type="number" name="UserID" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="WorkshopID">WorkshopID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="Rating">Rating:</label>
            <input type="number" name="Rating" value="<?php echo isset($v) ? $v : ''; ?>" min="1" max="5">
            <br><br>
            
            <label for="Comment">Comment:</label>
            <textarea name="Comment"><?php echo isset($w) ? $w : ''; ?></textarea>
            <br><br>

            <label for="FeedbackDate">Feedback Date:</label>
            <input type="date" name="FeedbackDate" value="<?php echo isset($u) ? $u : ''; ?>">
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
    $WorkshopID = $_POST['WorkshopID'];
    $Rating = $_POST['Rating'];
    $Comment = $_POST['Comment'];
    $FeedbackDate = $_POST['FeedbackDate'];

    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET UserID=?, WorkshopID=?, Rating=?, Comment=?, FeedbackDate=? WHERE FeedbackID=?");
    $stmt->bind_param("iiissi", $UserID, $WorkshopID, $Rating, $Comment, $FeedbackDate, $feedbackID);
    $stmt->execute();
    
    // Redirect to feedback.php
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
