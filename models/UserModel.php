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
private function StoreUser () {
    // sanitize and store data 
    $this->SanitizeData();     
    //  hash user password
    $hashPass = password_hash($this->purifyedData['password'], PASSWORD_DEFAULT);
    // store data 
    $queryData = $this->db->query('');
  }
  // store data into database 
  public function CreateAccount () {

    $db = $this->db;
    // select database if not available then create one 
    try {
        if ($db->select_db('blog')) {
            echo 'do something';
            $this->StoreUser();
        }
    } catch (Exception $e) {
        //create a database if not exits
        $db->query('CREATE DATABASE blog');
        $this->StoreUser();
    }
  }

  // ------------------------ return santizied data 
  public function GetFilteredData () {
    $this->SanitizeData();
    return $this->purifyedData;
  }

  
}

