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
}

function login(){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
$sql = "SELECT * FROM user_details WHERE username='$username' AND password='$password' ";
$result = $conn->query($sql);
if($row=$result->fetch_assoc()){
    if($row['admin_status'] == 'Y'){
      echo "admin";
    }else{
      echo "user";
    }
}else{
  echo "no";
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

}

function getCompany(){
  include 'connect.php';
  $sql = "SELECT DISTINCT Company FROM customer order by Company";
  $result = mysqli_query($conn,$sql);
  while($row = $result -> fetch_assoc()){
      echo $row['Company'].",";
  }
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
           echo "<td onclick='updateRow(this)'><i class='material-icons md-18 blue'> edit</i></td>";
           echo "<td onclick='delRow(this)'><i class='material-icons md-18 blue'> delete</i></td>";
           echo "</tr>";
         }
           echo "</table>";
  }else{

      $sql = "SELECT * from customer WHERE Company='$companyN'";
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
         <th>Company Site Name</th>
         <th>Company Job Title</th>
         <th></th>
         <th></th>
       </tr>";
       while($row=$result->fetch_assoc()){
         echo "<tr>";
         echo "<td contentEditable='true'>" . $row['Username'] . "</td>";
         echo "<td contentEditable='true'>" . $row['Firstname'] . "</td>";
         echo "<td contentEditable='true'>" . $row['Lastname'] . "</td>";
         echo "<td contentEditable='true'>" . $row['Email'] . "</td>";
         echo "<td contentEditable='true'>" . $row['Phone_Number'] . "</td>";
         echo "<td contentEditable='true'>" . $row['Company'] . "</td>";
         echo "<td contentEditable='true'>" . $row['Address_1'] . "</td>";
         echo "<td contentEditable='true'>" . $row['Address_2'] . "</td>";
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

    $sql = "UPDATE user_details SET firstname='$firstN', lastname='$lastN', email='$email', phone='$phone'  WHERE username='$username'";
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
    $companyN = $_POST['companyname'];
    $companyS = $_POST['companysite'];
    $jobtitle = $_POST['jobtitle'];

    $sql = "UPDATE customer SET Firstname='$firstN' ,Lastname='$lastN' ,Email='$email' ,Phone_Number='$phone' ,Company='$companyN' ,Address_1='$companyS' ,Address_2='$jobtitle' where username='$username'";
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
?>
