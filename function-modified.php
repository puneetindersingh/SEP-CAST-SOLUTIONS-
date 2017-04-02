<?php
if(isset($_POST['login'])){
    login();
}else if(isset($_POST['signin'])){
    signin();
}else if (isset($_POST['forget'])){
    forget();
}else if (isset($_POST['display'])){
    display();
}

function login(){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
$sql = "SELECT * FROM user_details WHERE username='$username' AND password='$password' ";
$result = $conn->query($sql);
if($row=$result->fetch_assoc()){
    if($row['admin_status'] == 'Y'){
      echo "<script> window.location = './adminpage.html';</script>";
    }else{
      echo "<script> window.location = './userpage.html';</script>";
    }
}else{
  echo "<script>alert('Username or Password is Wrong,Please try again'); window.location = './login.html';</script>";
}
}


function signin(){
include 'connect.php';
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$sql = "INSERT INTO user_details(username,password,email) VALUES('$username','$password','$email')";
$result = $conn->query($sql);
    echo "record inserted";
}


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
    echo $random;
     $sql1 = "UPDATE user_details SET password='$random' WHERE email= '$email' AND username = '$username'";
     if ($conn->query($sql1) === TRUE) {
       require 'class.smtp.php';
       require 'class.phpmailer.php';

       $mail = new PHPMailer;

       $mail->isSMTP();                                   // Set mailer to use SMTP
       $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
       $mail->SMTPAuth = true;                            // Enable SMTP authentication
       $mail->Username = 'puneetindersingh@gmail.com';          // SMTP username
       $mail->Password = 'your password'; // SMTP password
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
          echo "<script>alert('Record Updated And Please check your email to get the password'); window.location = './login.html';</script>";
       }

//         $to = $username;
//         $subject = 'Password Reset';
//         $message = 'Your New Password is-- '.$random;
//         $header = "From :- aman2gill29@gmail.com";
//
//         mail($to,$subject,$message,$header);


}
}
else{
  echo "<script>alert('Record Not Found'); window.location = './login.html';</script>";
}

}

function display(){
  include 'connect.php';
  $username = $_POST['username'];

  $sql = "";
  $result = mysqli_query($conn,$sql);
  echo "<table id='editable'>
   <tr>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Email address</th>
     <th>Phone</th>
     <th>Company</th>
     <th>Company Site Name</th>
     <th>Company Job Title</th>
   </tr>";
   while($row=$result->fetch_assoc()){
     echo "<tr>";
     echo "<td contentEditable='true'>" . $row['Firstname'] . "</td>";
     echo "<td contentEditable='true'>" . $row['Lastname'] . "</td>";
     echo "<td contentEditable='true'>" . $row['Email'] . "</td>";
     echo "<td contentEditable='true'>" . $row['Phone_Number'] . "</td>";
     echo "<td contentEditable='true'>" . $row['Company'] . "</td>";
     echo "<td contentEditable='true'>" . $row['Address_1'] . "</td>";
     echo "<td contentEditable='true'>" . $row['Address_2'] . "</td>";
     echo "</tr>";
   }
    echo "</table>";
    echo "<input class='btn'  type='submit' value='modifyU' name='modifyU'/>";
    mysqli_close($conn);
}

?>
