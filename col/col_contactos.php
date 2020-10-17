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
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("../includes/col_dashboard_navbar.php"); ?>
    
        <div class="container3">
            <h1 style="font-size:2.7rem;">Contactos</h1>
        </div>

        <div class="container3">
            <div class="tab__buttons">
                <button id="contacto1" class="tab tab__selected" type="button"><i class="material-icons">contact_phone</i> CA</button>
                <button id="contacto2" class="tab" type="button"><i class="material-icons">contact_phone</i> DACA</button>
                <button id="contacto3" class="tab" type="button"><i class="material-icons">contact_phone</i> DEC</button>
                <button id="contacto4" class="tab" type="button"><i class="material-icons">contact_phone</i> DFM</button>
                <button id="contacto5" class="tab" type="button"><i class="material-icons">contact_phone</i> DEGER</button>
                <button id="contacto6" class="tab" type="button"><i class="material-icons">contact_phone</i> DRHTI</button>
                <button id="contacto7" class="tab" type="button"><i class="material-icons">contact_phone</i> DAFSG</button>
                <button id="contacto8" class="tab" type="button"><i class="material-icons">contact_phone</i> DRMSU</button>
                <button id="contacto9" class="tab" type="button"><i class="material-icons">contact_phone</i> DEETI</button>
                <button id="contacto10" class="tab" type="button"><i class="material-icons">contact_phone</i> DFMCR</button>
            </div>
        </div>

        <div class="tab__content">
            <div id="content1" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do CA</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos1">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_ca($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="content2" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DACA</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos2">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_daca($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="content3" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DEC</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos3">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_dec($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="content4" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DFM</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos4">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_dfm($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="content5" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DEGER</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos5">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_deger($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="content6" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DRHTI</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos6">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_drhti($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="content7" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DAFSG</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos7">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_dafsg($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="content8" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DRMSU</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos8">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_drmsu($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="content9" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DEETI</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos9">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_deeti($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="content10" class="content__tab">
                <div class="container">
                    <div class="table_menu">
                        <h2><i class="material-icons">contacts</i> Contactos do DFMCR</h2>
                    </div>
                    <hr class="gray--hr">
                    <table class="content-table" id="tableContactos10">           
                        <thead>
                            <tr>
                                <th width="4%">Nº</th>
                                <th width="5%">Foto</th>
                                <th width="8%">Nome</th>
                                <th width="8%">Extensão</th>                        
                                <th width="5%">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php read_contactos_dfmcr($db);  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/table.js"></script>
    <script src="../js/col_contactos.js"></script>
    <script src="../js/check_msg.js"></script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
