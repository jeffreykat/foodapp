/*
 * Variables
 */

var eatList = document.getElementById('navE');
eatList.addEventListener('click', displayEatList);

var takeList = document.getElementById('navT');
takeList.addEventListener('click', displayTakeList);

var cookList = document.getElementById('navC');
cookList.addEventListener('click', displayCookList);

var modal = document.getElementById('myModal');
var btn = document.getElementById('add');
var span = document.getElementsByClassName("close")[0];
var optionDiv = document.getElementById('option');
var cOp = document.getElementById("closeOp");

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
  optionDiv.classList.remove("hidden");
}

window.onclick = function() {
  optionDiv.classList.add("hidden");
  optionDiv.style.display = "none";
}

cOp.onclick = function(event) {
  optionDiv.classList.add("hidden");
}

/*
 * Display nav lists
 */
function displayEatList(event) {
  var eList = document.getElementById('el');
  eList.classList.toggle("hidden");
}

window.onclick = function(event) {
  var eList = document.getElementById('el');
  if (event.target == eatList) {
    eList.classList.add("hidden");
  }
}

function displayTakeList(event) {
  var tList = document.getElementById('tl');
  tList.classList.toggle("hidden");
}

function displayCookList(event) {
  var cList = document.getElementById('cl');
  cList.classList.toggle("hidden");
}