<?php
include('database_connection.php');

// Check if CertificateID is set
if(isset($_REQUEST['CertificateID'])) {
    $cid = $_REQUEST['CertificateID'];
    
    // Prepare and execute the DELETE statement
    $fms = $connection->prepare("DELETE FROM certificates WHERE CertificateID = ?");
    $fms->bind_param("i", $cid);
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
            <input type="hidden" name="CertificateID" value="<?php echo $cid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($fms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='certificates.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $fms->error;
    }
    ?>
    </body>
    </html>
    <?php

    $fms->close();
} else {
    echo "CertificateID is not set.";
}

$connection->close();
?>
