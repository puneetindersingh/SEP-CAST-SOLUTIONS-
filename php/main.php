<?php
if(isset($_POST['qlik'])){
    qlik();
}else if(isset($_POST['resetpassword'])){
    resetpassword();
}
// fetch user iframes
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
//Change user passoword 
function resetpassword() {
include 'connect.php';
    $oldpass=$_POST['oldpassword'];

    $newpass=$_POST['newpassword'];
if(!empty($_COOKIE['username']))
{
  $currentuser=$_COOKIE['username'];
}


$sql3 = "SELECT * FROM user_details WHERE username='$currentuser' ";
$result = mysqli_query($conn,$sql3);
if($row=$result->fetch_assoc()){
    if($row['password'] == $oldpass){

      $sql="UPDATE user_details SET password='$newpass' where username='$currentuser' && password='$oldpass'";
      if ($conn->query($sql) === TRUE) {

      echo "<script>alert('Password changed'); window.history.back();</script>";
      } else {
      echo "<script>alert('Error $sql $conn->error'); window.history.back();</script>";
      echo "Error: " . $sql . "<br>" . $conn->error;
      }

    }else{
    echo "<script>alert('Invalid passoword entered'); window.history.back();</script>";  }
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
