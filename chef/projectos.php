<!DOCTYPE html>
<?php 
    include("../includes/conexao.php");
    require("../includes/acessos.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

    $id = 0;
    $dataPoints = array();

    if(isset($_SESSION['usuario_id']) &&(($_SESSION['usuario_dpto'] != "DRHTI") && ($_SESSION['usuario_dpto'] != "ADMIN") && ($_SESSION['usuario_tipo'] != "tecnico") && ($_SESSION['usuario_tipo'] != "admin") ) ){
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
    
    $tipo="";
    if($usuario_tipo == 'chefe'){
        $tipo = "tecnico";

    }else{
        $tipo = "chefe";
    }
    
?>
<html lang="pt-pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Colaborador - Projectos</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/col_projectos.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../js/amdcharts/lib/4/core.js"></script>
    <script type="text/javascript" src="../js/amdcharts/lib/4/charts.js"></script>
    <script type="text/javascript" src="../js/amdcharts/lib/4/animated.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include('../includes/dashboard_chefdpto.php'); ?>
    <br>
    <br>
    <br>
    <section class="content">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectos">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosChefDpto($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnalise">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos por colaborador do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="25%">Projecto</th>
                        <th width="15%">Nome</th>
                        <th width="10%">Início</th>
                        <th width="10%">Fim</th>
                        <th width="10%">( % )</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_perUser($db); ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <!----Modal para visualizar projecto---->
    <div class="modal-project">
        <div class="modal-project-content">
            <div class="project">
                <div class="project__header">
                    <div class="project__imgBox">
                        <div class="modal_view_pimage" id="modal_view_pimage">
                            
                        </div>
                        <div class="project__titleBox" id="modal_view_pname">
                            
                        </div>
                    </div>
                    <div class="project__inacomBox">
                        <div class="institutName_box">
                            <span>Instituto Angolano das Comunicações</span>
                        </div>
                        <div class="institutStreet_box">
                            <span>Avenida Dr. António Agostinho Neto, Nº 25-zona C, Praia do Bispo Caixa Postal 1459</span>
                        </div>
                    </div>
                </div>
                
                <div class="project__body">
                    <div class="project__details">
                        <div class="header__box">
                            <span>1. Contextualização</span>
                            <hr class="title__line">
                        </div>
                        <div class="project__text" id="modal_view_pcontext">
                            
                        </div>
                    </div>
                    
                    <div class="project__details">
                        <div class="header__box">
                            <span>2. Missão e Âmbito do Projecto</span>
                            <hr class="title__line">
                        </div>
                        <div class="project__text" id="modal_view_pmission">
                            
                        </div>
                    </div>
                    
                    <div class="project__details">
                        <div class="header__box">
                            <span>3. Objectivos</span>
                            <hr class="title__line">
                        </div>
                        <div class="project__text" id="modal_view_pgoal">
                            
                        </div>
                    </div>
                    
                    <div class="project__details">
                        <div class="header__box">
                            <span>4. Metodologia</span>
                            <hr class="title__line">
                        </div>
                        <div class="project__text" id="modal_view_pmetodology">
                            
                        </div>
                    </div>
                    
                    <div class="project__details">
                        <div class="header__box">
                            <span>5. Entregáveis</span>
                            <hr class="title__line">
                        </div>
                        <div class="project__text" id="modal_view_pentregaveis">
                            
                        </div>
                    </div>
                    
                    <div class="project__details">
                        <div class="header__box">
                            <span>6. Riscos do Projecto</span>
                            <hr class="title__line">
                        </div>
                        <div class="project__table">
                            <table class="content-modal-table">
                                <thead>
                                    <tr valign='top'>
                                        <th width="15%">Nome do Risco</th>
                                        <th width="30%">Descricção do Risco e Causa</th>
                                        <th width="20%">Impacto</th>
                                        <th width="20%">Accão de Mitigação</th>
                                        <th width="5%">Prob</th>
                                        <th width="5%">Imp</th>
                                    </tr>
                                </thead>
                                <tbody id="modal_view_priscos">
                                    <tr valign='top'>
                                        <td>1.	Implementação errada do portal.</td>
                                        <td>Erro na resolução das páginas do portal sem levar em conta o acesso por outros navegadores.</td>
                                        <td>Falta de harmonia nos componentes da página do portal.</td>
                                        <td>Reconfiguração da página para diferentes resoluções ou navegadores.</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="project__details">
                        <div class="header__box">
                            <span>7. Equipa do Projecto</span>
                            <hr class="title__line">
                        </div>
                        <div class="project__text" id="modal_view_pmembers">
                            <ul class="project__members" id="modal_view_pmembers">
                                <li>Benedito Calulo</li>
                                <li>Josemar Rosa</li>
                                <li>Tolávio Silva</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="project__details">
                        <div class="header__box">
                            <span>8. Cronograma</span>
                            <hr class="title__line">
                        </div>
                        <div class="project__text" >
                            
                            <div class="project__table">
                            <table class="content-modal-table">
                                <thead>
                                    <tr valign='top'>
                                        <th>Nº</th>
                                        <th>Fases do Projecto</th>
                                        <th>Data de Início</th>
                                        <th>Duração</th>
                                        <th>Data de Fim</th>
                                    </tr>
                                </thead>
                                <tbody id="modal_view_pfases_table">
                                    <tr valign='top'>
                                        <td>1.	Implementação errada do portal.</td>
                                        <td>Erro na resolução das páginas do portal sem levar em conta o acesso por outros navegadores.</td>
                                        <td>Falta de harmonia nos componentes da página do portal.</td>
                                        <td>Reconfiguração da página para diferentes resoluções ou navegadores.</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <div id="modal_view_pfases"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para dar o ponto de situação do projecto -->
    <div class="modal_comment_project">
        <div class="modal-content">
            <span class="close_comment_modal">×</span>
            <h1 style="font-size: 2rem;">Ponto de situação</h1>
            <hr>
            
            <div class="fase">
                <div class="task__label">
                    <span>Fase do projecto</span>
                </div>
                <select name="fase__selector" id="fase__selector" class="fase__selector" required>
                    <option value="">-- Selecione a fase do projecto --</option>
                    <option value="">Lenvantamento de requisitos</option>
                    <option value="">Preparação de Protótipo</option>
                    <option value="">Ajustes Finais</option>
                </select>
            </div>
            <div class="comment__body">
               <div class="comment__holder" id="comment__holder">
                  <div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="./imagens/teste/apple-business-computer-connection-392018.jpg" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>Tolávio Silva</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                              <h4>Fase 4: Levantamento de Requisitos</h4>    
                              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat sed nobis, temporibus. Nostrum voluptatum minus, consequatur ab vero ea, fugit non illo, excepturi eligendi saepe.</span>
                          </div>
                          <div class="comment__time">
                              <span>10/03/2020 13:12</span>
                          </div>
                      </div>
                  </div>
                  <div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="./imagens/teste/adult-african-american-afro-black-female-1181519.jpg" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>Manuel Domingos</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                             <h4>Fase 4: Levantamento de Requisitos</h4>
                              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, accusantium, doloribus. Exercitationem dolorum blanditiis quo corporis ex nam molestiae alias architecto doloribus saepe illum odio voluptates, necessitatibus quasi provident deserunt, cumque? Sed consequuntur accusamus, deserunt ex, eveniet veniam vitae neque.</span>
                          </div>
                          <div class="comment__time">
                              <span>15/03/2020 13:12</span>
                          </div>
                      </div>
                  </div>
                  
                  <div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="./imagens/teste/adult-african-american-afro-black-female-1181519.jpg" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>Manuel Domingos</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                              <h4>Fase 3: Implementação do Protótipo</h4>
                              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, blanditiis.</span>
                          </div>
                          <div class="comment__time">
                              <span>15/03/2020 13:52</span>
                          </div>
                      </div>
                  </div>
                  
                  <div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="./imagens/teste/musician-349790_640.jpg" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>Elieser Almeida</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                              <h4>Fase 2: Ajustes Finais</h4>
                              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque sunt ipsum ullam iusto esse eligendi culpa aspernatur tenetur earum perferendis necessitatibus praesentium vero doloremque ut debitis dolore eius harum, aliquid quod cupiditate illo, nobis neque dignissimos. Eius perspiciatis, vitae sit.</span>
                          </div>
                          <div class="comment__time">
                              <span>16/03/2020 10:33</span>
                          </div>
                      </div>
                  </div>  
               </div> 
            </div>
            
            <div class="modal__footer">
                <div class="footer__container">
                    <textarea name="" id="comment" cols="10" rows="3" class="text__comment" placeholder="Comentário sobre o projecto" required></textarea><button type="button" class="btn-blue" name="comment_projecto" id="comment_projecto">Comentar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para visualizar os comentários -->
    <div class="modal_view_comments">
        <div class="modal-content">
            <span class="close-view-comments">×</span>
            <h1 style="font-size: 2rem;">Ponto de situação</h1>
            <hr>
            
            <div class="comment__body">
               <div class="comment__holder" id="comment__view__holder">
                  <div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="./imagens/teste/apple-business-computer-connection-392018.jpg" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>Tolávio Silva</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                              <h4>Fase 4: Levantamento de Requisitos</h4>    
                              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat sed nobis, temporibus. Nostrum voluptatum minus, consequatur ab vero ea, fugit non illo, excepturi eligendi saepe.</span>
                          </div>
                          <div class="comment__time">
                              <span>10/03/2020 13:12</span>
                          </div>
                      </div>
                  </div>
                  <div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="./imagens/teste/adult-african-american-afro-black-female-1181519.jpg" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>Manuel Domingos</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                             <h4>Fase 4: Levantamento de Requisitos</h4>
                              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, accusantium, doloribus. Exercitationem dolorum blanditiis quo corporis ex nam molestiae alias architecto doloribus saepe illum odio voluptates, necessitatibus quasi provident deserunt, cumque? Sed consequuntur accusamus, deserunt ex, eveniet veniam vitae neque.</span>
                          </div>
                          <div class="comment__time">
                              <span>15/03/2020 13:12</span>
                          </div>
                      </div>
                  </div>
                  
                  <div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="./imagens/teste/adult-african-american-afro-black-female-1181519.jpg" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>Manuel Domingos</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                              <h4>Fase 3: Implementação do Protótipo</h4>
                              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, blanditiis.</span>
                          </div>
                          <div class="comment__time">
                              <span>15/03/2020 13:52</span>
                          </div>
                      </div>
                  </div>
                  
                  <div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="./imagens/teste/musician-349790_640.jpg" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>Elieser Almeida</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                              <h4>Fase 2: Ajustes Finais</h4>
                              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque sunt ipsum ullam iusto esse eligendi culpa aspernatur tenetur earum perferendis necessitatibus praesentium vero doloremque ut debitis dolore eius harum, aliquid quod cupiditate illo, nobis neque dignissimos. Eius perspiciatis, vitae sit.</span>
                          </div>
                          <div class="comment__time">
                              <span>16/03/2020 10:33</span>
                          </div>
                      </div>
                  </div>  
               </div> 
            </div>
            
            <div class="modal__footer">
                <div class="footer__container">
                    
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
                <h1>Eliminar Projecto</h1>
                <hr>
                <div class="modal__body2">
                    <div class="question">
                        <span>Tem mesmo a certeza que deseja eliminar este projecto ?</span>
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-red" name="deletar_projecto">Confirmar</button>
                    </div>
                </div>
                <input type="hidden" id="delProject" name="delProject"> 
            </form>
             
        </div>
    </div>
    
    <script src="../js/table.js"></script>
    <script src="../js/json/ckeditor/ckeditor.js"></script>
    <script src="../js/projectos.js"></script>
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
    
    <script>
        /*****************************************************
        *Script para trocar as cores em função das priorida -*
        *des
        *****************************************************/
        document.querySelectorAll('.status').forEach(i => {
            i.textContent.indexOf("Parado") !== -1 ?
            i.classList.add('yellow') :
            i.innerText.indexOf("Em atraso") !== -1 ?
            i.classList.add('orange') :
            i.innerText.indexOf("Por iniciar") !== -1 ?
            i.classList.add('blue') :
            i.innerText.indexOf("Concluido") !== -1 ?
            i.classList.add('green') :
            i.innerText.indexOf("Suspenso") !== -1 ?
            i.classList.add('red') :
            null;
        });
    </script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
