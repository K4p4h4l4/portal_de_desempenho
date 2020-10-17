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
    <link rel="stylesheet" href="../css/col_portais.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("../includes/col_dashboard_navbar.php"); ?>
    <div class="container3">
        <div class="wrapper">
            <div class="card">
                <a href="https://www.inacom.gov.ao" class="portal__links" target="_blank">
                    <div class="card__img">
                        <img src="../imagens/portais/inacom.jpg" alt="Imagem do Portal" class="portal__img">
                    </div>
                    <div class="card__icon">
                        <img src="../imagens/portais/inacom.ico" alt="" class="icon">
                    </div>
                    <div class="card__text">INACOM</div>
                </a>
            </div>
            <div class="card">
                <a href="http://192.178.1.221" class="portal__links" target="_blank">
                    <div class="card__img">
                        <img src="../imagens/portais/portal%20interno.jpg" alt="Imagem do Portal" class="portal__img">
                    </div>
                    <div class="card__icon">
                        <img src="../imagens/portais/sharepoint.ico" alt="" class="icon">
                    </div>
                    <div class="card__text">Portal Interno</div>
                </a>
            </div>
            <div class="card">
                <a href="http://www.observatoriotics.gov.ao" class="portal__links" target="_blank">
                    <div class="card__img">
                        <img src="../imagens/portais/observatorio.jpg" alt="Imagem do Portal" class="portal__img">
                    </div>
                    <div class="card__icon">
                        <img src="../imagens/portais/apple-touch-icon.png" alt="" class="icon">
                    </div>
                    <div class="card__text">Observatório</div>
                </a>
            </div>
            <div class="card">
                <a href="https://webmail.inacom.gov.ao/" class="portal__links" target="_blank">
                    <div class="card__img">
                        <img src="../imagens/portais/email.jpg" alt="Imagem do Portal" class="portal__img">
                    </div>
                    <div class="card__icon">
                        <img src="../imagens/portais/email.ico" alt="" class="icon">
                    </div>
                    <div class="card__text">Email Institucional</div>
                </a>
            </div>
        </div>
    </div>
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
