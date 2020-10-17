<!DOCTYPE html>
<?php
    require("../includes/conexao.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_tipo']=='admin')){
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
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Colaborador - Formações</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/col_formacoes.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/dashboard_ca.php'); ?>
    <br>
    <br>
    <br>
    <section class="content">
        <div class="container3">
            <div class="tab__buttons">
                <button id="matriz" class="tab tab__selected" type="button"><i class="material-icons">list</i> Formações p/ Departamento</button>
                <button id="analise" class="tab" type="button"><i class="material-icons">find_in_page</i> Formações em Análise</button>
            </div>
        </div>
        
        <?php include('../includes/ca_formacoes_body.php'); ?>
    </section>
    
    
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
    <script src="../js/ca_formacoes.js"></script>
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
