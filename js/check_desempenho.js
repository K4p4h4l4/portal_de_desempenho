let check_des = "activado";
$.ajax({
    url:"../includes/check_desempenho.php",
    method:"post",
    data:{check_des:check_des},
    dataType:"text",
    beforeSend:function(){
        $('#loader').show();
    },
    success:function(data){
        
    },
    complete:function(){
        $('#loader').hide();
    }
});