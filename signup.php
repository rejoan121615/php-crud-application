<?php 
// require database file 
  require_once("./database/database.php");
  require_once('./models/UserModel.php');

//  form validation store
	$inputValidation = [
		"name" => false,
		"email" => false,
		"password" => false
	];

  // check form 
  if (isset($_POST['submit'])) {
    // validate data 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //    validation checking methos
      function CheckValidation ($val, $field) {
		  if (empty($val)) {
			  $inputValidation[`{$field}`] = false;
		  } else {
			  $inputValidation[`{$field}`] = true;
		  }
      }
//    check validation for all field
      CheckValidation($name, 'name');
	  CheckValidation($email, 'email');
      CheckValidation($password, 'password');



    // sanitize user data 
    
    $registerUser = new User($name, $email, $password, $connection);
    // print_r($registerUser->GetFilteredData());
    $registerUser->CreateAccount();
    
  }


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body style="height: 100vh" class=" w-100 d-flex flex-column justify-content-center align-items-center ">
    <section class=" w-75 ">
      <div class="container">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <h1 class=" text-center ">Welcome, registration here</h1>
        <div class="mb-3 mt-5 ">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address:</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class=" mt-4">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>