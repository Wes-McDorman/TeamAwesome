

var showVolButton = document.getElementById('showVolButton');
var volList = document.getElementById('volList');

var showStuButton = document.getElementById('showStuButton');
var StuList = document.getElementById('StuList');

var userID = 10001;


//Volunteer show more button logic
if (showVolButton != null) {
showVolButton.onclick = function clickVol() {
  while (volList.hasChildNodes()) {
    volList.removeChild(volList.firstChild);
  }
  for(i = 0; i < 10; i++) {
    var entry = document.createElement('li');
    entry.appendChild(document.createTextNode(userID));
    volList.appendChild(entry);
  }
  userID++; //for testing delete after
}



}


//Student show more button logic
if (showStuButton != null) {
showStuButton.onclick = function clickStu() {
  while (stuList.hasChildNodes()) {
    stuList.removeChild(stuList.firstChild);
  }
  for(i = 0; i < 10; i++) {
    var entry = document.createElement('li');
    entry.appendChild(document.createTextNode(userID));
    stuList.appendChild(entry);
  }
  userID++; //for testing delete after
}


}
