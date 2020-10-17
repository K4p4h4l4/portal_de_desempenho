<!DOCTYPE html>
<?php
    require("../includes/conexao.php");
    require("../includes/read_data.php");
    include("../includes/check_token.php");

    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_dpto'] == "DRHTI") ){
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
        if((time() - $_SESSION['ultimo_login']) > 3600){
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/emojionearea.min.css">
    <link rel="icon" href="../imagens/icons/INACOM.ico"> 
    <!--link rel="stylesheet" href="../css/col_base.css"-->
    <link rel="stylesheet" href="../css/av.css"> 
    
    
    <link rel="stylesheet" href="../css/coming_soon.css">
    <link rel="stylesheet" href="../css/col_chat.css">
    <script type="text/javascript" src="../js/jquery/341/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/004db0217c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/emojionearea.min.js"></script>
</head>

<body>
    <?php include('../includes/dashboard_rh.php'); ?>
    <br>
    <br>
    <br>
    <section class="content">
       <div class="container4">
           <div class="chat__container">
               <div class="chat__usersContainer">
                   <div class="chat__usersSearchContainer">
                       <input type="text" class="search" id="search" placeholder="Procurar Usuários">
                       <!--div class="user__searchHolder">
                           
                       </div-->
                   </div>
                   <div class="chat__usersHolder" id="users__holder">
                       <div class="chart__usersCard">
                           <div class="chat__userImgBox">
                               <img src="../imagens/chat/lebron-james.jpg" alt="imagem de perfil" class="chat__userImg">
                               <div class="user__status on"></div>
                           </div>
                           <div class="user__detailsBox">
                               <div class="user__boxTop">
                                   <div class="user__name">Lebron James</div>
                                   <div class="user__lastSeenDate">05/05/2020</div>
                               </div>
                               <div class="user__lastMessage">
                                   <span>Aqui vai estar a mensagem</span>
                               </div>
                           </div>
                           <div class="chat__notification">
                               24
                           </div>
                       </div>                      
                       
                       <div class="chart__usersCard">
                           <div class="chat__userImgBox">
                               <img src="../imagens/chat/kevin-durant.jpg" alt="imagem de perfil" class="chat__userImg">
                               <div class="user__status off"></div>
                           </div>
                           <div class="user__detailsBox">
                               <div class="user__boxTop">
                                   <div class="user__name">Kevin Durant</div>
                                   <div class="user__lastSeenDate">05/05/2020</div>
                               </div>
                               <div class="user__lastMessage">
                                   <span>Aqui vai estar a mensagem</span>
                               </div>
                           </div>
                           <div class="chat__notification">
                               4
                           </div>
                       </div>                       
                       
                   </div>
               </div>
               <div class="user__chatBox">
                   <div class="user__chatHeader">
                       <div class="user__chatCard">
                           <div class="user__chatImgBox">
                               <img src="../imagens/logo/logo%20grx.jpg" alt="Imagem de perfil" class="user__chatImg user__chatImgMain">
                           </div>
                           <div class="user__chatDetails">
                               <div class="user__chatName">INACOM</div>
                               <div class="user__chatStatus">O INACOM garante a qualidade e transparência das comunicações Angolanas</div>
                               <div class="my__chatId" id="<?php echo $_SESSION['usuario_id']?>"></div>
                           </div>
                       </div>
                   </div>
                   <div class="chat__messagesBox" id="out">                       
                   </div>
                   <div class="user__chatBottom">
                       <textarea name="message" id="message" cols="30" rows="10" class="textMessage__input" placeholder="Escreva a sua mensagem"></textarea>
                       <button class="btn__sendMessage"><i class="material-icons">send</i></button>
                   </div>
               </div>
           </div>
       </div> 
    </section>
    
    <script src="../js/dropdown-menu.js"></script>
    <script src="../js/check_token.js"></script>
    <script src="../js/table.js"></script>
    <script src="../js/textEditor.js"></script>
    <script src="../js/col_chat.js"></script>
    <script src="../js/check_msg.js"></script>
    <script>
        $('#message').emojioneArea({
            pikerPosition:"top",
            searchPlaceholder: "Procurar"
        });
    </script>
    <!-- script src="../js/check_browser_tab_close.js"></script -->
</body>
</html>
