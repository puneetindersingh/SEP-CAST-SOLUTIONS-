function myFunction1() {
    var c = document.querySelectorAll(".login");
    if(c[0].style.display = "block"){
        c[0].style.display = "none";
    }
    var c2 = document.querySelectorAll(".reset");
    if(c2[0].style.display = "none"){
        c2[0].style.display = "block";
    }
}
var d = new Date();
var exdays = 30;
d.setTime(d.getTime()+(exdays*24*60*60*1000));
var expires = "expires="+d.toGMTString();
function setCookie(cname,cvalue,exdays){

	document.cookie = cname+"="+cvalue+"; "+expires;
}

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
	if (user!=""){
		document.getElementById('login-name').value = user;
	}
	else {

		user = document.getElementById('login-name').value;
  		if (user!="" && user!=null){
    		setCookie("username",user,30);
    	}
	}
}

function setUsername(){
  setCookie("username",document.getElementById('login-name').value,30);
}

var hide = document.getElementById('login-pass');
hide.addEventListener("click",function(){
  document.getElementById('test').innerHTML = "";
});

var xmlHttp;
function showHint(){
  setUsername();
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url='php/login.php';
 var params = "";
 params += "login=1&username="+document.getElementById('login-name').value;
 params += "&password="+document.getElementById('login-pass').value
 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChanged;
 xmlHttp.send(params);
}

function stateChanged(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  if(xmlHttp.responseText=="no"){
    document.cookie = "loginstatus=no; "+expires;
    document.getElementById('test').innerHTML="<i class='material-icons md-18 red'>warning</i>Username or Password is Wrong,Please try again!";
    document.getElementById('login-pass').value="";
  }else if(xmlHttp.responseText=="admin"){
    document.cookie = "loginstatus=yes; "+expires;
    window.location = "./adminpage.html";
  }else if (xmlHttp.responseText=="user") {
    document.cookie = "loginstatus=yes; "+expires;
    window.location = "./userpage.html";
  }else if (xmlHttp.responseText=="not active") {
    document.getElementById('test').innerHTML="<i class='material-icons md-18 blue'>warning</i>Your account is currently suspended please contact support !";
      document.getElementById('login-pass').value="";
  }
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

function popUps() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
