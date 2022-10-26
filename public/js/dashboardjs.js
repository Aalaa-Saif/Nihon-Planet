$(document).ready(function(){
    /*$('#toComment').on('click',function(){
        $('#bigSpace').show();
    });*/

    $('.to_Comment').on('click',function(){
        var id = $(this).data('id');
        $('#bigSpace-'+id).css('display','block');

    })


    $('.close').click(function(){
        $('.bigSpace').css("display","none");
    });




    $('.multiImg').on('click',function(){
        var id = $(this).data('id');
        $('#bigSpaceImg-'+id).css('display','block');

        var img = $(this).attr('src');

        $('#Image-'+id).attr('src',img);

    })

    $('.close').click(function(){
        $('.bigSpaceImg').css("display","none");
    });

});



