<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workshops</title>
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
    footer{
  background-color:burlywood;
  padding: 20px;
}
    section{
    padding:32px;
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
    <h1>Workshops Form</h1>
<form method="post" onsubmit="return confirmInsert();">
    <label for="WorkshopID">WorkshopID:</label>
    <input type="number" id="WorkshopID" name="WorkshopID" required><br><br>

    <label for="Title">Title:</label>
    <input type="text" id="Title" name="Title" required><br><br>

    <label for="Description">Description:</label>
    <textarea id="Description" name="Description" required></textarea><br><br>

    <label for="StartDate">Start Date:</label>
    <input type="date" id="StartDate" name="StartDate" required><br><br>

    <label for="EndDate">End Date:</label>
    <input type="date" id="EndDate" name="EndDate" required><br><br>

    <label for="InstructorID">InstructorID:</label>
    <input type="number" id="InstructorID" name="InstructorID" required><br><br>

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
    $stmt = $connection->prepare("INSERT INTO workshops (WorkshopID, Title, Description, StartDate, EndDate, InstructorID) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $WorkshopID, $Title, $Description, $StartDate, $EndDate, $InstructorID);

    // Set parameters from POST and execute
    $WorkshopID = $_POST['WorkshopID'];
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $InstructorID = $_POST['InstructorID'];
    
    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
    $stmt->close();
}
?>

   <!-- Displaying Table of workshops -->
<center><h2>Table of workshops</h2></center>
<table>
    <tr>
        <th>WorkshopID</th>
        <th>Title</th>
        <th>Description</th>
        <th>StartDate</th>
        <th>EndDate</th>
        <th>InstructorID</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');
    // Retrieve all records from the workshops table
    $stmt = $connection->prepare("SELECT * FROM workshops");
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if there are any results
    if ($result->num_rows > 0) { 
        // Loop through each row
        while ($row = $result->fetch_assoc()) {
            // Store the WorkshopID in a variable
            $workshopID = $row["WorkshopID"];
            // Output the data in table row format
            echo "<tr>
                <td>" . $row["WorkshopID"] . "</td>
                <td>" . $row["Title"] . "</td>
                <td>" . $row["Description"] . "</td>
                <td>" . $row["StartDate"] . "</td>
                <td>" . $row["EndDate"] . "</td>
                <td>" . $row["InstructorID"] . "</td>
                <td><a href='delete_workshops.php?WorkshopID=$workshopID'>Delete</a></td> 
                <td><a href='update_workshops.php?WorkshopID=$workshopID'>Update</a></td> 
            </tr>";
        }
    } else {
        // If no data found, display a message
        echo "<tr><td colspan='8'>No data found</td></tr>";
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