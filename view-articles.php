<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Articles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
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
    <h2>View Articles</h2>
    <div class="row">
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

      // Retrieve all articles from the 'article' table
      $sql = "SELECT * FROM article";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $category = $row['category'];
          $imagePath = $row['image'];
      ?>
          <div class="col-md-4">
            <div class="card mb-4">
              <div class=" text-center ">
                <img src="<?php echo $imagePath; ?>" class="card-img-top w-75 d-inline-block my-4 " alt="Article Image">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?></h5>
                <p class="card-text"><?php echo $description; ?></p>
                <p class="card-text"><small class="text-muted">Category: <?php echo $category; ?></small></p>
                <div class="d-flex justify-content-between">
                  <a href="view.php?id=<?php echo $id; ?>" class="btn btn-primary">View</a>
                  <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
                  <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo '<div class="alert alert-info" role="alert">
                No articles found.
              </div>';
      }

      // Close the database connection
      $conn->close();
      ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
