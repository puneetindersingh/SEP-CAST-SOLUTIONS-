var myTime;
function setTime(){
  myTime = setTimeout('Timeout()', 10000);
}
function resetTime() {
    clearTimeout(myTime);
    myTime = setTimeout('Timeout()', 10000);
}
function Timeout() {
    clearTimeout(myTime);
    alert("Your session is time out, please login again!");
    window.location = "./login.html";
    document.cookie = "loginstatus=no; "+expires;
}
