<?php

if(isset($_POST['add_user'])){
adduser();
}else if(isset($_POST['resetpassword']))
{
resetpassword();
}

function adduser(){
  include 'connect.php';
try{
    $username=$_POST['username'];
      $password=$_POST['password'];

      $fname = $_POST['fname'];
     $lname=$_POST['lname'];
     $email = $_POST['email'];
      $phone = $_POST['phone'];
      $company=$_POST['company'];
      $url=$_POST['url'];
      $jobtitle=$_POST['jobtitle'];
      $admin_status='N';
        $ac_status='Y';
      $a_status=$_POST['member'];
      if($a_status!=null)
      {
        if($a_status=='admin')
        {
          $admin_status='Y';
          
        }
      }
      $sql = "INSERT INTO user_details(username,firstname,lastname,email,phone,companysite,jobtitle,company,password,admin_status,account_status)
       VALUES('$username', '$fname', ' $lname', '$email', '$phone', '  $url', '$jobtitle', '$company', '$password', '$admin_status','$ac_status')";
    if ($conn->query($sql) === TRUE) {

    echo "<script>alert('New user added $result'); window.location = './adminpage.html';</script>";
} else {
  echo "<script>alert('Error $sql $conn->error'); window.location = './adminpage.html';</script>";
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
catch(Exception $e)
{
  echo $e;
}}


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

      echo "<script>alert('Password changed'); window.location = './userpage.html';</script>";
      } else {
      echo "<script>alert('Error $sql $conn->error'); window.location = './userpage.html';</script>";
      echo "Error: " . $sql . "<br>" . $conn->error;
      }

    }else{
    echo "<script>alert('Invalid passoword entered'); window.location = './userpage.html';</script>";  }
}else{
//  echo "no";
}


/*
if($row["password"]!=$oldpass)
{
$row = mysqli_fetch_assoc($chkpassword);



}



*/
  }
    ?>
