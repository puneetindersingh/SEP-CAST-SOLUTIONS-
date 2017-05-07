window.onload=checkCookie();
function topnav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "col-12 topnav") {
        x.className += " responsive";
    } else {
        x.className = "col-12 topnav";
    }
}
var selectName="";

function openCity(evt, cityName) {
    selectName=cityName;
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
    if(cityName == "qlikPage"){
      showQlik();
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

function logOut(){
  window.location = "./login.html";
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
 var url='php/userpage.php';
 var params = "";
 params += "profile=1&username="+getCookie('username');
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
 var url='php/userpage.php';
 var params = "";
 var phone = document.getElementById('phoneNo').value;
 phone = phone.replace(/\+/g, "%2B");
 params += "updateprofile=1&username="+getCookie('username')+"&firstname="+document.getElementById('firstN').value
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

function showQlik(){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url='php/main.php';
 var params = "";
 params += "qlik=1&username="+getCookie('username');
 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforQlik;
 xmlHttp.send(params);
}

function stateChangedforQlik(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  var str=xmlHttp.responseText;
  var obj = eval('(' + str + ')');
  var arr = new Array(obj.iframe1,obj.iframe2,obj.iframe3,obj.iframe4,obj.iframe5,obj.iframe6);
  var mess="<h4>Qlik Sense</h4><div class='rowTeam'>";
  mess += "<div class='col-12 columnQlik'><div class='helpCard'><iframe style='border:none;height:140px;width:100%;' src='https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=DTpyBG&opt=nointeraction&select=clearall' ></iframe></div></div>";
  for(var a=0;a<arr.length;a++){
    if(arr[a] != ""){
      mess += "<div class='col-6 columnQlik'><div class='helpCard'><iframe style='border:none;height:500px;width:100%;' src='"+arr[a]+"' ></iframe></div></div>";
    }
  }
  mess +="</div>";
  document.getElementById('qlikPage').innerHTML = mess;
 }
}
// <div class='col-6 columnQlik'><div class='helpCard'><iframe style='border:none;height:500px;width:100%;' src='"+arr[0]+"' ></iframe></div></div>
