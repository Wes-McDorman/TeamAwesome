window.onload = function() {



$('#needHome').click(function(){
        var hsDateArea = document.getElementById("homeShareDateArea");      

        if($(this).is(':checked')){
            var hsDateInput ='<div class="up"><div class="col-sm-12 homeTitle">HomeShare Availability</div>' +
        '<div class="form-group">' +
            '<label class="col-sm-2 control-label noPad" for="beginHomeShare">Start:</label>' +
            '<div class="col-sm-8 noPad">' +
            '<input class="form-control" type="datetime-local" name="beginHomeShare" id="beginHomeShare" required></div>' +
            '<div class="col-sm-2 noPad"></div></div>' +
        '<div class="form-group"><label class="col-sm-2 control-label noPad" for="endHomeShare" >End:</label>' +
            '<div class="col-sm-8 noPad">' +
                '<input class="form-control" type="datetime-local" name="endHomeShare" id="endHomeShare" required>' +
            '</div>' +
            '<div class="col-sm-2 noPad">' +
            '</div></div></div>';
            
            hsDateArea.innerHTML = hsDateInput;
        }else{
            hsDateArea.innerHTML = "";
        }
});
    
};