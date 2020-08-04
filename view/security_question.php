<?php
  error_reporting(0);
  session_start();
  require_once '../include/db.php';
  if(isset($_POST['login'])) {
    if(empty($_POST['answer'])) {
      $errors['answer'] = "enter your answer";
    } else {
      $answer = $_POST['answer'];
      $user_email = $_SESSION['user_email'];

      $sql = "SELECT * FROM users WHERE user_email = '$user_email' AND user_answer = '$answer'";
      $run = mysqli_query($connection, $sql);
      $check_user = mysqli_num_rows($run);
      if($check_user > 0) {
        $_SESSION['email'] = $user_email;
        $sql_status = mysqli_query($connection, "UPDATE users SET user_status = 'Online' WHERE user_email = '$user_email'");
        header("location: ../view/chat.php?login=successfull");
      } else {
        $errors['answer'] = "incorrect answer";
      }
    }    
  } 
?>

<!doctype html>
<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en"> 
<head> 
  <meta charset="utf-8">
  <title>Chat App | Security Question</title>
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
          <h2>security question</h2>
        </div>
        <!-- sign up form -->
        <div class="signInForm forgotPassword">           
          <form action="security_question.php" method="POST">     
            <div class='question emailId'>
              <label>question</label>
              <p><?php echo $_SESSION['user_question']; ?></p>
            </div>
            <div class='answer emailId'>
              <label for='answer'>answer</label>
              <input type='text' name='answer' maxlength='30' autocomplete='off'>
              <p class='error'>
                <?php
                  if(isset($errors['answer'])) { 
                    echo $e = $errors['answer']; 
                  }
                ?>
              </p>
            </div>
            <div>
              <input class='button' type='submit' value='Login' name='login'>
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