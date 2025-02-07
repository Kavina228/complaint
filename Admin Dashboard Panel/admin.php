<?php
/*// Database connection details
$servername = "localhost:8080";
$username = "root";
$password = ""; // Add your database password here
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from the registration table
$sql = "SELECT * FROM registration";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'><tr><th>Want to Complaint</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Department</th><th>Year</th><th>Gender</th><th>Place</th><th>Complaint</th><th>Number</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["want_to_complaint"] . "</td><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["email"] . "</td><td>" . $row["department"] . "</td><td>" . $row["year"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["place"] . "</td><td>" . $row["complaint"] . "</td><td>" . $row["number"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();*/
$con = mysqli_connect("localhost","root","","test");
if(!$con){
    die("connection Error");
}
?>
