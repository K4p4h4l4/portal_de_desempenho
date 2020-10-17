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

    $corrida_goal = 0;
    $corrida_state = 0;
    $corrida_id = 0;
    $corrida_data = read_corrida_data($db);
    if($corrida_data != null){
        $corrida_goal = $corrida_data['corrida_goal'];
        $corrida_state = $corrida_data['corrida_state'];
        $corrida_id = $corrida_data['corrida_id'];
    }

    $exercicio_goal = 0;
    $exercicio_state = 0;
    $exercicio_id = 0;
    $exercicio_data = read_exercicio_data($db);
    if($exercicio_data != null){
        $exercicio_goal = $exercicio_data['exercicio_goal'];
        $exercicio_state = $exercicio_data['exercicio_state'];
        $exercicio_id = $exercicio_data['exercicio_id'];
    }

    $desporto_goal = 0;
    $desporto_state = 0;
    $desporto_id = 0;
    $desporto_data = read_desporto_data($db);
    if($desporto_data != null){
        $desporto_goal = $desporto_data['desporto_goal'];
        $desporto_state = $desporto_data['desporto_state'];
        $desporto_id = $desporto_data['desporto_id'];
    }

    $ciclismo_goal = 0;
    $ciclismo_state = 0;
    $ciclismo_id = 0;
    $ciclismo_data = read_ciclismo_data($db);
    if($ciclismo_data != null){
        $ciclismo_goal = $ciclismo_data['ciclismo_goal'];
        $ciclismo_state = $ciclismo_data['ciclismo_state'];
        $ciclismo_id = $ciclismo_data['ciclismo_id'];
    }



?>

<html lang="pt-PT">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Colaborador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="../css/av.css">  
    <!--link rel="stylesheet" href="../css/col_base.css"-->
    <link rel="stylesheet" href="../css/col_saude.css">
    <link rel="stylesheet" href="../css/coming_soon.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
    
</head>

