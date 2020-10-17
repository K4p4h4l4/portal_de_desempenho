function windowOnClick(event) {
    
    if(event.target === modal_view_formation){
        show_viewFormation();
    }

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
        url: "../includes/read_data.php",
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


var modal_view_formation = document.querySelector('.modal-view-formation');
var btn_view_formation = document.querySelectorAll('.btn-view-formation');
var close_view_formation = document.querySelector('.close-view-formation');
var paginate_button = document.querySelectorAll('.paginate_button');

/**************************************
*Função para ver detalhes da formação *
**************************************/
function show_viewFormation(){
    modal_view_formation.classList.toggle('show-view-formation');
    var formacao_id = this.id;
    $('#fview__membros').find('li').remove();
    $.ajax({
        url:'../includes/load_modal.php',
        method:'post',
        data:{formacao_id:formacao_id},
        dataType:'json',
        success:function(data){
            $('#fview__nome').html(data.formacao_nome);
            $('#fview__entidade').html(data.formacao_entidade);
            $('#fview__local').html(data.formacao_local);
            $('#fview__exame').html(data.formacao_exame);
            $('#fview__exame__data').html(data.formacao_exame_data);
            $('#fview__custo').html('AOA '+data.formacao_custo);
            $('#fview__dpto').html(data.formacao_dpto);
            $('#fview__inicio').html(data.formacao_inicio);
            $('#fview__duracao').html(data.formacao_duracao+' dias');
            $('#fview__fim').html(data.formacao_fim);
            $('#fview__horario').html(data.formacao_hinicio+'-'+data.formacao_hfim);
            $('#fview__grupos').html('0'+data.formacao_grupos);
            $('#fview__nmembros').html('0'+data.formacao_nmembros);
            for(var i = 0; i < data.formacao_membros.length; i++){
                $('#fview__membros').append('<li>'+data.formacao_membros[i].usuario_nome+' '+data.formacao_membros[i].usuario_sobrenome+'</li>');
            }

        }
    });
}

/*********************************************
*Função para aprovar formação                *
*********************************************/
function approve_formation(){
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
}

/*******************************************
*Função para recusar uma formação          *
*******************************************/
function deny_formation(){
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
}

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
var content1 = document.getElementById('content1');
var content2 = document.getElementById('content2');

function showMatriz(){
    content1.style.transform = "translateX(0)";
    content1.style.display="block";
    content1.style.visibility="visible";
    content2.style.transform = "translateX(200%)";
    content2.style.display="none";
    content2.style.visibility="hidden";
    analise.classList.remove('tab__selected');
    matriz.classList.remove('tab__selected');
    matriz.classList.add('tab__selected');
}

function showAnalise(){
    content1.style.transform = "translateX(-200%)";
    content1.style.display="none";
    content1.style.visibility="hidden";
    content2.style.transform = "translateX(0)";
    content2.style.display="block";
    content2.style.visibility="visible";
    matriz.classList.remove('tab__selected');
    analise.classList.remove('tab__selected');
    analise.classList.add('tab__selected');
}

matriz.addEventListener('click', showMatriz);
analise.addEventListener('click', showAnalise);