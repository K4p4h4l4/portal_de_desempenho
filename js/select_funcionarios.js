var script = document.createElement("SCRIPT");
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName("head")[0].appendChild(script);

$(document).ready(function(){
    $('#departamento').change(function(){
        var dpto = $(this).val(); 
        
        $.ajax({
            url: "../includes/select_funcionario.php",
            method: "GET",
            data:{departamento:dpto},
            success: function(data){
                $('#colaboradores').html(data);
            },
            error:function(req, status, error) {
                window.alert( req + "\n" + status + "\n" + error );
            }

        });
    });
});
 


