<!DOCTYPE html>
<?php
    include("../includes/conexao.php");
    require("../includes/acessos.php");

    $id = 0; 

    if(isset($_SESSION['usuario_id']) &&(($_SESSION['usuario_dpto'] != "DRHTI") && ($_SESSION['usuario_dpto'] != "ADMIN") && ($_SESSION['usuario_tipo'] != "tecnico") && ($_SESSION['usuario_tipo'] != "admin") )){
        $id = $_SESSION['usuario_id'];
        
        $query = "select * from tb_usuarios where usuario_id='$id'";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);
        
        $usuario_nome = $row['usuario_nome'];
        $usuario_sobrenome = $row['usuario_sobrenome'];
        $usuario_departamento = $row['usuario_departamento'];
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
    <title>Portal do Colaborador - Relatórios</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/av.css">
    <link rel="stylesheet" href="../css/colaboradores.css">  
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script> 

    <style>
        .fa-input {
          font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

    </style>
    
</head>
    
<body>
    <?php include('../includes/dashboard_chefdpto.php'); ?>
    
    <section class="conteudo">
        <div class="rb-box">
            
            <h1>Tabela de Desempenho de Colaboradores</h1>
            <p>Nesta tabela poderá visualizar o relatório de todos os colaboradores em função dos anos e meses da sua avaliação.</p>
            <div class="opcoes">
                <div class="select__box">
                    <select name="" id="ano" class="year-selection ano">
                        <?php
                            $query = "select * from anos";
                            $result = mysqli_query($db, $query);
                            while($row = mysqli_fetch_assoc($result)){
                            $ano = $row['ano'];
                        ?>
                        <option value="<?php echo $ano; ?>" class="opcao"><?php echo $ano; ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="select__box">
                    <select name="" id="mes" class="year-selection mes">
                        <?php 
                            $query = "select * from meses";
                            $result = mysqli_query($db, $query);
                            while($row = mysqli_fetch_assoc($result)){
                                $id_mes = $row['id_mes'];
                                $mes = $row['mes'];
                        ?>
                        <option value="<?php echo $id_mes; ?>" class="opcao"><?php echo $mes; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <hr>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="">№</th>
                        <th class="">Nome</th>
                        <th class="">E-mail</th>
                        <th class="">Contacto</th>

                        <th class="">Editar</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                            $tipo="";
                            if($usuario_tipo == 'chefe'){
                                $tipo = "tecnico";

                            }else{
                                $tipo = "chefe";
                            }  
                            $qt = 1;
                            $query = "select * from tb_usuarios where usuario_departamento ='$usuario_departamento' and usuario_tipo ='$tipo'";
                            $result = mysqli_query($db, $query);
                            while($row = mysqli_fetch_assoc($result)){
                                $user_name = $row['usuario_nome'];
                                $user_surname = $row['usuario_sobrenome'];
                                $user_id = $row['usuario_id'];
                                $user_email = $row['usuario_email'];
                                $user_contact = $row['usuario_contacto'];
                    ?>
                    <tr>
                        <td data-label="Nº" style="text-align:center;" class=""><?php echo $qt;?></td>
                        <td data-label="Nome" class=""><?php echo $user_name." ".$user_surname;?></td>
                        <td data-label="E-mail" style="text-align:center;" class=""><?php echo $user_email
                            ;?></td>
                        <td data-label="Contacto" style="text-align:center;" class=""><?php echo $user_contact; ?></td>          
                        <td data-label="Settings" style="text-align:center;">
                            <!--input type="submit" class="btn btn-danger fa-input" data-toggle="modal" data-target="#myModal" contenteditable="false" value="&#xf1f8; Eliminar"/>
                            <input type="submit" class="btn btn-warning fa-input" data-toggle="modal" data-target="#myModal" contenteditable="false" value="&#xf044; Editar"/>
                            <!--a href="relatorio.php?ano=< ?php echo $ano; ?>&mes=< ?php echo $id_mes; ?>&user=< ?php echo $user_id; ?>"--><input type="submit" class="btn btn-secondary fa-input" data-toggle="modal" data-target="#myModal" contenteditable="false" value="&#xf1c1; Relatório" id="<?php echo $user_id; ?>"/><!--/a -->
                        </td>
                    </tr>
                    <?php $qt += 1; } ?>
                </tbody>
            </table>  
        </div>
        
        <?php  if($qt <= 8){
                    $output = "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                    echo $output;
                } 
        ?>
    </section>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">Modal title</h4>

            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/hamburger.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".btn-secondary").click( function(){
                var ano = document.getElementById("ano").value;
                var mes = document.getElementById("mes").value;
                var user = $(this).attr("id");
            
                $.ajax({
                    url: "../relatorio.php",
                    data:{ano:ano,mes:mes,user:user},
                    success:function(){
                        window.location.href = "../relatorio.php?ano="+ano+"&mes="+mes+"&user="+user;
                    }
                });
            }
        );
        });
        
    </script>
    
    <script>
        $(document).ready(function(){
            
            setInterval(function(){
                update_profile();
            }, 3000);
            
            function update_profile(){
                $.ajax({
                    url:'./includes/update_profile.php',
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
