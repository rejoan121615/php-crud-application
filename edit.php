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

// Retrieve the article from the 'article' table
$sql = "SELECT * FROM article WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $description = $row['description'];
    $category = $row['category'];
    $imagePath = $row['image'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Article</title>
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
            <h2>Edit Article</h2>
            <form action="update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $description; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="Technology" <?php if ($category == 'Technology') echo 'selected'; ?>>Technology</option>
                        <option value="Travel" <?php if ($category == 'Travel') echo 'selected'; ?>>Travel</option>
                        <option value="Food" <?php if ($category == 'Food') echo 'selected'; ?>>Food</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <img src="<?php echo $imagePath; ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
} else {
    echo '<div class="alert alert-info" role="alert">
        Article not found.
    </div>';
}

// Close the database connection
$conn->close();
?>
