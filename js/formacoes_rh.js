function windowOnClick(event) {

    if(event.target === modal_delete_formation){
        show_deleteFormation();
    }
}

/********************************************
*Remover a tag de colaboradores da formação *
********************************************/
$(document).on('click', '.removeWorkers', function(){
    $(this).closest('.workers').remove();
});

/************************************************
*Carregar o select com os devidos colaboradores *               
************************************************/
$(document).on('change', '.select', function(){
    var worker_dptoID = $(this).val();
    var data_dpto_id = $(this).data('dpto_id');
    $('#formacao__membro'+data_dpto_id).find('option').not(':first').remove();

    $.ajax({
        url: "../includes/read_data",
        method: "post",
        data:{worker_dptoID:worker_dptoID},
        dataType:"json",
        success:function(data){
            var size = data.length;

            for(var i = 0; i<size;i++){
                var id = data[i]['usuario_id'];
                var nome = data[i]['usuario_nome'];
                var sobrenome = data[i]['usuario_sobrenome'];
                $('#formacao__membro'+data_dpto_id).append('<option value="'+id+'" >'+nome+' '+sobrenome+'</option>');
            }
        }
    });
});

for(var i=0; i < btn_view_formation.length; i++){
    btn_view_formation[i].addEventListener('click', show_viewFormation);
}

close_view_formation.addEventListener('click', show_viewFormation);

window.addEventListener("click", windowOnClick);

var btn_approve_formation = document.querySelectorAll(".btn-approve-formation");
var btn_deny_formation = document.querySelectorAll(".btn-deny-formation");
var btn_delete_formation = document.querySelectorAll(".btn-delete-formation");
var modal_delete_formation = document.querySelector(".modal-delete");
var close_deleteFormation_modal = document.querySelector(".close-button2");

/*******************************************
*Função para mostrar a modal para confirmar*
*a eliminação da formação                  *
*******************************************/
function show_deleteFormation(){
    document.getElementById('delFormation').value = this.id;
    modal_delete_formation.classList.toggle('show-modal2');
}

for(var i=0; i < btn_approve_formation.length; i++){
    btn_approve_formation[i].addEventListener('click', function(){
        var approved_formation = this.id;
        $.ajax({
            url:"../includes/update_data.php",
            method:"post",
            data:{approved_formation:approved_formation},
            dataType:"text",
            success:function(data){
                console.log(data);
                window.location.reload(true);
            }
        });
    });
}

for(var i=0; i < btn_deny_formation.length; i++){
    btn_deny_formation[i].addEventListener('click', function(){
        var dennied_formation = this.id;
        $.ajax({
            url:"../includes/update_data.php",
            method:"post",
            data:{dennied_formation:dennied_formation},
            dataType:"text",
            success:function(data){
                console.log(data);
                window.location.reload(true);
            }
        });
    });
}

for(var i=0; i < btn_delete_formation.length; i++){
    btn_delete_formation[i].addEventListener('click', show_deleteFormation);
}

close_deleteFormation_modal.addEventListener('click', show_deleteFormation);

/**************************************************************
*Troca de conteúdos na parte de formações para o administrador*
**************************************************************/
var matriz = document.getElementById('matriz');
var analise = document.getElementById('analise');
var content11 = document.getElementById('content11');
var content22 = document.getElementById('content22');

function showMatriz(){
    content11.style.transform = "translateX(0)";
    content11.style.display="block";
    content11.style.visibility="visible";
    content22.style.transform = "translateX(200%)";
    content22.style.display="none";
    content22.style.visibility="hidden";
    analise.classList.remove('tab__selected');
    matriz.classList.remove('tab__selected');
    matriz.classList.add('tab__selected');
}

function showAnalise(){
    content11.style.transform = "translateX(-200%)";
    content11.style.display="none";
    content11.style.visibility="hidden";
    content22.style.transform = "translateX(0)";
    content22.style.display="block";
    content22.style.visibility="visible";
    matriz.classList.remove('tab__selected');
    analise.classList.remove('tab__selected');
    analise.classList.add('tab__selected');
}

matriz.addEventListener('click', showMatriz);
analise.addEventListener('click', showAnalise);