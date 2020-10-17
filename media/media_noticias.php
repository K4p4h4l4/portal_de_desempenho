<!DOCTYPE html>
<?php
    require("../includes/conexao.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");
        
    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_tipo']=='media')){
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
    <meta name="author" content="Nucleo de Desenvolvimento">
    <meta name="keywords" content="Noticias,noticias, noticia">
    <meta name="description" content="pagina de noticias, onde podem ser observadas as noticias internas e externas do INACOM">
    <meta name="theme-color" content="#3367D6">
    <link rel="apple-touch-icon" href="../imagens/icons/apple-touch-icon.png">
    <title>Área do Colaborador - Notícias</title>
    <link rel="manifest" href="../manifest/manifest.json">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="../css/col_base.css">
    <link rel="stylesheet" href="../css/coming_soon.css">
    <link rel="stylesheet" href="../css/media_noticias.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include("../includes/dashboard_media.php"); ?>
        <div class="container3">
           <h1 style="font-size:2.7rem;">Notícias</h1>
        </div>
        <div class="container">
            <div class=".add--box">
                <button class="btn btn-bkg-darkBlue" id="openAddNoticiasModal"><i class="material-icons">add</i><span>Adicionar</span></button>
            </div>
        </div>
        
        <div class="container">
            <div class="table_menu">
                <h2><i class="fas fa-newspaper"></i> Notícia Principal</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableNoticiaPrincipal">
                <thead>
                    <tr>
                        <th width="5%">Nº</th>
                        <th width="10%">Imagem</th>
                        <th width="10%">Título</th>
                        <th width="20%">Contexto</th>
                        <th width="5%">Publicação aos</th>
                        <th width="10%">Publicado por</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_principal_news($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container">
            <div class="table_menu">
                <h2><i class="fas fa-newspaper"></i> Notícias Públicas</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableNoticiasExternas">
                <thead>
                    <tr>
                        <th width="5%">Nº</th>
                        <th width="10%">Imagem</th>
                        <th width="10%">Título</th>
                        <th width="20%">Contexto</th>
                        <th width="5%">Publicação aos</th>
                        <th width="10%">Publicado por</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_external_news($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container">
            <div class="table_menu">
                <h2><i class="fas fa-newspaper"></i> Notícias Internas</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableNoticiasInternas">
                <thead>
                    <tr>
                        <th width="5%">Nº</th>
                        <th width="10%">Imagem</th>
                        <th width="10%">Título</th>
                        <th width="20%">Contexto</th>
                        <th width="5%">Publicação aos</th>
                        <th width="10%">Publicado por</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php read_internal_news($db); ?>
                </tbody>
            </table>
        </div>
        
        <!----Modal para adicionar noticia---->
        <div class="modal-add-noticia">
            <div class="modal-content">
                <form action="../includes/insert_data.php" enctype="multipart/form-data" method="post" id="form_addNoticia">
                    <span class="close-addNoticia">×</span>
                    <h1 style="font-size: 2rem;">Adicionar Notícia</h1>
                    <hr>
                    <div class="modal__body">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Tipo de notícia</span>
                            </div>
                            <div class="task__inputNameBox">
                                <select name="noticiaTipo" id="noticiaTipo" class="task__inputName" required>
                                    <!--option value="">-- Seleccione tipo de publicação --</option -->
                                    <option value="externa">Pública</option>
                                    <option value="interna">Interna</option>
                                </select>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Notícia Principal</span>
                            </div>
                            <div class="task__inputNameBox">
                                <select name="noticiaManchete" id="noticiaManchete" class="task__inputName" required>
                                    <!--option value="">-- Seleccione tipo de publicação --</option -->
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Título</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="text" class="task__inputName" id="noticiaTitulo" name="noticiaTitulo" required>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Imagem</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="file" class="task__inputName" id="noticiaImage" name="noticiaImage" accept="image/*"  required>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Contexto</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="noticia__context" name="noticiaContext" cols="30" rows="6" class="task__textarea" required placeholder="Contexto da noticia"></textarea>
                            </div>                   
                        </div>
                    </div>  

                    <div class="modal__footer">
                        <div class="footer__container">
                            <button type="submit" class="btn-blue" name="add_noticia" id="add_noticia">Adicionar</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
        
        
        <!----Modal para adicionar noticia---->
        <div class="modal-edit-noticia">
            <div class="modal-content-edit">
                <form action="../includes/update_data.php" enctype="multipart/form-data" method="post" id="form_editNoticia">
                    <span class="close-editNoticia">×</span>
                    <h1 style="font-size: 2rem;">Editar Notícia</h1>
                    <hr>
                    <div class="modal__body">
                        <div class="data_box">
                            <div class="task__label">
                                <span>Tipo de notícia</span>
                            </div>
                            <div class="task__inputNameBox">
                                <select name="noticiaTipoEdit" id="noticiaTipoEdit" class="task__inputName" required>
                                    <!--option value="">-- Seleccione tipo de publicação --</option -->
                                    <option value="externa">Pública</option>
                                    <option value="interna">Interna</option>
                                </select>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Notícia Principal</span>
                            </div>
                            <div class="task__inputNameBox">
                                <select name="noticiaMancheteEdit" id="noticiaMancheteEdit" class="task__inputName" required>
                                    <!--option value="">-- Seleccione tipo de publicação --</option -->
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Título</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="text" class="task__inputName" id="noticiaTituloEdit" name="noticiaTituloEdit" required>
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Imagem</span>
                            </div>
                            <div class="task__inputNameBox">
                                <input type="file" class="task__inputName" id="noticiaImageEdit" name="noticiaImageEdit" accept="image/*">
                            </div>                   
                        </div>
                        <div class="data_box">
                            <div class="task__label">
                                <span>Contexto</span>
                            </div>
                            <div class="task__inputNameBox">
                                <textarea id="noticia__contextEdit" name="noticiaContextEdit" cols="30" rows="6" class="task__textarea" required placeholder="Contexto da noticia"></textarea>
                            </div>                   
                        </div>
                        <input type="hidden" id="noticia_id" name="noticia_id">
                    </div>  

                    <div class="modal__footer">
                        <div class="footer__container">
                            <button type="submit" class="btn-blue" name="edit_noticia" id="edit_noticia">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
        
        <!----Modal para visualizar noticia---->
        <div class="modal-view-noticia">
            <div class="modal-view-noticia-content">
                <div class="modal-view-body">
                    <div class="news__imgHolder">
                        <img src="../imagens/noticias/imagem%20(1).jpg" alt="" class="news__img">
                    </div>
                    
                    <div class="news__titleHolder">
                        <span>Angola assume presidência dos reguladores das comunicações da CPLP</span>
                    </div>
                    
                    <hr class="cool__line">
                    
                    <div class="news__dateHolder">
                        <span>03/05/2020</span>
                    </div>
                    
                    <div class="news__contextHolder">
                        <p>A eleição foi feita , hoje, 13/03, em Assembleia da organização , que coincidiu com a realização , em Luanda , do décimo primeiro fórum da ARCTEL.</p><br>

                        <p>O PCA do Instituto angolano das comunicações ( INACOM, Leonel Augusto, passa a presidir a associação com grandes desafios .</p><br>

                        <p>“Serviços com qualidade e à preços acessíveis, partilha de infraestruturas, o reforço da literacia digital, como o roaming na CPLP, estão entre as prioridades”, disse no acto de encerramento do evento.</p><br>

                        <p>Organizado pelo INACOM, em parceria com a ARCTEL, o décimo primeiro fórum das comunicações da CPLP serviu, durante dois dias, para a partilha de experiências entre reguladores, operadores, universidades e sociedade civil.</p>
                    </div>
                </div>
            </div> 
        </div>
        
        <!----Modal para eliminar noticia---->
        <div class="modal-delete-noticia">
            <div class="modal-delete-noticia-content">
                <div class="modal__body2">
                    <form action="../includes/delete_data.php" method="post">
                        <span class="close-delete-modal">×</span>
                        <h1>Eliminar Notícia</h1>
                        <hr>
                        <div class="question">
                            <span>Tem mesmo a certeza que deseja eliminar esta notícia ?</span>                            
                        </div> 
                        <div class="modal__footer">
                            <div class="footer__container">
                                <button type="submit" class="btn-red" name="deletar_noticia">Confirmar</button>
                            </div>
                        </div>
                        <input type="hidden" id="delNews" name="delNews"> 
                    </form>
                </div>
            </div> 
        </div>
    </section>
    
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/registerSW.js"></script>
    <script src="../js/json/ckeditor/ckeditor.js"></script>
    <script src="../js/media_noticias.js"></script>
    <script>
        CKEDITOR.replace('noticia__context');
        CKEDITOR.replace('noticia__contextEdit');
    </script>
    <script src="../js/table.js"></script>
</body>
</html>
