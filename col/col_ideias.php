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
        if((time() - $_SESSION['ultimo_login']) > 1800){
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
    <link rel="stylesheet" href="../css/coming_soon.css">
    <link rel="stylesheet" href="../css/col_ideias.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("../includes/col_dashboard_navbar.php"); ?>
   
    <!--?php include("../includes/coming_soon.php");?-->
       <div class="container3">
           <h1 style="font-size:2.7rem;">Ideias</h1>
       </div>
        <div class="container">
            <div class=".add--box">
                <button class="btn btn-bkg-darkBlue" id="openIdeiaModal"><i class="material-icons">add</i><span>Adicionar</span></button>
            </div>
        </div>
        <div class="container">
            <div class="table_menu">
                <h2><i class="material-icons rotate-180">wb_incandescent</i> Minhas Ideias</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableIdeas">           
                <thead>
                    <tr>
                        <th width="15%">Ideia</th>
                        <th width="50%">Descrição</th>
                        <th width="10%">Data</th>
                        <th width="10%">Status</th>
                        <th width="10%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_minhas_ideias($db); ?>
                </tbody>
            </table>
        </div>  
    </section>
    
    <div class="modal-ideia">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button">×</span>
                <h1>Minha Sugestão</h1>
                <hr>
                <div class="modal__body">
                    <div class="title">
                        <span>Assunto</span>
                        <input type="text" name="ideia_assunto" class="titulo" id="ideia_assunto">
                    </div>
                    <div class="message">
                        <span>Descrição</span>
                        <div class="toolbar">                           
                            <ul class="tool-list">
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='justifyLeft' >
                                        <i class="material-icons">format_align_left</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='justifyCenter'>
                                        <i class="material-icons">format_align_center</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='bold'>
                                        <i class="material-icons">format_bold</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='italic' onclick="format('italic')">
                                        <i class="material-icons">format_italic</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='underline'>
                                        <i class="material-icons">format_underline</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='insertUnorderedList'>
                                        <i class="material-icons">format_list_bulleted</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='insertOrderedList'>
                                        <i class="material-icons">format_list_numbered</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='createLink'>
                                        <i class="material-icons">insert_link</i>
                                    </button>
                                </li>
                            </ul>                           
                        </div>
                        <div id="ideia_descricao" contenteditable="true" name="ideia_descricao" class="mensagem"></div>
                        <!--textarea id="ideia_descricao" cols="30" rows="10" name="ideia_descricao" class="mensagem" spellcheck="true"></textarea-->
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="inserir_ideia" id="inserir_ideia" value="inserir_ideia">Criar</button>
                    </div>
                </div>
                <input type="hidden" id="" name=""> 
            </form>
             
        </div>
    </div>
    
    <div class="modal-ideia-edit">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close-button2">×</span>
                <h1>Actualizar Dica de Saúde</h1>
                <hr>
                <div class="modal__body">
                    <div class="title">
                        <span>Título</span>
                        <input type="text" name="update_ideia_assunto" id="update_ideia_assunto" class="titulo">
                    </div>
                    <div class="message">
                        <span>Mensagem</span>
                        <div class="toolbar">                           
                            <ul class="tool-list">
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='justifyLeft' >
                                        <i class="material-icons">format_align_left</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='justifyCenter'>
                                        <i class="material-icons">format_align_center</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='bold'>
                                        <i class="material-icons">format_bold</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='italic' onclick="format('italic')">
                                        <i class="material-icons">format_italic</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='underline'>
                                        <i class="material-icons">format_underline</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='insertUnorderedList'>
                                        <i class="material-icons">format_list_bulleted</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='insertOrderedList'>
                                        <i class="material-icons">format_list_numbered</i>
                                    </button>
                                </li>
                                <li class="tool">
                                    <button type="button" class="tool--btn" data-command='createLink'>
                                        <i class="material-icons">insert_link</i>
                                    </button>
                                </li>
                            </ul>                           
                        </div>
                        <div id="update_ideia_descricao" contenteditable="true" name="update_ideia_descricao" class="mensagem"></div>
                        <!--textarea id="update_ideia_descricao" cols="30" rows="10" name="update_ideia_descricao" class="mensagem"></textarea-->
                    </div>
                </div>
                <input type="hidden" id="update_ideia_id" name="update_ideia_id">  
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-blue" name="update_ideia" id="update_ideia" value="update_ideia">Actualizar</button>
                    </div>
                </div>                
            </form>
             
        </div>
    </div>
    
    <div class="modal-ideia-delete">
        <div class="modal-content">
            <form action="../includes/delete_data.php" method="post">
                <span class="close-button3">×</span>
                <h1>Eliminar Ideia</h1>
                <hr>
                <div class="modal__body">
                    <p>Tem certeza que deseja eliminar a sua ideia?</p>
                </div>
                <input type="hidden" id="delete_ideia_id" name="delete_ideia_id">  
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-red" name="delete_ideia"> <i class="fa fa-trash"></i>Eliminar</button>
                    </div>
                </div>                
            </form>
             
        </div>
    </div>
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/col_ideias.js"></script>
    <script src="../js/table.js"></script>
    <script src="../js/textEditor.js"></script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
