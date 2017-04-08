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
  /*    if($username==null|| $passoword==null)
      {
          echo "<script>alert('Error No data entered(Username or password field cannot be empty)'); window.location = './adminpage.html';</script>";
          exit();
      }*/
      $a_status=$_POST['member'];

        if($a_status=='user')
      {
          $admin_status='N';

        }
        else {
          $admin_status='Y';

        }
        $company=$_POST['company'];
        $url=$_POST['url'];
        $jobtitle=$_POST['jobtitle'];

      $fname = $_POST['fname'];
     $lname=$_POST['lname'];
     $email = $_POST['email'];
      $phone = $_POST['phone'];



      $sql = "INSERT INTO user_details(username,firstname,lastname,email,phone,companysite,jobtitle,company,password,admin_status)
       VALUES('$username', '$fname', ' $lname', '$email', '$phone', '  $url', '$jobtitle', '$company', '$password', '$admin_status')";
    if ($conn->query($sql) === TRUE) {

    echo "<script>alert('New user added $result'); window.location = './adminpage.html';</script>";
} else {
  echo "<script>alert('Error $sql $conn->error'); window.location = './adminpage.html';</script>";
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
catch(Exception $e)
{
  echo "<script>alert('Error $e'); window.location = './adminpage.html';</script>";
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
