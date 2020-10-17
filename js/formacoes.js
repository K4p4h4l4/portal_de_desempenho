function windowOnClick(event) {
    
    if (event.target === modal) {
        toggleModal();
    }
    
    if(event.target === modal_view_formation){
        show_viewFormation();
    }

    if(event.target === modal_delete_formation){
        show_deleteFormation();
    }
}


/**********************************************************
Srcipt para abrir a modal para criar formação
**********************************************************/
var modal = document.querySelector(".modal-formacao");
var trigger = document.querySelector("#openFormacaoModal");
var closeButton = document.querySelector(".close-button");

function toggleModal() {
    modal.classList.toggle("show-modal");
}

trigger.addEventListener("click", toggleModal);

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

var addTag = document.getElementById('addTag');
var count = 1;

addTag.addEventListener('click', function(){
    count++;
   $('.add__workers').append('<div class="workers"><select name="formation__dpto" id="formation__dpto'+count+'" data-dpto_id='+count+' class="select"><option value="">--- Selecione o Departamento ---</option> <option value="DACA">DACA</option><option value="DAFSG">DAFSG</option>                                        <option value="DEETI">DEETI</option><option value="DEC">DEC</option><option value="DEGER">DEGER</option><option value="DFM">DFM</option><option value="DFMCR">DFMCR</option><option value="DRHTI">DRHTI</option><option value="DRMSU">DRMSU</option>                                    </select> <select name="formacao__membro[]" id="formacao__membro'+count+'" class="select"><option value="">--- Selecione o Colaborador ---</option></select><div class="add"><button class="removeWorkers"><i class="material-icons">remove</i></button>                                    </div></div>');
});

/********************************************
*Remover a tag de colaboradores da formação *
********************************************/
$(document).on('click', '.removeWorkers', function(){
    $(this).closest('.workers').remove();
});

/********************************************
*Botões do tab layout e suas funcionalidades* 
*da modal de adicionar formação             *
********************************************/
var content1 = document.getElementById('content1');
var content2 = document.getElementById('content2');
var content3 = document.getElementById('content3');

var detalhes = document.getElementById('formacao__detalhes');
var participantes = document.getElementById('formacao__participantes');
var tempo = document.getElementById('formacao__tempo');

function showFormacaoDetalhes(){
    content1.style.transform = "translateX(0)";
    content1.style.display="block";
    content1.style.visibility="visible";
    content2.style.transform = "translateX(200%)";
    content2.style.display="none";
    content2.style.visibility="hidden";
    content3.style.transform = "translateX(200%)";
    content3.style.display="none";
    content3.style.visibility="hidden";

    tempo.classList.remove('tab__header--selected');
    participantes.classList.remove('tab__header--selected');
    detalhes.classList.remove('tab__header--selected');
    detalhes.classList.add('tab__header--selected');

}

function showFormacaoParticipantes(){
    content1.style.transform = "translateX(-200%)";
    content1.style.display="none";
    content1.style.visibility="hidden";
    content2.style.transform = "translateX(0)";
    content2.style.display="block";
    content2.style.visibility="visible";
    content3.style.transform = "translateX(200%)";
    content3.style.display="none";
    content3.style.visibility="hidden";

    tempo.classList.remove('tab__header--selected');
    participantes.classList.remove('tab__header--selected');
    detalhes.classList.remove('tab__header--selected');
    participantes.classList.add('tab__header--selected');
}

function showFormacaoTempo(){
    content1.style.transform = "translateX(-200%)";
    content1.style.display="none";
    content1.style.visibility="hidden";
    content2.style.transform = "translateX(-200%)";
    content2.style.display="none";
    content2.style.visibility="hidden";
    content3.style.transform = "translateX(0)";
    content3.style.display="block";
    content3.style.visibility="visible";

    participantes.classList.remove('tab__header--selected');
    detalhes.classList.remove('tab__header--selected');
    tempo.classList.add('tab__header--selected');
}

detalhes.addEventListener('click',showFormacaoDetalhes);
participantes.addEventListener('click',showFormacaoParticipantes);
tempo.addEventListener('click',showFormacaoTempo);

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
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){
            console.log(data);
            window.location.reload(true);
        },
        complete:function(){
            $('#loader').hide();
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
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){
            console.log(data);
            window.location.reload(true);
        },
        complete:function(){
            $('#loader').hide();
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