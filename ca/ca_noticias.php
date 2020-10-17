<!DOCTYPE html>
<?php
    require("../includes/conexao.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");
        
    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_tipo']=='admin')){
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/col_base.css">
    <link rel="stylesheet" href="../css/col_noticias.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/loader.php')?>
    <?php include('../includes/dashboard_ca.php'); ?>
    <br>
    <br>
    <br>
    <section class="content">
        <div class="container5">
            <div class="news__container">
                <div class="news__mainContainer">
                    <div class="news__main">
                        <div class="news__main--card">
                            <div class="news__main--img">
                                <img src="../imagens/noticias/taras-shypka-iFSvn82XfGo-unsplash.jpg" class="news__imgPrincipal" alt="Notícia Principal">
                            </div>
                            <div class="news__main--title">
                                <span>Ministro advoga maior investimento para modernizar os órgãos do Sector</span>
                            </div>
                        </div>
                    </div>
                    <div class="news__external">
                        <div class="news__type">
                            <span>Notícias Internas</span>
                            <hr class="hr">
                        </div>
                        <div class="news__Wrapper internal">
                            <?php echo read_internal_news_user($db); ?>
                        </div>
                    </div>
                    <div class="news__external">
                        <div class="news__type">
                            <span>Notícias Públicas</span>
                            <hr class="hr">
                        </div>
                        <div class="news__Wrapper external">
                            <?php echo read_external_news_user($db); ?>
                        </div>
                    </div>
                </div>
                <div class="news__secondContainer">
                    <div class="weather__container">
                        <div class="weather__title">
                            <span>Luanda, Angola</span>
                        </div>
                        <div class="weather__box">
                            <div class="weather__wrapper">
                                <div class="weather__icon">
                                    <i class="fas fa-sun" id="weather__mainIcon"></i>
                                </div>
                                <div class="weather__numbers">
                                    <span class="weather__temp" id="weather__temp">33C</span>
                                    <span class="weather__string" id="weather__string">ensolarado</span>
                                </div>
                            </div>    
                        </div>
                        <div class="weather__otherDays">
                            <div class="weather__cards">
                                <span class="weather__day">quarta-feira</span>
                                <i class="fas fa-cloud-sun" id="weather__icon1"></i>
                                <span class="weather__temp--small" id="tmpt1">24C</span>
                            </div>
                            <div class="weather__cards">
                                <span class="weather__day">quinta-feira</span>
                                <i class="fas fa-cloud-sun-rain" id="weather__icon2"></i>
                                <span class="weather__temp--small" id="tmpt2">22C</span>
                            </div>
                            <div class="weather__cards">
                                <span class="weather__day">sexta-feira</span>
                                <i class="fas fa-cloud" id="weather__icon3"></i>
                                <span class="weather__temp--small" id="tmpt3">20C</span>
                            </div>
                            <div class="weather__cards">
                                <span class="weather__day">sábado</span>
                                <i class="fas fa-sun" id="weather__icon4"></i>
                                <span class="weather__temp--small" id="tmpt4">31C</span>
                            </div>
                            <div class="weather__cards">
                                <span class="weather__day">domingo</span>
                                <i class="fas fa-cloud-showers-heavy" id="weather__icon5"></i>
                                <span class="weather__temp--small" id="tmpt5">21C</span>
                            </div>
                        </div>
                    </div>
                    <div class="news__popularContainer">
                        <div class="news__external">
                            <div class="news__type">
                                <span>Notícias Populares</span>
                                <hr class="hr">
                            </div>
                            <div class="news__Wrapper">
                                <?php echo read_popular_news($db); ?>
                            </div>
                        </div>
                    </div>
                </div>
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
    </section>
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/registerSW.js"></script>
    <script src="../js/col_noticias.js"></script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
