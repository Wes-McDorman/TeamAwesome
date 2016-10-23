var range = document.getElementById("newRangeBut");
range.onclick = addRange();

function addRange(e) { 
    var button = document.getElementById("newRangeBut");
    
    e = e + 1;

    var newRange = '<button type="button" class="btn btn-default btn-xs alignRight" id="newRangeBut" onclick="addRange(' + e + ')">Add New Range</button>';
    button.outerHTML = newRange;
    alert(newRange);
    var range = document.getElementById("rangeItem");
    var rangeHtml = '<section class="item">' +
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
    
 
    
    range.innerHTML += rangeHtml;
    
}