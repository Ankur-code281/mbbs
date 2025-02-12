<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "mbbs_abroad"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $country = htmlspecialchars($_POST["country"]);

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($country)) {
        $stmt = $conn->prepare("INSERT INTO applications (name, email, phone, country) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $country);

        if ($stmt->execute()) {
            echo "<script>alert('Application submitted successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Error submitting application. Please try again.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}

$conn->close();
