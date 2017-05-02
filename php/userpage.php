<?php
if(isset($_POST['profile'])){
    profile();
}else if(isset($_POST['updateprofile'])){
    updateprofile();
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

  $sql = "UPDATE user_details SET firstname='$firstN' ,lastname='$lastN' ,email='$email' ,phone='$phone' ,company='$companyN' ,companysite='$companyS' ,jobtitle='$jobtitle' where username='$username'";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Profile Updated!!";
  }else{
    echo "Failed to Update Profile!!";
  }
  mysqli_close($conn);
}
?>
