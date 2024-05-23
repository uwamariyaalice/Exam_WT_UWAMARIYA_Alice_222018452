<?php
include('database_connection.php');

// Check if CertificateID is set
if(isset($_REQUEST['CertificateID'])) {
    $certificateID = $_REQUEST['CertificateID'];
    
    $stmt = $connection->prepare("SELECT * FROM certificates WHERE CertificateID = ?");
    $stmt->bind_param("i", $certificateID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['UserID'];
        $workshopID = $row['WorkshopID'];
        $issuedDate = $row['IssuedDate'];
        $certificateURL = $row['CertificateURL'];
    } else {
        echo "Certificate not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Certificate</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Certificate Form</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="UserID">User ID:</label>
            <input type="number" name="UserID" value="<?php echo isset($userID) ? $userID : ''; ?>">
            <br><br>

            <label for="WorkshopID">Workshop ID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($workshopID) ? $workshopID : ''; ?>">
            <br><br>

            <label for="IssuedDate">Issued Date:</label>
            <input type="date" name="IssuedDate" value="<?php echo isset($issuedDate) ? $issuedDate : ''; ?>">
            <br><br>
            
            <label for="CertificateURL">Certificate URL:</label>
            <input type="text" name="CertificateURL" value="<?php echo isset($certificateURL) ? $certificateURL : ''; ?>">
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
    $userID = $_POST['UserID'];
    $workshopID = $_POST['WorkshopID'];
    $issuedDate = $_POST['IssuedDate'];
    $certificateURL = $_POST['CertificateURL'];
    // Update the certificate in the database
    $stmt = $connection->prepare("UPDATE certificates SET UserID=?, WorkshopID=?, IssuedDate=?, CertificateURL=? WHERE CertificateID=?");
    $stmt->bind_param("iisss", $userID, $workshopID, $issuedDate, $certificateURL, $certificateID);
    $stmt->execute();
    
    // Redirect to certificates.php
    header('Location: certificates.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
