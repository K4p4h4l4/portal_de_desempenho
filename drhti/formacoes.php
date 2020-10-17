<!DOCTYPE html>
<?php 
    include("../includes/conexao.php");
    require("../includes/acessos.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

    $id = 0;
    $dataPoints = array();

    if(isset($_SESSION['usuario_id']) &&(($_SESSION['usuario_dpto'] == "DRHTI") && ($_SESSION['usuario_dpto'] != "ADMIN") && ($_SESSION['usuario_tipo'] != "tecnico") && ($_SESSION['usuario_tipo'] != "admin") ) ){
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
    <title>Portal do Colaborador - Formações</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/col_formacoes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>    
    
</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include('../includes/dashboard_rh.php'); ?>
    <br>
    <br>
    <br>
    
    <section class="content">
        <!--div class="container">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações aprovadas do < ?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoes">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    < ?php listar_formacoes_dpto($db);  ? >
                </tbody>
            </table>
        </div-->
        <div class="container3">
            <div class="tab__buttons">
                <button id="matriz" class="tab tab__selected" type="button"><i class="material-icons">school</i> Formações do Departamento</button>
                <button id="analise" class="tab" type="button"><i class="material-icons">library_books</i> Formações p/ Aprovação</button>
            </div>
        </div>
        <div class="tab__content">
            <div id="content11" class="content__tab">
                <div class="container">
                    <div class=".add--box">
                        <button class="btn-normal btn-bkg-darkBlue" id="openFormacaoModal"><i class="material-icons">add</i><span>Adicionar</span></button>
                    </div>
                </div>
                
                <div class="container animate__moveInBottom">
                    <div class="table_menu">
                        <h2><i class="material-icons">school</i> Formações do <?php echo $usuario_departamento; ?> - Andamento</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableFormacoesAndamento">           
                        <thead>
                            <tr>
                                <th width="15%">Formação</th>
                                <th width="5%">Entidade</th>
                                <th width="15%">Local</th>                        
                                <th width="5%">Duração</th>
                                <th width="7%">Início</th>
                                <th width="7%">Horário</th>
                                <th width="7%">Chef. Dpto</th>
                                <th width="7%">Admin</th>
                                <th width="7%">DRHTI</th>
                                <th width="5%"><i class="material-icons">settings</i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php listar_allformacoes_dpto($db);  ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="container animate__moveInBottom">
                    <div class="table_menu">
                        <h2><i class="material-icons">school</i> Formações em análise do <?php echo $usuario_departamento; ?></h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableFormacoesApproval">           
                        <thead>
                            <tr>
                                <th width="15%">Formação</th>
                                <th width="5%">Entidade</th>
                                <th width="15%">Local</th>                        
                                <th width="5%">Duração</th>
                                <th width="7%">Início</th>
                                <th width="7%">Horário</th>
                                <th width="7%">Chef. Dpto</th>
                                <th width="5%"><i class="material-icons">settings</i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php listar_formacoes_para_aprovacaoChef($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="content22" class="content__tab">
                <div class="container animate__moveInBottom">
                    <div class="table_menu">
                        <h2><i class="material-icons">school</i> Formações p/ aprovação(Outros departamentos)</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableFormacoesApprovalOtherDpto">           
                        <thead>
                            <tr>
                                <th width="15%">Departamento</th>
                                <th width="15%">Formação</th>
                                <th width="5%">Entidade</th>
                                <th width="15%">Local</th>                        
                                <th width="5%">Duração</th>
                                <th width="7%">Início</th>
                                <th width="7%">Horário</th>
                                <th width="7%">RH</th>
                                <th width="5%"><i class="material-icons">settings</i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php listar_formacoes_para_aprovacao_outros_dpto($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </section>
    
    <!------------------------------- 
       Modal para adicionar formação 
    --------------------------------->
    <div class="modal-formacao">
        <div class="modal-content">
            <form action="../includes/insert_data" method="post">
                <span class="close-button">×</span>
                <h1>Adicionar Formação</h1>
                <hr>
                <div class="modal__body">
                    <div class="tab__buttons">
                        <button id="formacao__detalhes" class="tab__header tab__header--selected" type="button">Formação</button>
                        <button id="formacao__participantes" class="tab__header" type="button" >Colaboradores</button>
                        <button id="formacao__tempo" class="tab__header" type="button" >Tempo</button>
                    </div>
                    <div class="tab__content">
                        <div class="content__tab" id="content1">
                            <div class="formation">
                                <span class="formation__details">Formação</span>
                                <input type="text" name="formacao__nome" class="formation__name__input" id="formacao__nome" placeholder="Nome da Formação" required>
                                
                            </div>
                            <div class="formation">
                                <span class="formation__details">Entidade</span>
                                <input type="text" name="formacao__entidade" class="formation__details__input" id="formacao__entidade" placeholder="Nome da Entidade" required>
                            </div>
                            <div class="formation">
                                <span class="formation__details">Local</span>
                                <input type="text" name="formacao__local" class="formation__details__input" id="formacao__local" placeholder="Local da Formação" required>
                            </div>
                            <div class="formation">
                                <span class="formation__details">Custo</span>
                                <input type="number" name="formacao__custo" class="formation__details__input" id="formacao__custo" min="0" max="100000000" placeholder="AOA" required>
                            </div>
                            <div class="formation">
                                <span class="formation__details">Tipo de Formação</span>
                                <input type="text" name="formacao__tipo" class="formation__details__input" id="formacao__tipo">
                            </div>
                        </div>
                        <div class="content__tab" id="content2">
                            <div class="formation">
                                <span class="formation__details">Nº de Grupos</span>
                                <input type="number" name="formacao__grupos" class="formation__details__input" id="formacao__grupos" min="1" max="10" placeholder="Nº de grupos para Formação">
                            </div>
                            <div class="formation">
                                <span class="formation__details">Participantes</span>
                                <div class="workers__card">
                                   <div class="add__workers">
                                       <div class="workers">
                                        <select name="formacao__dpto[]" data-dpto_id="1" class="select" required>
                                            <option value="">-- Seleccione o Departamento --</option>
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
                                        <select name="formacao__membro[]" id="formacao__membro1"  class="select" required>
                                            <option value="">-- Seleccione o Colaborador --</option>
                                        </select>
                        
                                    </div>
                                   </div>
                                    
                                    <div class="add">
                                        <button class="btn-blue" id="addTag"><i class="material-icons">add</i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <div class="content__tab" id="content3">
                            <div class="formation--flex">
                                <div class="formation__card--49">
                                    <span class="formation__details">Início</span>
                                    <input type="date" name="formacao__inicio" class="formation__details__input" id="formacao__inicio" required>
                                </div>
                                <div class="formation__card--49">
                                    <span class="formation__details">Duração da Formação</span>
                                    <input type="number" name="formacao__duracao" class="formation__details__input" id="formacao__duracao" min="1" max="30" placeholder="Dias" required>
                                </div>
                                
                            </div>
                            <div class="formation--flex">
                                <div class="formation__card--49">
                                    <span class="formation__details">Horário - Início</span>
                                    <input type="time" name="formacao__hinicio" class="formation__details__input" id="formacao__hinicio" required>
                                </div>
                                <div class="formation__card--49">
                                    <span class="formation__details">Horário - Término</span>
                                    <input type="time" name="formacao__hfim" class="formation__details__input" id="formacao__hfim" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="add_formacao" id="add_formacao" value="add_formacao">Adicionar</button>
                    </div>
                </div>
                <input type="hidden" id="" name=""> 
            </form>
             
        </div>
    </div>
    
    <!--------------------------------------
      Modal para visualizaar detalhes da 
      formação 
    --------------------------------------->
    <div class="modal-view-formation">
        <div class="modal-content">
            <span class="close-view-formation">×</span>
            <h1>Detalhes de Formação</h1>
            <hr>
            <div class="modal__body">
                <div class="data__holder">
                    <div class="data-box">
                        <div class="title__box">
                            <span>Formação</span>
                        </div>
                        <div class="text">
                            <span id="fview__nome">CCNA Routing & Switching</span>
                        </div>
                    </div>
                </div>
                <div class="data__holder--flex">
                    <div class="data-box">
                        <div class="title__box">
                            <span>Entidade</span>
                        </div>
                        <div class="text">
                            <span id="fview__entidade">Multiredes</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Local</span>
                        </div>
                        <div class="text">
                            <span id="fview__local">INACOM</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Exame</span>
                        </div>
                        <div class="text">
                            <span id="fview__exame">Não concluído</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Exame Data</span>
                        </div>
                        <div class="text">
                            <span id="fview__exame__data">21/04/1997</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Custo</span>
                        </div>
                        <div class="text">
                            <span id="fview__custo">AOA 880.000</span>
                        </div>
                    </div>
                    
                </div>
                
                <div class="data__holder--flex">
                    <div class="data-box">
                        <div class="title__box">
                            <span>Departamento</span>
                        </div>
                        <div class="text">
                            <span id="fview__dpto">DEETI</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Inicio</span>
                        </div>
                        <div class="text">
                            <span id="fview__inicio">09-03-2020</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Duração</span>
                        </div>
                        <div class="text">
                            <span id="fview__duracao">5 dias</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Fim</span>
                        </div>
                        <div class="text">
                            <span id="fview__fim">14-03-2020</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Horário</span>
                        </div>
                        <div class="text">
                            <span id="fview__horario">08:00-17:00</span>
                        </div>
                    </div>
                    
                </div>
                
                <div class="data__holder--flex">
                    <div class="data-box">
                        <div class="title__box">
                            <span>Nº de Grupos</span>
                        </div>
                        <div class="text">
                            <span id="fview__grupos">01</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Nº de Participantes</span>
                        </div>
                        <div class="text">
                            <span id="fview__nmembros">03</span>
                        </div>
                    </div>
                    <div class="data-box">
                        <div class="title__box">
                            <span>Colaboradores</span>
                        </div>
                        <div class="text">
                            <ul class="formation__col" id="fview__membros">
                                <li>Benedito Calulo</li>
                                <li>Isabel Jorge</li>
                                <li>Manuel Domingos</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <!--------------------------------------------------
    Modal para eliminar tarefa
    --------------------------------------------------->
    <div class="modal-delete">
        <div class="modal-content2">
            <form action="../includes/delete_data.php" method="post">
                <span class="close-button2">×</span>
                <h1>Eliminar Formação</h1>
                <hr>
                <div class="modal__body2">
                    <div class="question">
                        <span>Tem mesmo a certeza que deseja eliminar esta formação ?</span>
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-red" name="deletar_formacao">Confirmar</button>
                    </div>
                </div>
                <input type="hidden" id="delFormation" name="delFormation"> 
            </form>   
        </div>
    </div>
    
    <script src="../js/table.js"></script>
    <script src="../js/formacoes_rh.js"></script>
    <script src="../js/formacoes.js"></script>    
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
    
</body>
</html>
