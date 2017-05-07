$(document).ready(function(){

	$('#userRadio').hide();
	$('#UserRadio1').hide();
	$('#UserRadio2').hide();
  $('input[type="radio"]').click(function(){
 if($(this).attr('value') == 'admin') {
   $('#userRadio').hide();
	 $('#userRadio2').show();

 }
 if($(this).attr('value') == 'user'){
	 $('#userRadio2').hide();
$('#userRadio').show();
 }

 if($(this).attr('value') == 'admin1'){
	 $('#UserRadio1').hide();
	 $('#UserRadio2').hide();
	 showTableforU("admin");
 }
 if($(this).attr('value') == 'user1'){
	 $('#modifyUserTable').empty();
	 $('#UserRadio1').show();
	 $('#UserRadio2').show();
 }
    });
});

window.onload=checkCookie();

function topnav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "col-12 topnav") {
        x.className += " responsive";
    } else {
        x.className = "col-12 topnav";
    }
}

var selectName;
function openCity(evt, cityName) {
		selectName = cityName;
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
    if(cityName == "modifyUser"){
      getcompany();
    }
		if(cityName == "modifyCompany"){
			showTableforC();
		}
    if(cityName == "qlikPage"){
      getcompany();
      document.getElementById("iframe").src = "https://analytics.castsolutions.com.au";
      var i = document.getElementsByClassName('iframe');
      for(var b=0;b<i.length;b++){
        i[b].value = "";
      }
    }
}

var company = new Array();
function selectOp(array){
    if(selectName === "modifyUser"){
      var s = document.getElementById("companyselect");
    }
    else if(selectName === "qlikPage"){
      var s = document.getElementById("Company");
    }
		s.options.length=0;
    for(var a=0; a<array.length;a++){
        var op = document.createElement("option");
				if(a==0){
					op.setAttribute("value",0);
			    op.appendChild(document.createTextNode("Please Select a company..."));
			    s.appendChild(op);
				}else{
					op.setAttribute("value",array[a-1]);
	        op.appendChild(document.createTextNode(array[a-1]));
	        s.appendChild(op);
				}
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
    var name=getCookie("full_name");
  if(status!="" && status =="yes"){
    	if (user!=""){
    		document.getElementById('admin').innerHTML = name.replace(/\+/g, ' ').toUpperCase();
    	}
    	else {
        alert('no exist Cookie!');
      }
    }else{
      window.location = "./login.html";
    }
}
var xmlHttp;

function getcompany(){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url="php/adminpage.php";
 var params = "";
 params += "getCompany=1";
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforC;
 xmlHttp.send(params);
}
function stateChangedforC(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
    company = xmlHttp.responseText.split(",");
    selectOp(company);
 }
}

function showTableforU(companyN){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url="php/adminpage.php";
 var params = "";
 params += "displayU=1&companyN="+companyN;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforshowU;
 xmlHttp.send(params);
}

function stateChangedforshowU(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  document.getElementById('modifyUserTable').innerHTML=xmlHttp.responseText;
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

var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
var myreg1 = /^(\+61)[0-9]{1}[0-9]{4}[0-9]{4}$/;

function InfobyRow(r){
  var arr = new Array();
	var user=document.getElementById('user1');
	if(user.checked){
		for(var m=0 ; m<8;m++){
	   arr[m] = document.getElementById('editableForU').rows[r].cells[m].innerText;
	  }
	}else{
		for(var m=0 ; m<6;m++){
	   arr[m] = document.getElementById('editableForA').rows[r].cells[m].innerText;
	  }
	}
 return arr ;
}

function delRow(r){
  row = getRow(r);
  var user=document.getElementById('user1');
  var arr = new Array();
  arr = InfobyRow(row);
  if(confirm("Are you sure to delete this user?")){
  if(user.checked){
  	document.getElementById('editableForU').deleteRow(row);
  }else{
  	document.getElementById('editableForA').deleteRow(row);
  }
    deleteUser(arr[0]);
  }
}

function updateRow(r){
  row = getRow(r);
  var array = new Array();
  array = InfobyRow(row);
  editUser(array);
}

function deleteUser(username){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url='php/adminpage.php';
 var params = "";
 params += "deleteU=1&username="+username;
 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforDel;
 xmlHttp.send(params);
}

function stateChangedforDel(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  alert(xmlHttp.responseText);
 }
}

