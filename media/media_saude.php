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
    <meta name="author" content="nucleo de desenvolvimento">
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
    <link rel="stylesheet" href="../css/media_saude.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include("../includes/dashboard_media.php"); ?>
            <div class="container3">
               <h1 style="font-size:2.7rem;">Saúde</h1>
            </div>
            <div class="container">
                <div class=".add--box">
                    <button class="btn btn-bkg-darkBlue btn-criar" id="btn-criar"><i class="material-icons">add</i><span>Adicionar</span></button>
                </div>
            </div>

            <div class="container">
                <div class="table_menu">
                    <h2><i class="material-icons">favorite</i> Dicas de Saúde</h2>
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
                        <?php read_dicas_saude_media($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="modal-saude">
            <div class="modal-content">
                <form action="../includes/insert_data.php" method="post" enctype="multipart/form-data">
                    <span class="close-button">×</span>
                    <h1>Dica de Saúde</h1>
                    <hr>
                    <div class="modal__body">
                        <div class="imagem">
                            <label for="">Imagem</label>
                            <input type="file" class="imagem--input" accept="image/*" name="dica_imagem">
                        </div>
                        <div class="title">
                            <span>Título</span>
                            <input type="text" name="dica_titulo">
                        </div>
                        <div class="message">
                            <span>Mensagem</span>
                            <textarea id="dica_mensagem" cols="30" rows="10" name="dica_mensagem" ></textarea>
                        </div>
                    </div> 
                    <div class="modal__footer">
                        <div class="footer__container">
                            <button type="submit" class="btn-blue" name="inserir_dica_saude">Criar</button>
                        </div>
                    </div>
                    <input type="hidden" id="" name=""> 
                </form>

            </div>
        </div>

        <div class="modal-saude-edit">
            <div class="modal-content2">
                <form action="../includes/update_data.php" method="post">
                    <span class="close-button2">×</span>
                    <h1>Actualizar Dica de Saúde</h1>
                    <hr>
                    <div class="modal__body2">
                        <div class="title">
                            <span>Título</span>
                            <input type="text" name="update_dica_titulo" id="update_dica_titulo">
                        </div>
                        <div class="message">
                            <span>Mensagem</span>
                            <textarea id="edit__dicaMensagem" cols="30" rows="10" name="uptade_dica_mensagem" ></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="update_dica_id" name="update_dica_id">  
                    <div class="modal__footer">
                        <div class="footer__container">
                            <button type="submit" class="btn-blue" name="update_dica_saude">Actualizar</button>
                        </div>
                    </div>                
                </form>

            </div>
        </div>

        <div class="modal-saude-delete">
            <div class="modal-content3">
                <form action="../includes/delete_data.php" method="post">
                    <span class="close-button3">×</span>
                    <h1>Deletar Dica de Saúde</h1>
                    <hr>
                    <div class="modal__body3">
                        <p>Tem certeza que deseja eliminar esta dica de saúde?</p>
                    </div>
                    <input type="hidden" id="delete_dica_id" name="delete_dica_id">  
                    <div class="modal__footer">
                        <div class="footer__container">
                            <button type="submit" class="btn-red" name="delete_dica_saude"> <i class="fa fa-trash"></i> delete</button>
                        </div>
                    </div>                
                </form>

            </div>
        </div>
    </section>
    
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/registerSW.js"></script>
    <script src="../js/json/ckeditor/ckeditor.js"></script>
    <script src="../js/media_saude.js"></script>
    <script>
        CKEDITOR.replace('dica_mensagem');
        CKEDITOR.replace('edit__dicaMensagem');
    </script>
    <script src="../js/table.js"></script>
</body>
</html>
