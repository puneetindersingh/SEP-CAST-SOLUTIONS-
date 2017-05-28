<?php
if(isset($_POST['login'])){
    login();
}else if (isset($_POST['forget'])){
    forget();
}
// check if account is active , check credentials and login
function login(){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user_details WHERE username='$username' AND password='$password' ";
    $result = $conn->query($sql);

    if($row=$result->fetch_assoc()){
        $firstName = $row['firstname'];
        $lastName = $row ['lastname'];
        $fullName = $firstName." ".$lastName;  setcookie('full_name',$fullName,time()+36000,'/SEP-CAST-SOLUTIONS-/');
      if($row['account_status'] == 'N'){
        echo "not active";
        exit();
      }
        if($row['admin_status'] == 'Y'){
          echo "admin";
        }else{
          echo "user";
        }

    }else{
      echo "no";
    }
    mysqli_close($conn);
}
// email random password to the user 
function forget(){
    include 'connect.php';
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "SELECT username,email FROM user_details WHERE email= '$email' AND username = '$username'";

$result = mysqli_query($conn,$sql);
$check = mysqli_num_rows($result);

if($check==1){

    $character = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $random=substr(str_shuffle($character),0,8);
     $sql1 = "UPDATE user_details SET password='$random' WHERE  username = '$username'";
     if ($conn->query($sql1) === TRUE) {
       require 'class.smtp.php';
       require 'class.phpmailer.php';

       $mail = new PHPMailer;

       $mail->isSMTP();                                   // Set mailer to use SMTP
       $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
       $mail->SMTPAuth = true;                            // Enable SMTP authentication
       $mail->Username = 'pengzhang1925@gmail.com';          // SMTP username
       $mail->Password = ''; // SMTP password
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
          echo "<script>alert('Password Reset Successfully. Please Check your Email for new password. '); window.location = '../login.html';</script>";
       }
}
}
else{
  echo "<script>alert('Error Occured: Verify your details.'); window.location = '../login.html';</script>";
}
mysqli_close($conn);
}
?>