function editUser(array){
  xmlHttp = GetXmlHttpObject();
	var user=document.getElementById('user1');
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url='php/adminpage.php';
 var params = "";
 var phone = array[4];
 phone = phone.replace(/\+/g, "%2B");
 if(user.checked){
	 params += "editU=1&username="+array[0]+"&firstname="+array[1]
	 +"&lastname="+array[2]+"&email="+array[3]
	 +"&phone="+phone+"&company="+array[5]
	 +"&password="+array[6]+"&account_status="+array[7]+"&admin_status=N";

 }else{
	 params += "editU=1&username="+array[0]+"&firstname="+array[1]
	 +"&lastname="+array[2]+"&email="+array[3]
	 +"&phone="+phone+"&admin_status=Y"+"&password="+array[5];

 }
 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforEditU;
 xmlHttp.send(params);
}

function stateChangedforEditU(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  alert(xmlHttp.responseText);
 }
}

function companyInfobyRow(r){
  var arr = new Array();
 for(var m=0 ; m<4;m++){
  arr[m] = document.getElementById('tableForC').rows[row].cells[m].innerText;
 }
 return arr ;
}

function delCompany(r){
  row = getRow(r);
  var array = new Array();
  array = companyInfobyRow(row);
  if(confirm("Are you sure to delete this company?")){
    document.getElementById('tableForC').deleteRow(row);
    deleteCompany(array[0]);
  }
}

function updateCompany(r){
  row = getRow(r);
  var array1 = new Array();
  array1 = companyInfobyRow(row);
  editCompany(array1);
}


function deleteCompany(companyN){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url='php/adminpage.php';
 var params = "";
 params += "deleteC=1&companyName="+companyN;
 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforDelC;
 xmlHttp.send(params);
}

function stateChangedforDelC(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  alert(xmlHttp.responseText);
 }
}

function editCompany(array){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url='php/adminpage.php';
 var params = "";
 var phone = array[2];
 phone = phone.replace(/\+/g, "%2B");
 params += "editC=1&companyName="+array[0]+"&companyAddress="+array[1]
 +"&companyPhone="+phone+"&companySite="+array[3];
 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforEditC;
 xmlHttp.send(params);
}

function stateChangedforEditC(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  alert(xmlHttp.responseText);
 }
}

function showTableforC(){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url="php/adminpage.php";
 var params = "";
 params += "displayC=1";
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforshowC;
 xmlHttp.send(params);
}
function stateChangedforshowC(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  document.getElementById('modifyCompany').innerHTML=xmlHttp.responseText;
 }
}

function changesrc(value){
  if(value == "Dev-hub"){
    document.getElementById("iframe").src = "https://analytics.castsolutions.com.au/dev-hub/single-configurator";
  }
  else if(value == "Myhub"){
    document.getElementById("iframe").src = "https://analytics.castsolutions.com.au";
  }

}

function showQlikUser(CompanyN){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url="php/adminpage.php";
 var params = "";
 params += "qlikU=1&companyForQlik="+CompanyN;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforshowQlikU;
 xmlHttp.send(params);
}

function stateChangedforshowQlikU(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  qlikUser = xmlHttp.responseText.split(",");
  selectQlikU(qlikUser);
 }
}

var qlikUser = new Array();
function selectQlikU(array){
    var s1 = document.getElementById("qlikUser");
		s1.options.length=0;
    for(var a=0; a<array.length;a++){
        var op = document.createElement("option");
				if(a==0){
					op.setAttribute("value",0);
			    op.appendChild(document.createTextNode("Please Select a UserName..."));
			    s1.appendChild(op);
				}else{
					op.setAttribute("value",array[a-1]);
	        op.appendChild(document.createTextNode(array[a-1]));
	        s1.appendChild(op);
				}
  }
}

