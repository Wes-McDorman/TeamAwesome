var pickUpBox = document.getElementById("canPickUp");

var e = 0;
var shadeSwitch = "Dark";








function addRange(e) { 
    if(e == 0){
        e = 1;
    }else{


        
        var puRangeIterator = document.getElementById("pickUpRangeIterator");
        e = puRangeIterator.value;

        if(shadeSwitch === "Dark"){
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
        'name="availPUStart'+ e +'" required>'  +
    '</div>' +
    '<div class="col-sm-5 noPad"></div>' +
'</div>' +
    
'<div class="form-group">' +
  '<label class="col-sm-3 control-label noPad" for="availPUEnd">End Date/Time:</label>' +
    '<div class="col-sm-4 noPad">' +
        '<input class="form-control" type="datetime-local"' +
        'name="availPUEnd'+ e +'" required>' +
    '</div>' +
    '<div class="col-sm-5 noPad" id="delButArea' + e + '"><button type="button" class="btn btn-default btn-xs alignRight removeBut" id="deleteRangeBut' + e + '" onclick="deleteRange(' + e + ')">Remove this Range</button></div>'+
'</div>' +
'</section>';
            

    if(e != 1){
        var lastDeleteBut = document.getElementById("deleteRangeBut" + (e - 1) );
        lastDeleteBut.parentNode.removeChild(lastDeleteBut);
    }else{};
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
    if(puRangeIterator.value > 1){
        var lastId = puRangeIterator.value - 1;
        var previousRemoveButArea = document.getElementById("delButArea" + lastId);
        var replaceRemoveBut = '<button type="button" class="btn btn-default btn-xs alignRight removeBut" id="deleteRangeBut' + lastId + '" onclick="deleteRange(' + lastId + ')">Remove this Range</button>';
        previousRemoveButArea.innerHTML = replaceRemoveBut;
    }else{
        
    }
}

function editOldRange(x){
    document.getElementById('oldAvailPUStart' + x).disabled = false;
    document.getElementById('oldAvailPUEnd' + x).disabled = false;
    
    var rangeEditList = document.getElementById("rangeEditList");
    var thisAvailId = document.getElementById("thisAvailId" + x).value;
    
    rangeEditList.value = rangeEditList.value + thisAvailId + "-" + x + " " ;
}

function deleteOldRange(x){
    var deleteButId = "oldDelButArea" + x;
    var deleteButArea = document.getElementById(deleteButId);
    var rangeDelList = document.getElementById("rangeDelList");
    var thisAvailId = document.getElementById("thisAvailId" + x).value;
    
    document.getElementById('oldAvailPUStart' + x).disabled = true;
    document.getElementById('oldAvailPUEnd' + x).disabled = true;
    deleteButArea.innerHTML = "<center><div class='removeBut'> This availability will be deleted<br> when the form is submitted. </div></center>";
    rangeDelList.value = rangeDelList.value + " " +thisAvailId;
}


window.onload = function() {

$('#newRangeBut').click(addRange(e));

$('#canHome').click(function(){
        var hsDateArea = document.getElementById("homeShareDateArea");      

        if($(this).is(':checked')){
            var hsDateInput = '<div class="up" ><div class="col-sm-12 homeTitle">HomeShare Availability</div>' +
'<div class="form-group">'+
  '<label class="col-sm-2 control-label noPad" for="availPUStart">Start:</label>' +
    '<div class="col-sm-8 noPad">' +
        '<input class="form-control" type="datetime-local"' +
        ' id="beginHomeShare" name="beginHomeShare" required>'  +
    '</div>' +
    '<div class="col-sm-2 noPad"></div>' +
'</div>' +
    
'<div class="form-group">' +
  '<label class="col-sm-2 control-label noPad" for="availPUEnd">End:</label>' +
    '<div class="col-sm-8 noPad">' +
        '<input class="form-control" type="datetime-local"' +
        ' id="endHomeShare" name="endHomeShare" required>' +
    '</div>' +
    '<div class="col-sm-2 noPad"></div>'+
'</div></div>';
            hsDateArea.innerHTML = hsDateInput;
        }else{
            hsDateArea.innerHTML = "";
        }
});
    
$('#canPickUp').click(function(){ 
        var carInfoArea = document.getElementById("carInfoArea");
        var addRangeButArea = document.getElementById("addRangeButArea");
    
    if($(this).is(':checked')){
        
        var carInfo = '<div class="form-group ">' +
  '<label class="col-xs-12 col-sm-5 control-label noPad " ' +
  'for="passengers"># passengers your vehicle handles:</label> ' +
    '<div class="col-xs-12 col-sm-2 noPad">' +
        '<input class="form-control" type="number" name="passengers"' +
        'id="passengers" placeholder="#" required /> ' +
    '</div> ' +
    '<div class="col-sm-5 noPad"></div> ' +
'</div> '+

'<div class="form-group">' +
  '<label class="col-xs-12 col-sm-5 control-label noPad" ' +
  'for="suitcases"># suitcases your vehicle handles:</label>' +
    '<div class="col-xs-12 col-sm-2 noPad"> ' +
        '<input class="form-control" type="number" name="suitcases"' +
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
        'name="availPUStart'+ e +'" required>'  +
    '</div>' +
    '<div class="col-sm-5 noPad"></div>' +
'</div>' +
    
'<div class="form-group">' +
  '<label class="col-sm-3 control-label noPad" for="availPUEnd">End Date/Time:</label>' +
    '<div class="col-sm-4 noPad">' +
        '<input class="form-control" type="datetime-local"' +
        'name="availPUEnd'+ e +'" required>' +
    '</div>' +
    '<div class="col-sm-5 noPad"></div>'+
'</div>' +
'</section>';
  
        carInfoArea.innerHTML = carInfo;
        addRangeButArea.innerHTML = addRangeBut;
        var puRangeIterator = document.getElementById("pickUpRangeIterator");
        puRangeIterator.value = parseInt(puRangeIterator.value) + 1;
        
    } else {
       if (window.confirm("Warning: Proceeding will delete all Pick-Up data.")) { 
        carInfoArea.innerHTML = "";
        addRangeButArea.innerHTML = "";
       }else{
           $(this).prop('checked', true);
       };
        
        
    }
});

 
    
};