/***************************************
*Mostrar a modal de adicionar Projecto *
***************************************/
var modal_add_projecto = document.querySelector('.modal-add-projecto');
var addProjecModal = document.getElementById("addProjecModal");
var close_addProject = document.querySelector('.close-addProject');

function toggleProjectoModal() {
    modal_add_projecto.classList.toggle("show-modal");
    $('#form_addProject')[0].reset();

    CKEDITOR.instances.project__context.setData('', function(){
        this.checkDirty();
    });
    CKEDITOR.instances.project__mission.setData('', function(){
        this.checkDirty();
    });
    CKEDITOR.instances.project__goal.setData('', function(){
        this.checkDirty();
    });
    CKEDITOR.instances.project__metodology.setData('', function(){
        this.checkDirty();
    });
    CKEDITOR.instances.project__entregaveis.setData('', function(){
        this.checkDirty();
    });

    $('#add_projecto')[0].style.visibility = 'hidden';

}

function windowOnClick(event) {
    if (event.target === modal_add_projecto) {
        toggleProjectoModal();
    }

    if (event.target === modal_projecto) {
        showProjectModal();   
    }
    
    if(event.target === modal_updt_projecto){
        open_updtModal();
    }

    if(event.target === modal_comment_project){
        open_comment_modal();
    }

    if(event.target === modal_view_comments){
        open_view_comments();
    }modal_delete

    if(event.target === modal_delete){
        open_delete_project();
    }
}

addProjecModal.addEventListener("click", toggleProjectoModal);
close_addProject.addEventListener("click", toggleProjectoModal);
window.addEventListener("click", windowOnClick);

