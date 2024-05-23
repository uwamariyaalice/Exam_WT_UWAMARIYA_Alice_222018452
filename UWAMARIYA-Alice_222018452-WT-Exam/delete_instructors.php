<?php
include('database_connection.php');

// Check if InstructorID is set
if(isset($_REQUEST['InstructorID'])) {
    $iid = $_REQUEST['InstructorID'];
    
    // Prepare and execute the DELETE statement
    $fms = $connection->prepare("DELETE FROM instructors WHERE InstructorID = ?");
    $fms->bind_param("i", $iid);
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
            <input type="hidden" name="InstructorID" value="<?php echo $iid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($fms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='instructors.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $fms->error;
    }
    ?>
    </body>
    </html>
    <?php

    $fms->close();
} else {
    echo "InstructorID is not set.";
}

$connection->close();
?>
