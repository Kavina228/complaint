<?php
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
    $host = 'localhost'; // Assuming your MySQL server is running locally
    $dbusername = 'root';
    $dbpassword = ''; // Add your database password here
    $dbname = 'project';

    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
    } else {
        $SELECT = "SELECT * FROM register WHERE email = ? AND upswd1 = ?";
        
        // Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Login successful
            header("home page:index.html");
            exit;
            // Redirect to a welcome page or perform further actions
        } else {
            // Login failed
            echo "Invalid email or password";
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Email and password are required";
    die();
}
?>
