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
    <title>Portal do Colaborador - Desempenho</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/col_desempenho.css">
    <script type="text/javascript" src="../js/ajax/chart/chart.min.js"></script>
    <script type="text/javascript" src="../js/ajax/chart/chartjs-plugin-datalabels.js"></script>
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/dashboard_ca.php'); ?>
    <br>
    <br>
    <br>
    <section class="content">
        <div class="container">
            <div class="graph__top">
                <div class="graph__title">
                    <span>Avaliação de Desempenho</span>
                </div>
            </div>
            <div class="graph__container">
                <div class="graph__body">
                    <canvas id="graph" width="500" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="container2">
            <div class="donut__content">
                <div class="donut__box">
                     <div class="donut__header">
                         <div class="donut__title">
                             <span>Projectos do Departamento</span>
                         </div>
                     </div>
                     <div class="donut__container">
                         <div class="donut__body">
                             <canvas id="donutDptoProjects" width="500" height="300"></canvas>
                         </div>
                     </div>
                     <div class="donut__footer">
                         <div class="donut__statistics">
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >check</i></div>
                                 <div class="status">Concluídos</div>
                                 <div class="percent" id="concluded_projects">21.0%</div>
                             </div>
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >schedule</i></div>
                                 <div class="status">Atrasados</div>
                                 <div class="percent" id="delayed_projects">13.0%</div>
                             </div>
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >play_arrow</i></div>
                                 <div class="status">Por iniciar</div>
                                 <div class="percent" id="toStart_projects">26.0%</div>
                             </div>
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >sync</i></div>
                                 <div class="status">Em curso</div>
                                 <div class="percent" id="inProgress_projects">43.0%</div>
                             </div>
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >cancel</i></div>
                                 <div class="status">Parados</div>
                                 <div class="percent" id="stopped_projects">43.0%</div>
                             </div>
                         </div>
                     </div>
                </div>
                
                <div class="donut__box">
                    <div class="donut__header">
                         <div class="donut__title">
                             <span>Tarefas do Departamento</span>
                         </div>
                    </div>
                    <div class="donut__container">
                         <div class="donut__body">
                             <canvas id="donutDptoTasks" width="500" height="300"></canvas>
                         </div>
                    </div>
                    <div class="donut__footer">
                         <div class="donut__statistics">
                             <div class="donut__card--25">
                                 <div class="icon"><i class="material-icons" >assignment_turned_in</i></div>
                                 <div class="status">Concluídas</div>
                                 <div class="percent" id="tasks_concluded">21.0%</div>
                             </div>
                             <div class="donut__card--25">
                                 <div class="icon"><i class="material-icons" >assignment_late</i></div>
                                 <div class="status">Em revisão</div>
                                 <div class="percent" id="tasks_inRevision">13.0%</div>
                             </div>
                             <div class="donut__card--25">
                                 <div class="icon"><i class="material-icons" >assignment</i></div>
                                 <div class="status">Por iniciar</div>
                                 <div class="percent" id="tasks_inAnalysis">26.0%</div>
                             </div>
                             <div class="donut__card--25">
                                 <div class="icon"><i class="material-icons" >assignment_ind</i></div>
                                 <div class="status">Em curso</div>
                                 <div class="percent" id="tasks_inProgress">43.0%</div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if( ($_SESSION['usuario_tipo']=='admin') && ($_SESSION['usuario_login']!='alvaro.santos') ){

        
        ?>
        <div class="container2">
            <div class="donut__content">
                <div class="donut__box">
                     <div class="donut__header">
                         <div class="donut__title">
                             <span>Projectos do Departamento</span>
                         </div>
                     </div>
                     <div class="donut__container">
                         <div class="donut__body">
                             <canvas id="donutDptoProjects2" width="500" height="300"></canvas>
                         </div>
                     </div>
                     <div class="donut__footer">
                         <div class="donut__statistics">
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >check</i></div>
                                 <div class="status">Concluídos</div>
                                 <div class="percent" id="concluded_projects2">21.0%</div>
                             </div>
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >schedule</i></div>
                                 <div class="status">Atrasados</div>
                                 <div class="percent" id="delayed_projects2">13.0%</div>
                             </div>
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >play_arrow</i></div>
                                 <div class="status">Por iniciar</div>
                                 <div class="percent" id="toStart_projects2">26.0%</div>
                             </div>
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >sync</i></div>
                                 <div class="status">Em curso</div>
                                 <div class="percent" id="inProgress_projects2">43.0%</div>
                             </div>
                             <div class="donut__card">
                                 <div class="icon"><i class="material-icons" >cancel</i></div>
                                 <div class="status">Parados</div>
                                 <div class="percent" id="stopped_projects2">43.0%</div>
                             </div>
                         </div>
                     </div>
                </div>
                
                <div class="donut__box">
                    <div class="donut__header">
                         <div class="donut__title">
                             <span>Tarefas do Departamento</span>
                         </div>
                    </div>
                    <div class="donut__container">
                         <div class="donut__body">
                             <canvas id="donutDptoTasks2" width="500" height="300"></canvas>
                         </div>
                    </div>
                    <div class="donut__footer">
                         <div class="donut__statistics">
                             <div class="donut__card--25">
                                 <div class="icon"><i class="material-icons" >assignment_turned_in</i></div>
                                 <div class="status">Concluídas</div>
                                 <div class="percent" id="tasks_concluded2">21.0%</div>
                             </div>
                             <div class="donut__card--25">
                                 <div class="icon"><i class="material-icons" >assignment_late</i></div>
                                 <div class="status">Em revisão</div>
                                 <div class="percent" id="tasks_inRevision2">13.0%</div>
                             </div>
                             <div class="donut__card--25">
                                 <div class="icon"><i class="material-icons" >assignment</i></div>
                                 <div class="status">Por iniciar</div>
                                 <div class="percent" id="tasks_inAnalysis2">26.0%</div>
                             </div>
                             <div class="donut__card--25">
                                 <div class="icon"><i class="material-icons" >assignment_ind</i></div>
                                 <div class="status">Em curso</div>
                                 <div class="percent" id="tasks_inProgress2">43.0%</div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php 
            }
        ?>
    </section>
    
    <script src="../js/ca_desempenho.js"></script>
    <script src="../js/hamburger.js"></script>
    <script src="../js/check_desempenho.js"></script>
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
