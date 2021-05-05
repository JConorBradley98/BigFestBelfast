

function datevalidator() {

var currentdate = new Date();

var days = currentdate.getDate();

var months = currentdate.getMonth()+1;

var years = currentdate.getFullYear();

if(days<10){
    days = '0'+days;
}

if(months <10){
    months = '0'+months;
}

currentdate = years+'-'+months+'-'+days;

document.getElementById("dob").setAttribute("max",currentdate); }

window.onload = datevalidator;