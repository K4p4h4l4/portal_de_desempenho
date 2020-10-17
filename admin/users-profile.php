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
    <title>Painel de Controlo - Usuários</title>
    
    <link rel="icon" href="../imagens/icons/INACOM.ico">
    
    <!-- Goole Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../css/users-profile.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> 
    </script>
    
    <!--script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.min.js"></script-->
</head>

<body>
   <div class="sidebar">
       <div class="brand">
           <a href="control.php">
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
                    <li><a href="../admin/users-profile.php"><button class="menu__list"><i class="fa fa-user"></i> <span>Perfil</span></button></a></li>
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
       <div class="profile">
           <div class="profile__details">
               <div class="profile__header">
                   <div class="profile__image">
                       <img src="../imagens/perfil/warren-wong-bh4LQHcOcxE-unsplash.jpg" alt="Teste">
                   </div>
                   <div class="profile__name"><span><?php echo $usuario_nome." ".$usuario_sobrenome ?></span></div>
                   <hr>
               </div>
               <div class="profile__bottom">
                   <div class="profile__title">
                       <span>Contactos</span>
                    </div>
                   <div class="profile__contacts">
                       <h3>Endereço email</h3>
                       <span><?php echo $usuario_email ?></span>
                   </div>
                   <div class="profile__contacts">
                       <h3>Número de telefone</h3>
                       <span><?php echo $usuario_contacto ?></span>
                   </div>
               </div>
           </div>
           <div class="profile__edit">
               <div class="edit__header">
                   <div class="header__box">
                       <span>Configurações</span>
                   </div>
               </div>
               <div class="edit__body">
                   <form action="../includes/update_data.php" method="post" id="admin_form" enctype="multipart/form-data">
                    <div><p id="msg" style="font-size:1.5rem; color:red;"></p></div>
                   <div class="photo__box">
                       <div class="photo__label">
                           <label for="somthing">Imagem Usuário :</label>
                       </div>
                       <div class="photo__input">
                           <input type="file" name="usr_picture" id="usr_picture" accept="image/*" onchange="return fileValidation();">
                       </div>
                   </div>
                   <div class="user__box">
                       <div class="user__details">
                           <div class="name__label">
                               <label for="">Nome</label>
                           </div>
                           <div class="details__input">
                               <input type="text" value="<?php echo $usuario_nome ?>" id="usr_nome" name="usr_nome" disabled>
                           </div>
                       </div>
                       <div class="user__details">
                           <div class="name__label">
                               <label for="">Sobrenome</label>
                           </div>
                           <div class="details__input">
                               <input type="text" value="<?php echo $usuario_sobrenome ?>" id="usr_sobrenome" name="usr_sobrenome" disabled>
                           </div>
                       </div>
                   </div>
                   
                       <div class="user__box-2">
                           <div class="user__details-2">
                               <div class="name__label">
                                   <label for="">Nome de Usuário</label>
                               </div>
                               <div class="details__input">
                                   <input type="text" value="<?php echo $usuario_login ?>" id="usr_login" name="usr_login">
                               </div>
                           </div>
                           <div class="user__details-2">
                               <div class="name__label">
                                   <label for="">Email</label>
                               </div>
                               <div class="details__input">
                                   <input type="email" value="<?php echo $usuario_email ?>" id="usr_email" name="usr_email">
                               </div>
                           </div>
                           <div class="user__details-2">
                               <div class="name__label">
                                   <label for="">Palavra-Passe Antiga</label>
                               </div>
                               <div class="details__input">
                                   <input type="password" value="" id="old_pw" name="old_pw">
                               </div>
                           </div>
                           <div class="user__details-2">
                               <div class="name__label">
                                   <label for="">Nova Palavra-Passe</label>
                               </div>
                               <div class="details__input">
                                   <input type="password" id="new_pw" name="new_pw">
                               </div>
                           </div>
                           <div class="user__details-2">
                               <div class="name__label">
                                   <label for="" name="">Confirmar Palavra-Passe</label>
                               </div>
                               <div class="details__input">
                                   <input type="password" id="confirm_pw" name="confirm_pw">
                                   <input type="hidden" value="admin" id="usr_admin">
                               </div>
                           </div>
                       </div>
                       <div class="button__box">
                           <button type="submit" name="update_admin" id="update_admin" form="admin_form"><span>Actualizar Perfil</span></button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
    <script type="text/javascript">
        function fileValidation(){
            var fileInput = document.getElementById('usr_picture');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.png|\.bmp|\.jpeg|\.jfif|\.xbm)$/i;
            if(!allowedExtensions.exec(filePath)){
                alert('Por favor insira imagens do tipo JPG, PNG, BMP, JFIF e JPEG.  Obrigado');
                fileInput.value = '';
                return false;
            }
        }
    </script>
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/update_admin.js"></script>
    <script src="../js/check_token.js"></script>
    
</body>
</html>
