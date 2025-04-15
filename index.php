<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Management System</title>

  <!-- External Stylesheets -->
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

  <!-- Sidebar Section -->
  <div class="sidebar">
    <header>
      <i class="fa fa-address-book"></i>
      <h3>Contact Manager</h3>
    </header>

    <ul>
      <li>
        <a href="index.php" class="active" data-section="show-contacts">
          <i class="fa fa-list"></i> Show and Manage Contacts
        </a>
      </li>
      <li>
        <a href="index.php" data-section="add-contact">
          <i class="fa fa-user-plus"></i> Add Contact
        </a>
      </li>
    </ul>
  </div>

  <!-- Main Content Section -->
  <div class="content">

  <!-- Show All Contacts Section -->
  <div id="show-contacts" class="content-section" class="active">
      <h1>Show All Contacts</h1>
      <p>Here is the list of all your saved contacts:</p>

      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
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

// Prepare and bind the statement
$sql = "SELECT name , email , contact FROM contact";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
        echo "<td>";

        // Edit Button
        echo "<form style='display:inline;' onsubmit='return false;'>";
        echo "<input type='hidden' name='contact_number' value='" . htmlspecialchars($row['contact']) . "' id='contact-number-" . htmlspecialchars($row['contact']) . "'>";
       echo "<button type='button' onclick='openEditModal(\"" . htmlspecialchars($row['contact']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['name']) . "\")'>Edit</button>";
        echo "</form>";
       


        // Delete Button
        echo "<form action='delete.php' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this contact?\");'>";
        echo "<input type='hidden' name='contact' value='" . htmlspecialchars($row['contact']) . "'>";
        echo "<input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";

        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No contacts found</td></tr>";
}

$conn->close();
?>

        
        </tbody>
      </table>
    </div>

    <!-- Add Contact Section -->
    <div id="add-contact" class="content-section">
      <h1>Add Contact</h1>
      <form action="insert.php" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Enter name" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="number" id="phone" name="contact" placeholder="Enter phone number" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter email" required>
        </div>
        <button type="submit">Add Contact</button>
      </form>
    </div>

  </div> 

  <!-- Modal for editing contact -->
  <div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span class="close-button" onclick="closeEditModal()">&times;</span>
      <h2>Edit Contact</h2>
      <form action="update.php" method="POST">
        <div class="form-group">
          <label for="modal-name">Name<span style="color: red;">*</span></label>
          <input type="text" id="modal-name" name="name" required>
        </div>
        <div class="form-group">
          <label for="modal-phone">Phone</label>
          <input type="text" id="modal-phone" name="contact" required readonly>
        </div>
        <div class="form-group">
          <label for="modal-email">Email<span style="color: red;">*</span></label>
          <input type="email" id="modal-email" name="email" required>
        </div>
        <input type="hidden" id="modal-contact-number" name="contact_number">
        <button type="submit">Update Contact</button>
      </form>
    </div>
  </div>

  <!-- External JavaScript -->
  <script src="script.js"></script>
</body>

</html>