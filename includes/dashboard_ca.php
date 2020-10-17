<?php 

echo '<header>
        <div class="header">
            <div class="navbar-bbrand"><img src="../imagens/logo/logo_branco.png"></div>
            <div class="nome_topo">
                <div class="navbar--box-small">
                    <button class="notification">
                        <a href="ca_chat"><i class="fas fa-comments"><span class="not_red_msg" id="not_red_msg"></span></i><a>
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
                <li><a href="../ca/ca_noticias"><i class="far fa-newspaper"></i> <span class="list__links">noticias</span></a></li>
                <li><a href="../ca/ca_projectos"><i class="material-icons">business_center</i> <span class="list__links">projectos</span></a></li>
                <li><a href="../ca/ca_desempenho"><i class="material-icons">bar_chart</i> <span class="list__links">desempenho</span></a></li>
                <li><a href="../ca/ca_relatorios"><i class="material-icons">list_alt</i> <span class="list__links">Relatórios</span></a></li>
                <li><a href="../ca/ca_formacoes"><i class="material-icons">school</i> <span class="list__links">formações</span></a></li>
                <li><a href="../ca/ca_tarefas"><i class="material-icons">assignment</i> <span class="list__links">tarefas</span></a></li>
                <li><a href="../ca/ca_saude"><i class="material-icons">favorite</i><span class="list__links">Saúde</span></a></li>
                <li><a href="../ca/ca_portais"><i class="material-icons">public</i> <span class="list__links">portais</span></a></li>
                <li><a href="../ca/ca_contactos"><i class="material-icons">contact_phone</i> <span class="list__links">contactos</span></a></li>
                <li><a href="../ca/ca_perfil"><i class="material-icons">person</i> <span class="list__links">perfil</span></a></li>
            </ul>
        </div>
    </header>';

?>