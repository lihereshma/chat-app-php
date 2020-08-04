<?php
error_reporting(0);
  include_once 'db.php';
  $search_value = $_POST['search'];
  $current_user = $_SESSION['email'];
  $sql = "SELECT * FROM users WHERE user_email != '$current_user' AND (user_fname LIKE '%{$search_value}%' OR user_lname LIKE '%{$search_value}%')";
  $result = mysqli_query($connection, $sql);
  if(mysqli_num_rows($result) > 0) {
  
    while($row_user = mysqli_fetch_array($result)) {
      $user_fullName = $row_user['user_fname'] ." " .$row_user['user_lname'];
      $user_email = $row_user['user_email'];
      $user_profile = $row_user['user_profile'];
      $login = $row_user['user_status'];
  
      if ($login == 'Online') {
        $status = "<span class = 'status online'>online</span>";
      } else {
        $status = "<span class = 'status offline'>offline</span>";
      }
  
      echo "
        <li>
          <a href='chat.php?email=$user_email' title='$user_fullName'>
            <figure>
              <img src='$user_profile'>
            </figure>
            <div class='chat-left-details'>
              <p class='name'>$user_fullName</p>
              <p>$status</p>
            </div>
          </a> 
        </li>
      ";
    }
  } else {
    echo "<span>No results found for '$search_value'</span>";
  }  
?>