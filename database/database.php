<?php

  $connection = new mysqli('localhost', 'root', '', 'blog') or die("got an error");
  $connection->set_charset('utf8');
  // print_r($connection);
?>