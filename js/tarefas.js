/**********************************************************
Modal para adicionar tarefas 
**********************************************************/

var modal = document.querySelector(".modal-add-tarefa");
var trigger = document.querySelector("#openAddTarefa");
var closeButton = document.querySelector(".close-button");

function toggleModal() {
    modal.classList.toggle("show-modal");
}

function windowOnClick(event) {
    /*if (event.target === modal) {
        toggleModal();
    }*/

    if (event.target === modal_verTpc) {
        toggleModalViewTarefa();
    }

    if (event.target === modal_delete) {
        tarefa_eliminada();
    }

}

trigger.addEventListener("click", toggleModal);

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

/**********************************************
    Adicionar mais tasklist tags na modal para
    criar tarefas
    **********************************************/

    var addTaskList = document.getElementById('addTaskList');

    addTaskList.addEventListener('click', function(){
        $('.addCheck').append('<input type="text" class="task__checklistAdd"  name="input_checklistAdd[]" required>');   
    });

    var removeTaskList = document.getElementById('removeTaskList');

    removeTaskList.addEventListener('click', function(){
       $(".task__checklistAdd")[0].remove();
    });

    var addWorker = document.getElementById('addWorker');
    var count = 1;
    addWorker.addEventListener('click', function(){
        count++;
        $('.addWorkers').append('<div class="workers"><select name="worker_dpto[]" class="select" data-dpto_id='+count+' required><option value="S">--- Selecione o Departamento ---</option>            <option value="DACA">DACA</option><option value="DAFSG">DAFSG</option><option value="DEETI">DEETI</option><option value="DEC">DEC</option><option value="DEGER">DEGER</option>                           <option value="DFM">DFM</option><option value="DFMCR">DFMCR</option><option value="DRHTI">DRHTI</option><option value="DRMSU">DRMSU</option></select>                                        <div id="workers__selector"><select name="worker_id[]" class="selectd" id="worker-id'+count+'" required><option value="S" >--- Selecione o Colaborador ---</option></select><div class="checklist__buttons2"><button class="checklist__remove" id="removeWorker"><i class="material-icons">remove</i></button></div></div></div>');
    });

    /********************************************
    *Remover a tag de checklist                 *
    ********************************************/
    $(document).on('click', '.checklist__remove', function(){
        $(this).closest('.workers').remove();
    });
    
    /************************************************
    *Carregar o select com os devidos colaboradores *               
    ************************************************/
    $(document).on('change', '.select', function(){
        var worker_dptoID = $(this).val();
        var data_dpto_id = $(this).data('dpto_id');
        $('#worker-id'+data_dpto_id).find('option').not(':first').remove();
        $('#worker-idUptd'+data_dpto_id).find('option').not(':first').remove();
        $.ajax({
            url: "../includes/read_data.php",
            method: "post",
            data:{worker_dptoID:worker_dptoID},
            dataType:"json",
            success:function(data){
                console.log(data);
                var size = data.length;
                for(var i = 0; i<size;i++){
                    var id = data[i]['usuario_id'];
                    var nome = data[i]['usuario_nome'];
                    var sobrenome = data[i]['usuario_sobrenome'];
                    $('#worker-id'+data_dpto_id).append('<option value="'+id+'" >'+nome+' '+sobrenome+'</option>');
                    $('#worker-idUptd'+data_dpto_id).append('<option value="'+id+'" >'+nome+' '+sobrenome+'</option>');
                }
            }
        });
    });
    
    /************************************************
    *Carregar o select com os devidos colaboradores *               
    ************************************************/
    $(document).on('change', '.selectUptd', function(){
        var worker_dptoID = $(this).val();
        var data_dpto_id = $(this).data('dpto_id');
        
        $('#worker-idUptd'+data_dpto_id).find('option').not(':first').remove();
        $.ajax({
            url: "../includes/read_data.php",
            method: "post",
            data:{worker_dptoID:worker_dptoID},
            dataType:"json",
            success:function(data){
                console.log(data);
                var size = data.length;
                for(var i = 0; i<size;i++){
                    var id = data[i]['usuario_id'];
                    var nome = data[i]['usuario_nome'];
                    var sobrenome = data[i]['usuario_sobrenome'];
                    
                    $('#worker-idUptd'+data_dpto_id).append('<option value="'+id+'" >'+nome+' '+sobrenome+'</option>');
                }
            }
        });
    });


