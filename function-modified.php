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
$sql = "SELECT * FROM user WHERE username='$username' AND password='$password' ";
$result = $conn->query($sql);
if($row=$result->fetch_assoc()){
    if($row['admin_status'] == 'Y'){
      echo "<script>alert('Welcome Admin' ); window.location = './login.php';</script>";
    }else{
      echo "<script>alert('Welcome User' ); window.location = './login.php';</script>";
    }
}else{
  echo "<script>alert('Username or Password is Wrong,Please try again'); window.location = './login.php';</script>";
}
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
       require 'class.smtp.php';
       require 'class.phpmailer.php';

       $mail = new PHPMailer;

       $mail->isSMTP();                                   // Set mailer to use SMTP
       $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
       $mail->SMTPAuth = true;                            // Enable SMTP authentication
       $mail->Username = 'pengzhang1925@gmail.com';          // SMTP username
       $mail->Password = 'Your password'; // SMTP password
       $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
       $mail->Port = 587;// TCP port to connect to
      //  $mail->SMTPDebug  = 4;       //For debug the server connection

       $mail->setFrom('pengzhang1925@gmail.com', 'PengZhang');
       $mail->addAddress('pengzhang1925@gmail.com');   // Add a recipient
       //$mail->addCC('cc@example.com');
       //$mail->addBCC('bcc@example.com');

       $mail->isHTML(true);  // Set email format to HTML

       $bodyContent = '<h4>This is a test email!</h4>';
       $bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>PengZhang</b></br>
                           Your new Password is '.$random.'</p>';

       $mail->Subject = 'Email from Localhost by PengZhang';
       $mail->Body    = $bodyContent;

       if(!$mail->send()) {
         echo 'Message could not be sent.';
        //  echo 'Mailer Error: ' . $mail->ErrorInfo;
       } else {
          echo "<script>alert('Record Updated And Please check your email to get the password'); window.location = './login.php';</script>";
       }

//         $to = $username;
//         $subject = 'Password Reset';
//         $message = 'Your New Password is-- '.$random;
//         $header = "From :- aman2gill29@gmail.com";
//
//         mail($to,$subject,$message,$header);


}
}else{
  echo "<script>alert('Record Not Found'); window.location = './resetpassword.php';</script>";
}
}
?>
