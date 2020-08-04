<?php
  error_reporting(0);
  session_start();
  include_once '../include/db.php';

  if(isset($_POST['submit'])) {
    if(empty($_POST['email'])) {
      $errors['email'] = "empty field";
    } else {
      $email = $_POST['email'];

      $sql = "SELECT * FROM users WHERE user_email = '$email'";
      $run = mysqli_query($connection, $sql);
      $check_user = mysqli_num_rows($run);
      $row = mysqli_fetch_array($run);
      $user_question = $row['user_question'];

      $_SESSION['user_question'] = $user_question;
      $_SESSION['user_email'] = $email;

      if($check_user == 0) {
        $errors['email'] = "email address not found";
      } else {
        header("location: ../view/security_question.php");
      }
    }
  } 
?>

<!doctype html>
<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en"> 
<head> 
  <meta charset="utf-8">
  <title>Chat App | Forgot Password</title>
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
          <h2>forgot password</h2>
        </div>
        <!-- sign up form -->
        <div class="signInForm forgotPassword">           
          <form action="forgot_password.php" method="POST">        
            <!-- field for email -->
            <div class="emailId">
              <label for="email">enter your email address</label>
              <input type="text" name="email" maxlength="30" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" autocomplete="off">
              <p class="error">
                <?php if(isset($errors['email'])) { echo $errors['email']; } ?>
              </p>
            </div>            
            <!-- go button -->
            <div>
              <input class="button" type="submit" value="Submit" name="submit">
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
</body>
</html>