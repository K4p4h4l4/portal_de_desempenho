<!DOCTYPE html>
<?php 
    require __DIR__."/../includes/conexao.php";
    require __DIR__."/../includes/erros.php";

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

<html lang="pt-pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Avaliação de Funcionários</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/coming_soon.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"/>
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include('../includes/dashboard_rh.php'); ?>
    
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
            
            <hr>
            <h4>Competência profissional</h4>
            <br>
            <p>1. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que respeita à competência profissional?</p>
            
            <br>
            <ul>
            <li>04 - Trabalho de excelente qualidade (17)</li>
            <li>03 - Trabalho de boa qualidade. (12)</li>
            <li>02 - Trablho de qualidade razoável. (5)</li>
            <li>01 - Trabalho de má qualidade. (0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="compt_prof" required ></li>
            </ul>
            <br>
            <br>
            
          <hr>
            <br><br>
            <h4>Dinamismo e Iniciativa</h4>
            <br>
            <p>2.	Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que respeita ao seu dinamismo e iniciativa?</p>
            
            <br>
            <ul>
                <li>04 - Dinâmico e com iniciativa.(15)</li>
                <li>03 - Dinâmico só na execução.(12)</li>
                <li>02 - Diligente na execução.(6)</li>
                <li>01 - Pouco activo.(0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 15.</p></li>
            <li><input type="number" max="15" min="0" class="rb-tab-active" step="1" id="din_ini" required ><li>
            </ul>
            <br>
            <br>
          <hr>
            <br><br>
            <h4>Cumprimento das tarefas</h4>
            <br>
            <p>3. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que concerne o cumprimento das tarefas?</p>
            
            <br>
            <ul>
                <li>04 - Participa Sempre.(17)</li>
                <li>03 - Participa maioria das vezes.(12)</li>
                <li>02 - Participa pouco.(8)</li>
                <li>01 - Não participa.(0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="cump_tarefa" required ></li>
            </ul>
            <br>
           <hr>
            <br><br>
            <h4>Relações humanas no trabalho</h4>
            <br>
            <p>4. Para efeitos de avaliação serão tidos em conta os seguintes critérios, no que concerne o seu relacionamento humano no trabalho?</p>
            
            <br>
            <ul>
                <li>04 - Excelentes relações de trabalho.(15)</li>
                <li>03 - Boas relações de trabalho.(9)</li>
                <li>02 - Dificuldades de relacionamento.(6)</li>
                <li>01 - Mau relacionamento.(0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 15.</p></li>
            <li><input type="number" max="15" min="0" class="rb-tab-active" step="1" id="rel_hum_trab" required ><li>
            </ul>
            <br>
            <br>
            
            <hr>
            <br><br>
            <h4>Adapatação à função</h4>
            <br>
            <p>5.	Para efeitos de avaliação em ternos de Assiduidade e Pontualidade, aplicam-se os seguintes critérios de adapatação a função?</p>
            
            <br>
            <ul>
                <li>04 - Excelente adaptação.(16)</li>
                <li>03 - Adaptação razoável.(12)</li>
                <li>02 - Dificuldades de adapatação.(8)</li>
                <li>01 - Não distribui tarefas.(0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 16.</p></li>
            <li><input type="number" max="16" min="0" class="rb-tab-active" step="1" id="adapt_func" required ></li>
            </ul>
            <br>
            <br>

          <hr>
            <br><br>
            <h4>Disciplina</h4>
            <br>
            <p>6. Para efeitos de avaliação em ternos de Disciplina, aplicam-se os seguintes critérios?</p>
            
            <br>
            <ul>
                <li>04 - Exemplar.(15)</li>
                <li>03 - Disciplinado.(12)</li>
                <li>02 - Ocasionalmente indisciplinado.(9)</li>
                <li>01 - Indisciplinado.(0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 15.</p></li>
            <li><input type="number" max="15" min="0" class="rb-tab-active" step="1" id="disciplina" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Uso correcto dos equipamentos</h4>
            <br>
            <p>7. Faz o uso correcto dos equipamentos?</p>
            
            <br>
            <ul>
                <li>04 - Usa totalmente os meios e zela pela manutenção.(17)</li>
                <li>03 - Usa bem os meios e não permite danificação.(12)</li>
                <li>02 - Usa mal os meios.(9)</li>
                <li>01 - Usa mal os meios e danifica-os(0).</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 17.</p></li>
            <li><input type="number" max="17" min="0" class="rb-tab-active" step="1" id="uso_correct_equip" required ></li>
            </ul>
            <br>
            <br>
            
          
          <hr>
            <br><br>
            <h4>Apresentação e compostura</h4>
            <br>
            <p>8. Para efeitos de avaliação em ternos de Apresentação e Compostura, aplicam-se os seguintes critérios?</p>
            
            <br>
            <ul>
                <li>04 - Porte impecável.(10)</li>
                <li>03 - Bom porte.(7)</li>
                <li>02 - Pouca Compostura.(3)</li>
                <li>01 - Desleixado.(0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 10.</p></li>
            <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="apr_comp" required ></li>
            </ul>
            <br>
            <br>
            
          
          <hr>
            <br><br>
            <h4>Presença nos Briefings matinais</h4>
            <br>
            <p>9. Para efeitos de avaliação da sua Presença nos Briefings matinais, aplicam-se os seguintes critérios de avaliação?</p>
            
            <br>
            <ul>
                <li>04 - Assíduo.(10)</li>
                <li>03 - Raramente falta.(7)</li>
                <li>02 - Falta algumas vezes.(3)</li>
                <li>01 - Não aparece.(0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 10.</p></li>
            <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="rm" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Participação nas Reunões Operacionais</h4>
            <br>
            <p>10. Para efeitos de avaliação da sua Participação nas Reunões Operacionais aplicam-se os seguintes critérios de avaliação?</p>
            
            <br>
            <ul>
                <li>04 - Assíduo.(10)</li>
                <li>03 - Raramente falta.(7)</li>
                <li>02 - Falta algumas vezes.(3)</li>
                <li>01 - Não aparece.(0)</li>
            </ul>
            <br>
            <ul>
            <li><p>Escolha entre 0 e 10.</p></li>
            <li><input type="number" max="10" min="0" class="rb-tab-active" step="1" id="ro" required ></li>
            </ul>
            <br>
            <br>
          
          <hr>
            <br><br>
            <h4>Apreciação Geral</h4>
            <br>
            <p>Apreciação geral salientando se há ou não adaptação à função, quais os pontos fortes e fracos e quais os meios de aperfeiçoamento adequados:</p>
            
            <div class="obs">
                <div class="obs__box">
                    <textarea name="" id="obs" cols="10" rows="10" class="obs__textarea"></textarea>
                </div>
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
    <script src="../js/index2.js"></script>
    <script src="../js/check_msg.js"></script>
</body>
</html>
