$(window).on("load", function(){
    $('.loader').fadeOut("slow" , function (){
        $( '.loader' ).remove();
    });
})

$(document).ready(function(){
    $(".slidToggle").on("click" , function(){
        $(".pagebody").toggleClass("full");
        $(".sidebar").toggleClass("min");
    })
})
$(document).ready(function(){
    $(".toggl-RC,.RC-layer,.dismiss").on("click" , function(){
        $(".RC-layer").toggleClass("apper");
        $(".RC-modal").toggleClass("apper");
    })
})
    // ADD IMAGE
    $('.imageUploader').change(function (event){
        $(this).parents('.imagesUploadBlock').append('<div class="uploadedBlock"><img src="'+ URL.createObjectURL(event.target.files[0]) +'"><button class="close"><i class="la la-times"></i></button></div>');
    });

        $('.dropBox').on('click', '.close',function (){
        $(this).parent().remove();
    });

    $(".clickAdd").click(function (b){
        b.preventDefault();
        $('.dropBox').append('<div class="textCenter">' + '<div class="imagesUploadBlock">' + '<label class="uploadImg">' + '<span><i class="feather icon-image"></i></span>' + '<input type="file" accept="image/*" name="images[]" class="imageUploader">' + '</label>' + '</div>' + '</div>');

        $('.imageUploader').change(function (event){
            $(this).parents('.imagesUploadBlock').append('<div class="uploadedBlock"><img src="'+ URL.createObjectURL(event.target.files[0]) +'"><button class="close"><i class="feather icon-x"></i></button></div>');
        });
        $('.dropBox').on('click', '.close',function (){
            $(this).parents('.textCenter').remove();
        });

    });