/********************************************
    *Botões do tab layout e suas funcionalidades*
    ********************************************/
    var content11 = document.getElementById('content11');
    var content22 = document.getElementById('content22');
    var content33 = document.getElementById('content33');
    var content44 = document.getElementById('content44');
    var content55 = document.getElementById('content55');
    var content66 = document.getElementById('content66');

    var btn1 = document.getElementById('btn1');
    var btn2 = document.getElementById('btn2');
    var btn3 = document.getElementById('btn3');
    var btn4 = document.getElementById('btn4');
    var btn5 = document.getElementById('btn5');
    var btn6 = document.getElementById('btn6');

    function showNome(){
        content11.style.transform = "translateX(0)";
        content11.style.display = "block";
        content11.style.visibility= "visible";
        content22.style.transform = "translateX(200%)";
        content22.style.display = "none";
        content22.style.visibility= "hidden";
        content33.style.transform = "translateX(200%)";
        content33.style.display = "none";
        content33.style.visibility= "hidden";
        content44.style.transform = "translateX(200%)";
        content44.style.display = "none";
        content44.style.visibility= "hidden";
        content55.style.transform = "translateX(200%)";
        content55.style.display = "none";
        content55.style.visibility= "hidden";
        content66.style.transform = "translateX(200%)";
        content66.style.display = "none";
        content66.style.visibility= "hidden";
        btn6.classList.remove('tab__header--selected');
        btn5.classList.remove('tab__header--selected');
        btn4.classList.remove('tab__header--selected');
        btn3.classList.remove('tab__header--selected');
        btn2.classList.remove('tab__header--selected');
        btn1.classList.remove('tab__header--selected');
        btn1.classList.add('tab__header--selected');
        $('#add_projecto')[0].style.visibility = 'hidden';

    }

    function showMissao(){
        content11.style.transform = "translateX(-200%)";
        content11.style.display = "none";
        content11.style.visibility= "hidden";
        content22.style.transform = "translateX(0)";
        content22.style.display = "block";
        content22.style.visibility= "visible";
        content33.style.transform = "translateX(200%)";
        content33.style.display = "none";
        content33.style.visibility= "hidden";
        content44.style.transform = "translateX(200%)";
        content44.style.display = "none";
        content44.style.visibility= "hidden";
        content55.style.transform = "translateX(200%)";
        content55.style.display = "none";
        content55.style.visibility= "hidden";
        content66.style.transform = "translateX(200%)";
        content66.style.display = "none";
        content66.style.visibility= "hidden";
        btn6.classList.remove('tab__header--selected');
        btn5.classList.remove('tab__header--selected');
        btn4.classList.remove('tab__header--selected');
        btn3.classList.remove('tab__header--selected');
        btn2.classList.remove('tab__header--selected');
        btn1.classList.remove('tab__header--selected');
        btn2.classList.add('tab__header--selected');
        $('#add_projecto')[0].style.visibility = 'hidden';
    }

    function showMetodologia(){
        content11.style.transform = "translateX(-200%)";
        content11.style.display = "none";
        content11.style.visibility= "hidden";
        content22.style.transform = "translateX(-200%)";
        content22.style.display = "none";
        content22.style.visibility= "hidden";
        content33.style.transform = "translateX(0)";
        content33.style.display = "block";
        content33.style.visibility= "visible";
        content44.style.transform = "translateX(200%)";
        content44.style.display = "none";
        content44.style.visibility= "hidden";
        content55.style.transform = "translateX(200%)";
        content55.style.display = "none";
        content55.style.visibility= "hidden";
        content66.style.transform = "translateX(200%)";
        content66.style.display = "none";
        content66.style.visibility= "hidden";
        btn6.classList.remove('tab__header--selected');
        btn5.classList.remove('tab__header--selected');
        btn4.classList.remove('tab__header--selected');
        btn3.classList.remove('tab__header--selected');
        btn2.classList.remove('tab__header--selected');
        btn1.classList.remove('tab__header--selected');
        btn3.classList.add('tab__header--selected');
        $('#add_projecto')[0].style.visibility = 'hidden';
    }
    
    function showRiscos(){
        content11.style.transform = "translateX(-200%)";
        content11.style.display = "none";
        content11.style.visibility= "hidden";
        content22.style.transform = "translateX(-200%)";
        content22.style.display = "none";
        content22.style.visibility= "hidden";
        content33.style.transform = "translateX(-200%)";
        content33.style.display = "none";
        content33.style.visibility= "hidden";
        content44.style.transform = "translateX(0)";
        content44.style.display = "block";
        content44.style.visibility= "visible";
        content55.style.transform = "translateX(200%)";
        content55.style.display = "none";
        content55.style.visibility= "hidden";
        content66.style.transform = "translateX(200%)";
        content66.style.display = "none";
        content66.style.visibility= "hidden";
        btn6.classList.remove('tab__header--selected');
        btn5.classList.remove('tab__header--selected');
        btn4.classList.remove('tab__header--selected');
        btn3.classList.remove('tab__header--selected');
        btn2.classList.remove('tab__header--selected');
        btn1.classList.remove('tab__header--selected');
        btn4.classList.add('tab__header--selected');
        $('#add_projecto')[0].style.visibility = 'hidden';
    }
    
    function showEquipa(){
        content11.style.transform = "translateX(-200%)";
        content11.style.display = "none";
        content11.style.visibility= "hidden";
        content22.style.transform = "translateX(-200%)";
        content22.style.display = "none";
        content22.style.visibility= "hidden";
        content33.style.transform = "translateX(-200%)";
        content33.style.display = "none";
        content33.style.visibility= "hidden";
        content44.style.transform = "translateX(-200%)";
        content44.style.display = "none";
        content44.style.visibility= "hidden";
        content55.style.transform = "translateX(0)";
        content55.style.display = "block";
        content55.style.visibility= "visible";
        content66.style.transform = "translateX(200%)";
        content66.style.display = "none";
        content66.style.visibility= "hidden";
        btn6.classList.remove('tab__header--selected');
        btn5.classList.remove('tab__header--selected');
        btn4.classList.remove('tab__header--selected');
        btn3.classList.remove('tab__header--selected');
        btn2.classList.remove('tab__header--selected');
        btn1.classList.remove('tab__header--selected');
        btn5.classList.add('tab__header--selected');
        $('#add_projecto')[0].style.visibility = 'hidden';
    }
    
    function showCronograma(){
        content11.style.transform = "translateX(-200%)";
        content11.style.display = "none";
        content11.style.visibility= "hidden";
        content22.style.transform = "translateX(-200%)";
        content22.style.display = "none";
        content22.style.visibility= "hidden";
        content33.style.transform = "translateX(-200%)";
        content33.style.display = "none";
        content33.style.visibility= "hidden";
        content44.style.transform = "translateX(-200%)";
        content44.style.display = "none";
        content44.style.visibility= "hidden";
        content55.style.transform = "translateX(-200%)";
        content55.style.display = "none";
        content55.style.visibility= "hidden";
        content66.style.transform = "translateX(0)";
        content66.style.display = "block";
        content66.style.visibility= "visible";
        btn6.classList.remove('tab__header--selected');
        btn5.classList.remove('tab__header--selected');
        btn4.classList.remove('tab__header--selected');
        btn3.classList.remove('tab__header--selected');
        btn2.classList.remove('tab__header--selected');
        btn1.classList.remove('tab__header--selected');
        btn6.classList.add('tab__header--selected');
        $('#add_projecto')[0].style.visibility = 'visible';
    }
    
    btn1.addEventListener('click',showNome);
    btn2.addEventListener('click',showMissao);
    btn3.addEventListener('click',showMetodologia);
    btn4.addEventListener('click',showRiscos);
    btn5.addEventListener('click',showEquipa);
    btn6.addEventListener('click',showCronograma);
    
    /*****************************************
    *Botão para adicionar riscos do projecto * 
    *****************************************/
    var addRisk = document.getElementById('addRisk');
    var count = 1;
    addRisk.addEventListener('click', function(){
        $('.risk').append('<div class="risk__box"><input type="text" class="activity__inputText" id="data-risk_name'+count+'" name="risk_name[]" placeholder="Nome do risco" required>        <input type="text" class="activity__inputText" id="data-risk_cause'+count+'" name="risk_cause[]" placeholder="Descrição do risco e causa" required>                                    <input type="text" class="activity__inputText" id="data-risk_impact'+count+'" name="risk_impact[]" placeholder="Impacto do risco" required>                                       <input type="text" class="activity__inputText" id="data-risk_mitigation'+count+'" name="risk_mitigation[]" placeholder="Acção de Mitigação" required>                                        <input type="number" class="activity__inputNumber" id="data-risk_prob'+count+'" name="risk_prob[]" placeholder="Probabilidade" min="1" max="3" required>                            <input type="number" class="activity__inputNumber" id="data-risk_imp'+count+'" name="risk_imp[]" placeholder="Impacto" min="1" max="3" required><div class="checklist__buttons2"><button class="checklist__remove removeRisk" id="removeWorker"><i class="material-icons">remove</i></button></div>                               </div>');
    });
    
    /********************************************
    *Remover a tag de Risco                     *
    ********************************************/
    $(document).on('click', '.removeRisk', function(){
        $(this).closest('.risk__box').remove();
    });
    
    /*****************************************
    *Botão para adicionar novos colaboradores* 
    *á equipe                                *
    *****************************************/
    var addWorker = document.getElementById('addWorker');
    count = 1;
    addWorker.addEventListener('click', function(){
        count++;
        $('.addWorkers').append('<div class="workers"><select name="worker_dpto[]" class="select" data-dpto_id='+count+' required><option value="S">--- Selecione o Departamento ---</option><option value="CA">CA</option><option value="DACA">DACA</option><option value="DAFSG">DAFSG</option><option value="DEETI">DEETI</option><option value="DEC">DEC</option><option value="DEGER">DEGER</option>                           <option value="DFM">DFM</option><option value="DFMCR">DFMCR</option><option value="DRHTI">DRHTI</option><option value="DRMSU">DRMSU</option></select>                                        <div id="workers__selector"><select name="worker_id[]" class="selectd" id="worker-id'+count+'" required><option value="S" >--- Selecione o Colaborador ---</option></select><div class="checklist__buttons2"><button class="checklist__remove removeWorkers"><i class="material-icons">remove</i></button></div></div></div>');
    });
    
    /********************************************
    *Remover a tag de checklist                 *
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
        $('#worker-id'+data_dpto_id).find('option').not(':first').remove();
        
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
                    $('#worker-id'+data_dpto_id).append('<option value="'+id+'" >'+nome+' '+sobrenome+'</option>');
                    
                }
            }
        });
    });
    
    /*********************************************
    *Botão para adicionar mais actividades ao    *
    *projecto                                    * 
    *********************************************/
    var addActivity = document.getElementById("addActivity");
    count = 1;
    addActivity.addEventListener('click', function(){
        count++;
        $('.activity').append('<div class="activity__box"><input type="text" class="activity__inputText" id="data-act_text'+count+'" name="act_text[]" placeholder="Nome da Actividade">                                       <input type="date" class="activity__inputDate" id="data-act_data'+count+'" name="act_data[]">                                        <input type="number" class="activity__inputNumber" id="data-act_number'+count+'" name="act_number[]" min="1" placeholder="Dias"><div class="checklist__buttons2"><button class="checklist__remove removeActivity" id="removeWorker"><i class="material-icons">remove</i></button></div></div>');
    });
    
    /********************************************
    *Remover a tag de actividades de projecto   *
    ********************************************/
    $(document).on('click', '.removeActivity', function(){
        $(this).closest('.activity__box').remove();
    });


    /******************************************
    *Mostrar a modal de actualizar o Projecto *
    ******************************************/
    var modal_updt_projecto = document.querySelector('.modal-update-projecto');
    var open_updtProject = document.querySelectorAll(".btn-open-updtProject");
    var close_updtProject = document.querySelector('.close-updtProject');
    
    function open_updtModal(){
        modal_updt_projecto.classList.toggle('show-updt-modal');
        projectoUpdt_id = this.id;
        $.ajax({
            url: '../includes/load_modal.php',
            method: 'post',
            data:{projectoUpdt_id:projectoUpdt_id},
            dataType:'json',
            beforeSend:function(){
                $('#loader').show();
            },
            success:function(data){
                
                $('#projectUpdtName').val(data.projecto_nome);
                CKEDITOR.instances.projectUpdt__context.setData(data.projecto_contexto, function(){
                    this.checkDirty();
                });
                CKEDITOR.instances.projectUpdt__mission.setData(data.projecto_missao, function(){
                    this.checkDirty();
                });
                CKEDITOR.instances.projectUpdt__goal.setData(data.projecto_objectivo, function(){
                    this.checkDirty();
                });
                CKEDITOR.instances.projectUpdt__metodology.setData(data.projecto_metodologia, function(){
                    this.checkDirty();
                });
                CKEDITOR.instances.projectUpdt__entregaveis.setData(data.projecto_entregaveis, function(){
                    this.checkDirty();
                });
                
                $('.riskUpdt').html(data.projecto_riscos);
                $('.addWorkersUpdt').html(data.projecto_membros);
                $('.activityUpdt').html(data.projecto_fases);
                $('#project_id').val(data.projecto_id);
                $('#responsavel_id').html(data.projecto_responsaveis);
            },
            complete:function(){
                $('#loader').hide();
            }
        });
    }
    
    for(var i=0; i < open_updtProject.length; i++){
        open_updtProject[i].addEventListener('click', open_updtModal);
    }
    
    /****************************************************
    *Script para adicionar riscos a modal de actualizar *
    *projectos                                          *
    ****************************************************/
    var addRiskUpdt = document.getElementById('addRiskUpdt');
    
    addRiskUpdt.addEventListener('click', function(){
        var risk__box = document.querySelectorAll('risk__box');
        var count = 0;
        
        if(count == 0){
            count = risk__box.length;
        }
        
        $('.riskUpdt').append('<div class="risk__box"><input type="text" class="activity__inputText" id="data-risk_nameUpdt'+count+'" name="risk_nameUpdt[]" placeholder="Nome do risco" required>                                    <input type="text" class="activity__inputText" id="data-risk_causeUpdt'+count+'" name="risk_causeUpdt[]" placeholder="Descrição do risco e causa" required>                                    <input type="text" class="activity__inputText" id="data-risk_impactUpdt'+count+'" name="risk_impactUpdt[]" placeholder="Impacto do risco"  required><input type="text" class="activity__inputText" id="data-risk_mitigationUpdt'+count+'" name="risk_mitigationUpdt[]" placeholder="Acção de Mitigação" required><input type="number" class="activity__inputNumber" id="data-risk_probUpdt'+count+'" name="risk_probUpdt[]" placeholder="Probabilidade" min="1" max="3" required><input type="number" class="activity__inputNumber" id="data-risk_impUpdt'+count+'" name="risk_impUpdt[]" placeholder="Impacto" min="1" max="3" required> <div class="checklist__buttons2"><button class="checklist__remove removeRisk" id="removeWorkerUpdt"><i class="material-icons">remove</i></button></div></div>');
        
        count++;
    });
    
    close_updtProject.addEventListener('click', open_updtModal);
    
    /********************************************
    *Script para adicionar colaboradores a equi-*
    *pe do projecto                             *
    ********************************************/
    var addWorkerUpdt = document.getElementById('addWorkerUpdt');
    var c = 1;
    addWorkerUpdt.addEventListener('click', function(){
        var workers = document.querySelectorAll('.workers');
        
        if(c == 1){
            c = workers.length +1;
        }
        
        $('.addWorkersUpdt').append('<div class="workers"><select name="worker_dptoUpdt[]" class="select selectUpdt" data-dpto_idupdt="'+c+'" required><option value="S">--- Selecione o Departamento ---</option><option value="CA">CA</option><option value="DACA">DACA</option><option value="DAFSG">DAFSG</option>                        <option value="DEETI">DEETI</option><option value="DEC">DEC</option><option value="DEGER">DEGER</option>                                    <option value="DFM">DFM</option><option value="DFMCR">DFMCR</option><option value="DRHTI">DRHTI</option>                                            <option value="DRMSU">DRMSU</option></select><div id="workers__selector"><select name="worker_idUpdt[]" class="selectd" id="worker-idupdt'+c+'" required ><option value="">--- Selecione o Colaborador ---</option></select><div class="checklist__buttons2"><button class="checklist__remove removeWorkers" id="removeWorker"><i class="material-icons">remove</i></button></div>                                    </div></div>');
        
        c++;
    });
    
    /********************************************
    *Botões do tab layout e suas funcionalidades* 
    *da modal de actualizar projectos           *
    ********************************************/
    var contentUpdt1 = document.getElementById('contentUpdt1');
    var contentUpdt2 = document.getElementById('contentUpdt2');
    var contentUpdt3 = document.getElementById('contentUpdt3');
    var contentUpdt4 = document.getElementById('contentUpdt4');
    var contentUpdt5 = document.getElementById('contentUpdt5');
    var contentUpdt6 = document.getElementById('contentUpdt6');

    var updt1 = document.getElementById('updt1');
    var updt2 = document.getElementById('updt2');
    var updt3 = document.getElementById('updt3');
    var updt4 = document.getElementById('updt4');
    var updt5 = document.getElementById('updt5');
    var updt6 = document.getElementById('updt6');

    function showNomeUpdt(){
        contentUpdt1.style.transform = "translateX(0)";
        contentUpdt2.style.transform = "translateX(200%)";
        contentUpdt3.style.transform = "translateX(200%)";
        contentUpdt4.style.transform = "translateX(200%)";
        contentUpdt5.style.transform = "translateX(200%)";
        contentUpdt6.style.transform = "translateX(200%)";
        updt6.classList.remove('tab__header--selected');
        updt5.classList.remove('tab__header--selected');
        updt4.classList.remove('tab__header--selected');
        updt3.classList.remove('tab__header--selected');
        updt2.classList.remove('tab__header--selected');
        updt1.classList.remove('tab__header--selected');
        updt1.classList.add('tab__header--selected');

    }

    function showMissaoUpdt(){
        contentUpdt1.style.transform = "translateX(-200%)";
        contentUpdt2.style.transform = "translateX(0)";
        contentUpdt3.style.transform = "translateX(200%)";
        contentUpdt4.style.transform = "translateX(200%)";
        contentUpdt5.style.transform = "translateX(200%)";
        contentUpdt6.style.transform = "translateX(200%)";
        updt6.classList.remove('tab__header--selected');
        updt5.classList.remove('tab__header--selected');
        updt4.classList.remove('tab__header--selected');
        updt3.classList.remove('tab__header--selected');
        updt2.classList.remove('tab__header--selected');
        updt1.classList.remove('tab__header--selected');
        updt2.classList.add('tab__header--selected');
    }

    function showMetodologiaUpdt(){
        contentUpdt1.style.transform = "translateX(-200%)";
        contentUpdt2.style.transform = "translateX(-200%)";
        contentUpdt3.style.transform = "translateX(0)";
        contentUpdt4.style.transform = "translateX(200%)";
        contentUpdt5.style.transform = "translateX(200%)";
        contentUpdt6.style.transform = "translateX(200%)";
        updt6.classList.remove('tab__header--selected');
        updt5.classList.remove('tab__header--selected');
        updt4.classList.remove('tab__header--selected');
        updt3.classList.remove('tab__header--selected');
        updt2.classList.remove('tab__header--selected');
        updt1.classList.remove('tab__header--selected');
        updt3.classList.add('tab__header--selected');
    }
    
    function showRiscosUpdt(){
        contentUpdt1.style.transform = "translateX(-200%)";
        contentUpdt2.style.transform = "translateX(-200%)";
        contentUpdt3.style.transform = "translateX(-200%)";
        contentUpdt4.style.transform = "translateX(0)";
        contentUpdt5.style.transform = "translateX(200%)";
        contentUpdt6.style.transform = "translateX(200%)";
        updt6.classList.remove('tab__header--selected');
        updt5.classList.remove('tab__header--selected');
        updt4.classList.remove('tab__header--selected');
        updt3.classList.remove('tab__header--selected');
        updt2.classList.remove('tab__header--selected');
        updt1.classList.remove('tab__header--selected');
        updt4.classList.add('tab__header--selected');
    }
    
    function showEquipaUpdt(){
        contentUpdt1.style.transform = "translateX(-200%)";
        contentUpdt2.style.transform = "translateX(-200%)";
        contentUpdt3.style.transform = "translateX(-200%)";
        contentUpdt4.style.transform = "translateX(-200%)";
        contentUpdt5.style.transform = "translateX(0)";
        contentUpdt6.style.transform = "translateX(200%)";
        updt6.classList.remove('tab__header--selected');
        updt5.classList.remove('tab__header--selected');
        updt4.classList.remove('tab__header--selected');
        updt3.classList.remove('tab__header--selected');
        updt2.classList.remove('tab__header--selected');
        updt1.classList.remove('tab__header--selected');
        updt5.classList.add('tab__header--selected');
    }
    
    function showCronogramaUpdt(){
        contentUpdt1.style.transform = "translateX(-200%)";
        contentUpdt2.style.transform = "translateX(-200%)";
        contentUpdt3.style.transform = "translateX(-200%)";
        contentUpdt4.style.transform = "translateX(-200%)";
        contentUpdt5.style.transform = "translateX(-200%)";
        contentUpdt6.style.transform = "translateX(0)";
        updt6.classList.remove('tab__header--selected');
        updt5.classList.remove('tab__header--selected');
        updt4.classList.remove('tab__header--selected');
        updt3.classList.remove('tab__header--selected');
        updt2.classList.remove('tab__header--selected');
        updt1.classList.remove('tab__header--selected');
        updt6.classList.add('tab__header--selected');
    }
    
    updt1.addEventListener('click',showNomeUpdt);
    updt2.addEventListener('click',showMissaoUpdt);
    updt3.addEventListener('click',showMetodologiaUpdt);
    updt4.addEventListener('click',showRiscosUpdt);
    updt5.addEventListener('click',showEquipaUpdt);
    updt6.addEventListener('click',showCronogramaUpdt);
    
    /************************************************
    *Carregar o select com os devidos colaboradores *               
    ************************************************/
    $(document).on('change', '.selectUpdt', function(){
        var worker_dptoID = $(this).val();
        var data_dpto_id = $(this).data('dpto_idupdt');
        $('#worker-idupdt'+data_dpto_id).find('option').not(':first').remove();
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
                    
                    $('#worker-idupdt'+data_dpto_id).append('<option value="'+id+'" >'+nome+' '+sobrenome+'</option>');
                }
            }
        });
    });
    
    /***********************************************
    *Script para adicionar fases na modal de actua-*
    *lizar projectos                               *
    ***********************************************/
    var addActivityUpdt = document.getElementById('addActivityUpdt');
    var cnt =1;
    addActivityUpdt.addEventListener('click', function(){
        var boxUpdt = document.querySelectorAll('.boxUpdt');
        
        if(cnt == 1){
            cnt = boxUpdt.length + 1;
        }
         
        $('.activityUpdt').append('<div class="activity__box boxUpdt"><input type="text" class="activity__inputText" id="data-act_textUpdt'+cnt+'" name="act_textUpdt[]" placeholder="Nome da Actividade">                                       <input type="date" class="activity__inputDate" id="data-act_dataUpdt'+cnt+'" name="act_dataUpdt[]">                                        <input type="number" class="activity__inputNumber" id="data-act_numberUpdt'+cnt+'" name="act_numberUpdt[]" min="1" placeholder="Dias"><div class="checklist__buttons2"><button class="checklist__remove removeActivity" id="removeWorker"><i class="material-icons">remove</i></button></div></div>');
        
        cnt++;
    });


