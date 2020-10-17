<!DOCTYPE html>
<?php 
    include("../includes/conexao.php");
    require("../includes/acessos.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

    $id = 0;
    $dataPoints = array();

    if(isset($_SESSION['usuario_id']) &&(($_SESSION['usuario_dpto'] != "DRHTI") && ($_SESSION['usuario_dpto'] != "ADMIN") && ($_SESSION['usuario_tipo'] != "tecnico") && ($_SESSION['usuario_tipo'] != "admin")) ){
        $id = $_SESSION['usuario_id'];
        
        $query = "select * from tb_usuarios where usuario_id='$id'";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);
        
        $usuario_nome = $row['usuario_nome'];
        $usuario_sobrenome = $row['usuario_sobrenome'];
        $usuario_departamento = $row['usuario_departamento'];
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
<html lang="pt-pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Colaborador - Tarefas</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/col_tarefas.css">
    <link rel="stylesheet" href="../css/tarefas.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>        
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/dashboard_chefdpto.php'); ?>
    <br>
    <br>
    <br>
    <section class="content">
       
        <div class="container">
            <div class=".add--box">
                <button class="btn-normal btn-bkg-darkBlue" id="openAddTarefa"><i class="material-icons">add</i><span>Adicionar</span></button>
            </div>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">assignment</i> Tarefas do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableTarefas">           
                <thead>
                    <tr>
                        <th width="20%">Tarefas</th>
                        <th width="10%">Prioridade</th>
                        <th width="15%">Início</th>
                        <th width="15%">Fim</th>
                        <th width="15%">Status</th>
                        <th width="10%">(%)</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_tarefas_chedDpto($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">assignment</i> Tarefas em revisão do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tarefasEmRevisao">           
                <thead>
                    <tr>
                        <th width="25%">Tarefas</th>
                        <th width="10%">Prioridade</th>
                        <th width="15%">Início</th>
                        <th width="15%">Fim</th>
                        <th width="15%">Status</th>
                        <th width="10%">(%)</th>
                        <th width="10%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_tarefas_chedDpto_revisao($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tarefasPorUsuario">           
                <thead>
                    <tr>
                        <th width="25%">Nome</th>
                        <th width="9%">Prio. Alta</th>
                        <th width="9%">Prio. Média</th>
                        <th width="9%">Prio. Baixa</th>
                        <th width="9%">Por iniciar</th>
                        <th width="9%">Em curso</th>
                        <th width="9%">Em revisão</th>
                        <th width="9%">Concluídas</th>
                        <th width="9%">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_tarefas_per_user($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="todasTarefas">           
                <thead>
                    <tr>
                        <th width="15%">Tarefas</th>
                        <th width="15%">Nome</th>
                        <th width="15%">Prioridade</th>
                        <th width="15%">Inicio</th>
                        <th width="15%">Fim</th>
                        <th width="15%">Status</th>
                        <th width="10%">(%)</th>
                        <th width="10%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_allUser_tasks($db); ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <!----------------------------------------------
    Modal para visualizar tarefa
    ------------------------------------------------>
    <div class="modal__view__tarefa">
        <div class="modal-content">
            <span class="close__modal__tarefa">×</span>
            <h1>Tarefa</h1>
            <hr>
            <div class="modal__body">
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
    
    <!--script src="./js/check_token.js"></script -->
    <script src="../js/table.js"></script>
    <script src="../js/tarefas.js"></script>
    <script src="../js/hamburger.js"></script>
    <script>
        $(document).ready(function(){
            
            setInterval(function(){
                update_profile();
            }, 3000);
            
            function update_profile(){
                $.ajax({
                    url:'../includes/update_profile.php',
                    method:'post',
                    type:'text',
                    success:function(data){
                        
                    }
                });
            }
        });
    </script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
