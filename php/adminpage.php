<?php
if(isset($_POST['getCompany'])){
    getCompany();
}else if(isset($_POST['displayC'])){
    displayC();
}else if(isset($_POST['deleteC'])){
    deleteCompany();
}else if(isset($_POST['editC'])){
    editCompany();
}else if (isset($_POST['displayU'])){
    displayU();
}else if(isset($_POST['deleteU'])){
    deleteUser();
}else if(isset($_POST['editU'])){
    editUser();
}else if(isset($_POST['qlikU'])){
    qlikU();
}else if(isset($_POST['iframes'])){
    editIframes();
}else if(isset($_POST['add_user'])){
    adduser();
}else if(isset($_POST['add_company'])){
    addCompany();
}else if(isset($_POST['companyInfo'])){
    companyInfo();
}

function getCompany(){
  include 'connect.php';
  $sql = "SELECT DISTINCT name FROM company order by name";
  $result = mysqli_query($conn,$sql);
  while($row = $result -> fetch_assoc()){
      echo $row['name'].",";
  }
  mysqli_close($conn);
}

function displayC(){
  include 'connect.php';

  $sql = "SELECT * from company";
  $result = mysqli_query($conn,$sql);
  echo "

  <table id='tableForC'>
   <tr>
     <th>Company Name</th>
     <th>Company Address</th>
     <th>Company Phone</th>
     <th>PCompany URL</th>
     <th></th>
     <th></th>
   </tr>";
   while($row=$result->fetch_assoc()){
     echo "<tr>";
     echo "<td >" . $row['name'] . "</td>";
     echo "<td contentEditable='true'>" . $row['address'] . "</td>";
     echo "<td contentEditable='true'>" . $row['phone'] . "</td>";
     echo "<td contentEditable='true'>" . $row['site'] . "</td>";
     echo "<td onclick='updateCompany(this)'><i style='cursor:pointer' class='material-icons md-18 blue'>save</i></td>";
     echo "<td onclick='delCompany(this)'><i style='cursor:pointer' class='material-icons md-18 blue'> delete</i></td>";
     echo "</tr>";
   }
    echo "</table>";
    mysqli_close($conn);
}

function deleteCompany(){
  include 'connect.php';
  $companyName = $_POST['companyName'];
  $sql = "DELETE from company WHERE name='$companyName' ";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Record Deleted!";
  }else{
    echo "Error Occured: Record Update failed!";
  }
  mysqli_close($conn);
}

function editCompany(){
  include 'connect.php';
  $companyName = $_POST['companyName'];
  $companyAddress = $_POST['companyAddress'];
  $companyPhone = $_POST['companyPhone'];
  $companySite = $_POST['companySite'];

  $sql = "UPDATE company SET address='$companyAddress' ,phone='$companyPhone' ,site='$companySite' where name='$companyName'";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Record Modified!";
  }else{
    echo "Error Occured: Record Update failed!";
  }
  mysqli_close($conn);
}

function displayU(){
  include 'connect.php';
  $companyN = $_POST['companyN'];
  if($companyN == "admin"){
      $sql = "SELECT * FROM user_details WHERE admin_status='Y'";
      $result = mysqli_query($conn,$sql);
      echo"

      <table id='editableForA'>
       <tr>
         <th>Username</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email address</th>
         <th>Phone</th>
         <th>Password</th>
         <th></th>
         <th></th>
         </tr>";
         while($row = $result -> fetch_assoc()){
           echo "<tr>";
           echo "<td >" . $row['username'] . "</td>";
           echo "<td contentEditable='true'>" . $row['firstname'] . "</td>";
           echo "<td contentEditable='true'>" . $row['lastname'] . "</td>";
           echo "<td contentEditable='true'>" . $row['email'] . "</td>";
           echo "<td contentEditable='true'>" . $row['phone'] . "</td>";
           echo "<td contentEditable='true'>" . $row['password'] . "</td>";
           echo "<td onclick='updateRow(this)'><i style='cursor:pointer' class='material-icons md-18 blue'> save</i></td>";
           echo "<td onclick='delRow(this)'><i style='cursor:pointer' class='material-icons md-18 blue'> delete</i></td>";
           echo "</tr>";
         }
           echo "</table>";
  }else{

      $sql = "SELECT * from user_details WHERE company='$companyN'";
      $result = mysqli_query($conn,$sql);
      echo "

      <table id='editableForU'>
       <tr>
         <th>Username</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email address</th>
         <th>Phone</th>
         <th>Company</th>
         <th>Password</th>
         <th>Account Status(Y or N only)</th>
         <th></th>
         <th></th>
       </tr>";
       while($row=$result->fetch_assoc()){
         echo "<tr>";
         echo "<td >" . $row['username'] . "</td>";
         echo "<td contentEditable='true'>" . $row['firstname'] . "</td>";
         echo "<td contentEditable='true'>" . $row['lastname'] . "</td>";
         echo "<td contentEditable='true'>" . $row['email'] . "</td>";
         echo "<td contentEditable='true'>" . $row['phone'] . "</td>";
         echo "<td contentEditable='true'>" . $row['company'] . "</td>";
         echo "<td contentEditable='true'>" . $row['password'] . "</td>";
         echo "<td contentEditable='true'>" . $row['account_status'] . "</td>";
         echo "<td onclick='updateRow(this)'><i style='cursor:pointer' class='material-icons md-18 blue'> save</i></td>";
         echo "<td onclick='delRow(this)'><i style='cursor:pointer' class='material-icons md-18 blue'> delete</i></td>";
         echo "</tr>";
       }
        echo "</table>";
  }
    mysqli_close($conn);
}

