<?php

if(isset($_POST['add_user'])){
adduser();
}else if(isset($_POST['resetpassword']))
{
resetpassword();
}
// adds new user to the database
function adduser(){
  include 'connect.php';
try{
    $username=$_POST['username'];
      $password=$_POST['password'];

      $fname = $_POST['fname'];
      $lname=$_POST['lname'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $ac_status='Y';
      $company="";
      $url="";
      $jobtitle="";

      if(isset($_POST['member'])){
        $admin_status='Y';
      }else{
        $admin_status='N';
        $company=$_POST['company'];
        $url=$_POST['url'];
        $jobtitle=$_POST['jobtitle'];
      }

      $sql = "INSERT INTO user_details(username,firstname,lastname,email,phone,companysite,jobtitle,company,password,admin_status,account_status)
       VALUES('$username', '$fname', ' $lname', '$email', '$phone', '  $url', '$jobtitle', '$company', '$password', '$admin_status','$ac_status')";
       if($admin_status == 'N'){
         $sql1 = "INSERT INTO user_iframe(username,iframe1,iframe2,iframe3,iframe4,iframe5,iframe6) VALUES('$username','','','','','','')";
         $result = mysqli_query($conn,$sql1);
       }
    if ($conn->query($sql) === TRUE) {


    echo "<script>alert('New user added '); window.location = '../adminpage.html';</script>";

} else {
  echo "<script>alert('Error $sql $conn->error'); window.location = '../adminpage.html';</script>";
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
catch(Exception $e)
{
}}

//reset user password
function resetpassword() {

include 'connect.php';
    $oldpass=$_POST['oldpassword'];

    $newpass=$_POST['newpassword'];
if(!empty($_COOKIE['username']))
{
  $currentuser=$_COOKIE['username'];
}


$sql3 = "SELECT * FROM user_details WHERE username='$currentuser' ";
$result = $conn->query($sql3);
if($row=$result->fetch_assoc()){
    if($row['password'] == $oldpass){

      $sql="UPDATE user_details SET password='$newpass' where username='$currentuser' && password='$oldpass'";
      if ($conn->query($sql) === TRUE) {

      echo "<script>alert('Password changed'); window.location = '../userpage.html';</script>";
      } else {
      echo "<script>alert('Error $sql $conn->error'); window.location = '../userpage.html';</script>";
      echo "Error: " . $sql . "<br>" . $conn->error;
      }

    }else{
    echo "<script>alert('Invalid passoword entered'); window.location = '../userpage.html';</script>";  }
}else{

}



  }
    ?>
