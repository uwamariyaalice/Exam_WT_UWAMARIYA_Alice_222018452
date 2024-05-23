<?php
include('database_connection.php');

// Check if the 'query' GET parameter is set
if (isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for attendees
    $sql = "SELECT * FROM attendees WHERE AttendeeID LIKE '%$searchTerm%'";
    $result_attendees = $connection->query($sql);

    // Perform the search query for certificates
    $sql = "SELECT * FROM certificates WHERE CertificateID LIKE '%$searchTerm%'";
    $result_certificates = $connection->query($sql);

    // Perform the search query for feedback
    $sql = "SELECT * FROM feedback WHERE FeedbackID LIKE '%$searchTerm%'";
    $result_feedback = $connection->query($sql);

    // Perform the search query for instructors
    $sql = "SELECT * FROM instructors WHERE InstructorID LIKE '%$searchTerm%'";
    $result_instructors = $connection->query($sql);

    // Perform the search query for instructorworkshops
    $sql = "SELECT * FROM instructorworkshops WHERE InstructorWorkshopID LIKE '%$searchTerm%'";
    $result_instructorworkshops = $connection->query($sql);

    // Perform the search query for roboticsresources
    $sql = "SELECT * FROM roboticsresources WHERE Title LIKE '%$searchTerm%'";
    $result_roboticsresources = $connection->query($sql);

    // Perform the search query for workshopattendance
    $sql = "SELECT * FROM workshopattendance WHERE AttendanceID LIKE '%$searchTerm%'";
    $result_workshopattendance = $connection->query($sql);

    // Perform the search query for workshopregistration
    $sql = "SELECT * FROM workshopregistration WHERE RegistrationID LIKE '%$searchTerm%'";
    $result_workshopregistration = $connection->query($sql);

    // Perform the search query for workshops
    $sql = "SELECT * FROM workshops WHERE Title LIKE '%$searchTerm%'";
    $result_workshops = $connection->query($sql);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>Attendees:</h3>";
    if ($result_attendees->num_rows > 0) {
        while ($row = $result_attendees->fetch_assoc()) {
            echo "<p>" . $row['AttendeeID'] . "</p>";
        }
    } else {
        echo "<p>No attendees found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Certificates:</h3>";
    if ($result_certificates->num_rows > 0) {
        while ($row = $result_certificates->fetch_assoc()) {
            echo "<p>" . $row['CertificateID'] . "</p>";
        }
    } else {
        echo "<p>No certificates found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Feedback:</h3>";
    if ($result_feedback->num_rows > 0) {
        while ($row = $result_feedback->fetch_assoc()) {
            echo "<p>" . $row['FeedbackID'] . "</p>";
        }
    } else {
        echo "<p>No feedback found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Instructors:</h3>";
    if ($result_instructors->num_rows > 0) {
        while ($row = $result_instructors->fetch_assoc()) {
            echo "<p>" . $row['InstructorID'] . "</p>";
        }
    } else {
        echo "<p>No instructors found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Instructor Workshops:</h3>";
    if ($result_instructorworkshops->num_rows > 0) {
        while ($row = $result_instructorworkshops->fetch_assoc()) {
            echo "<p>" . $row['InstructorWorkshopID'] . "</p>";
        }
    } else {
        echo "<p>No instructor workshops found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Robotics Resources:</h3>";
    if ($result_roboticsresources->num_rows > 0) {
        while ($row = $result_roboticsresources->fetch_assoc()) {
            echo "<p>" . $row['Title'] . "</p>";
        }
    } else {
        echo "<p>No robotics resources found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Workshop Attendance:</h3>";
    if ($result_workshopattendance->num_rows > 0) {
        while ($row = $result_workshopattendance->fetch_assoc()) {
            echo "<p>" . $row['AttendanceID'] . "</p>";
        }
    } else {
        echo "<p>No workshop attendance found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Workshop Registration:</h3>";
    if ($result_workshopregistration->num_rows > 0) {
        while ($row = $result_workshopregistration->fetch_assoc()) {
            echo "<p>" . $row['RegistrationID'] . "</p>";
        }
    } else {
        echo "<p>No workshop registration found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Workshops:</h3>";
    if ($result_workshops->num_rows > 0) {
        while ($row = $result_workshops->fetch_assoc()) {
            echo "<p>" . $row['Title'] . "</p>";
        }
    } else {
        echo "<p>No workshops found matching the search term: " . $searchTerm . "</p>";
    }

    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
