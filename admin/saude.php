<!DOCTYPE html>
<?php
    require("../includes/conexao.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

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
    <title>Painel de Controlo - Dicas de Saúde</title>
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    
    <!-- Goole Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../css/saude.css">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> 
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
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
            <button class="btn-criar"><i class="fa fa-plus"></i> Saúde</button>
        </div>
        
        <div class="tables">
           <table class="users" id="myTable">
               <thead>
                   <tr>
                       <th width=10%>Imagem</th>
                       <th width=15%>Título</th>
                       <th width=55%>Mensagem</th>
                       <th width=15%>Data</th>
                       <th width=5%><i class="fa fa-cog"></i></th>
                   </tr>
               </thead>
               <tbody id="users-data">
                  <?php 
                        inserir_dicas_saude($db);
                   ?>
                   
               </tbody>
           </table>
       </div>
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
                        <textarea id="" cols="30" rows="10" name="dica_mensagem" ></textarea>
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
                        <textarea id="update_dica_mensagem" cols="30" rows="10" name="uptade_dica_mensagem" ></textarea>
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
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/modal2.js"></script>   
    <script src="../js/check_token.js"></script>
</body>
</html>
