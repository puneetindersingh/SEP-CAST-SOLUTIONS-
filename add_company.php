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
      
      $sql=" SELECT * FROM company WHERE name  = '$name'";
      
      
     $result = mysqli_query($conn,$sql);
     $check = mysqli_num_rows($result);

     if($check==1){
         echo "<script>alert('Record Exist'); window.location = './adminpage.html';</script>";
     }
      else {
          $sql1 = "INSERT INTO company(name,address,phone,site) VALUES('$name','$address','$phone','$site')";
      $result = $conn->query($sql1);
      echo "<script>alert('Company added'); window.location = './admin.html';</script>";
          
      }
     
      }

  // testing   echo "<script>alert('$name'); window.location = './userpage.html';</script>";

    ?>
