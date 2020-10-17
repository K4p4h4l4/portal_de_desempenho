<?php 

echo '
<div class="hamburger">
    <div class="burgerBar"></div>
</div>
<div class="dashboard">
    <div class="box--header">
        <div class="logo"><img src="../imagens/logo/logo_branco.png" alt="INACOM"></div>
    </div>
    <div class="box">
        <ul class="list">
            <li class="list--item"><a href="col_home"><i class="material-icons">home</i><span class="list__links">Home</span></a></li>
            <li class="list--item"><a href="col_projectos"><i class="material-icons md-white">business_center</i><span class="list__links">Projectos</span></a></li>
            <li class="list--item"><a href="col_noticias"><i class="far fa-newspaper"></i><span class="list__links">Notícias</span></a></li>
            <li class="list--item"><a href="col_formacoes"><i class="material-icons">school</i><span class="list__links">Formações</span></a></li>
            <li class="list--item"><a href="col_ideias"><i class="material-icons rotate-180">wb_incandescent</i><span class="list__links">Ideias</span></a></li>
            <li class="list--item"><a href="col_desempenho"><i class="material-icons">bar_chart</i><span class="list__links">Desempenho</span></a></li>
            <li class="list--item"><a href="col_tarefas"><i class="material-icons">assignment</i><span class="list__links">Tarefas</span></a></li>
            <li class="list--item"><a href="col_saude"><i class="material-icons">favorite</i><span class="list__links">Saúde</span></a></li>
            <li class="list--item"><a href="col_portais"><i class="material-icons">public</i><span class="list__links">Portais</span></a></li>
            <li class="list--item"><a href="col_contactos"><i class="material-icons">contact_phone</i><span class="list__links">Contactos</span></a></li>
            <li class="list--item"><a href="col_profile"><i class="material-icons md-white">person</i><span class="list__links">Perfil</span></a></li>
        </ul>
    </div>
</div>

<div class="navbar">
    <div class="navbar--content">
        <div class="navbar--box-small">
            <button class="notification">
                <a href="col_chat"><i class="fas fa-comments"><span class="not_red_msg" id="not_red_msg"></span></i><a>
            </button>
        </div>
        <div class="navbar--box-small">
            <button class="notification" id="notifications">
                <i class="fa fa-bell"></i><span class="badge"></span>
            </button>
            <div class="dropdown__notificationMenu">
                <div class="menu__notBody">
                    <ul class="menu__not">
                        <li class="dropdown__notificcation">
                            <a href="">
                                <button class="menu__listNot">
                                    <span><strong>Notifications title</strong></span>
                                    <span><i class="notification__text">Alguma coisa escrita por essas bandas que vai adoçar o negócio</i></span>
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <button class="menu__listNot">
                                    <span><strong>Notifications title</strong></span>
                                    <span><i class="notification__text">Alguma coisa escrita por essas bandas que vai adoçar o negócio</i></span>
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
             </div>
        </div>
        <div class="navbar--box-medium">
            <button id="btn-dropdown-menu">
                <div class="logo--container">
                    <img src="../imagens/perfil/'.$_SESSION['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                </div>
                <span>'.$usuario_nome.' '.$usuario_sobrenome.'</span>
                <i class="fa fa-sort-down"></i>
            </button>
            <div class="dropdown__menu">
             <div class="menu__body">
                 <ul class="menu">
                    <li><a href="../col/col_profile"><button class="menu__list"><i class="fa fa-user"></i> <span>Perfil</span></button></a></li>
                     <li><a href="../includes/logout.php"><button class="menu__list"><i class="fa fa-sign-out"></i><span>Sair</span></button></a></li>
                 </ul>
             </div>
         </div>
        </div>
    </div>
</div>
 <section class="content">
';

?>