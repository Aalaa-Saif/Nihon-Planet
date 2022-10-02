$(document).ready(function() {

    $('.closedash').click(function(){
        $('#sidebar-id').css("width","0");
        $('#sidebtn-id').css({
            "marginLeft":"0",
            "transition":"all 0.9s"
        });
    })

    $('.opendash').click(function(){
        $('#sidebar-id').css("width","250px");
        $('#sidebtn-id').css({
            "marginLeft":"250px",
            "transition":"all 0.9s"
        });
    })

});
