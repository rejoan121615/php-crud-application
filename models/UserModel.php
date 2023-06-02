<?php

class User {
  private $userData = [];
  private $purifyedData = [];
  private $db;

  // ------------------ constructor 
  public function __construct($name, $email, $password, $db) {
    $this->userData['name'] = $name;
    $this->userData['email'] = $email;
    $this->userData['password'] = $password;
    $this->db = $db;
  }

  // ------------------ sanitize user data 
  private function SanitizeData () {
    $temp_data_list = [];
    // tag sanitization
    $temp_data_list['name'] = strip_tags($this->userData['name']);
    $temp_data_list['email'] = filter_var($this->userData['email'], FILTER_VALIDATE_EMAIL);
    $temp_data_list['password'] = strip_tags($this->userData['password']);
    // additional data sanitization for database
    foreach($temp_data_list as $key => $value ) {
      $this->purifyedData[$key] = mysqli_real_escape_string($this->db, $value);
    }
    return $this->purifyedData;
  }

//  --------------------- store user data into database

  // store data into database 
  public function CreateAccount () {
    // select database if not available then create one 
    $this->db->select_db('blog');
    // sanitize and store data 
    $this->SanitizeData();     
    //  hash user password
    $hashPass = password_hash($this->purifyedData['password'], PASSWORD_DEFAULT);
    // store data 
    $tableQuery = 'SHOW TABLES LIKE \'users\'';
    $tableQueryResult = $this->db->query($tableQuery);
    $userDataQuery = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('{$this->purifyedData['name']}', '{$this->purifyedData['email']}', '{$hashPass}');";
    // if table exists then push data or create one and then push
    if ($tableQueryResult->num_rows) {
      $this->db->query($userDataQuery);
    } else {
      $newTableQuery = 'CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(40) NOT NULL,
      email VARCHAR(100) NOT NULL,
      password VARCHAR(255) NOT NULL
    )';
      $this->db->query($newTableQuery);
      $this->db->query($userDataQuery);
    }
    
  }

  // ------------------------ return santizied data 
  public function LogIn () {
	  $db = $this->db;
	  $queryResult = $db->query('SELECT * FROM `users`');
    echo 'logged in me';
	print_r($queryResult);
  }

  
}