function deleteUser(){
  include 'connect.php';
  $username = $_POST['username'];

  $sql = "DELETE from user_details WHERE username='$username' ";
  $result = mysqli_query($conn,$sql);
  if($result){
    echo "Record Deleted!";
  }else{
    echo "Error Occured: Record Update failed!";
  }
  mysqli_close($conn);
}

function editUser(){
  include 'connect.php';
  $status = $_POST['admin_status'];
  if($status == "Y"){
    $username = $_POST['username'];
    $firstN = $_POST['firstname'];
    $lastN = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass=$_POST['password'];

    $sql = "UPDATE user_details SET password='$pass',firstname='$firstN', lastname='$lastN', email='$email', phone='$phone'  WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    if($result){
      echo "Admin Modified!";
    }else{
      echo "Error occured:Failed to modify Admin!";
    }
  }else{
    $username = $_POST['username'];
    $firstN = $_POST['firstname'];
    $lastN = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $companyN = $_POST['company'];
    $pass = $_POST['password'];
    $ac_status = $_POST['account_status'];

    $sql = "UPDATE user_details SET firstname='$firstN' ,lastname='$lastN' ,email='$email' ,phone='$phone' ,company='$companyN' ,password='$pass' ,account_status='$ac_status' where username='$username'";
    $result = mysqli_query($conn,$sql);
    if($result){
      echo "User Modified!!";
    }else{
      echo "Error occured:Failed to modify User!";
    }
  }
  mysqli_close($conn);
}

function qlikU(){
  include 'connect.php';
  $companyForQlik = $_POST['companyForQlik'];
  $sql = "SELECT username FROM user_details WHERE admin_status='N'AND account_status='Y' AND company='$companyForQlik' ORDER BY username";
  $result = mysqli_query($conn,$sql);
  while($row = $result -> fetch_assoc()){
      echo $row['username'].",";
  }
  mysqli_close($conn);
}

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

function editIframes(){
  include 'connect.php';
  $username = $_POST['username'];
  $i1 = strtr($_POST['iframe1'],"*","&");
  $i2 = strtr($_POST['iframe2'],"*","&");
  $i3 = strtr($_POST['iframe3'],"*","&");
  $i4 = strtr($_POST['iframe4'],"*","&");
  $i5 = strtr($_POST['iframe5'],"*","&");
  $i6 = strtr($_POST['iframe6'],"*","&");
  $i7 = strtr($_POST['iframe7'],"*","&");
  $i8 = strtr($_POST['iframe8'],"*","&");
  $i9 = strtr($_POST['iframe9'],"*","&");
  $i10 = strtr($_POST['iframe10'],"*","&");


  $sql = "UPDATE user_iframe SET iframe1='$i1' ,iframe2='$i2' ,iframe3='$i3' ,iframe4='$i4' ,iframe5='$i5' ,iframe6='$i6' ,iframe7='$i7' ,iframe8='$i8' ,iframe9='$i9' ,iframe10='$i10' where username='$username'";
  $result = mysqli_query($conn,$sql) ;
  if($result){
    echo "Visualization Updated!";
  }else{
    // echo "Error occured:Failed to Update Visualization!";

    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
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
      $ac_status='Y';
      $company="";
      $url="";
      $jobtitle="";
      if(isset($_POST['member'])){
        $admin_status='Y';
      }else{
        $admin_status='N';
        $company=$_POST['company'];
        $url=$_POST['url'];
        $jobtitle=$_POST['jobtitle'];
      }
      $sql = "INSERT INTO user_details(username,firstname,lastname,email,phone,companysite,jobtitle,company,password,admin_status,account_status)
       VALUES('$username', '$fname', ' $lname', '$email', '$phone', '  $url', '$jobtitle', '$company', '$password', '$admin_status','$ac_status')";
       if($admin_status == 'N'){
         $sql1 = "INSERT INTO user_iframe(username,iframe1,iframe2,iframe3,iframe4,iframe5,iframe6) VALUES('$username','','','','','','')";
         $result = mysqli_query($conn,$sql1);
       }
    if ($conn->query($sql) === TRUE) {


    echo "<script>alert('New user added '); window.location = '../adminpage.html';</script>";

    echo "<script>alert('New user added'); window.location = '../adminpage.html';</script>";

} else {
  echo "<script>alert('Error $sql $conn->error'); window.location = '../adminpage.html';</script>";
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
catch(Exception $e)
{
}}

function addCompany()
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
       echo "<script>alert('Record Exist'); window.location = '../adminpage.html';</script>";
   }
    else {
        $sql1 = "INSERT INTO company(name,address,phone,site) VALUES('$name','$address','$phone','$site')";
    $result = $conn->query($sql1);
    echo "<script>alert('Company added'); window.location = '../adminpage.html';</script>";

    }

    }

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

      echo "<script>alert('Password changed'); window.location = '../userpage.html';</script>";
      } else {
      echo "<script>alert('Error $sql $conn->error'); window.location = '../userpage.html';</script>";
      echo "Error: " . $sql . "<br>" . $conn->error;
      }

    }else{
    echo "<script>alert('Invalid passoword entered'); window.location = '../userpage.html';</script>";  }
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

  function companyInfo(){
    include 'connect.php';
    $companyN = $_POST['companyN'];
    $sql = "SELECT * FROM company WHERE name = '$companyN'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    echo json_encode($row);
    mysqli_close($conn);
  }
?>
