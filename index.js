/*
 * Variables
 */
var eatOut = ["Block 15", "McMenamins", "Spaghetti Factory", "Pastini"];
var takeOut = ["Subway", "Thai", "Chipolte", "Panda", "Dominos", "Local Boyz"];
var homeCooking = ["Spaghetti", "Sandwich", "Pesto Pasta", "Dutch Puff", "French Toast", "Quesadilla"];

var locs = document.getElementsByClassName('location');
for(var i = 0; i < locs.length; i++){
   locs[i].addEventListener('click', displayOption);
}

/*
 * Displays option
 */
function displayOption(event){
   var optionDiv = document.getElementById('option');
   var output = getOption(event);
   document.getElementById("output").innerHTML = output;
   optionDiv.classList.remove("hidden");
}

/*
 * Finds the option and returns random output
 */
function getOption(event){
   if(event.target.id == "c")
      return homeCooking[randomNum(homeCooking)];
   if(event.target.id == "t")
      return takeOut[randomNum(takeOut)];
   if(event.target.id == "e")
      return eatOut[randomNum(eatOut)];
}

/*
 * Generates and returns random number of array length
 */
function randomNum(array){
   return Math.floor(Math.random() * array.length);
}

