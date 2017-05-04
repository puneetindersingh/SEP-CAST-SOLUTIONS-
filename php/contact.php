<?php
if(isset($_POST['admin_enquiry'])){
enquiry();
}
elseif(isset($_POST['user_enquiry'])){
user_enquiry();
}


  function enquiry()
  {
      include 'connect.php';
      $name = $_POST['name'];
     $email=$_POST['email'];
     $subject = $_POST['subject'];
      $message = $_POST['message'];

          $sql = "INSERT INTO admin_enquiry(name,email,subject,message) VALUES('$name','$email','$subject','$message')";
      $result = $conn->query($sql);
      echo "<script>alert(' Enquiry Submitted'); window.location = '../adminpage.html';</script>";

      }

function user_enquiry()
  {
      include 'connect.php';
      $name = $_POST['name'];
     $email=$_POST['email'];
     $subject = $_POST['subject'];
      $message = $_POST['message'];

          $sql1 = "INSERT INTO user_enquiry(name,email,subject,message) VALUES('$name','$email','$subject','$message')";
      $result = $conn->query($sql1);
      echo "<script>alert(' Enquiry Submitted'); window.location = '../userpage.html';</script>";

      }

      

  // testing   echo "<script>alert('$name'); window.location = './userpage.html';</script>";

    ?>