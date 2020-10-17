/*****************************************************
* Função para verificar todas as mensagens não lidas *
*****************************************************/
function fetch_not_red_msg(){
    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{not_red_msg:'activado'},
        success:function(data){
            let not_red_msg = document.getElementById('not_red_msg');
            
            let number = parseInt(data, 10);
            if(number > 0){
                not_red_msg.style.visibility="visible";
                not_red_msg.innerHTML = number;
            }else{
                not_red_msg.style.visibility = "hidden";
            }
        }
    });
}

setInterval(function(){
    fetch_not_red_msg();
}, 1000);