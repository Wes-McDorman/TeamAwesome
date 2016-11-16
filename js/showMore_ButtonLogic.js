

var showButton = document.getElementById('showMoreButton');
var volList = document.getElementById('volList');

var userID = 10001;

showButton.onclick = function clickIt() {
  for(i = 0; i < 10; i++) {
    var entry = document.createElement('li');
    entry.appendChild(document.createTextNode(userID));
    volList.appendChild(entry);
  }
}
