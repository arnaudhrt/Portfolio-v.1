$(function (){
    $('#contact-form').submit(function(e){
        e.preventDefault();
        var postdata = $('#contact-form').serialize();
    
        $.ajax({
            type: 'POST',
            url: 'script.php',
            data: postdata,
            dataType: 'json',
            success: function(result){

                if(result.isSuccess){
                    document.querySelector
                    $("#contact-form")[0].reset();
                } else {
                    
                }
            } 
        }); 
    });  
})