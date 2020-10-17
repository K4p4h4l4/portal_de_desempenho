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
    var update_admin = document.getElementById("update_admin");
    
    update_admin.addEventListener('click', function (){
        var fd = new FormData();
        var usr_login = document.getElementById('usr_login').value;
        var usr_email = document.getElementById('usr_email').value;
        var usr_picture = document.getElementById('usr_picture');
        var old_pw = document.getElementById('old_pw').value;
        var new_pw = document.getElementById('new_pw').value;
        var confirm_pw = document.getElementById('confirm_pw').value;
        var usr_admin = document.getElementById('usr_admin').value;
        
        /*usr_picture.addEventListener("onchange", function(){
               var file = this.files[0];
                console.log(file);
            });*/
        
        console.log(usr_picture.files[0]);
        fd.append('usr_picture', usr_picture);
        
        if(isEmpty(usr_picture)){
            
           $.ajax({
               url:"../includes/update_data.php",
               method: "post",
               data:{usr_login:usr_login,usr_email:usr_email,old_pw:old_pw,new_pw:new_pw,confirm_pw:confirm_pw,usr_nome:usr_nome,usr_sobrenome:usr_sobrenome, usr_admin:usr_admin},
               dataType:"json",
               success:function(data){
                   $('#admin_form').get(0).reset();   
                   $('#usr_login').val(data.usr_login);
                   $('#usr_email').val(data.usr_email);
                   $('#old_pw').val(data.usr_senha);
                   $('#msg').val(data.msg);
                   alert("Status: " + data.msg);
               },
                error:function(ts){
                    alert(ts.responseText);
                }
            });
        }else{
           $.ajax({
               url:"../includes/update_data.php",
               method: "post",
               data:{usr_login:usr_login,usr_email:usr_email,old_pw:old_pw,new_pw:new_pw,confirm_pw:confirm_pw,usr_nome:usr_nome,usr_sobrenome:usr_sobrenome,usr_picture:usr_picture,usr_admin:usr_admin},
               dataType:"json",
               success:function(data){
                   $('#admin_form').get(0).reset();   
                   $('#usr_login').val(data.usr_login);
                   $('#usr_email').val(data.usr_email);
                   $('#old_pw').val(data.usr_senha);
                   $('#msg').val(data.msg);
                   alert("Status: " + data.msg);
               },
                error:function(ts){
                    alert(ts.responseText);
                }
            }); 
        }
        
    });
});
