<?php
include('database_connection.php');

// Check if WorkshopID is set
if(isset($_REQUEST['WorkshopID'])) {
    $wid = $_REQUEST['WorkshopID'];
    
    // Prepare and execute the DELETE statement
    $fms = $connection->prepare("DELETE FROM workshops WHERE WorkshopID = ?");
    $fms->bind_param("i", $wid);
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
            <input type="hidden" name="WorkshopID" value="<?php echo $wid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($fms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='workshops.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $fms->error;
    }
    ?>
    </body>
    </html>
    <?php

    $fms->close();
} else {
    echo "WorkshopID is not set.";
}

$connection->close();
?>
