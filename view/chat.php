<?php
  error_reporting(0);
  session_start();
  include_once '../include/db.php';
  if(!isset($_SESSION['email'])) {
    header("location:../view/signIn.php");
  } else {
?>

<!doctype html>
<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en"> 
<head> 
  <meta charset="utf-8">
  <title>Chat App | Home</title>
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
        <form class="sign-out-form" method="POST">
          <div>
            <input class="blue-button" type="submit" name="left" value="Sign Out">
          </div>
          <?php 
            if(isset($_POST['left'])) { 
              $active_user = $_SESSION['email'];
              $update_msg = mysqli_query($connection, "UPDATE users SET user_status = 'Offline' WHERE user_email = '$active_user'");
              if(!$update_msg){
                die("failed");
              } else {
                header("location:../include/logout.php");
              }                  
            }
          ?>
        </form>
      </div>
    </header>
    <!--header section end-->
    <!--main section start-->
    <main>
      <section>
        <div class="wrapper">  
          <div class="left-chat">
            <form action="#FIXME" method="POST">
              <div>
                <input class="search" type="text" name="search" placeholder="Search" autocomplete=off>
              </div>
            </form>
            <div class="left-chat-list scroll">            
              <ul>
                <?php 
                  include_once '../include/get_users_data.php';
                ?>
              </ul>
            </div>
          </div>    
          <div class="right-chat">           
            <?php 
              $user = $_SESSION['email'];
              $get_user = "SELECT * FROM users WHERE user_email = '$user'";
              $run = mysqli_query($connection, $get_user);
              $row = mysqli_fetch_array($run);

              $user_name = $row['user_fname'] ." " .$row['user_lname'];
              $user_email = $row['user_email'];
              $current_user_profile = $row['user_profile'];
            ?>
            <?php
              if(isset($_GET['email'])) {
                global $connection;
                $get_username = $_GET['email'];
                $get_user = "SELECT * FROM users WHERE user_email = '$get_username'";
                $run = mysqli_query($connection, $get_user);
                $row_user = mysqli_fetch_array($run);

                $username = $row_user['user_email'];
                $chat_user = $row_user['user_fname'] ." " .$row_user['user_lname'];
                $user_progile_image = $row_user['user_profile'];
              }
            ?>
            <?php 
              if(!isset($_GET['email'])) {
                echo "
                  <div class='current_profile'>
                    <span>welcome to</span>
                    <h2>chat app</h2>
                    <figure>
                      <img src='$current_user_profile'>
                    </figure>
                    <div>$user_name</div>
                  </div>
                ";
              } else {
              ?>  
              <?php
                if(isset($_POST['send'])) {
                  $msg = htmlentities($_POST['content']);
                  if(empty($msg) || $msg == " ") {
                    $msg_error = "empty field not allowed";
                  } else {                    
                    $sql = "INSERT INTO messages (sender_username, receiver_username, msg_content, msg_date)
                      VALUES ('$user_email', '$username', '$msg', NOW())";
                    $run_insert = mysqli_query($connection, $sql);
                    if(!$run_insert) {
                      die("failed");
                    } else {
                      header("location:../view/chat.php?msg=added");
                    }
                  }
                }
              ?>
              <div class="right-header">
                <figure class="right-header-img">
                  <img src="<?php echo $user_progile_image; ?>" title="<?php echo $chat_user; ?>">
                </figure>
                <div class="right-header-detail">
                  <p><?php echo $chat_user; ?></p>
                </div>
              </div>
              <div class="right-header-contentchat scroll">
                <?php
                  $sql = "SELECT * FROM messages 
                    WHERE (sender_username = '$user_email' AND receiver_username = '$username') 
                    OR (receiver_username = '$user_email' AND sender_username = '$username') ORDER BY 1 ASC";
                  $run_select = mysqli_query($connection, $sql);

                  while($row = mysqli_fetch_array($run_select)) {
                  $sender_username = $row['sender_username'];
                  $receiver_username = $row['receiver_username'];
                  $msg_content = $row['msg_content'];
                  $msg_date = $row['msg_date'];
                  ?>
                  <ul>
                    <?php
                      if($user_email == $sender_username AND $username == $receiver_username) {
                        echo "
                          <li class='sender'>
                            <div class='rightside-chat'>
                              <p>$msg_content</p>
                              <span>$msg_date</span>  
                            </div>
                          </li>
                        ";
                      }

                      else if($user_email == $receiver_username AND $username == $sender_username) {
                        echo "
                          <li class='receiver'>
                            <div class='rightside-chat'>
                              <p>$msg_content</p>
                              <span>$msg_date</span>                           
                            </div>
                          </li>
                        ";
                      }
                    ?>
                  </ul>
                <?php } ?>
              </div>
              <div class="right-chat-textbox">
                <form action="#FIXME" method="POST">
                  <div>
                    <input type="text" name="content" placeholder="Type a message" autocomplete=off>
                  </div>
                  <div class="sendButton">
                    <input class="blue-button" type="submit" name="send" value="Send">
                  </div>                                 
                </form>
                <div class="error">
                  <?php if(isset($msg_error)) { echo $msg_error; } ?>
                </div>
              </div>              
            <?php } ?>
          </div> 
        </div>
      </section>     
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
  <script src="../assets/vendor/jquery-1.8.3.min.js"></script>
  <script src="../assets/js/script2.js"></script>
</body>
</html>
<?php } ?>