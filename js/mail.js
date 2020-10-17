    var btn = document.getElementById('btn-lembrete');   
    
    btn.addEventListener('click', function(){
        var btn_lembrete = this.id;
       $.ajax({
          url: '../includes/mail.php',
           method: 'post',
           data:{btn_lembrete:btn_lembrete},
           success:function(){
               alert("Enviado !");
           },
           error:function(ts){
                alert(ts.responseText);
            }
       });
    });