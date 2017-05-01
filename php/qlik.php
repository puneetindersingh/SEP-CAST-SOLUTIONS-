<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>User | Cast Solution</title>
 <link rel="stylesheet" href="css/mainPage.css">
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<script>
window.onload=checkCookie();
function topnav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "col-12 topnav") {
        x.className += " responsive";
    } else {
        x.className = "col-12 topnav";
    }
}

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    if(cityName == "modifyProfile"){
      showProfile();
    }
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function getCookie(cname){
 var name = cname + "=";
 var ca = document.cookie.split(';');
 for(var i=0; i<ca.length; i++) {
   var c = ca[i].trim();
   if (c.indexOf(name)==0) return c.substring(name.length,c.length);
 }
 return "";
}

function checkCookie(){
 var user=getCookie("username");
  var status=getCookie("loginstatus");
    var name =getCookie("full_name");
  if(status!="" && status =="yes"){
     if (user!=""){
       document.getElementById('user').innerHTML = name.replace(/\+/g,' ').toUpperCase();
     }
     else {
        alert('no exist Cookie!');
      }
    }else{
      window.location = "./login.html";
    }
}

var d = new Date();
var exdays = 30;
d.setTime(d.getTime()+(exdays*24*60*60*1000));
var expires = "expires="+d.toGMTString();

function setStatus(){
  document.cookie = "loginstatus=no; "+expires;
}

var xmlHttp;
function showProfile(){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url='function-modified.php';
 var params = "";
 params += "profile=1&username="+document.getElementById('user').innerHTML;
 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChanged;
 xmlHttp.send(params);
}

function stateChanged(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  var str=xmlHttp.responseText;

  var obj = eval('(' + str + ')');
  document.getElementById('firstN').value = obj.firstname;
  document.getElementById('lastN').value = obj.lastname;
  document.getElementById('emailAddress').value = obj.email;
  document.getElementById('phoneNo').value = obj.phone;
  document.getElementById('companyN').value = obj.company;
  document.getElementById('companySite').value = obj.companysite;
  document.getElementById('jobTitle').value = obj.jobtitle;
 }
}

