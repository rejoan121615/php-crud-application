<?php

class User {
  private $userData = [];
  private $purifyedData = [];
  private $db;

  // constructor 
  public function __construct($name, $email, $password, $db) {
    $this->userData['name'] = $name;
    $this->userData['email'] = $email;
    $this->userData['password'] = $password;
    $this->db = $db;
  }

  // sanitize user data 
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

  // return santizied data 
  public function GetFilteredData () {
    $this->SanitizeData();
    return $this->purifyedData;
  }
  
}


?>