<!DOCTYPE html>
<?php
    require("../includes/conexao.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_tipo']=='tecnico')){
        $id = $_SESSION['usuario_id'];
        
        $query = "select * from tb_usuarios where usuario_id='$id'";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);
        
        $usuario_nome = $row['usuario_nome'];
        $usuario_sobrenome = $row['usuario_sobrenome'];
        $usuario_departamento = $row['usuario_departamento'];
        $usuario_login = $row['usuario_login'];
        $usuario_email = $row['usuario_email'];
        $usuario_contacto = $row['usuario_contacto'];
        $usuario_tipo = $row['usuario_tipo'];
    }else{
        header('location: ../403');
    }

    if(isset($_SESSION['usuario_id'])){
        if((time() - $_SESSION['ultimo_login']) > 1800){
            header("location: ../includes/logout.php");
        }else{
            $_SESSION['ultimo_login'] = time();
        }
    }

?>
<html lang="pt-PT">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="nucleo de desenvolvimento">
    <meta name="keywords" content="tarefas,tarefa,trabalho,colaborador,colaboradores">
    <meta name="description" content="pagina de tarefas, onde podem ser observadas as tarefas do departamento bem como as do colaborador sem esquecer o seu progresso">
    <meta name="theme-color" content="#3367D6">
    <link rel="apple-touch-icon" href="../imagens/icons/apple-touch-icon.png">
    <title>Área do Colaborador</title>
    <link rel="manifest" href="../manifest/manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/col_base.css">
    <link rel="stylesheet" href="../css/coming_soon.css">
    <link rel="stylesheet" href="../css/col_tarefas.css" />
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include("../includes/col_dashboard_navbar.php"); ?>
    
    <div class="container3">
       <h1 style="font-size:2.7rem;">Tarefas</h1>
    </div>
   
    <!-- ?php include("../includes/coming_soon.php");? -->
    
    <div class="container">
        <div class=".add--box">
            <button class="btn btn-bkg-darkBlue" id="openAddTarefa"><i class="material-icons">add</i><span>Adicionar</span></button>
        </div>
        
    </div>
    
    <div class="container">
            <div class="table_menu">
                <h2><i class="material-icons">assignment</i> Tarefas do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableTarefas">           
                <thead>
                    <tr>
                        <th width="20%">Tarefas</th>
                        <th width="15%">Prioridade</th>
                        <th width="15%">Início</th>
                        <th width="15%">Fim</th>
                        <th width="20%">Status</th>
                        <th width="10%">(%)</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_tarefas($db); ?>
                </tbody>
            </table>
        </div>
    
    <div class="container3">
        <div class="tasks">
            <!--   Tarefas em curso -->
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInAnalisys_counter($db)?></div>
                        <div class="task__header"><span>Tarefas em análise</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Lista de Tarefas</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInAnalisys($db);?>
                </div>
            </div>
            
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_ind</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInProgress_counter($db); ?></div>
                        <div class="task__header"><span>Tarefas em Curso</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Em Curso</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInProgress($db);?>
                    
                </div>
            </div>
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_late</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInRevision_counter($db);?></div>
                        <div class="task__header"><span>Tarefas em Revisão</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Em Revisão</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInRevision($db);?>
                    
                </div>
            </div>
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_turned_in</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksConcluded_counter($db); ?></div>
                        <div class="task__header"><span>Tarefas Conluídas</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Concluídas</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksConcluded($db);?>
                </div>
            </div>
            
        </div>
    </div>
    
    </section>
    
    <!----------------------------------------------
    Modal para adicionar tarefa
    ------------------------------------------------>
    <div class="modal-add-tarefa">
        <div class="modal-content">
            <form action="../includes/insert_data.php" method="post">
                <span class="close-button">×</span>
                <h1>Adicionar Tarefa</h1>
                <hr>
                <div class="modal__body">
                    
                    <div class="data_box">
                        <div class="task__label">
                            <span>Tarefa</span>
                        </div>
                        <div class="task__inputNameBox">
                            <input type="text" class="task__inputName" id="input_TaskName" name="input_TaskName" required>
                        </div>                   
                    </div>
                    <div class="data_box--around">
                        <div class="formation__card--32">
                            <div class="task__label">
                                <span>Prioridade</span>
                            </div>
                            <div class="task__inputNameBox">
                                <select name="task__priority" id="" class="task__prioritySelect" required>
                                    <option value="None">--- ---</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Média</option>
                                    <option value="Baixa">Baixa</option>
                                </select>
                            </div> 
                        </div>
                        <div class="formation__card--32">
                            <div class="task__label">
                                <span>Data - Início</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="date" class="task__inputDate" id="input_StartDate" name="input_StartDate" required>
                            </div> 
                        </div>
                        <div class="formation__card--32">
                            <div class="task__label">
                                <span>Data - Fim</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="date" class="task__inputDate" id="input_EndtDate" min="0" max="500" name="input_EndtDate" required>
                            </div> 
                        </div>
                    </div>
                    <div class="data_box">
                        <div class="task__label">
                            <span>Checklist</span>
                        </div>
                        <div class="task__inputNameBox--flex">
                            <div class="checklist addCheck">
                                <input type="text" class="task__checklistAdd"  name="input_checklistAdd[]" required>
                            </div>
                            <div class="checklist__buttons">
                                <button class="checklist__add" id="addTaskList"><i class="material-icons">add</i></button>
                                <button class="checklist__add" id="removeTaskList"><i class="material-icons">remove</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="data_box">
                        <div class="task__label">
                            <span>Membros</span>
                        </div>
                        <div class="task__inputNameBox--flex"> 
                            <div class="checklist addWorkers">
                                <div class="workers">
                                    <select name="worker_dpto[]" class="select" data-dpto_id="1" required> <!--//onchange="load__worker(this.value);"-->
                                        <option value="S">--- Selecione o Departamento ---</option>
                                        <option value="DACA">DACA</option>
                                        <option value="DAFSG">DAFSG</option>
                                        <option value="DEETI">DEETI</option>
                                        <option value="DEC">DEC</option>
                                        <option value="DEGER">DEGER</option>
                                        <option value="DFM">DFM</option>
                                        <option value="DFMCR">DFMCR</option>
                                        <option value="DRHTI">DRHTI</option>
                                        <option value="DRMSU">DRMSU</option>
                                    </select>
                                    
                                    <div id="workers__selector">
                                        <select name="worker_id[]" class="selectd" id="worker-id1" required >
                                            <option value="">--- Selecione o Colaborador ---</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="checklist__buttons">
                                <button class="checklist__add" id="addWorker" type="button"><i class="material-icons">add</i></button>
                            </div> 
                        </div>
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="add_tarefa" id="add_tarefa">Adicionar</button>
                    </div>
                </div>
                 
            </form>
             
        </div>
    </div>
    
    <!----------------------------------------------
    Modal para visualizar tarefa
    ------------------------------------------------>
    <div class="modal__view__tarefa">
        <div class="modal-content">
            <span class="close__modal__tarefa">×</span>
            <h1>Tarefa</h1>
            <hr>
            <div class="modal__body">
                <?php include('../includes/loader.php')?>
                <div class="data_box">
                    <div class="task__labelTitle">
                        <span id="task__labelTitle">Fazer o Jantar</span>
                    </div>                   
                </div>
                <div class="task__holder">
                    <div class="task--flex">
                        <div class="task__box">
                            <div class="task__label">
                                <span>Prioridade</span>
                            </div>
                            <div class="task__info">
                                <span id="task__viewPriority">Alta</span>
                            </div>
                        </div>
                        <div class="task__box">
                            <div class="task__label">
                                <span>Início</span>
                            </div>
                            <div class="task__info">
                                <span id="task__viewStart">03/07/2020</span>
                            </div>
                        </div>
                        <div class="task__box">
                            <div class="task__label">
                                <span>Fim</span>
                            </div>
                            <div class="task__info">
                                <span id="task__viewEnd">03/07/2020</span>
                            </div>
                        </div>
                        <div class="task__box">
                            <div class="task__label">
                                <span>Status</span>
                            </div>
                            <div class="task__info">
                                <span id="task__viewStatus">Em analise</span>
                            </div>
                        </div>
                        <div class="task__box">
                            <div class="task__label">
                                <span>(%)</span>
                            </div>
                            <div class="task__info">
                                <span id="task__viewPercent">100%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="task--flex">
                    <div class="data_box">
                        <div class="task__label">
                            <span>Cheklist</span>
                        </div>
                        <div class="task__listBox">
                            <ul class="task__modalList" id="task__viewChecklist">
                                <li>Checar a lista</li>
                                <li>Verificar dinheiro</li>
                                <li>Fazer as compras</li>
                            </ul>
                        </div>
                    </div>
                    <div class="data_box">
                        <div class="task__label">
                            <span>Membros</span>
                        </div>
                        <div class="task__listBox">
                            <ul class="task__modalList" id="task__viewMembers">
                                <li>Checar a lista</li>
                                <li>Verificar dinheiro</li>
                                <li>Fazer as compras</li>
                            </ul>
                        </div>                  
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!----------------------------------------------
    Modal para editar tarefa
    ------------------------------------------------>
    <div class="modal-update-tarefa">
        <div class="modal-content">
            <form action="../includes/update_data.php" method="post"> <!--  -->
                <span class="close-updateTpc">×</span>
                <h1>Actualizar Tarefa</h1>
                <hr>
                <div class="modal__body--height">
                    <div class="data_box">
                        <div class="task__label">
                            <span>Tarefa</span>
                        </div>
                        <div class="task__inputNameBox">
                            <input type="text" class="task__inputName" id="input_uptdTaskName" name="input_uptdTaskName" required>
                        </div>                   
                    </div>
                    <div class="data_box--around">
                        <div class="formation__card--32">
                            <div class="task__label">
                                <span>Prioridade</span>
                            </div>
                            <div class="task__inputNameBox">
                                <select name="task__uptdPriority" id="task__uptdPriority" class="task__prioritySelect" required>
                                    <option value="None">--- ---</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Média</option>
                                    <option value="Baixa">Baixa</option>
                                </select>
                            </div> 
                        </div>
                        <div class="formation__card--32">
                            <div class="task__label">
                                <span>Data - Início</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="date" class="task__inputDate" id="input_uptdStartDate" name="input_uptdStartDate" required>
                            </div> 
                        </div>
                        <div class="formation__card--32">
                            <div class="task__label">
                                <span>Data - Fim</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="date" class="task__inputDate" id="input_uptdEndtDate" min="0" max="500" name="input_uptdEndtDate" required>
                            </div> 
                        </div>
                    </div>
                    <div class="data_box">
                        <div class="task__label">
                            <span>Checklist</span>
                        </div>
                        <div class="task__inputNameBox--flex">
                            <div class="checklist updtCheck" id="task__uptdChecklist">
                                <input type="text" class="task__checklistUpdt"  name="input_uptdChecklistAdd[]" required>
                            </div>
                            <div class="checklist__buttons">
                                <button class="checklist__add" id="addTaskUptdList"><i class="material-icons">add</i></button>
                                <button class="checklist__add" id="removeTaskUptdList" type="button"><i class="material-icons">remove</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="data_box">
                        <div class="task__label">
                            <span>Membros</span>
                        </div>
                        <div class="task__inputNameBox--flex"> 
                            <div class="checklist addWorkersUptd">
                                <div class="workers" id="task__uptdMembers">
                                    <select name="worker_uptdDpto[]" class="selectUptd" data-dpto_id="1" required>
                                        <option value="S">--- Selecione o Departamento ---</option>
                                        <option value="DACA">DACA</option>
                                        <option value="DAFSG">DAFSG</option>
                                        <option value="DEETI">DEETI</option>
                                        <option value="DEC">DEC</option>
                                        <option value="DEGER">DEGER</option>
                                        <option value="DFM">DFM</option>
                                        <option value="DFMCR">DFMCR</option>
                                        <option value="DRHTI">DRHTI</option>
                                        <option value="DRMSU">DRMSU</option>
                                    </select>
                                    
                                    <div id="workers__selector">
                                        <select name="worker_uptdId[]" class="selectdUptd" id="worker-idUptd" required >
                                            <option value="">--- Selecione o Colaborador ---</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="checklist__buttons">
                                <button class="checklist__add" id="uptdWorker" type="button"><i class="material-icons">add</i></button>
                            </div> 
                        </div>
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="uptd_tarefa" id="uptd_tarefa">Actualizar</button>
                    </div>
                    <input type="hidden" id="task_id" name="task_id">
                </div>
            </form>
             
        </div>
    </div>
    
    <!--------------------------------------------------
    Modal para eliminar tarefa
    --------------------------------------------------->
    <div class="modal-delete">
        <div class="modal-content2">
            <form action="../includes/delete_data.php" method="post">
                <span class="close-button2">×</span>
                <h1>Eliminar Tarefa</h1>
                <hr>
                <div class="modal__body2">
                    <div class="question">
                        <span>Tem mesmo a certeza que deseja eliminar esta tarefa ?</span>
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-red" name="deletar_task">Confirmar</button>
                    </div>
                </div>
                <input type="hidden" id="delTask" name="delTask"> 
            </form>
             
        </div>
    </div>
    
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/table.js"></script>
    <script src="../js/col_tarefas.js"></script>
    <script src="../js/registerSW.js"></script>
    
    <script>
        /*****************************************************
        *Script para trocar as cores em função das priorida -*
        *des
        *****************************************************/
        document.querySelectorAll('.task__priority').forEach(i => {
            i.textContent.indexOf("Alta") !== -1 ?
            i.classList.add('red') :
            i.innerText.indexOf("Media") !== -1 ?
            i.classList.add('orange') :
            i.innerText.indexOf("Baixa") !== -1 ?
            i.classList.add('blue') :
            null;
        });
    </script>
    
    <script>
        /*******************************************************
        *Script para actualizar o estado da checklist se foi   *
        *feita ou não                                          *
        *******************************************************/
        $(".toDo").on('click', function(){
            var checklistvalue = document.getElementById('task-'+this.id).value;
            $.ajax({
                url:"../includes/update_data.php",
                method:"post",
                data:{checklistvalue:checklistvalue},
                dataType:'json',
                beforeSend:function(){
                    $('#loader').show();
                },
                success:function(data){
                    window.location.reload('true');
                },
                complete:function(){
                  $('#loader').hide();  
                },
                error:function(err){
                    window.location.reload('true');
                }
            });
            
        });
    </script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
