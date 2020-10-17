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
        $usuario_movel = $row['usuario_movel'];
        $usuario_tipo = $row['usuario_tipo'];
        $_SESSION['usuario_foto'] = $row['usuario_foto'];
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
    <link rel="stylesheet" href="../css/col_profile.css" />
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
    
</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include("../includes/col_dashboard_navbar.php"); ?>
   
        <div class="container">
            <div class="profilebox">
                <div class="porfile--contacts">
                    <div class="profileHeader">
                        <div class="profile--image">
                            <img src="../imagens/perfil/<?php echo $_SESSION['usuario_foto']; ?>" alt="Minha Foto">
                        </div>
                        <div class="profile--myname"><span><?php echo $usuario_nome." ".$usuario_sobrenome ?></span></div>
                        <hr>
                    </div>
                    <div class="contacts">
                        <div class="contacts--title"><span>Contactos</span></div>
                        <div class="box--contacts">
                            <div class="contact--title">
                                <span>Endereço de E-mail</span>
                            </div>
                            <div class="contact--content">
                                <span><?php echo $usuario_email ?></span>
                            </div>
                        </div>
                        <div class="box--contacts">
                            <div class="contact--title">
                                <span>Número de Extensão</span>
                            </div>
                            <div class="contact--content">
                                <span><?php echo $usuario_contacto; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile--details">
                    <div class="details--header">
                        <span>Configurações</span>
                    </div>
                    <div class="details--body">
                        <form action="" method="post" id="user_form">
                            <div class="details">
                                <div class="details--box">
                                    <label for="">Nome</label>
                                    <input type="text" value="<?php echo $usuario_nome; ?>" id="usr_nome" disabled>
                                </div>
                                <div class="details--box">
                                    <label for="">Sobrenome</label>
                                    <input type="text" value="<?php echo $usuario_sobrenome; ?>" id="usr_sobrenome" disabled>
                                </div>
                            </div>
                            <div class="mydetails">
                                <div class="mydetails--box">
                                    <label for="">Nome de Login</label>
                                    <input type="text" value="<?php echo $usuario_login; ?>" id="usr_login" disabled autocomplete="username">
                                </div>
                                <div class="mydetails--box">
                                    <label for="">Foto de perfil</label>
                                    <input type="file" id="usr_photo" onchange="return fileValidation();" autocomplete="photo" accept="image/*">
                                </div>
                                <div class="mydetails--box">
                                    <label for="">E-mail</label>
                                    <input type="email" value="<?php echo $usuario_email; ?>" id="usr_email" autocomplete="email">
                                </div>
                                <div class="mydetails--box">
                                    <label for="">Número da extensão</label>
                                    <input type="number" min="0" max="9999" value="<?php echo $usuario_contacto; ?>" id="usr_contacto">
                                </div>
                                <div class="mydetails--box">
                                    <label for="">Telemóvel</label>
                                    <input type="number" min="0" max="999999999" value="<?php echo $usuario_movel; ?>" id="usr_movel">
                                </div>
                                <div class="mydetails--box">
                                    <label for="">Palavra-passe Antiga</label>
                                    <input type="password" id="old_pw" autocomplete="current-password">
                                </div>
                                <div class="mydetails--box">
                                    <label for="">Nova Palavra-passe</label>
                                    <input type="password" id="new_pw" autocomplete="new-password">
                                </div>
                                <div class="mydetails--box">
                                    <label for="">Confirmar nova Palavra-passe</label>
                                    <input type="password" id="confirm_pw" autocomplete="new-password">
                                    <input type="hidden" value="tecnico" id="usr_type">
                                </div>
                            </div>
                            <div class="button--box">
                                <button class="btn btn-blue" type="button" id="update_usr"><span>Actualizar</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/update_user.js"></script>
    <script src="../js/check_token.js"></script>
    <script>
        function fileValidation(){
            var fileInput = document.getElementById('usr_photo');
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