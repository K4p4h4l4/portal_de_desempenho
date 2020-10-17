/*var script = document.createElement("SCRIPT");
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName("head")[0].appendChild(script);*/

$(document).ready(function(){
    $('#funcionarios').change(function(){
        var user_id = document.getElementById('funcionarios').value;
        var ficha = document.getElementById('ficha');
        
        $.ajax({
            url: "../includes/select_ficha.php",
            method: "GET",
            data:{user_id:user_id},
            success: function(data){
                ficha.innerHTML = data;
                $.getScript("../js/selection.js", function( data, textStatus, jqxhr){
                });    
            },
            error:function(req, status, error) {
                window.alert( req + "\n" + status + "\n" + error );
            }

        });  
    });
});
