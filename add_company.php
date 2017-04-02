<?php
if(isset($_POST['add_company'])){
add();
}

  function add()
  {
      include 'connect.php';
      $name = $_POST['name'];
     $address=$_POST['address'];
     $phone = $_POST['phone'];
      $site = $_POST['site'];
     $sql = "INSERT INTO company(name,address,phone,site) VALUES('$name','$address','$phone','$site')";
      $result = $conn->query($sql);
      echo "<script>alert('Company added'); window.location = './userpage.html';</script>";
      }

  // testing   echo "<script>alert('$name'); window.location = './userpage.html';</script>";

    ?>
