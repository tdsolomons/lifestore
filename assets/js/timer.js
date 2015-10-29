var year = 2015;			// in what year will your target be reached?
var month = 11;				// value between 0 and 11 (0=january,1=february,...,11=december)
var day = 22;				// between 1 and 31
var hour = 0;				// between 0 and 24
var minute = 0;			// between 0 and 60
var second = 0;			// between 0 and 60
var eventtext = "until the next big thing"; // text that appears next to the time left
var endtext = "We reached the next big thing!!"; // text that appears when the target has been reached
var end = new Date(year,month,day,hour,minute,second);
function timeleft(){
	var now = new Date();
	if(now.getYear() < 1900)
		yr = now.getYear() + 1900;
	var sec = second - now.getSeconds();
	var min = minute - now.getMinutes();
	var hr = hour - now.getHours();
	var dy = day - now.getDate();
	var mnth = month - now.getMonth();
	var yr = year - yr;
	var daysinmnth = 32 - new Date(now.getYear(),now.getMonth(), 32).getDate();
	if(sec < 0){
		sec = (sec+60)%60;
		min--;
	}
	if(min < 0){
		min = (min+60)%60;
		hr--;	
	}
	if(hr < 0){
		hr = (hr+24)%24;
		dy--;	
	}
	if(dy < 0){
		dy = (dy+daysinmnth)%daysinmnth;
		mnth--;	
	}
	if(mnth < 0){
		mnth = (mnth+12)%12;
		yr--;
	}	
	var sectext = " s ";
	var mintext = " m, and ";
	var hrtext = " h, ";
	var dytext = " days, ";
	var mnthtext = " months, ";
	var yrtext = " years, ";
	if (yr == 1)
		yrtext = " year, ";
	if (mnth == 1)
		mnthtext = " month, ";
	if (dy == 1)
		dytext = " day, ";
	if (hr == 1)
		hrtext = " h, ";
	if (min == 1)
		mintext = " m, and ";
	if (sec == 1)
		sectext = " s ";
	if(now >= end){
		document.getElementById("timeleft").innerHTML = endtext;
		clearTimeout(timerID);
	}
	else{
	document.getElementById("timeleft").innerHTML =  mnth + mnthtext + dy + dytext + hr + hrtext + min + mintext + sec + sectext ;
	}
	timerID = setTimeout("timeleft()", 1000); 
}
window.onload = timeleft;