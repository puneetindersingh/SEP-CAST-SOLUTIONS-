<?php
if(isset($_POST['login'])){
    login();
}else if(isset($_POST['signin'])){
    signin();
}else if (isset($_POST['forget'])){
    forget();
}else if (isset($_POST['displayU'])){
    displayU();
}else if(isset($_POST['profile'])){
    profile();
}else if(isset($_POST['updateprofile'])){
    updateprofile();
}else if(isset($_POST['deleteU'])){
    deleteUser();
}else if(isset($_POST['editU'])){
    editUser();
}else if(isset($_POST['getCompany'])){
    getCompany();
}else if(isset($_POST['deleteC'])){
    deleteCompany();
}else if(isset($_POST['editC'])){
    editCompany();
}else if(isset($_POST['displayC'])){
    displayC();
}else if(isset($_POST['qlik'])){
    qlik();
}else if(isset($_POST['qlikU'])){
    qlikU();
}else if(isset($_POST['iframes'])){
    editIframes();
}

function login(){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
$sql = "SELECT * FROM user_details WHERE username='$username' AND password='$password' ";
$result = $conn->query($sql);

if($row=$result->fetch_assoc()){

    $firstName = $row['firstname'];
    $lastName = $row ['lastname'];
    $fullName = $firstName." ".$lastName;  setcookie('full_name',$fullName);
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


function signin(){
include 'connect.php';
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$sql = "INSERT INTO user_details(username,password,email) VALUES('$username','$password','$email')";
$result = $conn->query($sql);
    echo "record inserted";
    mysqli_close($conn);
}


function forget(){
    include 'connect.php';
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "SELECT username,email FROM customer WHERE email= '$email' AND username = '$username'";

$result = mysqli_query($conn,$sql);
$check = mysqli_num_rows($result);

if($check==1){

    $character = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $random=substr(str_shuffle($character),0,8);
    echo $random;
     $sql1 = "UPDATE user SET password='$random' WHERE  username = '$username'";
     if ($conn->query($sql1) === TRUE) {
       require 'class.smtp.php';
       require 'class.phpmailer.php';

       $mail = new PHPMailer;

       $mail->isSMTP();                                   // Set mailer to use SMTP
       $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
       $mail->SMTPAuth = true;                            // Enable SMTP authentication
       $mail->Username = 'pengzhang1925@gmail.com';          // SMTP username
       $mail->Password = 'QQ0819xy'; // SMTP password
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
mysqli_close($conn);
}


function getCompany(){
  include 'connect.php';
  $sql = "SELECT DISTINCT name FROM company order by name";
  $result = mysqli_query($conn,$sql);
  while($row = $result -> fetch_assoc()){
      echo $row['name'].",";
  }
  mysqli_close($conn);
}

function displayU(){
  include 'connect.php';
  $companyN = $_POST['companyN'];
  if($companyN == "admin"){
      $sql = "SELECT * FROM user_details WHERE admin_status='Y'";
      $result = mysqli_query($conn,$sql);
      echo"

      <table id='editable'>
       <tr>
         <th>Username</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email address</th>
         <th>Phone</th>
         <th>Password</th>
         <th></th>
         <th></th>
         </tr>";
         while($row = $result -> fetch_assoc()){
           echo "<tr>";
           echo "<td contentEditable='true'>" . $row['username'] . "</td>";
           echo "<td contentEditable='true'>" . $row['firstname'] . "</td>";
           echo "<td contentEditable='true'>" . $row['lastname'] . "</td>";
           echo "<td contentEditable='true'>" . $row['email'] . "</td>";
           echo "<td contentEditable='true'>" . $row['phone'] . "</td>";
           echo "<td contentEditable='true'>" . $row['password'] . "</td>";
           echo "<td onclick='updateRow(this)'><i class='material-icons md-18 blue'> edit</i></td>";
           echo "<td onclick='delRow(this)'><i class='material-icons md-18 blue'> delete</i></td>";
           echo "</tr>";
         }
           echo "</table>";
  }else{

      $sql = "SELECT * from user_details WHERE company='$companyN'";
      $result = mysqli_query($conn,$sql);
      echo "

      <table id='editable'>
       <tr>
         <th>Username</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email address</th>
         <th>Phone</th>
         <th>Company</th>
         <th>Password</th>
         <th>Account Status(Y or N only)</th>
         <th></th>
         <th></th>
       </tr>";
       while($row=$result->fetch_assoc()){
         echo "<tr>";
         echo "<td contentEditable='true'>" . $row['username'] . "</td>";
         echo "<td contentEditable='true'>" . $row['firstname'] . "</td>";
         echo "<td contentEditable='true'>" . $row['lastname'] . "</td>";
         echo "<td contentEditable='true'>" . $row['email'] . "</td>";
         echo "<td contentEditable='true'>" . $row['phone'] . "</td>";
         echo "<td contentEditable='true'>" . $row['company'] . "</td>";
         echo "<td contentEditable='true'>" . $row['password'] . "</td>";
         echo "<td contentEditable='true'>" . $row['account_status'] . "</td>";
         echo "<td onclick='updateRow(this)'><i class='material-icons md-18 blue'> edit</i></td>";
         echo "<td onclick='delRow(this)'><i class='material-icons md-18 blue'> delete</i></td>";
         echo "</tr>";
       }
        echo "</table>";
  }
    mysqli_close($conn);
}

function profile(){
  include 'connect.php';
  $username = $_POST['username'];

  $sql = "SELECT * from user_details where username='$username'";
  $result = mysqli_query($conn,$sql);
  $row = $result->fetch_assoc();
  echo json_encode($row);
  mysqli_close($conn);
}

function updateprofile(){
  include 'connect.php';
  $username = $_POST['username'];
  $firstN = $_POST['firstname'];
  $lastN = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $companyN = $_POST['companyname'];
  $companyS = $_POST['companysite'];
  $jobtitle = $_POST['jobtitle'];

  $sql = "UPDATE user_details SET firstname='$firstN' ,lastname='$lastN' ,Email='$email' ,phone='$phone' ,company='$companyN' ,companysite='$companyS' ,jobtitle='$jobtitle' where username='$username'";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Profile Updated!!";
  }else{
    echo "Failed to Update Profile!!";
  }
  mysqli_close($conn);
}

function deleteUser(){
  include 'connect.php';
  $username = $_POST['username'];

  $sql = "DELETE from customer WHERE Username='$username' ";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Delete Successfully!!";
  }else{
    echo "Delete Failed, Please check your database setting!";
  }
  mysqli_close($conn);
}

function editUser(){
  include 'connect.php';
  $status = $_POST['admin_status'];
  if($status == "Y"){
    $username = $_POST['username'];
    $firstN = $_POST['firstname'];
    $lastN = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass=$_POST['password'];

    $sql = "UPDATE user_details SET password='$pass',firstname='$firstN', lastname='$lastN', email='$email', phone='$phone'  WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    if($result){
      echo "Admin Modified!!";
    }else{
      echo "Failed to modify Admin!!";
    }
  }else{
    $username = $_POST['username'];
    $firstN = $_POST['firstname'];
    $lastN = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $companyN = $_POST['company'];
    $pass = $_POST['password'];
    $ac_status = $_POST['account_status'];

    $sql = "UPDATE user_details SET firstname='$firstN' ,lastname='$lastN' ,email='$email' ,phone='$phone' ,company='$companyN' ,password='$pass' ,account_status='$ac_status' where username='$username'";
    $result = mysqli_query($conn,$sql);
    if($result){
      echo "User Modified!!";
    }else{
      echo "Failed to modify User!!";
    }
  }

  mysqli_close($conn);

}

function deleteCompany(){
  include 'connect.php';
  $companyName = $_POST['companyName'];

  $sql = "DELETE from company WHERE name='$companyName' ";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Delete Successfully!!";
  }else{
    echo "Delete Failed, Please check your database setting!";
  }
  mysqli_close($conn);
}

