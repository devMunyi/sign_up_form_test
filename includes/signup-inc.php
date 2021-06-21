<?php
include_once 'dbh-inc.php';

//Handling User input
if(isset($_POST['submit_button'])){
  $user_first_name = $_POST['user_first_name'];
  $user_last_name = $_POST['user_last_name'];
  $user_email = $_POST['user_email'];
  $user_phone_number = $_POST['user_phone_number'];
  $user_country = $_POST['user_country'];
  $user_password = $_POST['user_password'];
  $user_confirm_password = $_POST['user_confirm_password'];

  
  //validating the inputs
    //Check for empty fields
    $error_msg = '';
    $success_msg = '';
    if(empty($user_first_name) || empty($user_last_name) || empty($user_email) ||empty($user_phone_number) || empty($user_country) 
    || empty($user_password) || empty($user_confirm_password)){
      
      $error_msg="All input fields are required";       
      //header("location: ../sign_up_form.php?signup = empty");
      //exit();
    }else
      //check for invalid characters from $user_first_name, $user_last_name and $user_country
      if(!preg_match("/^[a-zA-Z]*$/", $user_first_name) || !preg_match("/^[a-zA-Z]*$/", $user_last_name)
      || !preg_match("/^[a-zA-Z]*$/", $user_country)){
      $error_msg = "First name, last name and country should contain only letters or/and numbers";
      }else{
        //check if email is valid
        if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
          $error_msg = "You entered an invalid email address";
        }else{
            //checking wether email is unique
            $sql = "SELECT * FROM users WHERE user_email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $user_email);

            $stmt->execute();
            $num_rows = $stmt->fetchAll(PDO::FETCH_NUM);
            if(count($num_rows) > 0){
              $error_msg = "User with that email id already exist";
            }else{
              //checking wether phone number is unique
              $sql = "SELECT * FROM users WHERE user_phone_number = ?";
              $stmt = $pdo->prepare($sql);
              $stmt->bindValue(1, $user_phone_number);
              
              $stmt->execute();
              $num_rows = $stmt->fetchAll(PDO::FETCH_NUM);
              if(count($num_rows) > 0){
                $error_msg = "User with that phone number already exist";
              }else{
                //checking  wether password matches
                if($user_password !== $user_confirm_password){
                  $error_msg = "The two passwords you entered doesn't match";
                }else{
                  //checking wether password is too short characters
                  $trimed_user_password = trim($user_password); #first removing white spaces before and at the end of the password
                  if(strlen($trimed_user_password) < 5 ){                      
                    $error_msg ="Your password should be be atleast 5 characters";
                  }else{
                    //Hash password
                    $hashed_user_password = password_hash($user_password, PASSWORD_DEFAULT);

                    /*
                    Before inserting the user data, the following multiple comment lines shows how I intiallly created my table
                      CREATE TABLE users(
                        user_id INT(11) AUTO_INCREMENT PRIMARY KEY, 
                        user_first_name VARCHAR(255) NOT NULL, 
                        user_last_name VARCHAR(255) NOT NULL, 
                        user_email VARCHAR(255) NOT NULL, 
                        user_phone_number VARCHAR(255) NOT NULL, 
                        user_country VARCHAR(255) NOT NULL, 
                        user_password VARCHAR(255) NOT NULL,
                        UNIQUE(user_email, user_phone_number
                      );
                    */
                    
                    //Inserting user inputs into the database after validating
                    $sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_phone_number, user_country,
                    user_password) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(1,$user_first_name);
                    $stmt->bindValue(2, $user_last_name);
                    $stmt->bindValue(3, $user_email);
                    $stmt->bindValue(4, $user_phone_number);
                    $stmt->bindValue(5, $user_country);
                    $stmt->bindValue(6, $hashed_user_password);
                    
                    $stmt->execute();

                    $success_msg ="You signed up succcessfully";

                    /*header("Location: ../sign_up_form.php?signup=success");
                    exit();
                    */
                  }
                }
              }
            }
        }
      }
}
/*else{
  header('location: sign_up_form.php');
}
*/
?>