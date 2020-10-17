$(document).ready(function(){
    /**************************************************************************
    *Função para carregas os devidos dados do usuário seleccionado para o chat*
    **************************************************************************/
    function fetch_user_selected_data(){
        let user_id = this.id;
        isPaused = false;
        $.ajax({
            url:"../includes/read_data.php",
            method:"post",
            data:{fetch_user_for_chat:user_id},
            dataType:"json",
            success:function(data){
                let state ='';
                document.querySelector('.user__chatName').innerHTML = data[0].nome+' '+data[0].sobrenome;
                document.querySelector('.user__chatImgMain').src = "../imagens/perfil/"+data[0].foto;
                if(data[0].state=='on'){
                    state = 'Online';
                }else{
                    state = 'Offline';
                }
                document.querySelector('.user__chatStatus').innerHTML = state;
                document.querySelector('.btn__sendMessage').setAttribute('id', data[0].usuario_id);
                
                get_chat_messages(); 
                
                /*var chat_hist = document.getElementById('out');
                for(let n=0; n<3; n++){
                    chat_hist.scrollTop = chat_hist.scrollHeight;
                }
                
                console.log(chat_hist.scrollHeight);*/
            }
        });
    }
    
    /*******************************************
    *Função para carregar os usuários na lateral*
    ********************************************/
    function fetch_users(){
        $.ajax({
            url:'../includes/read_data.php',
            method:'post',
            data:{chat_users:"activado"},
            beforeSend:function(){
                $('#loader').show();
            },
            success:function(data){
                let users_chatHolder = document.getElementById('users__holder');
                users_chatHolder.innerHTML = data;
                
                let user_selected = document.querySelectorAll('.chart__usersCard');
                for(let i=0; i<user_selected.length; i++){
                    user_selected[i].addEventListener('click', fetch_user_selected_data);
                }
            },
            complete:function(){
                $('#loader').hide();
            }
        });
    }
    
    /*********************************************************
    *Função para verificar se os usuários estão online ou não*
    *********************************************************/
    function update_last_activity(){
        $.ajax({
            url:'../includes/update_data.php',
            method:'post',
            data:{check_user:"activado"},
            success:function(){
                
            }
        });
    }
    
    /******************************************
    *Função para carregar as mensagens do chat*
    ******************************************/
    function get_chat_messages(){
        let to_user_id = document.querySelector('.btn__sendMessage').getAttribute('id');
        $.ajax({
            url:"../includes/read_data.php",
            method:"post",
            data:{fetch_chat_messages:"activado", to_user_id:to_user_id},
            success:function(data){
                let chat_history = document.getElementById('out');
                let my_id = document.querySelector('.my__chatId').getAttribute('id');
                let other_userId = document.querySelector('.btn__sendMessage').getAttribute('id');
                /*function updateScroll(){
                    console.log('chegou aqui');
                    if(!scrolled){
                        chat_history = document.getElementById('out');
                        chat_history.scrollTop = chat_history.scrollHeight;
                    }
                }*/
                   
                chat_history.innerHTML = data;
                
                if((my_id!=null)&&(other_userId!=null)){
                    $.ajax({
                        url:"../includes/update_data.php",
                        method:"post",
                        data:{mensagem_lida:"activado",my_id:my_id,other_id:other_userId},
                        success:function(data){
                            
                        }
                    });
                   //console.log("Os dois estão setados");
                    /*var scrolled = false;

                    $("#out").on('scroll', function(){
                        scrolled=true;
                    });*/
                }
                               
                chat_history = document.getElementById('out');
                chat_history.scrollTop = chat_history.scrollHeight;
            }
        });
    }
    
    /*****************************
    *Função para enviar mensagens*
    *****************************/
    function send_message(){
        let to_id = this.id;
        let message = document.getElementById('message').value;
        if(message == ''){
            alert('Não se esqueça de escrever a sua mensagem!');
        }else if(to_id == 0){
            alert('Seleccione alguém para começar o chat!');
        }else{
            $.ajax({
                url:"../includes/insert_data.php",
                method:"post",
                data:{to_user_id:to_id,chat_message:message},
                success:function(data){
                    /*message = '';*/
                    var element = $('#message').emojioneArea();
                    element[0].emojioneArea.setText('');
                    get_chat_messages();
                }
            });
        }
        //console.log(message);
    }
    
    var isPaused = false;
    
    fetch_users();
    
    setInterval(function(){
        if(!isPaused){
            update_last_activity();
            fetch_users();
        }
    }, 5000);
    
    setInterval(function(){
        get_chat_messages();
    }, 1000);
    
    
    let btn_send_message = document.querySelector('.btn__sendMessage');
    
    btn_send_message.addEventListener('click', send_message);
    
    /******************************
    *Função para procurar usuários*
    ******************************/
    $("#search").on("keyup", function(e) {
        e.preventDefault;
        isPaused = true;
        var t = $(this).val().toLowerCase();
        $("#users__holder .chart__usersCard").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(t) > -1);
        });
    });
    
});