<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Article</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  
  <?php
  // Database connection configuration
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "blog";

  // Create a connection to MySQL database
  $conn = new mysqli($servername, $username, $password);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Create the database if it doesn't exist
  $createDbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
  $conn->query($createDbQuery);

  // Switch to the database
  $conn->select_db($dbname);

  // Create the 'article' table if it doesn't exist
  $createTableQuery = "CREATE TABLE IF NOT EXISTS article (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL
  )";
  $conn->query($createTableQuery);

  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Prepare and execute the SQL query to insert the form data into the 'article' table
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $imageName = $_FILES['image']['name'];
    $imageTempName = $_FILES['image']['tmp_name'];
    $imagePath = "images/" . $imageName;

    move_uploaded_file($imageTempName, $imagePath);

    $sql = "INSERT INTO article (title, description, category, image) VALUES ('$title', '$description', '$category', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
      echo '<div class="container mt-5">
              <div class="alert alert-success" role="alert">
                Article created successfully!
              </div>
            </div>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  // Close the database connection
  $conn->close();
  ?>

  <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5 ">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="add-article.php">Add New Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="view-articles.php">All Article</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  <div class="container mt-5">
    <h2>Create Article</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category" required>
          <option value="">Select a category</option>
          <option value="Technology">Technology</option>
          <option value="Travel">Travel</option>
          <option value="Food">Food</option>
          <!-- Add more options as needed -->
        </select>
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