/***********************************************
*Modal para abrir a modal de comentar projectos*
***********************************************/
var modal_comment_project = document.querySelector('.modal_comment_project');
var btn_open_comment_modal = document.querySelectorAll('.btn-open-comment-modal');
var close_comment_modal = document.querySelector('.close_comment_modal');
window.addEventListener("click", windowOnClick);

/*********************************
*Função para carregar comentários*
*na modal de criar comentários   *
*********************************/
function get_comments(id){
    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{get_comentario:id},
        dataType:'html',
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){
            $('#comment__holder').html(data);
        },
        complete:function(){
            $('#loader').hide();
        }
    });
}

/*********************************
*Função para carregar comentários*
*na modal de ver comentários     *
*********************************/
function get_comments2(id){
    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{get_comentarios:id},
        dataType:'html',
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){
            $('#comment__view__holder').html(data);
        },
        complete:function(){
            $('#loader').hide();
        }
    });
}

function open_comment_modal(){
    modal_comment_project.classList.toggle('show_comment_modal');
    var project_id = this.id;

    var comment_projecto = document.getElementById('comment_projecto');
    get_comments(project_id);
    $('#fase__selector').find('option').not(':first').remove();
    $.ajax({
        url:'../includes/read_data',
        method:'post',
        data:{get_fases:project_id},
        dataType:'json',
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){
            for(var i=0; i< data.length; i++){
                var fase_id = data[i].fase_id;
                var fase_nome = data[i].fase_nome;

                $('#fase__selector').append('<option value="'+fase_id+'">'+fase_nome+'</option>')
            }
        },
        complete:function(){
            $('#loader').hide();
        }
    });

    comment_projecto.addEventListener('click', function(){

        var comment = document.getElementById('comment').value;
        var fase_id = document.getElementById('fase__selector').value;
        if(comment != ''){
            console.log(fase_id);
            $.ajax({
                url:'../includes/insert_data',
                method:'post',
                data:{projecto:project_id,comment:comment,fase_id:fase_id},
                dataType:'json',
                beforeSend:function(){
                    $('#loader').show();
                },
                success:function(data){
                    var textarea = document.getElementById('comment');
                    textarea.value = '';
                    get_comments(project_id);
                    window.location.reload(true);
                },
                complete:function(){
                    $('#loader').hide();
                }
            });
        }    

    });
}

