$(document).ready(function(){
    /*$('#toComment').on('click',function(){
        $('#bigSpace').show();
    });*/

    $('.to_Comment').on('click',function(){
        var id = $(this).data('id');
        $('#bigSpace-'+id).css('display','block');

    })

    $('.close').click(function(){
        var id = $(this).data('id');
        $('.bigSpace').css("display","none");
    });

});

