
    /**********************************************************
    Srcipt para abrir a modal para criar formação
    **********************************************************/
    var modal = document.querySelector(".modal-formacao");
    var trigger = document.querySelector("#openFormacaoModal");
    var closeButton = document.querySelector(".close-button");

    function toggleModal() {
        modal.classList.toggle("show-modal");
    }

    function windowOnClick(event) {
        if (event.target === modal) {
            toggleModal();
        }
        
        if(event.target === modal_view_formation){
            show_viewFormation();
        }
        
        if(event.target == modal_edit_formation){
            show_editFormation();
        }
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
        content1.style.display= "block";
        content1.style.visibility="visible";
        content2.style.transform = "translateX(200%)";
        content2.style.display= "none";
        content2.style.visibility="hidden";
        content3.style.transform = "translateX(200%)";
        content3.style.display= "none";
        content3.style.visibility="hidden";
        
        tempo.classList.remove('tab__header--selected');
        participantes.classList.remove('tab__header--selected');
        detalhes.classList.remove('tab__header--selected');
        detalhes.classList.add('tab__header--selected');

    }

    function showFormacaoParticipantes(){
        content1.style.transform = "translateX(-200%)";
        content1.style.display= "none";
        content1.style.visibility="hidden";
        content2.style.transform = "translateX(0)";
        content2.style.display= "block";
        content2.style.visibility="visible";
        content3.style.transform = "translateX(200%)";
        content3.style.display= "none";
        content3.style.visibility="hidden";
        
        tempo.classList.remove('tab__header--selected');
        participantes.classList.remove('tab__header--selected');
        detalhes.classList.remove('tab__header--selected');
        participantes.classList.add('tab__header--selected');
    }

    function showFormacaoTempo(){
        content1.style.transform = "translateX(-200%)";
        content1.style.display= "none";
        content1.style.visibility="hidden";
        content2.style.transform = "translateX(-200%)";
        content2.style.display= "none";
        content2.style.visibility="hidden";
        content3.style.transform = "translateX(0)";
        content3.style.display= "block";
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
    
    for(var i=0; i < btn_view_formation.length; i++){
        btn_view_formation[i].addEventListener('click', show_viewFormation);
    }
    
    close_view_formation.addEventListener('click', show_viewFormation);
    
    var modal_edit_formation = document.querySelector('.modal-edit-formation');
    var close_edit_formation = document.querySelector('.close-edit-formation');
    var btn_edit_formation = document.querySelectorAll('.btn-edit-formation');
    
    function show_editFormation(){
        modal_edit_formation.classList.toggle('show-edit-formation');
        
        var formacao_id = this.id;
        $('#formacao__membrosupdt').find('.workers').remove();
        $.ajax({
            url:'../includes/load_modal.php',
            method:'post',
            data:{formacao_id:formacao_id},
            dataType:'json',
            success:function(data){
                $('#formacao__idupdt').val(data.formacao_id);
                $('#formacao__nomeupdt').val(data.formacao_nome);
                $('#formacao__entidadeupdt').val(data.formacao_entidade);
                $('#formacao__localupdt').val(data.formacao_local);
                $('#formacao__exameupdt').val(data.formacao_exame);
                $('#formacao__exame_dataupdt').val(data.formacao_exame_data);
                $('#formacao__custoupdt').val(data.formacao_custo);
                $('#formacao__inicioupdt').val(data.formacao_inicio_especial);
                $('#formacao__duracaoupdt').val(data.formacao_duracao);
                $('#formacao__hinicioupdt').val(data.formacao_hinicio);
                $('#formacao__hfimupdt').val(data.formacao_hfim);
                $('#formacao__gruposupdt').val(data.formacao_grupos);
                $('#fview__nmembros').html('0'+data.formacao_nmembros);
                
                for(var i = 0; i < data.formacao_membros.length; i++){
                    $('#formacao__membrosupdt').append('<div class="workers workers__updt"><select name="formacao__dptoupdt[]" data-dpto_idupdt="'+i+'" class="select selectupdt" required>              <option value="'+data.formacao_membros[i].usuario_departamento+'">'+data.formacao_membros[i].usuario_departamento+'</option><option value="DACA">DACA</option>                                       <option value="DAFSG">DAFSG</option><option value="DEETI">DEETI</option><option value="DEC">DEC</option>                           <option value="DEGER">DEGER</option><option value="DFM">DFM</option><option value="DFMCR">DFMCR</option>                           <option value="DRHTI">DRHTI</option><option value="DRMSU">DRMSU</option></select>                                        <select name="formacao__membroupdt[]" id="formacao__membroupdt'+i+'"  class="select" required><option value="'+data.formacao_membros[i].usuario_id+'">'+data.formacao_membros[i].usuario_nome+' '+data.formacao_membros[i].usuario_sobrenome+'</option></select><div class="add"><button class="removeWorkers"><i class="material-icons">remove</i></button>                                    </div></div>');
                }
                
            }
        });
    }
    
    for(i=0; i < btn_edit_formation.length; i++){
        btn_edit_formation[i].addEventListener('click',show_editFormation);
    }
    
    close_edit_formation.addEventListener('click',show_editFormation);
    
    /************************************************
    *Carregar o select com os devidos colaboradores *               
    ************************************************/
    $(document).on('change', '.selectupdt', function(){
        var worker_dptoID = $(this).val();
        var dpto_idupdt = $(this).data('dpto_idupdt');
        $('#formacao__membroupdt'+dpto_idupdt).find('option').remove();
        $.ajax({
            url: "../includes/read_data.php",
            method: "post",
            data:{worker_dptoID:worker_dptoID},
            dataType:"json",
            success:function(data){
                var size = data.length;
                console.log(data);
                for(var i = 0; i<size;i++){
                    var id = data[i]['usuario_id'];
                    var nome = data[i]['usuario_nome'];
                    var sobrenome = data[i]['usuario_sobrenome'];
                    $('#formacao__membroupdt'+dpto_idupdt).append('<option value="'+id+'" >'+nome+' '+sobrenome+'</option>');
                }
            }
        });
    });
    
    var addTagupdt = document.getElementById('addTagupdt');
    count = 1;
    
    addTagupdt.addEventListener('click', function(){
        var getworker_uptdId = document.querySelectorAll('.workers__updt');//selectdupdt
        if(count == 1){
           count = getworker_uptdId.length;
        }
        
       $('.add__updtworkers').append('<div class="workers workers__updt"><select name="formacao__dptoupdt[]" data-dpto_idupdt="'+count+'" class="select selectupdt"><option value="">--- Selecione o Departamento ---</option> <option value="DACA">DACA</option><option value="DAFSG">DAFSG</option>                                        <option value="DEETI">DEETI</option><option value="DEC">DEC</option><option value="DEGER">DEGER</option><option value="DFM">DFM</option><option value="DFMCR">DFMCR</option><option value="DRHTI">DRHTI</option><option value="DRMSU">DRMSU</option>                                    </select> <select name="formacao__membroupdt[]" id="formacao__membroupdt'+count+'" class="select"><option value="">--- Selecione o Colaborador ---</option></select><div class="add"><button class="removeWorkers"><i class="material-icons">remove</i></button>                                    </div></div>');
        
        count++;
    });
    
    /********************************************
    *Botões do tab layout e suas funcionalidades* 
    *da modal de actualizar formação            *
    ********************************************/
    var contentupdt1 = document.getElementById('contentupdt1');
    var contentupdt2 = document.getElementById('contentupdt2');
    var contentupdt3 = document.getElementById('contentupdt3');

    var detalhesupdt = document.getElementById('formacao__detalhesupdt');
    var participantesupdt = document.getElementById('formacao__participantesupdt');
    var tempoupdt = document.getElementById('formacao__tempoupdt');
    
    function showFormacaoDetalhesupdt(){
        contentupdt1.style.transform = "translateX(0)";
        contentupdt1.style.display= "block";
        contentupdt1.style.visibility="visible";
        contentupdt2.style.transform = "translateX(200%)";
        contentupdt2.style.display= "none";
        contentupdt2.style.visibility="hidden";
        contentupdt3.style.transform = "translateX(200%)";
        contentupdt3.style.display= "none";
        contentupdt3.style.visibility="hidden";
        
        tempoupdt.classList.remove('tab__header--selected');
        participantesupdt.classList.remove('tab__header--selected');
        detalhesupdt.classList.remove('tab__header--selected');
        detalhesupdt.classList.add('tab__header--selected');

    }

    function showFormacaoParticipantesupdt(){
        contentupdt1.style.transform = "translateX(-200%)";
        contentupdt1.style.display= "none";
        contentupdt1.style.visibility="hidden";
        contentupdt2.style.transform = "translateX(0)";
        contentupdt2.style.display= "block";
        contentupdt2.style.visibility="visible";
        contentupdt3.style.transform = "translateX(200%)";
        contentupdt3.style.display= "none";
        contentupdt3.style.visibility="hidden";
        
        tempoupdt.classList.remove('tab__header--selected');
        participantesupdt.classList.remove('tab__header--selected');
        detalhesupdt.classList.remove('tab__header--selected');
        participantesupdt.classList.add('tab__header--selected');
    }

    function showFormacaoTempoupdt(){
        contentupdt1.style.transform = "translateX(-200%)";
        contentupdt1.style.display= "none";
        contentupdt1.style.visibility="hidden";
        contentupdt2.style.transform = "translateX(-200%)";
        contentupdt2.style.display= "none";
        contentupdt2.style.visibility="hidden";
        contentupdt3.style.transform = "translateX(0)";
        contentupdt3.style.display= "block";
        contentupdt3.style.visibility="visible";
        
        participantesupdt.classList.remove('tab__header--selected');
        detalhesupdt.classList.remove('tab__header--selected');
        tempoupdt.classList.add('tab__header--selected');
    }
    
    detalhesupdt.addEventListener('click',showFormacaoDetalhesupdt);
    participantesupdt.addEventListener('click',showFormacaoParticipantesupdt);
    tempoupdt.addEventListener('click',showFormacaoTempoupdt);
    
    function add_action(){
        btn_view_formation = document.querySelectorAll('.btn-view-formation');
        btn_edit_formation = document.querySelectorAll('.btn-edit-formation');
        
        for(var i=0; i < btn_view_formation.length; i++){
            btn_view_formation[i].addEventListener('click', show_viewFormation);
        }
        
        for(i=0; i < btn_edit_formation.length; i++){
            btn_edit_formation[i].addEventListener('click',show_editFormation);
        }
        
    }
    
    var paginate_button = document.querySelectorAll('.paginate_button');
    
    for(var i=0; i < paginate_button.length; i++){
        paginate_button[i].addEventListener('click', add_action);
    }
