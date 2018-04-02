/*
 * Variables
 */
var eatList = document.getElementsByClassName('navE');
for (var i = 0; i < eatList.length; i++) {
  eatList[i].addEventListener('click', displayEatList);
}

var takeList = document.getElementsByClassName('navT');
for (var i = 0; i < takeList.length; i++) {
  takeList[i].addEventListener('click', displayTakeList);
}

var cookList = document.getElementsByClassName('navC');
for (var i = 0; i < cookList.length; i++) {
  cookList[i].addEventListener('click', displayCookList);
}

var modal = document.getElementById('myModal');
var btn = document.getElementById('add');
var span = document.getElementsByClassName("close")[0];

/*
 * Modal
 */
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

/*
 * Displays option
 */
function displayOption(param) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.open("GET", "displayOption.php?q="+param, true);
  xmlhttp.send();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("showOpt").innerHTML = this.responseText;
    }
  };
  var optionDiv = document.getElementById('option');
  optionDiv.classList.remove("hidden");
}

/*
 * Display nav lists
 */
function displayEatList(event) {
  var eList = document.getElementById('el');
  eList.classList.toggle("hidden");
}

function displayTakeList(event) {
  var tList = document.getElementById('tl');
  tList.classList.toggle("hidden");
}

function displayCookList(event) {
  var cList = document.getElementById('cl');
  cList.classList.toggle("hidden");
}
