<?php
  include_once "includes/signup-inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="includes/style.css">
  <title>Sign Up</title>
</head>

<body>
  <div class="container">
    <div class="title">Sign Up Form</div>
    <form action="" method="post">

      <div class="user-details">
        <div class="input-box">
          <span class="details">
            First Name
          </span><span style="color: red;">*</span>
          <input type="text" name="user_first_name" placeholder="Enter Your First Name" value="<?php 
          if(isset($_POST['user_first_name'])) echo $_POST['user_first_name'];
          ?>">
        </div>
        <div class="input-box">
          <span class="details">
            Last Name
          </span><span style="color: red;">*</span>
          <input type="text" name="user_last_name" placeholder="Enter Your Last Name" value="<?php
          if(isset($_POST['user_last_name'])){
            echo $_POST['user_last_name'];
          }
          ?>">
        </div>
        <div class="input-box">
          <span class="details">
            Email
          </span><span style="color: red;">*</span>
          <input type="email" name="user_email" placeholder="Enter Your email" value="<?php
          if(isset($_POST['user_email'])){
            echo $_POST['user_email'];
          }
          ?>">
        </div>
        <div class="input-box">
          <span class="details">
            Phone Number
          </span><span style="color: red;">*</span>
          <input type="text" name="user_phone_number" placeholder="Enter Your Phone Number" value="<?php
          if(isset($_POST['user_phone_number'])){
            echo $_POST['user_phone_number'];
          }
          ?>">
        </div>
        <div class="input-box">
          <span class="details">
            Country
          </span><span style="color: red;">*</span>
          <input type="text" name="user_country" placeholder="Enter Your Country" value="<?Php
          if(isset($_POST['user_country'])){
            echo $_POST['user_country'];
          }
          ?>">
        </div>
        <div class="input-box">
          <span class="details">
            Password
          </span><span style="color: red;">*</span>
          <input type="password" name="user_password" placeholder="Enter Your Password" value="">
        </div>

        <div class="input-box">
          <span class="details">
            Confirm Pasword
          </span><span style="color: red;">*</span>
          <input type="password" name="user_confirm_password" placeholder="Confirm Your Password" value="">
        </div>
      </div>

      <div style="color: red;">
        <?php 
        if(!empty($error_msg)){
        echo $error_msg;
        }
         ?>
      </div>

      <div style="color: green;">
        <?php 
        if(!empty($success_msg)){
        echo $success_msg;
        }
        ?>
      </div>


      <div class="button">
        <input type="submit" name="submit_button" value="Click To Sign Up">
      </div>
    </form>
  </div>
</body>

</html>