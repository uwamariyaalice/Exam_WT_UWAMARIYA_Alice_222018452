<?php
include('database_connection.php');

// Check if InstructorWorkshopID is set
if(isset($_REQUEST['InstructorWorkshopID'])) {
    $id = $_REQUEST['InstructorWorkshopID'];
    
    // Prepare and execute the DELETE statement
    $fms = $connection->prepare("DELETE FROM instructorworkshops WHERE InstructorWorkshopID = ?");
    $fms->bind_param("i", $id);
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
            <input type="hidden" name="InstructorWorkshopID" value="<?php echo $id; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($fms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='instructorworkshops.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $fms->error;
    }
    ?>
    </body>
    </html>
    <?php

    $fms->close();
} else {
    echo "InstructorWorkshopID is not set.";
}

$connection->close();
?>
