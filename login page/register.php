<?php
$uname1 = $_POST['uname1'];
$email  = $_POST['email'];
$upswd1 = $_POST['upswd1'];
$upswd2 = $_POST['upswd2'];

if (!empty($uname1) && !empty($email) && !empty($upswd1) && !empty($upswd2)) {
    $host = 'localhost'; // Assuming your MySQL server is running locally
    $dbusername = 'root';
    $dbpassword = ''; // Add your database password here
    $dbname = 'project';

    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connect Error ('. $conn->connect_errno .') ' . $conn->connect_error);
    } else {
        $SELECT = "SELECT email FROM register WHERE email = ?";
        $INSERT = "INSERT INTO register (uname1, email, upswd1, upswd2) VALUES (?, ?, ?, ?)";

        // Prepare and bind SELECT statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        // Check if email already exists
        if ($rnum == 0) {
            $stmt->close();

            // Prepare and bind INSERT statement
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssss", $uname1, $email, $upswd1, $upswd2);
            if ($stmt->execute()) {
                echo "New record inserted successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Someone already registered using this email";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All fields are required";
}
?>
