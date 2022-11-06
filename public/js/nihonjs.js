const { isSet } = require("lodash");

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
       var pass = $('#myPass');

        if (pass.attr('type') === "password") {
            pass.attr('type','text');
        }
        else{
            pass.attr('type','password');
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




});

