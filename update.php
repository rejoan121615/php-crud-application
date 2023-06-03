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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Update the article in the 'article' table
    $sql = "UPDATE article SET title='$title', description='$description', category='$category' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the 'view-articles.php' page after successful update
        header("Location: view-articles.php");
        exit();
    } else {
        echo "Error updating article: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
