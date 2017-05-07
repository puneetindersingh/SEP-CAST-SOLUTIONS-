<?php
if(isset($_POST['sendMail'])){
sendMail();
}
else if(isset($_POST['saveDraft'])){
saveDraft();
}else if(isset($_POST['inbox'])){
inbox();
}else if(isset($_POST['sentmail'])){
sentmail();
}else if(isset($_POST['draft'])){
draft();
}else if(isset($_POST['deleteMail'])){
  deleteMail();
}else if(isset($_POST['changeStatus'])){
  changeStatus();
}else if(isset($_POST['updateDraft'])){
  updateDraft();
}

// 0--unread,1--read,2--draft
function sendMail(){
      include 'connect.php';
      $sender = $_COOKIE['username'];
     $receiver=$_POST['receiver'];
     $subject = $_POST['subject'];
      $message = $_POST['message'];

      $sql = "INSERT INTO mailbox(username,sender,receiver,subject,message,status) VALUES('$sender','$sender','$receiver','$subject','$message','0')";
      $sql1 = "INSERT INTO mailbox(username,sender,receiver,subject,message,status) VALUES('$receiver','$sender','$receiver','$subject','$message','0')";
      if($result = $conn->query($sql) && $result1 = $conn->query($sql1)){
        echo "<script>alert('Mail Send, Please check in your Sent Mail!'); window.location = '../userpage.html';</script>";
      }else{
        echo "<script>alert($conn->error); window.location = '../userpage.html';</script>";
      }
}

function saveDraft(){
    include 'connect.php';
    $sender = $_COOKIE['username'];
   $receiver=$_POST['receiver'];
   $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO mailbox(username,sender,receiver,subject,message,status) VALUES('$sender','$sender','$receiver','$subject','$message','2')";
    if($result = $conn->query($sql)){
      echo "<script>alert('Your unsent mail have being saved,Please check in Draft!'); window.location = '../userpage.html';</script>";
    }else{
      echo "<script>alert($conn->error); window.location = '../userpage.html';</script>";
    }
}


function inbox(){
  include 'connect.php';
  $receiver = $_COOKIE['username'];
  $pre = "SELECT admin_status FROM user_details WHERE username='$receiver'";
  $preResult = mysqli_query($conn,$pre);
  $status = $preResult -> fetch_assoc();
  if($status['admin_status'] == 'Y'){
    $sql = "SELECT * FROM mailbox WHERE receiver LIKE '%admin%' AND username LIKE '%admin%' ORDER BY times DESC";
  }else{
    $sql = "SELECT * FROM mailbox WHERE receiver = '$receiver' AND username = '$receiver' ORDER BY times DESC";
  }
  $result = mysqli_query($conn,$sql);
  $json = array();
  while($row = $result->fetch_assoc()){
    $json[] = array('inbox' => $row);
  }
  echo json_encode($json);
  mysqli_close($conn);
}

function sentmail(){
  include 'connect.php';
  $sender = $_COOKIE['username'];
  $sql = "SELECT * FROM mailbox WHERE sender = '$sender' AND username = '$sender' ORDER BY times DESC";
  $result = mysqli_query($conn,$sql);
  $json = array();
  while($row = $result->fetch_assoc()){
    $json[] = array('sent' => $row);
  }
  echo json_encode($json);
  mysqli_close($conn);
}

function draft(){
  include 'connect.php';
  $sender = $_COOKIE['username'];
  $sql = "SELECT * FROM mailbox WHERE sender = '$sender' AND username = '$sender' AND status = '2' ORDER BY times DESC";
  $result = mysqli_query($conn,$sql);
  $json = array();
  while($row = $result->fetch_assoc()){
    $json[] = array('draft' => $row);
  }
  echo json_encode($json);
  mysqli_close($conn);
}

function deleteMail(){
  include 'connect.php';
  $username = $_COOKIE['username'];
  $sen = $_POST['sender'];
  $rec = $_POST['receiver'];
  $time = $_POST['times'];
  $sql = "DELETE from mailbox WHERE username='$username' AND sender='$sen' AND receiver='$rec' AND times='$time' ";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Delete Successfully!!";
  }else{
    echo "Delete Failed, Please check your database setting!";
  }
  mysqli_close($conn);
}

function changeStatus(){
  include 'connect.php';
  $username = $_COOKIE['username'];
  $sen = $_POST['sender'];
  $rec = $_POST['receiver'];
  $time = $_POST['times'];
  $sql="UPDATE mailbox SET status='1' WHERE username='$username' AND sender='$sen' AND receiver='$rec' AND times='$time'";
  $result = mysqli_query($conn,$sql);
  // if($result){
  //   echo "Change Successfully!!";
  // }else{
  //   echo "Delete Failed, Please check your database setting!";
  // }
  mysqli_close($conn);
}

function updateDraft(){
  include 'connect.php';
  $sender = $_COOKIE['username'];
  $receiver=$_POST['receiver'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $times = $_POST['times'];

  $sql = "UPDATE mailbox SET receiver = '$receiver', subject = '$subject', message = '$message' WHERE username='$sender' AND sender='$sender' AND times = '$times' AND status = '2'";
  if($result = $conn->query($sql)){
    echo "<script>alert('Your unsent mail have being saved,Please check in Draft!'); window.location = '../userpage.html';</script>";
  }else{
    echo "<script>alert($conn->error); window.location = '../userpage.html';</script>";
  }
}
?>
