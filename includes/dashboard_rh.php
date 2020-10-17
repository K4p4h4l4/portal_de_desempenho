<?php 

echo '<header>
        <div class="header">
            <div class="navbar-bbrand"><img src="../imagens/logo/logo_branco.png"></div>
            <div class="nome_topo">
                <div class="navbar--box-small">
                    <button class="notification">
                        <a href="chat"><i class="fas fa-comments"><span class="not_red_msg" id="not_red_msg"></span></i><a>
                    </button>
                </div>
                <div class="lista_topo">
                    <div class="logo--container">
                        <img src="../imagens/perfil/'.$_SESSION['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                    </div>
                </div>
                <div class="lista_topo">
                    <a class="link_topo">
                        '.$_SESSION['usuario_nome']." ".$_SESSION['usuario_sobrenome'].'
                    </a>
                </div>
                <div class="lista_topo">
                    <a href="../includes/logout.php" class="link_topo">
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fa fa-sign-out"></i>Sair
                        </button>
                    </a>
                </div>
            </div>
            
        </div>
        
        <div class="hamburger">
            <div class="burgerBar"></div>
        </div>
        <div id="sidebarMenu">
            <ul class="sidebarMenuInner">
                <li><a href="../drhti/avaliacao"><i class="material-icons">timeline</i> <span class="list__links">Avaliar</span></a></li>
                <li><a href="../drhti/noticias"><i class="far fa-newspaper"></i> <span class="list__links">Notícias</span></a></li>
                <li><a href="../drhti/desempenho"><i class="material-icons">bar_chart</i> <span class="list__links">Desempenho</span></a></li>
                <li><a href="../drhti/colaboradores"><i class="material-icons">list_alt</i> <span class="list__links">Relatórios</span></a></li>
                <li><a href="../drhti/avaliacao_pont_asse"><i class="material-icons">alarm</i> <span class="list__links">Av. Pont & Ass.</span></a></li>
                <li><a href="../drhti/projectos"><i class="material-icons">business_center</i> <span class="list__links">projectos</span></a></li>
                <li><a href="../drhti/formacoes"><i class="material-icons">school</i> <span class="list__links">formações</span></a></li>
                <li><a href="../drhti/tarefas"><i class="material-icons">assignment</i> <span class="list__links">tarefas</span></a></li>
                <li><a href="../drhti/portais"><i class="material-icons">public</i> <span class="list__links">portais</span></a></li>
                <li><a href="../drhti/contactos"><i class="material-icons">contact_phone</i> <span class="list__links">contactos</span></a></li>
                <li><a href="../drhti/perfil"><i class="material-icons">person</i> <span class="list__links">perfil</span></a></li>
            </ul>
        </div>
    </header>';

?>