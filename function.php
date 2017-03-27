<?php

if(isset($_POST['login'])){
    login();
}else if(isset($_POST['signin'])){
    signin();
}else if (isset($_POST['forget'])){
    forget();
}


function login(){

    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];


$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

$result = $conn->query($sql);
$row=$result->fetch_assoc();
if(!$row){

   
    
echo "<script>alert('Username Password is Wrong'); window.location = './login.php';</script>";     
}
     
else{
    if($row['admin_status'] == 'Y'){
        echo "<script>alert('Welcome Admin'); window.location = './login.php';</script>"; 
}
    else{
        echo "<script>alert('welcome user'); window.location = './login.php';</script>"; 
}
    }
        
    }
        
//    $sql1 = "SELECT admin_status FROM user WHERE username='$username' AND password='$password' ";
//    $result1 = $conn->query($sql1);
//    echo $result1;
 echo "<script>alert('Username Password is Correct'); window.location = './login.php';</script>"; 

    
}


function signin(){

include 'connect.php';
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];


$sql = "INSERT INTO user(username,password,email) VALUES('$username','$password','$email')";

$result = $conn->query($sql);
    echo "record inserted";

}


function forget(){
    include 'connect.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    


    $sql = "SELECT username,email FROM user WHERE email= '$email' AND username = '$username'";
 
$result = mysqli_query($conn,$sql);
$check = mysqli_num_rows($result);
if($check==1){
    
    $character = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $random=substr(str_shuffle($character),0,8);
    echo $random;
     $sql1 = "UPDATE user SET password='$random' WHERE email= '$email' AND username = '$username'";
     if ($conn->query($sql1) === TRUE) {
         $to = $username;
         $subject = 'Password Reset';
         $message = 'Your New Password is-- '.$random;
         $header = "From :- aman2gill29@gmail.com";
         
         mail($to,$subject,$message,$header);
         
         echo "<script>alert('Record Updated'); window.location = './login.php';</script>";

}

}else{ 
  echo "<script>alert('Record Not Found'); window.location = './resetpassword.php';</script>";

}
}
?>
