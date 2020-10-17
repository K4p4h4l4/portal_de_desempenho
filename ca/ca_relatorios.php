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
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Colaborador - Relatórios</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/av.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('../includes/dashboard_ca.php'); ?>
    <br>
    <br>
    <br>
    <section class="content">
        <div class="container">
            <div class="table_menu">
                <h2><i class="material-icons">list_alt</i> Relatórios</h2>
            </div>
            <hr class="gray--hr">
            <div class="reportsBox">
                <div class="selectBox">
                    <select name="reportDpto" id="reportDpto" class="reportSelector">
                        <option value="S">--- Seleccione o Departamento ---</option>
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
                </div>
                <div class="selectBox">
                    <select name="reportType" id="reportType" class="reportSelector">
                        <option value="S">--- Seleccione o relatório ---</option>
                        <option value="tarefas">Tarefas</option>
                        <!--option value="tarefas">Projectos</option>
                        <option value="tarefas">Formações</option-->
                    </select>
                </div>
                <div class="selectBox">
                    <select name="reportTime" id="reportTime" class="reportSelector">
                        <option value="S">--- Seleccione o período ---</option>
                        <option value="hoje">Hoje</option>
                    </select>
                </div>
                <div class="selectBox">
                    <button class="reportGenerator" name="reportGenerator" id="reportGenerator" type="button"><i class="far fa-file-pdf-o"></i> Relatório</button>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/ca_relatorios.js"></script>
    <script src="../js/hamburger.js"></script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