close_comment_modal.addEventListener('click', open_comment_modal);

for(var i=0; i<btn_open_comment_modal.length;i++){
    btn_open_comment_modal[i].addEventListener('click', open_comment_modal);
}

/********************************************
*Abrir Modal de vizualização de commentários*
*de projectos                               *
********************************************/
var open_comments = document.querySelectorAll('.btn-view-project-comments');
var modal_view_comments = document.querySelector('.modal_view_comments');
var close_comments = document.querySelector('.close-view-comments');

function open_view_comments(){
    modal_view_comments.classList.toggle('show-view-comments');
    var project_id = this.id;
    get_comments2(project_id);
}

close_comments.addEventListener('click',open_view_comments);

for(var i=0; i<open_comments.length;i++){
    open_comments[i].addEventListener('click',open_view_comments);
}

/******************************************
*Modal para ver detalhes do projecto      *
******************************************/
var modal_projecto = document.querySelector('.modal-project');
var btn_view_project = document.querySelectorAll('.btn-view-project');

function showProjectModal(){
    modal_projecto.classList.toggle("show-modal-project");
    var projecto_id = this.id;

    $.ajax({
        url: '../includes/load_modal.php',
        method: 'post',
        data:{projecto_id:projecto_id},
        dataType:'json',
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){

            $('#modal_view_pname').html(data.projecto_nome);
            $('#modal_view_pimage').html(data.projecto_imagem);
            $('#modal_view_pcontext').html(data.projecto_contexto);
            $('#modal_view_pmission').html(data.projecto_missao);
            $('#modal_view_pgoal').html(data.projecto_objectivo);
            $('#modal_view_pmetodology').html(data.projecto_metodologia);
            $('#modal_view_pentregaveis').html(data.projecto_entregaveis);
            $('#modal_view_priscos').html(data.projecto_riscos);
            $('#modal_view_pmembers').html(data.projecto_membros);
            $('#modal_view_pfases').html(data.projecto_fases);
            $('#modal_view_pfases_table').html(data.projecto_fases_table);

            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                var chart = am4core.create("modal_view_pfases", am4charts.XYChart);
                chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                chart.paddingRight = 30;
                chart.dateFormatter.inputDateFormat = "dd-MM-yyyy HH:mm"; //yyyy-MM-dd HH:mm

                var colorSet = new am4core.ColorSet();
                colorSet.saturation = 0.4;

                chart.data = data.projecto_fases;

                var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "name";
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.inversed = true;

                var d = new Date();
                var n = d.getFullYear()+1;

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.dateFormatter.dateFormat = "dd-MM-yyyy HH:mm"; //yyyy-MM-dd HH:mm
                dateAxis.renderer.minGridDistance = 70;
                dateAxis.baseInterval = { count: 30, timeUnit: "minute" };
                dateAxis.max = new Date(n, 0, 1, 24, 0, 0, 0).getTime();
                dateAxis.strictMinMax = true;
                dateAxis.renderer.tooltipLocation = 0;

                var series1 = chart.series.push(new am4charts.ColumnSeries());
                series1.columns.template.width = am4core.percent(80);
                series1.columns.template.tooltipText = "{name}: {openDateX} - {dateX}";

                series1.dataFields.openDateX = "fromDate";
                series1.dataFields.dateX = "toDate";
                series1.dataFields.categoryY = "name";
                series1.columns.template.propertyFields.fill = "color"; // get color from data
                series1.columns.template.propertyFields.stroke = "color";
                series1.columns.template.strokeOpacity = 1;

                chart.scrollbarX = new am4core.Scrollbar();

                }); // end am4core.ready()
        },
        complete:function(){
            $('#loader').hide();
        }
    });
}

