$(document).ready(function(){
    
    function check_token(){
        var teste = 'teste';
        $.ajax({
            url:"../includes/check_token.php",
            method: "POST",
            data:{"teste":teste},
            dataType:"json",
            success:function(data){
                console.log(data.response);
                if(data.response == 1){
                    alert("Chegou aqui");
                    window.location.pathname = "../includes/logout.php";
                }
            }
        });
    }
    
    setInterval(function(){check_token()}, 3000);
});