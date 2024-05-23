<?php
include('database_connection.php');

// Check if FeedbackID is set
if(isset($_REQUEST['FeedbackID'])) {
    $fid = $_REQUEST['FeedbackID'];
    
    // Prepare and execute the DELETE statement
    $fms = $connection->prepare("DELETE FROM feedback WHERE FeedbackID = ?");
    $fms->bind_param("i", $fid);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body bgcolor="grey">
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="FeedbackID" value="<?php echo $fid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($fms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='feedback.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $fms->error;
    }
    ?>
    </body>
    </html>
    <?php

    $fms->close();
} else {
    echo "FeedbackID is not set.";
}

$connection->close();
?>