<body>
    <?php include('../includes/dashboard_ca.php'); ?>
    <br>
    <br>
    <br>
    <!--?php include("../includes/coming_soon.php");?-->
    <section class="content">
        <div class="container4">
            <div class="healthBox">
                <div class="messageBox">
                    <span>A saúde traz vigor, disposição e bem-estar na rotina de uma pessoa, além de garantir mais anos de vida.Então, acompanhe as nossas dicas que farão você manter a sua saúde em dia, para aproveitar os melhores momentos ao lado de si mesmo e da sua família.</span>
                </div>
                <div class="imageBox">
                    <img src="../imagens/teste/vegetables-1212845_1920.jpg" alt="">
                </div>
            </div>
        </div>
        
        <div class="container3">
            <div class="activities">
                <div class="myactivity">
                    <div class="myactivity--title">
                        <span>Objectivos da semana</span>
                    </div>
                    <div class="activity--data">
                        <div class="activity-flex">
                            <div class="activity--icon">
                                <i class="material-icons">directions_run</i>
                            </div>
                            <div class="activity--details">
                                <span>Corrida</span>
                                <p></p>
                            </div>
                        </div>
                        
                        <div class="activity--progress">
                            <span id="myCurRunState" class="myState"><?php echo $corrida_state." KM"; ?></span><span class="myGoal" id="myRunningGoal"><?php echo $corrida_goal." KM"; ?></span>
                            
                            <div class="progress--bar">
                                <div class="current--progress"></div>
                            </div>
                        </div>
                    </div>
                    <div class="activity--footer">
                        <div class="activity--actions">
                            <button id="addRunGoal"><i class="material-icons">add</i></button>
                            <button id="runGoal"><i class="material-icons">edit</i></button>
                        </div>
                    </div>
                </div>
                
                <div class="myactivity">
                    <div class="myactivity--title">
                        <span>Objectivos da semana</span>
                    </div>
                    <div class="activity--data">
                        <div class="activity-flex">
                            <div class="activity--icon">
                                <i class="material-icons">fitness_center</i>
                            </div>
                            <div class="activity--details">
                                <span>Exercícios</span>
                                <p></p>
                            </div>
                        </div>
                        
                        <div class="activity--progress">
                            <span class="myState"><?php echo $exercicio_state." Min"; ?></span><span class="myGoal"><?php echo $exercicio_goal." Min"; ?></span>
                            <div class="progress--bar">
                                <div class="current--progress"></div>
                            </div>
                        </div>
                    </div>
                    <div class="activity--footer">
                        <div class="activity--actions">
                            <button id="addExGoal"><i class="material-icons">add</i></button>
                            <button id="exGoal"><i class="material-icons">edit</i></button>
                        </div>
                    </div>
                </div>
                
                <div class="myactivity">
                    <div class="myactivity--title">
                        <span>Objectivos da semana</span>
                    </div>
                    <div class="activity--data">
                        <div class="activity-flex">
                            <div class="activity--icon">
                                <i class="material-icons">pool</i>
                            </div>
                            <div class="activity--details">
                                <span>Desporto</span>
                                <p></p>
                            </div>
                        </div>
                        
                        <div class="activity--progress">
                            <span class="myState"><?php echo $desporto_state." Min"; ?></span><span class="myGoal"><?php echo $desporto_goal." Min"; ?></span>
                            <div class="progress--bar">
                                <div class="current--progress"></div>
                            </div>
                        </div>
                    </div>
                    <div class="activity--footer">
                        <div class="activity--actions">
                            <button id="addDespGoal"><i class="material-icons">add</i></button>
                            <button id="despGoal"><i class="material-icons">edit</i></button>
                        </div>
                    </div>
                </div>
                
                <div class="myactivity">
                    <div class="myactivity--title">
                        <span>Objectivos da semana</span>
                    </div>
                    <div class="activity--data">
                        <div class="activity-flex">
                            <div class="activity--icon">
                                <i class="material-icons">directions_bike</i>
                            </div>
                            <div class="activity--details">
                                <span>Ciclismo</span>
                                <p></p>
                            </div>
                        </div>
                        
                        <div class="activity--progress">
                            <span class="myState"><?php echo $ciclismo_state." Min"; ?></span><span class="myGoal"><?php echo $ciclismo_goal." Min"; ?></span>
                            <div class="progress--bar">
                                <div class="current--progress"></div>
                            </div>
                        </div>
                    </div>
                    <div class="activity--footer">
                        <div class="activity--actions">
                            <button id="addCicGoal"><i class="material-icons">add</i></button>
                            <button id="cicGoal"><i class="material-icons">edit</i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container4">
            <div class="dicas">
                <div class="dicas--container">
                    <div class="dicas--header">
                        <span>Dicas de Saúde</span>
                    </div>
                    <div class="dicas--body">
                        
                        <?php read_dicas_saude($db); ?>
                    </div>
                </div>
                <div class="dicas--image">
                    <img src="../imagens/teste/man-climbing-on-rope-2468339.jpg" alt="A minha saúde">
                </div>
            </div>
        </div>
    </section>
    
    <!----------------------------------- 
           Modals para Corrida
    ------------------------------------>
    <div class="modal-run-goal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button">×</span>
                <h1>Objectivo Semanal</h1>
                <hr>
                <div class="modal__body">
                    <div class="data_box">
                        <span>Seu Objectivo ?</span>
                        <input type="number" id="input_RunGoal" min="0" max="500" name="input_RunGoal">
                    </div>
                    <div class="data_box">
                        <span>Quanto percorrido?</span>
                        <input type="number" id="input_curRunState" min="0" max="500" name="input_curRunState">
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="update_runGoal" id="update_runGoal">Actualizar</button>
                    </div>
                </div>
                <input type="hidden" id="runGoalID" name="runGoalID" value="<?php echo $corrida_id; ?>"> 
            </form>
             
        </div>
    </div>
    
    <div class="modal-create-run-goal">
        <div class="modal-content2">
            <form action="" method="post">
                <span class="close-button2">×</span>
                <h1>Objectivo Semanal</h1>
                <hr>
                <div class="modal__body2">
                    <div class="data_box">
                        <span>Seu Objectivo ?</span>
                        <input type="number" id="create_input_RunGoal" min="0" max="500">
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="create_runGoal" id="create_runGoal">Criar</button>
                    </div>
                </div>
                <input type="hidden" id="run_creatorID" value="<?php echo $id; ?>" name=""> 
            </form>
             
        </div>
    </div>
    
    <!----------------------------------- 
           Modals para exercícios
    ------------------------------------>
    
    <div class="modal-create-ex-goal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button3">×</span>
                <h1>Objectivo Semanal</h1>
                <hr>
                <div class="modal__body">
                    <div class="data_box">
                        <span>Seu Objectivo ?</span>
                        <input type="number" id="create_input_ExGoal" min="0" max="500">
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="create_exGoal" id="create_exGoal">Criar</button>
                    </div>
                </div>
                <input type="hidden" id="ex_creatorID" value="<?php echo $id; ?>" name=""> 
            </form>
             
        </div>
    </div>
    
    <div class="modal-ex-goal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button4">×</span>
                <h1>Objectivo Semanal</h1>
                <hr>
                <div class="modal__body">
                    <div class="data_box">
                        <span>Seu Objectivo ?</span>
                        <input type="number" id="input_ExGoal" min="0" max="500" name="input_ExGoal">
                    </div>
                    <div class="data_box">
                        <span>Quanto percorrido?</span>
                        <input type="number" id="input_curExState" min="0" max="500" name="input_curExState">
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="update_exGoal" id="update_exGoal">Actualizar</button>
                    </div>
                </div>
                <input type="hidden" id="exGoalID" name="exGoalID" value="<?php echo $exercicio_id; ?>"> 
            </form>
             
        </div>
    </div>
    
    <!----------------------------------- 
           Modals para desporto
    ------------------------------------>
    
    <div class="modal-create-desp-goal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button5">×</span>
                <h1>Objectivo Semanal</h1>
                <hr>
                <div class="modal__body">
                    <div class="data_box">
                        <span>Seu Objectivo ?</span>
                        <input type="number" id="create_input_DespGoal" min="0" max="500">
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="create_despGoal" id="create_despGoal">Criar</button>
                    </div>
                </div>
                <input type="hidden" id="desp_creatorID" value="<?php echo $id; ?>" name=""> 
            </form>
             
        </div>
    </div>
    
    <div class="modal-desp-goal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button6">×</span>
                <h1>Objectivo Semanal</h1>
                <hr>
                <div class="modal__body">
                    <div class="data_box">
                        <span>Seu Objectivo ?</span>
                        <input type="number" id="input_DespGoal" min="0" max="500" name="input_DespGoal">
                    </div>
                    <div class="data_box">
                        <span>Quanto percorrido?</span>
                        <input type="number" id="input_curDespState" min="0" max="500" name="input_curDespState">
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="update_despGoal" id="update_despGoal">Actualizar</button>
                    </div>
                </div>
                <input type="hidden" id="despGoalID" name="despGoalID" value="<?php echo $desporto_id; ?>"> 
            </form>
             
        </div>
    </div>
    
    
    <!----------------------------------- 
           Modals para Ciclismo
    ------------------------------------>
    
    <div class="modal-create-cic-goal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button7">×</span>
                <h1>Objectivo Semanal</h1>
                <hr>
                <div class="modal__body">
                    <div class="data_box">
                        <span>Seu Objectivo ?</span>
                        <input type="number" id="create_input_CicGoal" min="0" max="500">
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="create_cicGoal" id="create_cicGoal">Criar</button>
                    </div>
                </div>
                <input type="hidden" id="cic_creatorID" value="<?php echo $id; ?>" name=""> 
            </form>
             
        </div>
    </div>
    
    <div class="modal-cic-goal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button8">×</span>
                <h1>Objectivo Semanal</h1>
                <hr>
                <div class="modal__body">
                    <div class="data_box">
                        <span>Seu Objectivo ?</span>
                        <input type="number" id="input_CicGoal" min="0" max="500" name="input_CicGoal">
                    </div>
                    <div class="data_box">
                        <span>Quanto percorrido?</span>
                        <input type="number" id="input_curCicState" min="0" max="500" name="input_curCicState">
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="update_cicGoal" id="update_cicGoal">Actualizar</button>
                    </div>
                </div>
                <input type="hidden" id="cicGoalID" name="cicGoalID" value="<?php echo $ciclismo_id; ?>"> 
            </form>
             
        </div>
    </div>
    
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/col_saude.js"></script>
    <script> 
        $(document).ready(function(){ 
            var cur_progress = document.getElementsByClassName('current--progress');
            
            //Progresso para a Corrida           
            cur_progress[0].style.width = "<?php if($corrida_goal != 0){echo (($corrida_state/$corrida_goal)*100)."%";}else{echo "0%";} ?>";
            
            //Progresso para os Exercícios
            cur_progress[1].style.width = "<?php if($exercicio_goal != 0){echo (($exercicio_state/$exercicio_goal)*100)."%";}else{echo "0%";} ?>";
            
            //Progresso para os Exercícios
            cur_progress[2].style.width = "<?php if($desporto_goal != 0){echo(($desporto_state/$desporto_goal)*100)."%";}else{echo "0%";} ?>";
            
            //Progresso para os Exercícios
            cur_progress[3].style.width = "<?php if($ciclismo_goal != 0){echo (($ciclismo_state/$ciclismo_goal)*100)."%";}else{echo "0%";} ?>";

        });
        
    </script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
