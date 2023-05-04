<?php

session_start();

include('connections.php');

$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(isset($_POST["username"]) && !empty(trim($_POST["username"]))){
        
        $sql = "SELECT id FROM login WHERE username = '".$conn->real_escape_string(trim($_POST['username']))."'";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $username_err = "This username is already taken.";
        } else{
            $username = trim($_POST["username"]);
        }
    } else {
        $username_err = "Please enter a username.";
    }
    

    if(isset($_POST["email"]) && !empty(trim($_POST["email"]))){
        
        $sql = "SELECT id FROM login WHERE email = '".$conn->real_escape_string(trim($_POST['email']))."'";
        $result = $conn->query($sql);
        
        if($result->num_rows == 1){
            $email_err = "This email address is already registered.";
        } else{
            $email = trim($_POST["email"]);
        }
    } else {
        $email_err = "Please enter an email address.";
    }
    
   
    if(isset($_POST["password"]) && !empty(trim($_POST["password"]))){
        if(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
    } else {
        $password_err = "Please enter a password.";     
    }
    
    if(empty($username_err) && empty($email_err) && empty($password_err)){
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO login (username, email, password) VALUES ('".$conn->real_escape_string($username)."', '".$conn->real_escape_string($email)."', '".$conn->real_escape_string($hashed_password)."')";
        if($conn->query($sql)){

            header('Location:login.php') ;
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    header('Location:login.php');
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <h2 class="text-center my-4">Sign up Form</h2>
      <form action="signup.php" method="post">
        <div class="form-group">
          <label for="username">username:</label>
          <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="submit">Signup</button>
        </div>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>