function editCompany(){
  include 'connect.php';
  $companyName = $_POST['companyName'];
  $companyAddress = $_POST['companyAddress'];
  $companyPhone = $_POST['companyPhone'];
  $companySite = $_POST['companySite'];

  $sql = "UPDATE company SET address='$companyAddress' ,phone='$companyPhone' ,site='$companySite' where name='$companyName'";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Company Modified!!";
  }else{
    echo "Failed to modify Company!!";
  }
  mysqli_close($conn);

}

function displayC(){
  include 'connect.php';

  $sql = "SELECT * from company";
  $result = mysqli_query($conn,$sql);
  echo "

  <table id='tableForC'>
   <tr>
     <th>Company Name</th>
     <th>Company Address</th>
     <th>Company Phone</th>
     <th>PCompany URL</th>
     <th></th>
     <th></th>
   </tr>";
   while($row=$result->fetch_assoc()){
     echo "<tr>";
     echo "<td contentEditable='true'>" . $row['name'] . "</td>";
     echo "<td contentEditable='true'>" . $row['address'] . "</td>";
     echo "<td contentEditable='true'>" . $row['phone'] . "</td>";
     echo "<td contentEditable='true'>" . $row['site'] . "</td>";
     echo "<td onclick='updateCompany(this)'><i class='material-icons md-18 blue'> edit</i></td>";
     echo "<td onclick='delCompany(this)'><i class='material-icons md-18 blue'> delete</i></td>";
     echo "</tr>";
   }
    echo "</table>";
    mysqli_close($conn);
}

function qlik(){
  include 'connect.php';
  $username = $_POST['username'];

  $sql = "SELECT * from user_details where username='$username'";
  $sql1 = "SELECT * FROM user_iframe where username='$username'";
  $result = mysqli_query($conn,$sql);
  $result1 = mysqli_query($conn,$sql1);
  $row = $result->fetch_assoc();
  $row += $result1->fetch_assoc();
  echo json_encode($row);
  mysqli_close($conn);
}

function qlikU(){
  include 'connect.php';
  $sql = "SELECT username FROM user_details WHERE admin_status='N'AND account_status='Y' ORDER BY username";
  $result = mysqli_query($conn,$sql);
  while($row = $result -> fetch_assoc()){
      echo $row['username'].",";
  }
  mysqli_close($conn);
}

function editIframes(){
  include 'connect.php';
  $username = $_POST['username'];
  $i1 = strtr($_POST['iframe1'],"*","&");
  $i2 = strtr($_POST['iframe2'],"*","&");
  $i3 = strtr($_POST['iframe3'],"*","&");
  $i4 = strtr($_POST['iframe4'],"*","&");
  $i5 = strtr($_POST['iframe5'],"*","&");
  $i6 = strtr($_POST['iframe6'],"*","&");

  $sql = "UPDATE user_iframe SET iframe1='$i1' ,iframe2='$i2' ,iframe3='$i3' ,iframe4='$i4' ,iframe5='$i5' ,iframe6='$i6' where username='$username'";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Visualization Updated!!";
  }else{
    echo "Failed to Update Visualization!!";
  }
  mysqli_close($conn);
}
?>
