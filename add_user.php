<?php
function validateForm() {
    var x = document.forms["add_user.php"]["username"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}


if(isset($_POST['add_user'])){
  include 'connect.php';
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

      $sql = "INSERT INTO user_details(username,firstname,lastname,email,phone,companysite,jobtitle,company,password,admin_status)
       VALUES('$username', '$fname', ' $lname', '$email', '$phone', '  $url', '$jobtitle', '$company', '$password', '$admin_status')";
    if ($conn->query($sql) === TRUE) {

    echo "<script>alert('New user added $result'); window.location = './adminpage.html';</script>";
} else {
  echo "<script>alert('Error $sql $conn->error'); window.location = './adminpage.html';</script>";
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  }
  if(isset($_POST['resetpassword']))
  {
include 'connect.php';
    $oldpassword=$_POST['oldpassword'];
    $newpassword=$_POST['newpassword'];



  }
  else{
  echo "<script>alert('No data Found'); window.location = './adminpage.html';</script>";

  }



    ?>
