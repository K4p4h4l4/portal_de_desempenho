/**********************************************************
                    Criar dica de Saúde
**********************************************************/
var modal = document.querySelector(".modal-saude");
var trigger = document.querySelector(".btn-criar");
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
               Modal Editar Dica de Saúde
**********************************************************/
var modal2 = document.querySelector(".modal-saude-edit");
var trigger2 = document.querySelectorAll(".btn-view");
var closeButton2 = document.querySelector(".close-button2");

function toggleModal2() {
    modal2.classList.toggle("show-modal2");
    var dica_id = this.id;
    $.ajax({
        url:"../includes/load_modal.php",
        method: "post",
        data:{dica_id:dica_id},
        dataType:"json",
        success:function(data){
            $('#update_dica_titulo').val(data.dica_titulo);
            $('#update_dica_mensagem').val(data.dica_mensagem);
            $('#update_dica_id').val(data.dica_id);
            
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
               Modal Editar Dica de Saúde
**********************************************************/
var modal3 = document.querySelector(".modal-saude-delete");
var trigger3 = document.querySelectorAll(".btn-delete");
var closeButton3 = document.querySelector(".close-button3");

function toggleModal3() {
    modal3.classList.toggle("show-modal3");
    var del_dica_id = this.id;
    $.ajax({
        url:"../includes/load_modal.php",
        method: "post",
        data:{del_dica_id:del_dica_id},
        dataType:"json",
        success:function(data){
            $('#delete_dica_id').val(data.del_dica_id);  
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