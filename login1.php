<?php
session_start();
 $username = $_POST['username'];
 $password = $_POST['password'];
 $con = new mysqli("localhost","root","","login");
 if($con->connect_error){
    die("Failed to Connect: ".$con->connect_error);
 }
 else
 {
    $stmt=$con->prepare("select * from users where username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows>0){
        $data = $stmt_result->fetch_assoc();
        if($data['password']===$password){
            $_SESSION['username']=$username;
            header("Location:profile.php");
            exit();
            //echo "<h2>Login Success</h2>";
        }
        else
        {
            echo "INVALID";
        }
    }
    else{
       echo "<h2>INVALID</h2>"; 
    }

 }

?>
