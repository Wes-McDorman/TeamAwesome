var pickUpBox = document.getElementById("canPickUp");

var e = 0;
var shadeSwitch = "Dark";

function addRange(e) { 
    if(e == 0){
        e = 1;
    }else{
        e = e + 1;
        if(e % 2 == 0){
            shadeSwitch = "Light";
        }else{
            shadeSwitch = "Dark";
        };
    var button = document.getElementById("addBut");
    var addRangeButArea = document.getElementById("addRangeButArea");
    var newRangeBut = '<button type="button" class="btn btn-default btn-xs" id="newRangeBut" onclick="addRange(' + e + ')">Add New Range</button>';

    var rangeHtml = '<section class="item dateRange' + shadeSwitch + '" id="dateRange' + e + '">' +
'<div class="form-group">'+
  '<label class="col-sm-3 control-label noPad" for="availPUStart">Start Date/Time:</label>' +
    '<div class="col-sm-4 noPad">' +
        '<input class="form-control" type="datetime-local"' +
        'id="availPUStart'+ e +'" required>'  +
    '</div>' +
    '<div class="col-sm-5 noPad"></div>' +
'</div>' +
    
'<div class="form-group">' +
  '<label class="col-sm-3 control-label noPad" for="availPUEnd">End Date/Time:</label>' +
    '<div class="col-sm-4 noPad">' +
        '<input class="form-control" type="datetime-local"' +
        'id="availPUEnd'+ e +'" required>' +
    '</div>' +
    '<div class="col-sm-5 noPad"><button type="button" class="btn btn-default btn-xs alignRight removeBut" id="deleteRangeBut' + e + '" onclick="deleteRange(' + e + ')">Remove this Range</button></div>'+
'</div>' +
'</section>';
        
    var puRangeIterator = document.getElementById("pickUpRangeIterator");
        if(puRangeIterator.value  !== null){
            puRangeIterator.value = parseInt(puRangeIterator.value) + 1;
        }else{};
    button.innerHTML = newRangeBut;
    addRangeButArea.innerHTML += rangeHtml;  
        
    }
};

function deleteRange(x){
    var dateID = "dateRange" + x;
    var dateSection = document.getElementById(dateID);
    var puRangeIterator = document.getElementById("pickUpRangeIterator");
        if(puRangeIterator.value  !== null){
            puRangeIterator.value = parseInt(puRangeIterator.value) - 1;
        }else{};
    dateSection.parentNode.removeChild(dateSection);
}



window.onload = function() {

$('#newRangeBut').click(addRange(e));
    
$('#canPickUp').click(function(){ 
        var carInfoArea = document.getElementById("carInfoArea");
        var addRangeButArea = document.getElementById("addRangeButArea");
    
    if($(this).is(':checked')){
        
        var carInfo = '<div class="form-group">' +
  '<label class="col-xs-12 col-sm-5 control-label noPad" ' +
  'for="passengers"># passengers your vehicle handles:</label> ' +
    '<div class="col-xs-12 col-sm-2 noPad">' +
        '<input class="form-control" type="number" ' +
        'id="passengers" placeholder="#" required /> ' +
    '</div> ' +
    '<div class="col-sm-5 noPad"></div> ' +
'</div> '+

'<div class="form-group">' +
  '<label class="col-xs-12 col-sm-5 control-label noPad" ' +
  'for="suitcases"># suitcases your vehicle handles:</label>' +
    '<div class="col-xs-12 col-sm-2 noPad"> ' +
        '<input class="form-control" type="number"' +
        'id="suitcases" placeholder="#" required />' + 
    '</div>' +
    '<div class="col-xs-0 col-sm-5 noPad"></div>' +
'</div>';
        
        var addRangeBut = '<label> <span>Create Ranges of Pick-Up Availablity</span></label>' +
    '<button type="button" class="btn btn-default btn-xs alignRight bigBut" id="firstNewRangeBut" onclick="addRange(1)">Add New Range</button>' +
            '<section class="item dateRangeDark">' +
'<div class="form-group">'+
  '<label class="col-sm-3 control-label noPad" for="availPUStart">Start Date/Time:</label>' +
    '<div class="col-sm-4 noPad">' +
        '<input class="form-control" type="datetime-local"' +
        'id="availPUStart'+ e +'" required>'  +
    '</div>' +
    '<div class="col-sm-5 noPad"></div>' +
'</div>' +
    
'<div class="form-group">' +
  '<label class="col-sm-3 control-label noPad" for="availPUEnd">End Date/Time:</label>' +
    '<div class="col-sm-4 noPad">' +
        '<input class="form-control" type="datetime-local"' +
        'id="availPUEnd'+ e +'" required>' +
    '</div>' +
    '<div class="col-sm-5 noPad"></div>'+
'</div>' +
'</section>';
  
        carInfoArea.innerHTML = carInfo;
        addRangeButArea.innerHTML = addRangeBut;
        
        
    } else {
       
        carInfoArea.innerHTML = "";
        addRangeButArea.innerHTML = "";
        
        
    }
});

 
    
};