for(var i=0 ; i< btn_view_project.length ; i++){
    btn_view_project[i].addEventListener("click",showProjectModal);
}

/****************************************************
*Comandos para aprovar ou recusar projectos
****************************************************/
var btn_approve_project = document.querySelectorAll(".btn-approve-project");
var btn_approve_project_concluded = document.querySelectorAll(".btn-approve-project-concluded");
var btn_deny_project = document.querySelectorAll(".btn-deny-project");
var btn_delete_project = document.querySelectorAll(".btn-delete-project");
var modal_delete = document.querySelector(".modal-delete");
var close_delProj_modal = document.querySelector(".close-button2");

function approve_project(){
    var approved_project = this.id;   
    $.ajax({
        url:"../includes/update_data.php",
        method:"post",
        data:{approved_project:approved_project},
        dataType:"text",
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){
            window.location.reload(true);
        },
        complete:function(){
            $('#loader').hide();
        }
    });
}

function approve_project_concluded(){
    var approved_project_concluded = this.id;   
    $.ajax({
        url:"../includes/update_data.php",
        method:"post",
        data:{approved_project_concluded:approved_project_concluded},
        dataType:"text",
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){
            window.location.reload(true);
        },
        complete:function(){
            $('#loader').hide();
        }
    });
}

function deny_project(){
    var denied_project = this.id;  
    $.ajax({
        url:"../includes/update_data.php",
        method:"post",
        data:{denied_project:denied_project},
        dataType:"text",
        beforeSend:function(){
            $('#loader').show();
        },
        success:function(data){
            window.location.reload(true);
        },
        complete:function(){
            $('#loader').hide();
        }
    });
}

