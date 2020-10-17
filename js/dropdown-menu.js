/*********************************************
*        Mostrar o menu de Perfil e Sair     *
*********************************************/
    
    var btn_menu = document.getElementById('btn-dropdown-menu');
    var menu = document.querySelector('.dropdown__menu');
    
    btn_menu.addEventListener('click', function(){
        menu.classList.toggle('visivel');
    });
    
    function load_unseen_notifications(view = ''){
        $.ajax({
            url: '../includes/read_data.php',
            method:'post',
            data:{view:view},
            dataType: 'json',
            success:function(data){
                $('.menu__not').html(data.notification);
                
                if(data.unseen_notification > 0){
                    $('.badge')[0].style.visibility='visible';
                    $('.badge').html(data.unseen_notification);
                }else{
                    $('.badge')[0].style.visibility='hidden';
                }
            }
        });
    }

    load_unseen_notifications();
    
    var btn_notifications = document.getElementById('notifications');
    var notifications = document.querySelector('.dropdown__notificationMenu');
    
    btn_notifications.addEventListener('click', function(){
        notifications.classList.toggle('visivel');
        $('.badge').html('');
        load_unseen_notifications('yes');
    });

    setInterval(function(){
        load_unseen_notifications()
    }, 5000);
    
    var hamburger = document.querySelector(".hamburger");
    
    hamburger.addEventListener('click', function(){
        document.querySelector(".dashboard").classList.toggle('show__fullDashboard');
        hamburger.classList.toggle('open');
    });