<?php
include 'connections.php';

if(isset($_POST['submit'])){
    $firstname= $_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $password=MD5($_POST['password']);
    $gender=$_POST['gender'];
    $sql="INSERT INTO users(id,fname, lname, email, password, gender) VALUES ('','$firstname', '$lastname','$email', '$password', '$gender')";
    $result= $conn->query($sql);

    if($result==true){
        $inserted_id = mysqli_insert_id($conn);
        echo '<div class="alert alert-success" role="alert">New user registered successfully!</div>';
    }else{
        echo "<div class='alert alert-danger' role='alert'>Error registering user: ".$sql.'br'.$conn->error."</div>";
    }
    $conn->close();

    header('Location: read.php');
}
?>
