$(document).ready(function(){
    
    function isEmpty(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
    }
    
    var usr_nome = document.getElementById('usr_nome').value;
    var usr_sobrenome = document.getElementById('usr_sobrenome').value;
    var update_usr = document.getElementById("update_usr");

    update_usr.addEventListener('click', function (){
        var usr_login = document.getElementById('usr_login').value;
        var usr_email = document.getElementById('usr_email').value;
        var usr_photo = document.getElementById('usr_photo');
        var old_pw = document.getElementById('old_pw').value;
        var new_pw = document.getElementById('new_pw').value;
        var confirm_pw = document.getElementById('confirm_pw').value;
        var usr_type = document.getElementById('usr_type').value;
        var usr_contacto = document.getElementById('usr_contacto').value;
        var usr_movel = document.getElementById('usr_movel').value;
        const endpoint = "../includes/update_data.php";
        const formData = new FormData();
        
        formData.append("usr_photo", usr_photo.files[0]);
        
        if(isEmpty(usr_photo)){
            fetch(endpoint, {
                method:"post",
                body: formData
            }).catch(console.error);
        }
        
         //console.log(usr_type);           
        $.ajax({
           url:"../includes/update_data.php",
           method: "post",
           data:{usr_login:usr_login,usr_email:usr_email,old_pw:old_pw,new_pw:new_pw,confirm_pw:confirm_pw,usr_nome:usr_nome,usr_sobrenome:usr_sobrenome,usr_type:usr_type, usr_contacto:usr_contacto, usr_movel:usr_movel},
           dataType:"json",
            beforeSend:function(){
                $('#loader').show();
            },
           success:function(data){
               $('#user_form').get(0).reset();   
               $('#usr_login').val(data.usr_login);
               $('#usr_email').val(data.usr_email);
               $('#old_pw').val(data.usr_senha);      
               alert("Status: " + data.msg);
               console.log(usr_photo);
               window.location.reload(true);
           },
            complete:function(){
                $('#loader').hide();
            },
            error:function(ts){
                window.location.reload(true);
                alert(ts.responseText);
            }
        });
                
    });
});
