var usuario_login = document.getElementById('usuario_login').value;
var usuario_senha = document.getElementById('usuario_senha').value;
var btn_login = document.getElementById('btn_login');

btn_login.addEventListener('click',function(e){
    $.ajax({
        url: './includes/logar.php',
        method: 'post',
        data:{usuario_login:usuario_login,usuario_senha:usuario_senha},
        success: function(data){}
    });
});