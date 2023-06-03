<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Create a connection to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the article ID from the query parameter
$id = $_GET['id'];

// Delete the article from the 'article' table
$sql = "DELETE FROM article WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Article deleted successfully."); window.location.href = "view-articles.php";</script>';
} else {
    echo "Error deleting article: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