function showQlikUserIframes(username){
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 if(username !="" && username !=0){
   var url='php/main.php';
   var params = "";
   params += "qlik=1&username="+username;
   // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
   xmlHttp.open("POST",url,true);
   xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xmlHttp.onreadystatechange=stateChangedforQlikIframes;
   xmlHttp.send(params);
 }
}

function stateChangedforQlikIframes(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
  var str=xmlHttp.responseText;
  var obj1 = eval('(' + str + ')');
  var array = new Array(obj1.iframe1,obj1.iframe2,obj1.iframe3,obj1.iframe4,obj1.iframe5,obj1.iframe6,obj1.iframe7,obj1.iframe8,obj1.iframe9,obj1.iframe10);
  document.getElementById('userInfo').innerHTML="JobTitle:"+obj1.jobtitle;
  document.getElementById('iframe1').value = array[0];
  document.getElementById('iframe2').value = array[1];
  document.getElementById('iframe3').value = array[2];
  document.getElementById('iframe4').value = array[3];
  document.getElementById('iframe5').value = array[4];
  document.getElementById('iframe6').value = array[5];
  document.getElementById('iframe7').value = array[6];
  document.getElementById('iframe8').value = array[7];
  document.getElementById('iframe9').value = array[8];
  document.getElementById('iframe10').value = array[9];
 }
}

function addIframes(){
  var username = document.getElementById('qlikUser').value;
  xmlHttp = GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return 0;
 }
 var url='php/adminpage.php';
 var params = "";
 params += "iframes=1&username="+username+"&iframe1="+document.getElementById('iframe1').value.replace(/\&/g,"*")
 +"&iframe2="+document.getElementById('iframe2').value.replace(/\&/g,"*")+"&iframe3="+document.getElementById('iframe3').value.replace(/\&/g,"*")
 +"&iframe4="+document.getElementById('iframe4').value.replace(/\&/g,"*")+"&iframe5="+document.getElementById('iframe5').value.replace(/\&/g,"*")
 +"&iframe6="+document.getElementById('iframe6').value.replace(/\&/g,"*")+"&iframe7="+document.getElementById('iframe7').value.replace(/\&/g,"*")
 +"&iframe8="+document.getElementById('iframe8').value.replace(/\&/g,"*")+"&iframe9="+document.getElementById('iframe9').value.replace(/\&/g,"*")
 +"&iframe10="+document.getElementById('iframe10').value.replace(/\&/g,"*");
 // var params = "username="+document.getElementById('reset-username').value+"&email="+document.getElementById('email-name').value;
 xmlHttp.open("POST",url,true);
 xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xmlHttp.onreadystatechange=stateChangedforEditIframes;
 xmlHttp.send(params);
}

function stateChangedforEditIframes(){
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
    alert(xmlHttp.responseText);
 }
}

function previewIframes(type){
  var modal = document.getElementById('myModal');
  if(type=="preview_iframes"){
    modal.style.display="block";
    var iframe = document.getElementsByClassName('iframe');
    var arr =new Array();
    for(var b=0;b<iframe.length;b++){
      arr[b]=iframe[b].value;
    }
    var mess="<h4>Qlik Sense</h4><div class='rowTeam'>";
    mess += "<div class='col-12 columnQlik'><div class='helpCard'><iframe style='border:none;height:140px;width:100%;' src='https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=DTpyBG&opt=nointeraction&select=clearall' ></iframe></div></div>";
    for(var a=0;a<arr.length;a++){
      if(arr[a] != ""){
        mess += "<div class='col-6 columnQlik'><div class='helpCard'><iframe style='border:none;height:500px;width:100%;' src='"+arr[a]+"' ></iframe></div></div>";
      }
    }
    mess +="</div><div style='text-align:right;'><input type='submit' name='close' value='Back' onclick='previewIframes(this.name)'></div>";
    document.getElementById('previewContent').innerHTML = mess;
  }else if(type == "close"){
    modal.style.display="none";
  }
}
