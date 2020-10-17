<!DOCTYPE html>
<?php 
    //require __DIR__."/../includes/conexao.php";
    include("../includes/mostrar_dptos.php");

    $id = 0; 

    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_dpto'] == "DRHTI") ){
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
    <title>Portal do Colaborador</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/colaboradores.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"/>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/dashboard_rh.php'); ?>
    
    <section class="conteudo">
       <form action="" method="post"> <!-- ./includes/av_funcionario.php -->
        <div class="rb-box">
            
            <h1>Avaliação da Assiduidade e Pontualidade</h1>
            <p>Para avaliação de funcionários, leia atentamente e preencha as perguntas que se seguem. Certifique-se de marcar todas as questões sem esquecer das anotações semanais.</p>
            <hr>
            <h4>Informações do Colaborador</h4>
            <!--p>Departamento do Colaborador</p-->
            <br>
            <div class="opcoes">
                <div class="select__box">
                    <!--span>Seleccionar Departamento:</span-->
                    <select  name="funcionarios" id="departamento" class="year-selection" > <!-- style="margin-left: 10px; width: 300px;height: 40px; padding: 10px; border-radius:5px;" --> 
                        <option value="">--- Escolha um Departamento ---</option>
                        <?php echo inserir_dptos($db); ?>
                    </select>
                    
                </div>
                <!-- br -->
                
                <div class="select__box"> <!-- div_selec_colaborador -->
                    <!--span>Seleccionar colaborador:</span-->
                    <select name="funcionarios" class="year-selection" id="colaboradores" > <!-- style="margin-left: 10px; width: 300px;height: 40px; padding: 10px; border-radius:5px;" -->
                        <?php echo inserir_funcionarios($db) ?>
                    </select>
                </div>
                
            </div>
            
            <hr>
            <h4>Assiduidade</h4>
            <br>
            <p>1. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que respeita à assiduidade?</p>
            <br>
	    <ul>
		<li>04 - Assíduo ( 10 ).</li>
		<li>03 - Raramente falta ( 7).</li>
		<li>02 - Falta algumas vezes ( 3 ).</li>
		<li>01 - Falta sistemáticamente ( 0 ).</li>
	    </ul>
	    <br>
	    <ul>
		<li><p>Escolha entre 0 e 10.</p></li>
		<li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="assid"></li>
	    </ul>
            
            <br>
            
            <hr>
            <br><br>
            <h4>Pontualidade</h4>
            <br>
            <p>2.	Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que respeita à pontualidade?</p>
            <br>
            <ul>
                <li>04 - Pontual ( 10 ).</li>
                <li>03 - Atrasos raros ( 7).</li>
                <li>02 - Atrasos frequentes ( 3 ).</li>
                <li>01 - Atrasos sistemáritcos ( 0 ).</li>
            </ul>
            <br>
            <ul>
                <li><p>Escolha entre 0 e 10.</p></li>
                <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="pont"></li>
            </ul>
            <br>
            
            <hr>
            <br><br>
                <h4>Faltas</h4>
            <br>
            <p>Insira o número de faltas injustificadas  e justificadas para o mês corrente.</p>
            <div class="faltas">
              <div class="faltas__box">
                    <label for="faltas" class="faltas__label">Faltas injustificadas:</label>
                    <input type="number" class="faltas__input" min="0" max="100" step="1" id="faltas_injustificadas">
              </div>
              <div class="faltas__box">
                    <label for="faltas" class="faltas__label">Faltas justificadas:</label>
                    <input type="number" class="faltas__input" min="0" max="100" step="1" id="faltas_justificadas" >
              </div> 
            </div>
            
          <!-- Button -->
          <div class="button-box">
            <button class="button activar" name="btn_av_funcionario">Submeter</button>
          </div>

        </div>
        </form>
    </section>
    <footer></footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../js/index2.js"></script>
    <script src="../js/select_funcionarios.js"></script>
    <script src="../js/check_msg.js"></script>
    
</body>
</html>
