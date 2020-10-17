<?php 
if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'leonel.augusto') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Leonel Augusto
?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DACA</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamento">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_daca($db);  ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DEETI</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamentoDeeti">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_deeti($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="content2" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DACA</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApproval">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_daca($db);  ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DEETI</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApprovalDeeti">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_deeti($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'luisa.augusto') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Luísa Augusto ?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DAFSG</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamento">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_dafsg($db);  ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DRHTI</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamentoDeeti">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_drhti($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="content2" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DAFSG</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApproval">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_dafsg($db);  ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DRHTI</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApprovalDeeti">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_drhti($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
}elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'ale.fernandes') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Alé Fernandes ?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DEGER</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamento">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_deger($db);  ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DFM</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamentoDeeti">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_dfm($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="content2" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DEGER</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApproval">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_deger($db);  ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DFM</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApprovalDeeti">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_dfm($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'antonio.moniz') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin António Moniz ?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DEC</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamento">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_dec($db);  ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DRMSU</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamentoDeeti">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_drmsu($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="content2" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DEC</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApproval">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_dec($db);  ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DRMSU</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApprovalDeeti">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_drmsu($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
}elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'alvaro.santos') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Álvaro Santos ?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações do DFM CR</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesAndamento">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="7%">Admin</th>
                        <th width="7%">DRHTI</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_allformacoes_dfmcr($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="content2" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">school</i> Formações em análise do DFM CR</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="tableFormacoesApproval">           
                <thead>
                    <tr>
                        <th width="15%">Formação</th>
                        <th width="5%">Entidade</th>
                        <th width="15%">Local</th>                        
                        <th width="5%">Duração</th>
                        <th width="7%">Início</th>
                        <th width="7%">Horário</th>
                        <th width="7%">Chef. Dpto</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_formacoes_para_aprovacao_dfmcr($db);  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
}
?>