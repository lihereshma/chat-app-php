<?php
  $dbServerName = "localhost";
  $dbUserName = "root";
  $dbPassword = "";
  $dbName = "chat_app";

  $connection = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

  if(!$connection) {
    die("Failed" . mysqli_error($connection));
  }
?>