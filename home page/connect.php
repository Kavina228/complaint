<?php
// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Database connection
$servername = "localhost"; // Assuming your MySQL server is running locally
$username = "root";
$password = ""; // Add your database password here
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO registration (want_to_complaint, firstName, lastName, email, department, year, gender, place, complaint, number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        // Sanitize and bind parameters
        $want_to_complaint = sanitizeInput($_POST['want_to_complaint']);
        $firstName = sanitizeInput($_POST['firstName']);
        $lastName = sanitizeInput($_POST['lastName']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Using filter_var for email
        $department = sanitizeInput($_POST['department']);
        $year = intval($_POST['year']); // Assuming 'year' is an integer
        $gender = sanitizeInput($_POST['gender']);
        $place = sanitizeInput($_POST['place']);
        $complaint = sanitizeInput($_POST['complaint']);
        $number = sanitizeInput($_POST['number']);

        $stmt->bind_param("ssssissssi", $want_to_complaint, $firstName, $lastName, $email, $department, $year, $gender, $place, $complaint, $number);

        // Execute statement
        $execVal = $stmt->execute();

        if (!$execVal) {
            echo "Error: " . $stmt->error;
        } else {
            echo "Registration successful...";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
