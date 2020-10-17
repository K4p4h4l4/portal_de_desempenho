/**********************************************************
*Script para sugerir uma ideia 
**********************************************************/
var modal = document.querySelector(".modal-ideia");
var trigger = document.querySelector("#openIdeiaModal");
var closeButton = document.querySelector(".close-button");

function toggleModal() {
    modal.classList.toggle("show-modal");
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

trigger.addEventListener("click", toggleModal);

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

/**********************************************************
Srcipt para carreagar os dados na modal de editar ideia
**********************************************************/
var modal2 = document.querySelector(".modal-ideia-edit");
var trigger2 = document.querySelectorAll(".btn-edit-ideia");
var closeButton2 = document.querySelector(".close-button2");

function toggleModal2() {
    modal2.classList.toggle("show-modal2");
    var ideia_id = this.id;
    $.ajax({
        url:"../includes/load_modal.php",
        method: "post",
        data:{ideia_id:ideia_id},
        dataType:"json",
        success:function(data){
            $('#update_ideia_assunto').val(data.ideia_assunto);
            var update_ideia_descricao = document.getElementById('update_ideia_descricao');
            update_ideia_descricao.innerHTML = data.ideia_descricao;
            $('#update_ideia_id').val(data.ideia_id);
            
        }
    });
}

function windowOnClick2(event) {
    if (event.target === modal2) {
        toggleModal2();
    }
}

for(var i=0; i< trigger2.length; i++){
    trigger2[i].addEventListener("click", toggleModal2);
}

closeButton2.addEventListener("click", toggleModal2);
window.addEventListener("click", windowOnClick2);

/**********************************************************
               Modal eliminar Ideia
**********************************************************/
var modal3 = document.querySelector(".modal-ideia-delete");
var trigger3 = document.querySelectorAll(".btn-delete-ideia");
var closeButton3 = document.querySelector(".close-button3");

function toggleModal3() {
    modal3.classList.toggle("show-modal3");
    var del_ideia_id = this.id;
    $.ajax({
        url:"../includes/load_modal.php",
        method: "post",
        data:{del_ideia_id:del_ideia_id},
        dataType:"json",
        success:function(data){
            $('#delete_ideia_id').val(data.del_ideia_id);  
        }
    });
}

function windowOnClick3(event) {
    if (event.target === modal3) {
        toggleModal3();
    }
}

for(var i=0; i< trigger3.length; i++){
    trigger3[i].addEventListener("click", toggleModal3);
}

closeButton3.addEventListener("click", toggleModal3);
window.addEventListener("click", windowOnClick3);


    var ideia = document.getElementById('inserir_ideia');
    
    ideia.addEventListener('click', function(){
        var inserir_ideia = document.getElementById('inserir_ideia').value;
        var ideia_assunto = document.getElementById('ideia_assunto').value;
        var ideia_descricao = document.getElementById("ideia_descricao").innerHTML;

        $.ajax({
            url:"../includes/insert_data.php",
            method: "post",
            data:{inserir_ideia:inserir_ideia, ideia_assunto:ideia_assunto, ideia_descricao:ideia_descricao},
            dataType:"json",
            success:function(data){
                prompt("Dados inseridos com sucesso");
            }
        });
    });
    
    var updt_ideia = document.getElementById('update_ideia');
    
    updt_ideia.addEventListener('click', function(){
        var update_ideia_id = document.getElementById('update_ideia_id').value;
        var update_ideia_assunto = document.getElementById('update_ideia_assunto').value;
        var update_ideia_descricao = document.getElementById('update_ideia_descricao').innerHTML;
        var update_ideia = document.getElementById('update_ideia').value;
        
        $.ajax({
            url:"../includes/update_data.php",
            method: "post",
            data:{update_ideia:update_ideia, update_ideia_id:update_ideia_id, update_ideia_assunto:update_ideia_assunto, update_ideia_descricao:update_ideia_descricao},
            dataType:"json",
            success:function(data){
                alert("Dados inseridos com sucesso");
            }
        });
    });
    
    function add_action(){
        trigger2 = document.querySelectorAll(".btn-edit-ideia");
        trigger3 = document.querySelectorAll(".btn-delete-ideia");
        
        for(var i=0; i< trigger2.length; i++){
            trigger2[i].addEventListener("click", toggleModal2);
        }
        
        for(i=0; i < btn_edit_formation.length; i++){
            btn_edit_formation[i].addEventListener('click',show_editFormation);
        }
        
    }
    
    var paginate_button = document.querySelectorAll('.paginate_button');
    
    for(var i=0; i < paginate_button.length; i++){
        paginate_button[i].addEventListener('click', add_action);
    }
    
    for(var i=0; i< trigger3.length; i++){
        trigger3[i].addEventListener("click", toggleModal3);
    }