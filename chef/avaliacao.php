<!DOCTYPE html>
<?php 
    include("../includes/conexao.php");
    include("../includes/erros.php");
    require("../includes/acessos.php");

    $id = 0; 

    if(isset($_SESSION['usuario_id'])&&(($_SESSION['usuario_dpto'] != "DRHTI") && ($_SESSION['usuario_dpto'] != "ADMIN") && ($_SESSION['usuario_tipo'] != "tecnico") && ($_SESSION['usuario_tipo'] != "admin") )){
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
        if((time() - $_SESSION['ultimo_login']) > 3600){
            header("location: ../includes/logout");
        }else{
            $_SESSION['ultimo_login'] = time();
        }
    }
?>

<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Colaborador - Avaliar</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/coming_soon.css">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"/>
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/loader.php')?>   
    <?php include('../includes/dashboard_chefdpto.php'); ?>
    
    <?php 
        
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
   
        if(($dia > 10) && ($dia < 20) ){
            
        
    ?>
    <br>
    <br>
    <br>
    <div class="content">
        <div class="container">
            <?php include("../includes/av_bloqueada.php");?>
        </div>
    </div>
    <?php }else{ ?>
    <section class="conteudo">
       <form action="" method="post"> <!-- ./includes/av_funcionario.php -->
        <div class="rb-box">
            
            <h1>Ficha de Avaliação de Desempenho</h1>
            <p>Para avaliação de funcionários, leia atentamente e preencha as perguntas que se seguem. Certifique-se de marcar todas as questões sem esquecer das anotações semanais.</p>
            <hr>
            <h4>Informações do Colaborador</h4>
            <p>Colaborardor que será avaliado.</p>
            <br>
            <div>
                <div class="div_selec_colaborador">
                    <span>Seleccionar colaborador:</span>
                    <select style="margin-left: 10px; width: 200px;height: 30px;" name="funcionarios" id="funcionarios" class="funcionarios">
                       <option value="">--- Escolha um funcionario ---</option>
                        <?php
                            $tipo="";
                            if($usuario_tipo == 'chefe'){
                                $tipo = "tecnico";
                                
                            }else{
                                $tipo = "chefe";
                            }  
                        
                            $query = "select * from tb_usuarios where usuario_departamento ='$usuario_departamento' and usuario_tipo ='$tipo'";
                            $result = mysqli_query($db, $query);
                            while($row = mysqli_fetch_assoc($result)){
                            $user_name = $row['usuario_nome'];
                            $user_surname = $row['usuario_sobrenome'];
                            $user_id = $row['usuario_id'];
                        ?>
                        <option value="<?php echo $user_id;?>"><?php echo $user_name." ".$user_surname;?></option>
                        <?php } ?>
                    </select>
                </div>
                <br>
                
            </div>
            <div class="fichas" id="ficha">
            
            </div>
          <!-- Button -->
          <div class="button-box">
            <button class="button trigger" name="btn_av_funcionario">Submeter</button>
          </div>

        </div>
        </form>
    </section>
    <?php }?>
    <footer></footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../js/select_ficha.js"></script>  
    <script src="../js/index.js"></script>
    <script src="../js/hamburger.js"></script>
    <script src="../js/check_desempenho.js"></script>
    <script src="../js/check_msg.js"></script>
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
    <!-- script src="../js/check_browser_tab_close.js"></script -->
    
</body>
</html>