function GetXmlHttpObject(){
var xmlHttp=null;
try{
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e){
 //Internet Explorer
 try{
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e){
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

function updateProfile(){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
 var myreg1 = /^(\+61)[0-9]{1}[0-9]{4}[0-9]{4}$/;
 if(!myreg.test(document.getElementById('emailAddress').value)){
   alert("Please enter the correct email with '@' format!");
 }else if(!myreg1.test(document.getElementById('phoneNo').value)){
   alert("Please enter the Phone Number with '+61' at the front and 9 following numbers!");
 }else{
 var url='function-modified.php';
 var params = "";
 var phone = document.getElementById('phoneNo').value;
 phone = phone.replace(/\+/g, "%2B");
 params += "updateprofile=1&username="+document.getElementById('user').innerHTML+"&firstname="+document.getElementById('firstN').value
 +"&lastname="+document.getElementById('lastN').value+"&email="+document.getElementById('emailAddress').value
 +"&phone="+phone+"&companyname="+document.getElementById('companyN').value
 +"&companysite="+document.getElementById('companySite').value+"&jobtitle="+document.getElementById('jobTitle').value;

 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.onreadystatechange=stateChangedforProfie;
 xmlHttp.send(params);
}
}

function stateChangedforProfie(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  alert(xmlHttp.responseText);
 }
}

</script>
<body onload="checkCookie()">
<div class="row">

<!-- top nav -->

<div class="col-12 topnav" id="myTopnav">

  <a id="logoleftTop"><img id="logo" src="img/LOGO-01.png"/></a>
  <a href="#User"><i class="material-icons md-18 blue">face</i> <text id="user">USER</text></a>
  <a class="tablinks" onclick="location.href = 'QLIK.php';">QLIK SENSE</a>
  <a class="tablinks" onclick="openCity(event, 'contact')"><i class="material-icons md-18 blue">contact_phone</i> CONTACT</a>
  <a class="tablinks" onclick="openCity(event, 'aboutform')"><i class="material-icons md-18 blue">lightbulb_outline</i> ABOUT</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="topnav()">&#9776;</a>
</div>
<!-- side bar -->
<div class="col-2 menu">
  <ul>

    <li class="tablinks" onclick="openCity(event, 'modifyProfile')"><i class="material-icons md-18 blue">edit</i> Modify Profile</li>
    <li class="tablinks" onclick="openCity(event, 'helpPage')"><i class="material-icons md-18 blue"> help</i> Help</li>
<li> <i class="material-icons md-18 blue">power_settings_new</i><a href="login.html" style="text-decoration: none;  color: black; " onclick="logOut()"> Log Out</a></li>
    <li class="dropdown">
    <a class="dropbtn"><i class="material-icons md-18 blue">settings_applications</i> Settings</a>
    <div class="dropdown-content">
      <a class="tablinks" href="#" onclick="openCity(event, 'passReset')"><i class="material-icons md-18 blue">settings</i> Password Reset</a>
      <a href="#"><i class="material-icons md-18 blue">settings</i> Function 2</a>
      <a href="#"><i class="material-icons md-18 blue">settings</i> Function 3</a>
    </div>
  </li>
  </ul>
</div>

<!-- new form -->
<div class="col-14 divAddUser allform tabcontent" id="modifyProfile">
    <h4>User information</h4>
    <label for="fname">First Name</label>
    <input type="text" placeholder="Your name.." id="firstN">
    <label for="lname">Last Name</label>
    <input type="text" placeholder="Your last name.." id="lastN">
    <label for="lname">Email address</label>
    <input type="text" placeholder="Your email address.." id="emailAddress">
    <label for="lname">Phone number</label>
    <input type="text" placeholder="Your phone number.." id="phoneNo">
    <label for="lname">Company Name</label>
    <input type="text" placeholder="Your company name.." id="companyN">
    <label for="lname">Company Site Name</label>
    <input type="text" placeholder="Your company site name.." id="companySite">
    <label for="lname">Company Job Title</label>
    <input type="text" placeholder="Your company job title.." id="jobTitle">
    <input type="submit" name="edituser"value="Submit" onclick="updateProfile()">
</div>

<div class="col-14 divAddUser allform tabcontent" id="passReset">
  <form action="add_user.php" method="POST">
    <h4>Password Reset</h4>
    <label for="fname">Old Password</label>
    <input type="password"  name="oldpassword" placeholder="Your old password">
    <label for="fname">New Password</label>
    <input type="password"  name="newpassword" placeholder="Your new password">
    <input type="submit" name="resetpassword" value="Submit">
  </form>
</div>


 <!-- contact form -->
<div class="col-14 divAddUser allform tabcontent" id="contact">
  <form action="/action_page.php">
    <h4>Contact Us</h4>
    <label for="fname">Name</label>
    <input type="text" placeholder="Your name"required>
    <label for="fname">Email</label>
    <input type="email" placeholder="Your email"required>
    <label for="fname">Subject</label>
    <input type="text" placeholder="Subject"required>
    <label for="fname">Message</label>
    <textarea rows="10" type="text" placeholder="..."required></textarea>
    <input type="submit" value="Submit">
  </form>
</div>

<!-- About form -->
<div class="col-14 divAddUser allform tabcontent" id="aboutform">
    <h4>About Us</h4>
    <p>Cast Solutions provides consulting services and product solutions for companies seeking to enhance their performance and strategy, and looking to achieve sustainable growth.
    We thrive from being involved with businesses seeking to grow or improve. The common element is the need for a fresh approach, a process, tools and access to people who have done this successfully across diverse markets.</p>
<div class="rowTeam">
  <div class="columnTeamMain">
    <div class="teamCard">
      <img id="imgRob" src="img/castTeam/Claire.png" alt="Claire Lange">
      <div class="teamContainer">
        <h3>Claire Lange</h3>
        <p class="teamTitle">Client Relationship Lead</p>
        <p>Claire has more than 25 years' experience in various business sectors including industrial, utilities, construction and infrastructure. Founding Cast in 2004, she has a passion for working with companies to enable growth and collaborative partnerships. At Cast Solutions, Claire leads the Strategic Services team. </p>
        <p>claire@castsolutions.com.au</p>
        <p><button class="teamBtn">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="columnTeamMain">
    <div class="teamCard">
      <img id="imgRob" src="img/castTeam/Rob.png" alt="Rob Lange">
      <div class="teamContainer">
        <h3>Rob Lange</h3>
        <p class="teamTitle">Business Operations Lead</p>
        <p>Rob brings 30 years' experience in the engineering; oil and gas trading in Australia, Japan, South East Asia and Europe.  He has been responsible for the expansion into Data analytics solutions working closely with end clients. At Cast Solutions, Rob leads the Product Solutions, Data Analytics  and business operations.</p>
        <p>rob@castsolutions.com.au</p>
        <p><button class="teamBtn">Contact</button></p>
      </div>
    </div>
  </div>
  <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/DavidKirby.png" alt="David Kirby">
      <div class="teamContainer">
        <h3>David Kirby</h3>
        <p class="teamTitle">Strategic Consultant</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/JanineHoey.png" alt="Janine Hoey">
      <div class="teamContainer">
        <h3>Janine Hoey</h3>
        <p class="teamTitle">Strategic Consultant</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/MarkusZ.png" alt="Markus Z">
      <div class="teamContainer">
        <h3>Markus Z</h3>
        <p class="teamTitle">Strategic Consultant</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/LachlanWells.png" alt="LachlanWells">
      <div class="teamContainer">
        <h3>Lachlan Wells</h3>
        <p class="teamTitle">IT Lead Consultant</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/ShirleyZhang.png" alt="Shirley Zhang">
      <div class="teamContainer">
        <h3>Shirley Zhang</h3>
        <p class="teamTitle">Technical Support</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/MarcieKlocker.png" alt="Marcie Klocker">
      <div class="teamContainer">
        <h3>Marcie Klocker</h3>
        <p class="teamTitle">Technical Support</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/NoraManandi.png" alt="Nora Manandi">
      <div class="teamContainer">
        <h3>Nora Manandi</h3>
        <p class="teamTitle">Marketing Support</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/DamienCleary.png" alt="Damien Cleary">
      <div class="teamContainer">
        <h3>Damien Cleary</h3>
        <p class="teamTitle">Analytics Support</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/JamesTomlinson.png" alt="James Tomlinson">
      <div class="teamContainer">
        <h3>James Tomlinson</h3>
        <p class="teamTitle">Analytics Support</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/MattLeahy.png" alt="Matt Leahy">
      <div class="teamContainer">
        <h3>Matt Leahy</h3>
        <p class="teamTitle">Business Support</p>
      </div>
    </div>
  </div>
    <div class="columnTeam">
    <div class="teamCard">
      <img src="img/castTeam/DanielHarz.png" alt="Daniel Harz">
      <div class="teamContainer">
        <h3>Daniel Harz</h3>
        <p class="teamTitle">Analytics Intern</p>
      </div>
    </div>
  </div>
</div>
</div>

<!-- new help page -->
<div class="col-14 divAddUser allform tabcontent" id="helpPage">
    <h4>How to reset password?</h4>
<div class="rowTeam">
  <div class="columnHelp">
    <div class="helpCard">
      <img src="img/changePassword1.png" alt="First step">
      <div class="teamContainer">
        <h3>Change Password</h3>
        <p class="teamTitle">Step 1</p>
        <p>Click setting and it will show Rest Password link.</p>
        <p>Please input your old Password and the new password your want to change.</p>
      </div>
    </div>
  </div>

  <div class="columnHelp">
    <div class="helpCard">
      <img src="img/changePassword2.png" alt="Second step">
      <div class="teamContainer">
        <h3>Change Password</h3>
        <p class="teamTitle">Step 2</p>
        <p>Click submit button to change password.</p>
      </div>
    </div>
  </div>
</div>
</div>
<?php
include 'connect.php';
$username = $_COOKIE['username'];
$sql = "SELECT * FROM user_iframe WHERE username='$username'";
$result = $conn->query($sql);
if($row = $result-> fetch_assoc()){
  $iframe1 = $row['iframe1'];
  $iframe2 = $row['iframe2'];
  $iframe3 = $row['iframe3'];
  $iframe4 = $row['iframe4'];
}
  ?>


 <div class ="topnav" style="padding-left:13.66%">
<iframe style="border:none;height:500px;width:40%;padding-top:50px" src='https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=DTpyBG&opt=nointeraction&select=clearall' ></iframe>


</div>


<!-- <div class="col-12 right">
  <div class="aside">
    <h2>Space 1</h2>
    <p>These space for something use future</p>
    <h2>Space 2</h2>
    <p>These space for something use future</p>
    <h2>Space 3</h2>
    <p>These space for something use future</p>
  </div>
</div> -->

</div>

</body>
</html>
