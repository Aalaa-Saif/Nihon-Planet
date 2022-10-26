$(document).ready(function(){

    $('.show_image').on('click',function(){
        var id = $(this).data('id');
        $('#bigSpace-'+id).css('display','block');

        var img = $(this).attr('src');

        $('#img01-'+id).attr('src',img);

        $('.show_image2').on('click',function(){
            var img2 = $(this).attr('src');
            $('#img01-'+id).attr('src',img2);
        });


    })

    $('.close').click(function(){
        $('.bigSpace').css("display","none");
    });


    $('#checkPass').click(function(){
       var x = $('#myPass');

        if (x.attr('type') === "password") {
          x.attr('type','text');
        }
        else{
          x.attr('type','password');
        }
    });

    $('#checkPassConf').click(function(){
        var confirm = $('#password-confirm');

        if (confirm.attr('type') === "password") {
            confirm.attr('type','text');
        }
        else{
            confirm.attr('type','password');
        }
    });

    $('.nihon_model_btn').click(function(){
        $('.nihon-container').fadeToggle(1000);
    });
});
