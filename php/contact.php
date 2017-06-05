<?php


if(isset($_POST['sendMail']) || isset($_POST['sendDraft'])){
sendMail();
}else if(isset($_POST['saveDraft'])){
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
}else if(isset($_POST['initial'])){
  initial();
}

// 0--unread,1--read,2--draft
function sendMail(){
      include 'connect.php';
      $sender = $_COOKIE['username'];
     $receiver=$_POST['receiver'];
     $subject = $_POST['subject'];
      $message = $_POST['message'];
      if($subject==null||$receiver==null||$message==null)
      {
        echo "<script>alert('Field cannot be empty, please check !'); history.go(-1); </script>";
        exit();
      }
      $sql = "INSERT INTO mailbox(username,sender,receiver,subject,message,status) VALUES('$sender','$sender','$receiver','$subject','$message','0')";
      $sql1 = "INSERT INTO mailbox(username,sender,receiver,subject,message,status) VALUES('$receiver','$sender','$receiver','$subject','$message','0')";
      if($sender == $receiver){
        if($result = $conn->query($sql)){
          echo "<script>alert('Mail Send, Please check in your Sent Mail!'); history.go(-1); </script>";
        }else{
          echo "<script>alert($conn->error); history.go(-1); </script>";
        }
      }else{if(isset($_POST['sendDraft'])){
        $times = $_POST['times'];
        $sql2 = "DELETE FROM mailbox WHERE username = '$sender' AND times = '$times' AND status = '2'";
        if($result = $conn->query($sql) && $result1 = $conn->query($sql1) && $result2 = $conn->query($sql2)){

          echo "<script>alert('Mail Send, Please check in your Sent Mail!');   history.go(-1); </script>";

        }else{
          echo "<script>alert($conn->error); history.go(-1); </script>";
        }
      }else{
        if($result = $conn->query($sql) && $result1 = $conn->query($sql1)){
          echo "<script>alert('Mail Send, Please check in your Sent Mail!');   history.go(-1);</script>";


        }else{
          echo "<script>alert($conn->error); history.go(-1); </script>";
        }


      }
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
      echo "<script>alert('Your unsent mail have being saved,Please check in Draft!'); history.go(-1); </script>";
    }else{
      echo "<script>alert($conn->error); history.go(-1); </script>";
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
  $sql = "SELECT * FROM mailbox WHERE sender = '$sender' AND username = '$sender' AND status='0' ORDER BY times DESC";
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
  $sql="UPDATE mailbox SET status='1' WHERE username='$rec' AND sender='$sen' AND receiver='$rec' AND times='$time'";
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
    echo "<script>alert('Your unsent mail have being saved,Please check in Draft!'); history.go(-1); </script>";
  }else{
    echo "<script>alert($conn->error); history.go(-1); </script>";
  }
  mysqli_close($conn);
}

function initial(){
  include 'connect.php';
  $user = $_COOKIE['username'];
  $sql = "SELECT COUNT(*) FROM mailbox WHERE username = '$user' AND receiver = '$user' AND status ='0'";
  $sql1 = "SELECT COUNT(*) FROM mailbox WHERE sender = '$user' AND username = '$user' AND status = '2'";
  $result = mysqli_query($conn,$sql);
  $result1 = mysqli_query($conn,$sql1);
  if($result && $result1){
    $row = $result->fetch_assoc();
    $row1 = $result1->fetch_assoc();
    $json = array();
    $json[] = array('inbox' => $row);
    $json[] = array('draft' => $row1);
    echo json_encode($json);
  }else{
    echo "Initial Failed!";
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
}
?>
