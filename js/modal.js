/**********************************************************
                    Modal Editar Avaliação
**********************************************************/
var modal = document.querySelector(".modal");
var trigger = document.querySelectorAll(".btn-edit");
var closeButton = document.querySelector(".close-button");

function toggleModal() {
    modal.classList.toggle("show-modal");
    var av_id = this.id;
    $.ajax({
        url:"../includes/load_modal.php",
        method: "post",
        data:{av_id:av_id},
        dataType:"json",
        success:function(data){
            $('#nome').val(data.usuario_nome);
            $('#sobrenome').val(data.usuario_sobrenome);
            $('#username').val(data.usuario_login);
            $('#mes').val(data.av_mes);
            $('#ano').val(data.av_ano);
            $('#compt_prof').val(data.av_competencia_profissional);
            $('#din_inic').val(data.av_dinamismo_iniciativa);
            $('#cumpr_tpc').val(data.av_cumprimento_tarefa);
            $('#rel_hum_trab').val(data.av_rel_hum_trab);
            $('#adpt_func').val(data.av_adpt_func);
            $('#disc').val(data.av_disciplina);
            $('#corr_eqpt').val(data.av_uso_correcto_equip);
            $('#apr_compst').val(data.av_apresentacao_compostura);
            $('#ro').val(data.av_reuniao_op);
            $('#rm').val(data.av_reuniao_mat);
            $('#avl').val(av_id);
        }
    });
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

for(var i=0; i< trigger.length; i++){
    trigger[i].addEventListener("click", toggleModal);
}

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);
  
    
/**********************************************************
                    Modal Eliminar Avaliação
**********************************************************/ 
var modal2 = document.querySelector(".modal-delete");
var trigger2 = document.querySelectorAll(".btn-delete");
var closeButton2 = document.querySelector(".close-button2");

function toggleModal2() {
    modal2.classList.toggle("show-modal2");
    var del_id = this.id;
    
    $('#delAv').val(del_id);
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
                    Modal Editar Usuários
**********************************************************/
var modal3 = document.querySelector(".modal-userDetails");
var trigger3 = document.querySelectorAll(".btn-edit-user");
var closeButton3 = document.querySelector(".close-button3");

function toggleModal3() {
    modal3.classList.toggle("show-modal3");
    var usr_id = this.id;
    $.ajax({
        url:"../includes/load_modal.php",
        method: "post",
        data:{usr_id:usr_id},
        dataType:"json",
        success:function(data){
            $('#usr_nome').val(data.usuario_nome);
            $('#usr_sobrenome').val(data.usuario_sobrenome);
            $('#usr_email').val(data.usuario_email);
            $('#usr_contacto').val(data.usuario_contacto);
            $('#usr_departamento').val(data.usuario_departamento);
            $('#usr_categoria').val(data.usuario_categoria);
            $('#usr_login').val(data.usuario_login);
            $('#usr_tipo').val(data.usuario_tipo);
            $('#usr_senha').val(data.usuario_senha);
            $('#usr_id').val(data.usuario_id);
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

/**********************************************************
                    Modal Eliminar Colaborador
**********************************************************/ 
var modal4 = document.querySelector(".modal-delete-users");
var trigger4 = document.querySelectorAll(".btn-delete-user");
var closeButton4 = document.querySelector(".close-button4");

function toggleModal4() {
    modal4.classList.toggle("show-modal4");
    var del_usr_id = this.id;
    
    $('#delUsr').val(del_usr_id);
}

function windowOnClick4(event) {
    if (event.target === modal4) {
        toggleModal4();
    }
}

for(var i=0; i< trigger4.length; i++){
    trigger4[i].addEventListener("click", toggleModal4);
}

closeButton4.addEventListener("click", toggleModal4);
window.addEventListener("click", windowOnClick4);

/**********************************************************
                    Criar Colaborador
**********************************************************/
var modal5 = document.querySelector(".modal-create-user");
var trigger5 = document.querySelector(".btn-criar");
var closeButton5 = document.querySelector(".close-button5");

function toggleModal5() {
    modal5.classList.toggle("show-modal5");
}

function windowOnClick5(event) {
    if (event.target === modal5) {
        toggleModal5();
    }
}

trigger5.addEventListener("click", toggleModal5);

closeButton5.addEventListener("click", toggleModal5);
window.addEventListener("click", windowOnClick5);