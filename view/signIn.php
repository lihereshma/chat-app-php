<?php
  error_reporting(0);
  session_start();
  require_once '../include/db.php';
  
  if(isset($_POST['signIn'])) {    
    $userEmail = $_POST['email'];
    $password = $_POST['password'];
    
    if(empty($userEmail) OR empty($password)) {
      $error = "empty fields not allowed";
    } else {
      $sql = "SELECT * FROM users WHERE user_email = '$userEmail'";
      $query = mysqli_query($connection, $sql);

      if(mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_array($query);
        if(password_verify($password, $row['user_pswd'])){
          if(isset($_POST['check'])) {
            setcookie('email', $userEmail);
          } 
          $sql_status = mysqli_query($connection, "UPDATE users SET user_status = 'Online' WHERE user_email = '$userEmail'");
          $_SESSION['email'] = $userEmail;
          header('location:../view/chat.php?login=successfull');
        } else {
          $error = "incorrect password";
        }        
      } else {         
        $error = "incorrect email id";
      }
    }    
  }
?>

<!doctype html>
<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en"> 
<head> 
  <meta charset="utf-8">
  <title>Chat App | Sign In</title>
  <!-- Place favicon.ico in the root directory: mathiasbynens.be/notes/touch-icons -->
  <link rel="shortcut icon" href="../favicon.ico">
  <!--font-awesome link for icons-->
  <link rel="stylesheet" media="screen" href="../assets/vendor/fontawesome-free-5.13.0-web/css/all.min.css">
  <!-- Default style-sheet is for 'media' type screen (color computer display).  -->
  <link rel="stylesheet" media="screen" href="../assets/css/style.css">
</head>
<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <div class="wrapper">
        <h1>
          <a href="index.php" title="Chat App">            
            <span>chat app</span>  
            <span class="logo">logo</span>          
          </a>
        </h1>
      </div>
    </header>
    <!--header section end-->
    <!--main section start-->
    <main>
      <div class="wrapper">
        <!-- form title -->
        <div>
          <h2>sign in</h2>
        </div>
        <!-- sign up form -->
        <div class="signInForm"> 
          <form action="signIn.php" method="POST">
            <div class="error error-msg">        
              <?php 
                if(isset($error)) { echo $error; }
              ?>
            </div>
            <!-- field for email -->
            <div class="emailId">
              <label for="email">email address</label>
              <input type="text" name="email" maxlength="40" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" autocomplete="off">
            </div>
            <!-- field for password -->
            <div class="password">
              <label for="password">password</label>
              <input type="password" name="password" maxlength="15" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>">
              <span class="show">show</span>
            </div> 
            <ul>
              <li class="remember">
                <input type="checkbox" name="check">
                <label for="check">remember me</label>
              </li>
              <li class="forgot">
                <a href="../view/forgot_password.php" title="Forgot Password">forgot password?</a>
              </li>
            </ul>            
            <!-- sign in button -->
            <div>
              <input class="button" type="submit" value="Sign In" name="signIn">
            </div>
          </form>         
        </div>
      </div>
    </main>
    <!--main section end-->
    <!--footer section start-->
    <footer>      
      <div class="wrapper">
        <h3>copyright&copy;2020, <a href="#FIXME" title="Reshma Lihe">reshma lihe</a></h3>
      </div>
    </footer>
    <!--footer section end-->
  </div>
  <!--container end-->
  <script src="../assets/js/script.js"></script>
</body>
</html>