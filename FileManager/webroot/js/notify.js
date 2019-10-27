function fetchdata(){
    $.ajax({
        url: '/notification',
        type: 'get',

        success: function(data){
            //JSON.parse(data);
            //alert(typeof data);
            $('.dropdown-menu').html(data);
        }
    });
}

$(document).ready(function(){
    setInterval(fetchdata,500);

});
