<?php
  error_reporting(0);
  session_start();
  require_once '../include/db.php';
  require_once '../include/validation.php';

  if(isset($_POST['upload'])) {
    $u_image = $_FILES['profile']['name'];
    $validationImage = new Validator($_FILES);
    $errors = $validationImage->validateProfile();                
  }
  
  if(isset($_POST['signUp'])) {
    $validationForm = new Validator($_POST);
    $errors = $validationForm->validate();
    if(count($errors) == 0) {
      $i_profile = $_SESSION['profile'];
      $i_fname = $_POST['fname'];
      $i_lname = $_POST['lname'];
      $i_gender = $_POST['gender'];
      $u_birthday = $_POST['birthday'];
      $i_email = $_POST['email'];
      echo $i_phone = $_POST['phone'];
      $u_pswd = $_POST['password'];
      $i_question = $_POST['question'];
      $i_answer = $_POST['answer'];

      $i_birthday = date('d-m-Y', strtotime($u_birthday));
      $i_pswd = password_hash($u_pswd, PASSWORD_DEFAULT);


      $_SESSION['question'] = $i_question;
      
      echo $sql = "INSERT INTO users (user_profile, user_fname, user_lname, user_gender, user_birthday,
        user_email, user_phone, user_pswd, user_question, user_answer) 
        VALUES ('../assets/images/$i_profile', '$i_fname', '$i_lname', '$i_gender', '$i_birthday',
        '$i_email', $i_phone, '$i_pswd', '$i_question', '$i_answer')";
      
      $add_result = mysqli_query($connection, $sql);

      if(!$add_result) {
        die("Failed");
      } else {
        header ("location:../view/signIn.php?account=created");
      }      
    }
  }
?>

<!doctype html>
<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en"> 
<head> 
  <meta charset="utf-8">
  <title>Chat App | Sign Up</title>
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
          <h2>sign up</h2>
        </div>
        <!-- sign up form -->
        <div class="signUpForm"> 
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">         
            <div class="left-form">            
              <ul class="photo">
                <li>
                <label for="profile">select profile</label>
                  <figure>
                    <?php 
                      if(!isset($_FILES['profile']['name'])) {
                        echo "<img src='../assets/images/profile.jpg' alt='Profile Image'>";
                      } else {
                        global $errors, $u_image;
                        if(count($errors) == 0) {
                          $_SESSION['profile'] = $u_image;
                          echo "<img src='../assets/images/$u_image' alt='$u_image'>";
                        }                    
                        else {
                          echo "<img src='../assets/images/profile.jpg' alt='Profile Image'>";
                        }   
                      }                 
                    ?>                  
                  </figure>              
                </li>
                <li class="button-wrap">
                  <span class="upload-button">click here
                    <input type="file" name="profile" size="60">
                  </span>
                  <button name="upload">upload</button>
                    <p class="error">
                    <?php if(isset($errors['profile'])) { echo $errors['profile']; } ?>
                  </p>
                </li>            
              </ul>                          
              <ul class="name">
                <!-- field for first name -->
                <li class="fname">
                  <label for="fname">first name</label>
                  <input type="text" name="fname" maxlength="15" value="<?php if(isset($_POST['fname'])) { echo $_POST['fname']; } ?>" autocomplete="off">
                  <p class="error">
                    <?php if(isset($errors['fname'])) { echo $errors['fname']; } ?>
                  </p>
                </li>
                <!-- field for last name -->
                <li class="lname">
                  <label for="lname">last name</label>
                  <input type="text" name="lname" maxlength="15" value="<?php if(isset($_POST['lname'])) { echo $_POST['lname']; } ?>" autocomplete="off">
                  <p class="error">
                    <?php if(isset($errors['lname'])) { echo $errors['lname']; } ?>
                  </p>
                </li>  
              </ul>        
              <ul class="secondRow">
                <!-- field for gender -->
                <li class="gender">
                  <label>gender</label>
                  <select name="gender">
                    <option value=""><?php if(isset($_POST['gender'])) { echo $_POST['gender']; } ?></option>
                    <option value="male">male</option>
                    <option value="female">female</option>  
                    <option value="other">other</option>                
                  </select> 
                  <p class="error">
                    <?php if(isset($errors['gender'])) { echo $errors['gender']; } ?>
                  </p>          
                </li>                            
                <!-- field for DOB -->
                <li class="birthday">
                  <label>birthday</label>
                  <input type="date" name="birthday" value="<?php if(isset($_POST['birthday'])) { echo $_POST['birthday']; } ?>">
                  <p class="error">
                    <?php if(isset($errors['birthday'])) { echo $errors['birthday']; } ?>
                  </p>         
                </li> 
              </ul> 
              <!-- field for email -->
              <div class="emailId">
                <label for="email">email address</label>
                <input type="text" name="email" maxlength="40" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" autocomplete="off">
                <p class="error">
                  <?php if(isset($errors['email'])) { echo $errors['email']; } ?>
                </p>
              </div>
              <!-- field for phone number -->
              <div class="phone">
                <label for="phone">phone number</label>
                <input type="text" name="phone" maxlength="15" value="<?php if(isset($_POST['phone'])) { echo $_POST['phone']; } ?>" autocomplete="off">
                <p class="error">
                  <?php if(isset($errors['phone'])) { echo $errors['phone']; } ?>
                </p>
              </div> 
            </div>
            <div class="right-form">
              <ul>
                <!-- field for password -->
                <li class="password">
                  <label for="password">password</label>
                  <input type="password" name="password" maxlength="15" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>">
                  <!-- <span class="show">show</span> -->
                  <p class="error">
                    <?php if(isset($errors['password'])) { echo $errors['password']; } ?>
                  </p>
                </li>
                <li class="password">
                  <label for="cPassword">Confirm Password</label>
                  <input type="password" name="cPassword" maxlength="15">
                  <!-- <span class="show">show</span> -->
                  <p class="error">
                    <?php if(isset($errors['cPassword'])) { echo $errors['cPassword']; } ?>
                  </p>
                </li>
              </ul>

              <ul class="security-questions">
                <!-- field for questions -->
                <li class="select">
                  <label>security question</label>
                  <select name="question">
                    <option value="" maxlength="50"><?php if(isset($_POST['question'])) { echo $_POST['question']; } ?></option>
                    <?php
                      $questions = array(
                        "what was the name of your childhood friend ?",
                        "in what city did you meet your partner ?",
                        "what was your first phone number ?",
                        "what was the name of your first school ?",
                        "what is your dream job ?"
                      );
                      foreach ($questions as $number) {
                        echo "<option value='$number'>$number</option>;";
                      }
                    ?> 
                  </select> 
                  <p class="error">
                    <?php if(isset($errors['question'])) { echo $errors['question']; } ?>
                  </p>          
                </li>     
                
                <!-- field for answers -->
                <li class="answer">
                  <label for="answer">answer</label>
                  <input type="text" name="answer" maxlength="30" value="<?php if(isset($_POST['answer'])) { echo $_POST['answer']; } ?>" autocomplete="off">
                  <p class="error">
                    <?php if(isset($errors['answer'])) { echo $errors['answer']; } ?>
                  </p>
                </li>
              </ul>
              <!-- sign up button -->
              <div>
                <input class="button" type="submit" value="Sign Up" name="signUp">
              </div>
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