/**********************************************************
Modal para visualizar tarefas 
**********************************************************/
var modal_verTpc = document.querySelector(".modal__view__tarefa");
var ver_tpc = document.querySelectorAll(".btn-view-tarefa");
var close_modalTpc = document.querySelector(".close__modal__tarefa");

function toggleModalViewTarefa(){
    modal_verTpc.classList.toggle("show-modalView-tarefa");
    var work_id = this.id;
    $.ajax({
        url: '../includes/load_modal.php',
        method: 'post',
        data:{work_id:work_id},
        dataType:'json',
        success:function(data){
            $('#task__labelTitle').html(data.tarefa_nome);
            $('#task__viewPriority').html(data.tarefa_prioridade);
            $('#task__viewStart').html(data.tarefa_inicio);
            $('#task__viewEnd').html(data.tarefa_fim);
            $('#task__viewStatus').html(data.tarefa_status);
            $('#task__viewPercent').html(data.tarefa_percent + "%");
            $('#task__viewChecklist').html(data.tarefa_checklist);
            $('#task__viewMembers').html(data.tarefa_members);
        }
    });
}

for(var i=0; i < ver_tpc.length; i++){
    ver_tpc[i].addEventListener("click",toggleModalViewTarefa)
}

close_modalTpc.addEventListener("click",toggleModalViewTarefa);
window.addEventListener("click", windowOnClick);

/*************************************************
*Funções para aprovar, recuar ou eliminar tarefa *
*************************************************/

var btn_verified_tarefa = document.querySelectorAll(".btn-verified-tarefa");
var btn_clear_tarefa = document.querySelectorAll(".btn-clear-tarefa");
var btn_delete_tarefa = document.querySelectorAll(".btn-delete-tarefa");
var modal_delete = document.querySelector('.modal-delete');
var close_delete_task = document.querySelector('.close-button2');

function tarefa_verificada(){
    var approved_task = this.id;
    $.ajax({
        url:'../includes/update_data.php',
        method:'post',
        data:{approved_task:approved_task},
        dataType:'text',
        success:function(data){   
            window.location.reload(true);
            console.log('Concluida');
        },
        error:function(err){
            window.location.reload(true);
            console.log('erro');
        }
    });    
}

function tarefa_recusada(){
    var refused_task = this.id;
    $.ajax({
        url:'../includes/update_data.php',
        method:'post',
        data:{refused_task:refused_task},
        dataType:'text',
        success:function(data){
            window.location.reload(true);
            console.log('Recusada');            
        },
        error:function(err){
            window.location.reload(true);
            console.log('erro');
        }
    });    
}

/***************************************************************
*Função para abrir modal de confirmação de eliminação de tarefa*
***************************************************************/
function tarefa_eliminada(){
    modal_delete.classList.toggle('show-modal2');
    document.getElementById('delTask').value = this.id;
}

for(var i=0; i < btn_verified_tarefa.length; i++){
    btn_verified_tarefa[i].addEventListener('click', tarefa_verificada);
}

for(var i=0; i < btn_clear_tarefa.length; i++){
    btn_clear_tarefa[i].addEventListener('click', tarefa_recusada);
}

for(var i=0; i < btn_delete_tarefa.length; i++){
    btn_delete_tarefa[i].addEventListener('click', tarefa_eliminada);
}

close_delete_task.addEventListener('click', tarefa_eliminada);