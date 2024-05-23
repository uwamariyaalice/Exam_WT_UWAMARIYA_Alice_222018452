<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructor Workshops</title>
    <style>
       a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: grey; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: grey;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:32px;
    }
        footer{
  background-color:burlywood;
  padding: 20px;
}
  </style>
  
    <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>

</head>
<body>
<header>
     <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./images/images.jpeg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">attendees</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./certificates.php">certificates</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">feedback</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./instructors.php">instructors</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./instructorworkshops.php">instructorworkshops</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./roboticsresources.php">roboticsresources</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./workshopattendances.php">workshopattendances</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./workshopregistration.php">workshopregistration</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">workshops</a>
  </li>
    
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Use other account</a>
        <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
    <form class="d-flex" role="search" action="search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</header>
<section>
    <h1>Instructor Workshops Form</h1>
<form method="post" onsubmit="return confirmInsert();">
    <label for="InstructorWorkshopID">InstructorWorkshopID:</label>
    <input type="number" id="InstructorWorkshopID" name="InstructorWorkshopID" required><br><br>

    <label for="InstructorID">InstructorID:</label>
    <input type="number" id="InstructorID" name="InstructorID" required><br><br>

    <label for="WorkshopID">WorkshopID:</label>
    <input type="number" id="WorkshopID" name="WorkshopID" required><br><br>

    <input type="submit" name="insert" value="Insert"><br><br>
</form>
<a href="./home.html">Go Back to Home</a>

<!-- PHP Code to Insert Data -->
<?php
// Include the database connection file
include('database_connection.php');

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Prepare the insert statement
    $stmt = $connection->prepare("INSERT INTO instructorworkshops (InstructorWorkshopID, InstructorID, WorkshopID) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $InstructorWorkshopID, $InstructorID, $WorkshopID);

    // Set parameters from POST and execute
    $InstructorWorkshopID = $_POST['InstructorWorkshopID'];
    $InstructorID = $_POST['InstructorID'];
    $WorkshopID = $_POST['WorkshopID'];
    
    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
    $stmt->close();
}
?>

   <!-- Displaying Table of instructor workshops -->
<center><h2>Table of instructor workshops</h2></center>
<table border="1">
    <tr>
        <th>InstructorWorkshopID</th>
        <th>InstructorID</th>
        <th>WorkshopID</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');
    // Retrieve all records from the instructorworkshops table
    $stmt = $connection->prepare("SELECT * FROM instructorworkshops");
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if there are any results
    if ($result->num_rows > 0) { 
        // Loop through each row
        while ($row = $result->fetch_assoc()) {
            // Store the InstructorWorkshopID in a variable
            $instructorWorkshopID = $row["InstructorWorkshopID"];
            // Output the data in table row format
            echo "<tr>
                <td>" . $row["InstructorWorkshopID"] . "</td>
                <td>" . $row["InstructorID"] . "</td>
                <td>" . $row["WorkshopID"] . "</td>
                <td><a href='delete_instructorworkshops.php?InstructorWorkshopID=$instructorWorkshopID'>Delete</a></td> 
                <td><a href='update_instructorworkshops.php?InstructorWorkshopID=$instructorWorkshopID'>Update</a></td> 
            </tr>";
        }
    } else {
        // If no data found, display a message
        echo "<tr><td colspan='5'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
</table>

</section>
<footer>
    <center> 
        <b><h2><i>UR CBE BIT  prepared by:Alice</i></h2></b>
    </center>
</footer>
</body>
</html>
