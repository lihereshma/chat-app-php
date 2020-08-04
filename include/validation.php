<?php
  class Validator {
    private $data;
    private $fdata;
    private $errors = [];

    public function __construct($post_data) {
      $this->data = $post_data;
    }

    public function validate() {
      $this->validatefname();
      $this->validatelname();
      $this->validateGender();
      $this->validateBirthday();
      $this->validateEmail();
      $this->validatePhone();
      $this->validatePassword();
      $this->validatecPassword();
      $this->validateQuestion();
      $this->validateAnswer();
      return $this->errors;
    }

    public function validateLogin() {
      $this->validateEmail();
      $this->validatePassword();
      return $this->errors;
    }

    // Image validation
    public function validateProfile() {
      $val = $this->data['profile'];
      if(isset($val)) {
        $fileName = $_FILES['profile']['name'];
        $fileSize = $_FILES['profile']['size'];
        $fileTemp = $_FILES['profile']['tmp_name'];
        $fileType = $_FILES['profile']['type'];
        $fileInfo = getimagesize($_FILES['profile']['tmp_name']);
        $width = $fileInfo[0];
        $height = $fileInfo[1];
          
        if (is_uploaded_file($fileTemp)) {
          if($width <= "200" || $height <= "200") {
            if ($fileSize < 2097152) {
              if ($fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png') {
                if (move_uploaded_file($fileTemp,'assets/images/'.$fileName)) { 
                  // image uplaoded successfully             
                }
              } else {
                $this->addError(profile, "Only JPG, PNG and JPEG files are allowed");
              }
            } else {
              $this->addError(profile, "please select file less than or 2MB");
            }
          } else {
            $this->addError(profile, "profile dimensions should be within 200x200");
          }
        } else {
          $this->addError(profile, "no file is selected");
        }
      }
      return $this->errors;
    }
    
    // first name validation
    private function validatefname() {
      $val = $this->data['fname'];
      if(empty($val)) {
        $this->addError(fname, "empty field not allowed");
      } else {
        if(!preg_match('/^[a-zA-Z]{2,}$/', $val)) {
          $this->addError(fname, "invalid name");
        }
      }
    }

    // last name validation
    private function validatelname() {
      $val = $this->data['lname'];
      if(empty($val)) {
        $this->addError(lname, "empty field not allowed");
      } else {
        if(!preg_match('/^[a-zA-Z]{2,}$/', $val)) {
          $this->addError(lname, "invalid name");
        }
      }
    }

    // gender validation
    private function validateGender() {
      $val = $this->data['gender'];
      if(empty($val)) {
        $this->addError(gender, "please select gender");
      }
    }

    // birthday validation
    private function validateBirthday() {
      $val = $this->data['birthday'];
      if(empty($val)) {
        $this->addError(birthday, "please select date");
      }
    }

    // Email validation
    private function validateEmail() {
      $val = $this->data['email'];
      if(empty($val)) {
        $this->addError(email, "empty field not allowed");
      } else {
        if(!filter_var($val, FILTER_VALIDATE_EMAIL)) {
          $this->addError(email, "invalid email");
        } else {
          $connection = mysqli_connect("localhost", "root", "", "chat_app");
          $sql = "SELECT * FROM users WHERE user_email = '$val'";
          $run = mysqli_query($connection, $sql);
          $row = mysqli_num_rows($run);
          if($row == 1) {
            $this->addError(email, "email address already exist, try another one");
          }
        }
      } 
    }

    // Phone number validation
    private function validatePhone() {
      $val = $this->data['phone'];
      if(empty($_POST['phone'])) {
        $this->addError(phone, "empty field not allowed");
      } else if (!preg_match("/^[0-9]+$/", $val)) {
        $this->addError(phone, "only numbers are allowed");
      } else if (strlen($val) <= '8' && strlen($val) >= '15') {
        $this->addError(phone, "phone number must be of range 8 to 15 digits");
      }
    }

    // Password validation
    private function validatePassword() {
      $val = $this->data['password'];
      if(empty($val)) {
        $this->addError(password, "empty field not allowed");
      } else if (strlen($_POST["password"]) <= '8' && strlen($_POST["password"]) >= '15') {
        $this->addError(password, "password range must be 8 to 15");
      } else if (!preg_match("#[0-9]+#", $val)) {
        $this->addError(password, "your password must contain at least 1 number");
      } else if (!preg_match("#[A-Z]+#", $val)) {
        $this->addError(password, "your password must contain at least 1 capital letter");
      } else if (!preg_match("#[a-z]+#", $val)) {
        $this->addError(password, "your password must contain at least 1 lowercase letter");
      } else if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) {
        $this->addError(password, "your password must contain at least 1 special character");
      }
    }

    // Re-entered password validation
    private function validatecPassword() {
      $val = $this->data['password'];
      if(empty($val)) {
        $this->addError(cPassword, "empty field not allowed");
      } else if($_POST['cPassword'] != $_POST['password']) {
        $this->addError(cPassword, "password not matched");
      }
    }

    // answer validation
    private function validateAnswer() {
      $val = $this->data['answer'];
      if(empty($val)) {
        $this->addError(answer, "empty field not allowed");
      } else if(strlen($val) > 30) {
        $this->addError(answer, "answer is too long");
      }
    }

    // question validation
    private function validateQuestion() {
      $val = $this->data['question'];
      if(empty($val)) {
        $this->addError(question, "please select security question");
      }
    }
    
    // Store errors in errors array
    private function addError($inputField, $error) {
      $this->errors[$inputField] = $error;
    }
  }
?>