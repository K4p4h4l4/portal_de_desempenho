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
        if((time() - $_SESSION['ultimo_login']) > 7200){
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
    <title>Área do Colaborador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="icon" href="../imagens/icons/INACOM.ico">  
    <link rel="stylesheet" href="../css/col_base.css">
    <link rel="stylesheet" href="../css/col_projectos.css">
    <link rel="stylesheet" href="../css/coming_soon.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    
    <script type="text/javascript" src="../js/amdcharts/lib/4/core.js"></script>
    <script type="text/javascript" src="../js/amdcharts/lib/4/charts.js"></script>
    <script type="text/javascript" src="../js/amdcharts/lib/4/animated.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include("../includes/col_dashboard_navbar.php"); ?>
   
   <div class="container3">
       <h1 style="font-size:2.7rem;">Projectos</h1>
   </div>
    <!--?php include("../includes/coming_soon.php");? -->
    
    <div class="container">
        <div class=".add--box">
            <button class="btn btn-bkg-darkBlue" id="addProjecModal"><i class="material-icons">add</i><span>Adicionar</span></button>
        </div>
    </div>
    
    <div class="container">
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
                    <th width="10%">Início</th>
                    <th width="10%">Chef. Dpto.</th>
                    <th width="10%">C.A.</th>
                    <th width="13%">Status</th>
                    <th width="5%"><i class="material-icons">settings</i></th>
                </tr>
            </thead>
            <tbody>
                <?php echo listar_projectos($db); ?>
            </tbody>
        </table>
    </div>
    
      <div class="container">
        <div class="table_menu">
            <h2><i class="material-icons">business_center</i> Meus Projectos</h2>
        </div>
        <hr class="gray--hr">
        
        <table class="content-table" id="tableMeusProjectos">
            <thead>
                <tr>
                    <th width="15%">Nome</th>
                    <th width="10%">( % )</th>
                    <th width="10%">Responsável</th>
                    <th width="20%">Fase</th>
                    <th width="10%">Início</th>
                    <th width="10%">Fim</th>
                    <th width="10%">Chef. Dpto</th>
                    <th width="10%">C.A.</th>                    
                    <th width="10%">Status</th>
                    <th width="5%"><i class="material-icons">settings</i></th>
                </tr>
            </thead>
            <tbody>
                <?php echo listar_user_projects($db); ?>
            </tbody>
        </table>
    </div>
    
    <!----Modal para adicionar projecto---->
    <div class="modal-add-projecto">
        <div class="modal-content">
            <form action="../includes/insert_data.php" enctype="multipart/form-data" method="post" id="form_addProject">
                <span class="close-addProject">×</span>
                <h1 style="font-size: 2rem;">Adicionar Projecto</h1>
                <hr>
                
                <div class="tab__buttons">
                    <button id="btn1" class="tab__header tab__header--selected" type="button">Nome</button>
                    <button id="btn2" class="tab__header" type="button" >Missão</button>
                    <button id="btn3" class="tab__header" type="button" >Metodologia</button>
                    <button id="btn4" class="tab__header" type="button" >Riscos</button>
                    <button id="btn5" class="tab__header" type="button" >Equipa</button>
                    <button id="btn6" class="tab__header" type="button" >Cronograma</button>
                </div>
                <div class="tab__content">
                    <div class="content__tab" id="content1">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Nome</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="text" class="task__inputName" id="projectName" name="projectName" required>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Imagem</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="file" class="task__inputName" id="projectImage" name="projectImage" accept="image/*"  required>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Contextualização</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="project__context" name="project__context" cols="30" rows="6" class="task__textarea" required placeholder="Contexto do Projecto"></textarea>
                            </div>                   
                        </div>
                    </div>
                    <div class="content__tab" id="content2">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Missão e Âmbito</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="project__mission" name="project__mission" cols="30" rows="6" class="task__textarea" required placeholder="Missão e Âmbito do Projecto"></textarea>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Objectivo</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="project__goal" name="project__goal" cols="30" rows="6" class="task__textarea" required placeholder="Objectivo do Projecto"></textarea>
                            </div>                   
                        </div>
                    </div>
                    <div class="content__tab" id="content3">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Metodologia</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="project__metodology" name="project__metodology" cols="30" rows="6" class="task__textarea" required placeholder="Metodologia do Projecto"></textarea>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Entregáveis</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="project__entregaveis" name="project__entregaveis" cols="30" rows="6" class="task__textarea" required placeholder="Entregáveis do Projecto"></textarea>
                            </div>                   
                        </div>
                    </div>
                    <div class="content__tab" id="content4">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Riscos do Projecto</span>
                            </div> 
                            <div class="task__inputNameBox--flex">
                                <div class="risk">
                                    <div class="risk__box">
                                        <input type="text" class="activity__inputText" id="data-risk_name1" name="risk_name[]" placeholder="Nome do risco" required>
                                        <input type="text" class="activity__inputText" id="data-risk_cause1" name="risk_cause[]" placeholder="Descrição do risco e causa" required>
                                        <input type="text" class="activity__inputText" id="data-risk_impact1" name="risk_impact[]" placeholder="Impacto do risco" required>
                                        <input type="text" class="activity__inputText" id="data-risk_mitigation1" name="risk_mitigation[]" placeholder="Acção de Mitigação" required>
                                        <input type="number" class="activity__inputNumber" id="data-risk_prob1" name="risk_prob[]" placeholder="Probabilidade" min="1" max="3" required>
                                        <input type="number" class="activity__inputNumber" id="data-risk_imp1" name="risk_imp[]" placeholder="Impacto" min="1" max="3" required>
                                    </div>
                                </div>
                                <div class="activity__btn">
                                   <button class="addActivity" id="addRisk" type="button"><i class="material-icons">add</i></button>
                                </div>
                                
                            </div>              
                        </div>
                    </div>
                    <div class="content__tab" id="content5">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Equipa do Projecto</span>
                            </div>
                            <div class="task__inputNameBox--flex"> 
                                <div class="checklist addWorkers">
                                    <div class="workers">
                                        <select name="worker_dpto[]" class="select" data-dpto_id="1" required>
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
                    <div class="content__tab" id="content6">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Cronograma</span>
                            </div>
                            <div class="task__inputNameBox--flex">
                                <div class="activity">
                                   <div class="activity__box">
                                        <input type="text" class="activity__inputText" id="data-act_text1" name="act_text[]" placeholder="Nome da Actividade" required>
                                        <input type="date" class="activity__inputDate" id="data-act_data1" name="act_data[]" placeholder="data" required>
                                        <input type="number" class="activity__inputNumber" id="data-act_number1" name="act_number[]" min="1" placeholder="Dias" required>
                                        <div class="checklist__buttons2">
                                           
                                       </div>
                                   </div>
                                </div>
                                <div class="activity__btn">
                                   <button class="addActivity" id="addActivity" type="button"><i class="material-icons">add</i></button>
                                </div>
                            </div>                
                        </div>
                    </div>
                </div>
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="add_projecto" id="add_projecto">Adicionar</button>
                    </div>
                </div>
            </form>
        </div> 
    </div>
    
    <!----Modal para visualizar projecto---->
    <div class="modal-project">
        
        <div class="modal-project-content">
            
            <div class="project">
                <div class="project__header">
                    <div class="project__imgBox">
                        <div class="" id="modal_view_pimage">
                            
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
               
    <!----Modal para actualizar projecto---->
    <div class="modal-update-projecto">
        <div class="modal-content">
            <form action="../includes/update_data.php" enctype="multipart/form-data" method="post">
                <span class="close-updtProject">×</span>
                <h1 style="font-size: 2rem;">Actualizar Projecto</h1>
                <hr>
                
                <div class="tab__buttons">
                    <button id="updt1" class="tab__header tab__header--selected" type="button">Nome</button>
                    <button id="updt2" class="tab__header" type="button" >Missão</button>
                    <button id="updt3" class="tab__header" type="button" >Metodologia</button>
                    <button id="updt4" class="tab__header" type="button" >Riscos</button>
                    <button id="updt5" class="tab__header" type="button" >Equipa</button>
                    <button id="updt6" class="tab__header" type="button" >Cronograma</button>
                </div>
                <div class="tab__content">
                    <div class="content__tab" id="contentUpdt1">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Nome</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="text" class="task__inputName" id="projectUpdtName" name="projectUpdtName" required>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Imagem</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="file" class="task__inputName" id="projectUpdtImage" name="projectUpdtImage" accept="image/*" onchange="return fileValidation();" >
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Contextualização</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="projectUpdt__context" name="projectUpdt__context" cols="30" rows="6" class="task__textarea" required placeholder="Contexto do Projecto"></textarea>
                            </div>                   
                        </div>
                    </div>
                    <div class="content__tab" id="contentUpdt2">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Missão e Âmbito</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="projectUpdt__mission" name="projectUpdt__mission" cols="30" rows="6" class="task__textarea" required placeholder="Missão e Âmbito do Projecto"></textarea>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Objectivo</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="projectUpdt__goal" name="projectUpdt__goal" cols="30" rows="6" class="task__textarea" required placeholder="Objectivo do Projecto"></textarea>
                            </div>                   
                        </div>
                    </div>
                    <div class="content__tab" id="contentUpdt3">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Metodologia</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="projectUpdt__metodology" name="projectUpdt__metodology" cols="30" rows="6" class="task__textarea" required placeholder="Metodologia do Projecto"></textarea>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Entregáveis</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="projectUpdt__entregaveis" name="projectUpdt__entregaveis" cols="30" rows="6" class="task__textarea" required placeholder="Entregáveis do Projecto"></textarea>
                            </div>                   
                        </div>
                    </div>
                    <div class="content__tab" id="contentUpdt4">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Riscos do Projecto</span>
                            </div> 
                            <div class="task__inputNameBox--flex">
                                <div class="risk riskUpdt">
                                    <div class="risk__box">
                                        <input type="text" class="activity__inputText" id="data-risk_nameUpdt1" name="risk_nameUpdt[]" placeholder="Nome do risco" required>
                                        <input type="text" class="activity__inputText" id="data-risk_causeUpdt1" name="risk_causeUpdt[]" placeholder="Descrição do risco e causa" required>
                                        <input type="text" class="activity__inputText" id="data-risk_impactUpdt1" name="risk_impactUpdt[]" placeholder="Impacto do risco" required>
                                        <input type="text" class="activity__inputText" id="data-risk_mitigationUpdt1" name="risk_mitigationUpdt[]" placeholder="Acção de Mitigação" required>
                                        <input type="number" class="activity__inputNumber" id="data-risk_probUpdt1" name="risk_probUpdt[]" placeholder="Probabilidade" min="1" max="3" required>
                                        <input type="number" class="activity__inputNumber" id="data-risk_impUpdt1" name="risk_impUpdt[]" placeholder="Impacto" min="1" max="3" required>
                                    </div>
                                </div>
                                <div class="activity__btn">
                                   <button class="addActivity" id="addRiskUpdt" type="button"><i class="material-icons">add</i></button>
                                </div>   
                            </div>              
                        </div>
                    </div>
                    <div class="content__tab" id="contentUpdt5">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Equipa do Projecto</span>
                            </div>
                            <div class="task__inputNameBox--flex"> 
                                <div class="checklist addWorkersUpdt">
                                    <div class="workers">
                                        <select name="worker_dptoUpdt[]" class="select selectUpdt" data-dpto_idupdt="1" required>
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
                                            <select name="worker_idUpdt[]" class="selectd " id="worker-idupdt1" required >
                                                <option value="">--- Selecione o Colaborador ---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="checklist__buttons">
                                    <button class="checklist__add" id="addWorkerUpdt" type="button"><i class="material-icons">add</i></button>
                                </div> 
                            </div>                 
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Responsável do Projecto</span>
                            </div>
                            <div id="responsavel__selector">
                                <select name="responsavel_id" class="select__resp" id="responsavel_id" required >
                                    <option value="">--- Selecione o Responsável ---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="content__tab" id="contentUpdt6">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Cronograma</span>
                            </div>
                            <div class="task__inputNameBox--flex">
                                <div class="activity activityUpdt">
                                   <div class="activity__box boxUpdt">
                                        <input type="text" class="activity__inputText" id="data-act_textUpdt1" name="act_textUpdt[]" placeholder="Nome da Actividade" required>
                                        <input type="date" class="activity__inputDate" id="data-act_dataUpdt1" name="act_dataUpdt[]" placeholder="data" required>
                                        <input type="number" class="activity__inputNumber" id="data-act_numberUpdt1" name="act_numberUpdt[]" min="1" placeholder="Dias" required>
                                        <div class="checklist__buttons2">
                                           
                                       </div>
                                   </div>
                                </div>
                                <div class="activity__btn">
                                   <button class="addActivity" id="addActivityUpdt" type="button"><i class="material-icons">add</i></button>
                                </div>
                            </div>                
                        </div>
                    </div>
                    <input type="hidden" id="project_id" name="project_id">
                </div>
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="updt_projecto" id="updt_projecto">Actualizar</button>
                    </div>
                </div>
            </form>
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
                              <img src="../imagens/teste/apple-business-computer-connection-392018.jpg" class="comment__usr--img" alt="Imagem do usuario">
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
                              <img src="../imagens/teste/adult-african-american-afro-black-female-1181519.jpg" class="comment__usr--img" alt="Imagem do usuario">
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
                              <img src="../imagens/teste/adult-african-american-afro-black-female-1181519.jpg" class="comment__usr--img" alt="Imagem do usuario">
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
                              <img src="../imagens/teste/musician-349790_640.jpg" class="comment__usr--img" alt="Imagem do usuario">
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
                              <img src="../imagens/teste/apple-business-computer-connection-392018.jpg" class="comment__usr--img" alt="Imagem do usuario">
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
                              <img src="../imagens/teste/adult-african-american-afro-black-female-1181519.jpg" class="comment__usr--img" alt="Imagem do usuario">
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
                              <img src="../imagens/teste/adult-african-american-afro-black-female-1181519.jpg" class="comment__usr--img" alt="Imagem do usuario">
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
                              <img src="../imagens/teste/musician-349790_640.jpg" class="comment__usr--img" alt="Imagem do usuario">
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
                                        
    </section>
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/table.js"></script>
    <script src="../js/json/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('project__context');
        CKEDITOR.replace('project__mission');
        CKEDITOR.replace('project__goal');
        CKEDITOR.replace('project__metodology');
        CKEDITOR.replace('project__entregaveis');
        CKEDITOR.replace('projectUpdt__context');
        CKEDITOR.replace('projectUpdt__mission');
        CKEDITOR.replace('projectUpdt__goal');
        CKEDITOR.replace('projectUpdt__metodology');
        CKEDITOR.replace('projectUpdt__entregaveis');
        
    </script>
    <script src="../js/col_projectos.js"></script>
    <script src="../js/check_project.js"></script>
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
    <script>
        function fileValidation(){
            var fileInput = document.getElementById('projectUpdtImage');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.png|\.jpg|\.gif|\.jfif|\.jpeg)$/i;
            if(!allowedExtensions.exec(filePath)){
                alert("Somente imagens no formato: png, jpg, gif, jfif e jpeg são aceites. Obrigado!");
                fileInput.value = '';
                return false;
            }
        }
    </script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
