<!DOCTYPE html>
<?php 
    include("../includes/conexao.php");
    require("../includes/acessos.php");

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
        
        $query2 = "select * from tb_av_usuarios where usuario_id ='$user_id' and av_mes = (MONTH(CURDATE())-1)";
        $result2 = mysqli_query($db, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $media = $row2['media_ponderada'];

        array_push($dataPoints, array("label"=> $row['usuario_nome']." ".$row['usuario_sobrenome'], "y"=> $media));
    }
?>
<html lang="pt-pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Colaborador - Perfil</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/av.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
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
                                <button class="btn__special btn-blue" type="button" id="update_usrChef"><span>Actualizar</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/update_userChef.js"></script>
    <script src="../js/hamburger.js"></script>
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
