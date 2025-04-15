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
    $contact = htmlspecialchars($_POST['contact']);
    $email = htmlspecialchars($_POST['email']);

    // Check for duplicate contact number or email
    $checkDuplicate = $conn->prepare("SELECT * FROM contact WHERE contact = ? OR email = ?");
    $checkDuplicate->bind_param("ss", $contact, $email);
    $checkDuplicate->execute();
    $result = $checkDuplicate->get_result();

    if ($result->num_rows > 0) {
        echo "A contact with the same phone number or email already exists.";
    } else {
        // Insert the new contact
        $stmt = $conn->prepare("INSERT INTO contact (name, contact, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $contact, $email);

        if ($stmt->execute()) {
            echo "New contact added successfully.";
            header("Location: index.php"); // Redirect to the main page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkDuplicate->close();
}

// Close the database connection
$conn->close();
?>