for(var i=0; i < btn_approve_project.length; i++){
    btn_approve_project[i].addEventListener('click', approve_project);
}

for(var i=0; i < btn_approve_project_concluded.length; i++){
    btn_approve_project_concluded[i].addEventListener('click', approve_project_concluded);
}

for(var i=0; i < btn_deny_project.length; i++){
    btn_deny_project[i].addEventListener('click', deny_project);
}

/*******************************
*Função para eleminar projecto *
*******************************/
function open_delete_project(){
    document.getElementById('delProject').value = this.id;
    modal_delete.classList.toggle('show-modal2');
}

/**********************************************
*Comando para eliminar projecto               *
**********************************************/
for(var i=0; i < btn_delete_project.length; i++){
    btn_delete_project[i].addEventListener('click', open_delete_project);
}

//Commando para fechar a modal
close_delProj_modal.addEventListener('click', open_delete_project);

/***************************************
*Tab layout para os administradores    *
***************************************/
var matriz = document.getElementById('matriz');
var analise = document.getElementById('analise');
var conclusao = document.getElementById('conclusao');
var content1 = document.getElementById('content1');
var content2 = document.getElementById('content2');
var content3 = document.getElementById('content3');


function showMatriz(){
    content1.style.transform = "translateX(0)";
    content1.style.display="block";
    content1.style.visibility="visible";
    content2.style.transform = "translateX(200%)";
    content2.style.display="none";
    content2.style.visibility="hidden";
    content3.style.transform = "translateX(200%)";
    content3.style.display="none";
    content3.style.visibility="hidden";
    analise.classList.remove('tab__selected');
    conclusao.classList.remove('tab__selected');
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
    content3.style.transform = "translateX(200%)";
    content3.style.display="none";
    content3.style.visibility="hidden";
    matriz.classList.remove('tab__selected');
    conclusao.classList.remove('tab__selected');
    analise.classList.remove('tab__selected');
    analise.classList.add('tab__selected');
}

function showConclusao(){
    content1.style.transform = "translateX(-200%)";
    content1.style.display="none";
    content1.style.visibility="hidden";
    content2.style.transform = "translateX(-200%)";
    content2.style.display="none";
    content2.style.visibility="hidden";
    content3.style.transform = "translateX(0)";
    content3.style.display="block";
    content3.style.visibility="visible";
    analise.classList.remove('tab__selected');
    matriz.classList.remove('tab__selected');
    conclusao.classList.remove('tab__selected');
    conclusao.classList.add('tab__selected');
}

matriz.addEventListener('click', showMatriz);
analise.addEventListener('click', showAnalise);
conclusao.addEventListener('click', showConclusao);