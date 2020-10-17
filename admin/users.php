<!DOCTYPE html>
<?php
    require_once("../includes/conexao.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

    $query = "select * from tb_usuarios";
    $result = mysqli_query($db, $query);

    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_dpto']=='ADMIN')){
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
    <title>Painel de Controlo - Usuários</title>
    
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    
    <!-- Goole Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../css/users.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    
    
    
    
</head>

<body>
   <div class="sidebar">
       <div class="brand">
           <a href="control">
               <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                  <g fill="none" fill-rule="evenodd">
                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z"></path>
                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z"></path>
                  </g>
                </svg>
                <span class="brand__name">Control Painel</span>
           </a>
       </div>
       <div class="sidemenus">
           <ul class="sidemenus__list">
               <li><a href="control" class="links"><i class="fa fa-bar-chart-o"></i><span>Analítica</span></a></li>
               <li><a href="users" class="links"><i class="fa fa-users"></i><span>Usuários</span></a></li>
               <li><a href="enviar-lembrete" class="links"><i class="fa fa-envelope"></i><span>E-mail</span></a></li>
               <li><a href="saude" class="links"><i class="fa fa-heart"></i><span>Saúde</span></a></li>
               <li><a href="users-profile" class="links"><i class="fa fa-user"></i><span>Perfil</span></a></li>
           </ul>
       </div>
   </div>
   <div class="nav">
      
       <div class="account">
         <button class="dropdown__button" id="btn-dropdown-menu">
             <div class="account__img">
              <img src="../imagens/perfil/warren-wong-bh4LQHcOcxE-unsplash.jpg" alt="Foto de Perfil" class="account__img">
              </div>
              <div class="account__name">
                  <span><?php echo $usuario_nome." ".$usuario_sobrenome ?></span>
              </div>
              <div class="account__arrow">
                  <i class="fa fa-sort-down"></i>
              </div>
         </button>
         <div class="dropdown__menu">
             <div class="menu__body">
                 <ul class="menu">
                    <li><a href="../admin/users-profile"><button class="menu__list"><i class="fa fa-user"></i> <span>Perfil</span></button></a></li>
                     <li><a href="../includes/logout.php"><button class="menu__list"><i class="fa fa-sign-out"></i><span>Sair</span></button></a></li>
                 </ul>
             </div>
         </div>
          
       </div>
       <div class="notifications">
           <i class="fa fa-bell-o"></i>
       </div>
   </div>
   <div class="content">
        <div class="tables">
            <button class="btn-criar"><i class="fa fa-plus"></i> Adicionar colaborador</button>
        </div>
       <div class="tables">
           <table class="users" id="myTable">
               <thead>
                   <tr>
                       <th>Nome</th>
                       <th>E-mail</th>
                       <th>Contacto</th>
                       <th>Departamento</th>
                       <th>Categoria</th>
                       <th>Media Geral</th>
                       <th><i class="fa fa-cog"></i></th>
                   </tr>
               </thead>
               <tbody id="users-data">
                  <?php 
                        inserir_usuarios($db);
                   ?>
                   
               </tbody>
           </table>
           <div class="pagination-container">
               <nav>
                   <ul class="pagination"></ul>
               </nav>
           </div>
       </div>
       <div class="tables">
           <table class="users" id="myTable2">
               <thead>
                   <tr>
                       <th>Nome</th>
                       <th>Compt. Prof.</th>
                       <th>Din. Ini.</th>
                       <th>Cumpr. Tarefa</th>
                       <th>Rel. Hum. Trab.</th>
                       <th>Adpt. Func.</th>
                       <th>Disciplina</th>
                       <th>Uso Corr. Eqpto.</th>
                       <th>Apr. Compst.</th>
                       <th>Reun. Mat.</th>
                       <th>Reun. Op.</th>
                       <th>Mês</th>
                       <th>Ano</th>
                       <th><i class="fa fa-cog"></i></th>
                   </tr>
               </thead>
               <tbody>
                  <?php
                        inserir_avaliacao($db);
                   ?>
               </tbody>
           </table>
       </div>
   </div>
    
    <div class="modal">
        <div class="modal-content">
            <span class="close-button">×</span>
            <h1>Ediar Avaliação</h1>
            <hr>
            <div class="modal__body">
                <form action="../includes/update_data.php" method="post">
                    <div class="name__container">
                        <div class="name__box">
                            <div class="label__name">
                                <span>Nome</span>
                            </div>
                            <div class="input__name">
                                <input type="text" id="nome" disabled>
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Sobrenome</span>
                            </div>
                            <div class="input__name">
                                <input type="text" id="sobrenome" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="name__container">
                        <div class="name__box">
                            <div class="label__name">
                                <span>Username</span>
                            </div>
                            <div class="input__name">
                                <input type="text" id="username" disabled>
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Mês</span>
                            </div>
                            <div class="input__name">
                                <input type="text" value="Julho" id="mes" disabled>
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>2019</span>
                            </div>
                            <div class="input__name">
                                <input type="text" id="ano" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="name__container">
                        <div class="name__box">
                            <div class="label__name">
                                <span>Compt. Prof.</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="17" id="compt_prof" name="compt_prof">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Din. Ini.</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="15" id="din_inic" name="din_inic">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Cumpr. Tarefa</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="17" id="cumpr_tpc" name="cumpr_tpc">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Rel. Hum. Trab.</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="15" id="rel_hum_trab" name="rel_hum_trab">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Adpt. Func.</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="16" id="adpt_func" name="adpt_func">
                            </div>
                        </div>
                    </div>
                    <div class="name__container">
                        <div class="name__box">
                            <div class="label__name">
                                <span>Disciplina</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="15" id="disc" name="disc">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Uso Corr. Eppto.</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="17" id="corr_eqpt" name="corr_eqpt">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Apr. Compst.</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="10" id="apr_compst" name="apr_compst">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Reun. Mat.</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="10" id="rm" name="rm">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Reun. Op.</span>
                            </div>
                            <div class="input__name">
                                <input type="number" min="0" max="10" id="ro" name="ro">
                            </div>
                        </div>
                        <input type="hidden" min="0" id="avl" name="avl">
                    </div>
                    <div class="modal__footer">
                        <div class="footer__container">
                            <button type="submit" class="update_av" name="actualizar_av">Actualizar</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
     
     <div class="modal-delete">
        <div class="modal-content2">
            <form action="../includes/delete_data.php" method="post">
                <span class="close-button2">×</span>
                <h1>Eliminar Avaliação</h1>
                <hr>
                <div class="modal__body2">
                    <div class="question">
                        <span>Tem mesmo a certeza que deseja eliminar esta avaliação ?</span>
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-red" name="deletar_av">Confirmar</button>
                    </div>
                </div>
                <input type="hidden" id="delAv" name="delAv"> 
            </form>
             
        </div>
    </div>
    
<div class="modal-userDetails">
    <div class="modal-content3">
        <span class="close-button3">×</span>
        <h1>Ediar Usuário</h1>
        <hr>
        <div class="modal__body3">
            <form action="../includes/update_data.php" method="post">
                <div class="name__container">
                    <div class="name__box">
                        <div class="label__name">
                            <span>Nome</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_nome" name="usr_nome">
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Sobrenome</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_sobrenome" name="usr_sobrenome">
                        </div>
                    </div>
                </div>
                <div class="name__container">
                    <div class="name__box">
                        <div class="label__name">
                            <span>User Login</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_login" name="usr_login">
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Email</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_email" name="usr_email">
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Categoria</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_categoria" name="usr_categoria">
                        </div>
                    </div>
                </div>
                <div class="name__container">
                    <div class="name__box">
                        <div class="label__name">
                            <span>Departamento</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_departamento" name="usr_departamento">
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Palavra-Passe</span>
                        </div>
                        <div class="input__name">
                            <input type="password" id="usr_senha" name="usr_senha">
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Usuário Tipo</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_tipo" name="usr_tipo">
                        </div>
                    </div>
                    <div class="name__box">
                        <div class="label__name">
                            <span>Contacto</span>
                        </div>
                        <div class="input__name">
                            <input type="text" id="usr_contacto" name="usr_contacto">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="usr_id" name="usr_id">
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="update_av" name="actualizar_usr">Actualizar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
   
   <div class="modal-delete-users">
        <div class="modal-content4">
            <form action="../includes/delete_data.php" method="post">
                <span class="close-button4">×</span>
                <h1>Eliminar Usuário</h1>
                <hr>
                <div class="modal__body4">
                    <div class="question">
                        <span>Tem mesmo a certeza que deseja eliminar este colaborador?</span>
                    </div>
                </div> 
                <div class="modal__footer">
                    <div class="footer__container">
                        <button type="submit" class="btn-red" name="deletar_usr"><i class="fa fa-trash"></i> Eliminar</button>
                    </div>
                </div>
                <input type="hidden" id="delUsr" name="delUsr"> 
            </form>
             
        </div>
    </div>
    
    <div class="modal-create-user">
        <div class="modal-content5">
            <span class="close-button5">×</span>
            <h1>Criar Usuário</h1>
            <hr>
            <div class="modal__body5">
                <form action="../includes/insert_data.php" method="post">
                    <div class="name__container">
                        <div class="name__box">
                            <div class="label__name">
                                <span>Nome</span>
                            </div>
                            <div class="input__name">
                                <input type="text" name="novo_nome">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Sobrenome</span>
                            </div>
                            <div class="input__name">
                                <input type="text" name="novo_sobrenome">
                            </div>
                        </div>
                    </div>
                    <div class="name__container">
                        <div class="name__box">
                            <div class="label__name">
                                <span>User Login</span>
                            </div>
                            <div class="input__name">
                                <input type="text" name="novo_login">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Email</span>
                            </div>
                            <div class="input__name">
                                <input type="text" name="novo_email">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Categoria</span>
                            </div>
                            <div class="input__name">
                                <input type="text" name="novo_categoria">
                            </div>
                        </div>
                    </div>
                    <div class="name__container">
                        <div class="name__box">
                            <div class="label__name">
                                <span>Departamento</span>
                            </div>
                            <div class="input__name">
                                <input type="text" name="novo_departamento">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Palavra-Passe</span>
                            </div>
                            <div class="input__name">
                                <input type="password" name="novo_senha">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Usuário Tipo</span>
                            </div>
                            <div class="input__name">
                                <input type="text" name="novo_tipo">
                            </div>
                        </div>
                        <div class="name__box">
                            <div class="label__name">
                                <span>Contacto</span>
                            </div>
                            <div class="input__name">
                                <input type="text" name="novo_contacto">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal__footer">
                        <div class="footer__container">
                            <button type="submit" class="update_av" name="criar_usr"><i class="fa fa-plus"></i> Criar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="../js/dropdown-menu.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           //Português registros
            $('#myTable').DataTable({
                "language": {
                    "sProcessing":    "Procesando...",
                    "sLengthMenu":    "Mostrar _MENU_ registros",
                    "sZeroRecords":   "Nenhum resultado encontrado",
                    "sEmptyTable":    "Sem dados disponíveis",
                    "sInfo":          "Mostrando registros de _START_ á _END_ de um total de _TOTAL_ registros",
                    "sInfoEmpty":     "Mostrando registros de 0 á 0 de um total de 0 registros",
                    "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Procurar:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Carregando...",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sLast":    "Último",
                        "sNext":    "Seguinte",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            //Português Registros
            $('#myTable2').DataTable({
                "language": {
                    "sProcessing":    "Procesando...",
                    "sLengthMenu":    "Mostrar _MENU_ registros",
                    "sZeroRecords":   "Nenhum resultado encontrado",
                    "sEmptyTable":    "Sem dados disponíveis",
                    "sInfo":          "Mostrando registros de _START_ á _END_ de um total de _TOTAL_ registros",
                    "sInfoEmpty":     "Mostrando registros de 0 á 0 de um total de 0 registros",
                    "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Procurar:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Carregando...",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sLast":    "Último",
                        "sNext":    "Seguinte",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>
    <script> 
        $(document).ready(function() { 
            $("#search").on("keyup", function() { 
                var value = $(this).val().toLowerCase(); 
                $("#users-data tr").filter(function() { 
                    $(this).toggle($(this).text() 
                    .toLowerCase().indexOf(value) > -1) 
                }); 
            }); 
        }); 
    </script>
    <script src="../js/modal.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/table.js"></script>
</body>
</html>
