<?php
include('database_connection.php');

// Check if RegistrationID is set
if(isset($_REQUEST['RegistrationID'])) {
    $rid = $_REQUEST['RegistrationID'];
    
    // Prepare and execute the DELETE statement
    $fms = $connection->prepare("DELETE FROM workshopregistration WHERE RegistrationID = ?");
    $fms->bind_param("i", $rid);
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
            <input type="hidden" name="RegistrationID" value="<?php echo $rid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($fms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='workshopregistration.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $fms->error;
    }
    ?>
    </body>
    </html>
    <?php

    $fms->close();
} else {
    echo "RegistrationID is not set.";
}

$connection->close();
?>
