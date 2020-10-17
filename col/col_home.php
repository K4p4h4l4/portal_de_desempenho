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
        $usuario_categoria = $row['categoria'];
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
    <link rel="stylesheet" href="../css/col_home.css"/>
    <link rel="stylesheet" href="../css/coming_soon.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include("../includes/col_dashboard_navbar.php"); ?>
   
    <!--?php include("../includes/coming_soon.php");?-->
    
    <div class="container3">
        <div class="profile">
            <div class="profile__holder">
                <div class="user">
                    <div class="user__holder">
                        <div class="user__header">
                            <img src="../imagens/perfil/<?php echo $_SESSION['usuario_foto']; ?>" alt="Imagem do colaborador" class="user__profileImg">
                            <div class="user__fullname">
                                <span><?php echo $_SESSION['usuario_nome'].' '.$_SESSION['usuario_sobrenome']; ?></span>
                            </div>
                            <div class="user__category">
                                <span><?php echo $usuario_categoria; ?></span>
                            </div>
                        </div>
                        <div class="user__body">
                            <div class="body__box">
                                <div class="box__icon">
                                    <i class="material-icons md-white">person</i>
                                </div>
                                <div class="box__text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit est ad, cumque.</p>
                                </div>
                            </div>
                            
                            <div class="body__box">
                                <div class="box__icon">
                                    <i class="material-icons md-white">phone</i>
                                </div>
                                <div class="box__text">
                                    <p><?php echo $usuario_contacto; ?></p>
                                    <p class="special__text">trabalho</p>
                                </div>
                            </div>
                            
                            <div class="body__box">
                                <div class="box__icon">
                                    <i class="material-icons md-white">email</i>
                                </div>
                                <div class="box__text">
                                    <p><?php echo $usuario_email; ?></p>
                                    <p class="special__text">trabalho</p>
                                </div>
                            </div>
                            
                            <div class="body__box">
                                <div class="box__icon">
                                    <i class="material-icons md-white">business</i>
                                </div>
                                <div class="box__text">
                                    <p>Avenida Dr. António Agostinho Neto, nº 25 Zona C, Praia do Bispo</p>
                                    <p class="special__text">Luanda - Angola</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="user__resume">
                    <div class="user__staff">
                        <div class="staff__holder">
                            <div class="staff__icon">
                                <i class="material-icons">business_center</i>
                            </div>
                            <div class="staff">
                                <div class="staff__header">
                                    <span>Projectos</span>
                                </div>
                                <?php get_lastProjects($db); ?>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="user__staff">
                        <div class="staff__holder">
                            <div class="staff__icon">
                                <i class="material-icons">school</i>
                            </div>
                            <div class="staff">
                                <div class="staff__header">
                                    <span>Formações</span>
                                </div>
                                <?php get_lastFormations($db);?>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="user__staff">
                        <div class="staff__holder">
                            <div class="staff__icon">
                                <i class="material-icons rotate-180">wb_incandescent</i>
                            </div>
                            <div class="staff">
                                <div class="staff__header">
                                    <span>Ideias</span>
                                </div>
                                
                                <?php get_lastIdeas($db); ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>   
    </section>
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/check_project.js"></script>
    <script src="../js/check_desempenho.js"></script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
