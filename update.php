<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve input values
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("UPDATE contact SET name = ?, email = ? WHERE contact = ?");
    $stmt->bind_param("sss", $name, $email, $contact);

    if ($stmt->execute()) {
        echo "Contact updated successfully.";
        header("Location: index.php"); // Redirect back to the main page
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

