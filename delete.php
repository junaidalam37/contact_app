<?php
$email = $_POST['email'];

$conn = new mysqli("localhost", "root", "", "mydatabase");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<p> connected to database successfully!</p>";

$query = "DELETE FROM contact WHERE email = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<p>Record deleted successfully!</p>";
        header("Location: index.php");
    exit();
    } else {
        echo "<p>No matching record found to delete.</p>";
    }
} else {
    echo "<p>Error: " . $stmt->error . "</p>";

}

$stmt->close();
$conn->close();
?>
