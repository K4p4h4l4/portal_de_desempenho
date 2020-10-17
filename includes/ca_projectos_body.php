<?php

    if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'leonel.augusto') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Leonel Augusto ?>
    <div class="tab__content">
        <div id="content1" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class=".add--box">
                    <button class="btn__ca btn-bkg-darkBlue" id="addProjecModal"><i class="material-icons">add</i><span>Adicionar</span></button>
                </div>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do CA</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosCa">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_ca($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DACA</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDaca">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEETI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DAFSG</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDafsg">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dafsg($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DRHTI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDrhti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_drhti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEGER</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeger">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deger($db); ?>
                    </tbody>
                </table>
            </div>
    
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DFM</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDfm">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dfm($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEC</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDec">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dec($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DRMSU</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDrmsu">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_drmsu($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DFM CR</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDfmcr">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dfmcr($db); ?>
                    </tbody>
                </table>
            </div>
            
        </div>
        <div id="content2" class="content__tab">

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnalise">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DAFSG</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDafsg">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dafsg($db); ?>
                </tbody>
            </table>
        </div>
        
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DRHTI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDrhti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_drhti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEGER</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDeger">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_deger($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfm">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfm($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEC</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDec">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dec($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DRMSU</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDrmsu">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_drmsu($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM CR</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfmcr">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfmcr($db); ?>
                </tbody>
            </table>
        </div>
        </div>
           
        <div id="content3" class="content__tab">  
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos para confirmação de conclusão</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosPeruser">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_para_confirmacao_conclusao_deetiDaca($db); ?>
                    </tbody>
                </table>
            </div>

            <!--div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos por colaborador do <?php echo $usuario_departamento; ?></h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosPeruser">
                    <thead>
                        <tr>
                            <th width="25%">Projecto</th>
                            <th width="15%">Nome</th>
                            <th width="10%">Início</th>
                            <th width="10%">Fim</th>
                            <th width="10%">( % )</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        < ?php echo listar_projectos_perUser($db); ?>
                    </tbody>
                </table>
            </div-->
        </div>
    </div>
        <?php 
        
    }elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'luisa.augusto') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Luísa Augusto ?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class=".add--box">
                <button class="btn__ca btn-bkg-darkBlue" id="addProjecModal"><i class="material-icons">add</i><span>Adicionar</span></button>
            </div>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do CA</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosCa">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_ca($db); ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do DAFSG</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosDafsg">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_dafsg($db); ?>
                </tbody>
            </table>
        </div>

        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do DRHTI</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosDrhti">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_drhti($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DACA</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDaca">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEETI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEGER</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeger">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deger($db); ?>
                    </tbody>
                </table>
            </div>
    
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DFM</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDfm">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dfm($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEC</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDec">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dec($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DRMSU</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDrmsu">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_drmsu($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DFM CR</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDfmcr">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dfmcr($db); ?>
                    </tbody>
                </table>
            </div>
    </div>
       
    <div id="content2" class="content__tab">  
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DAFSG</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDafsg">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dafsg($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DRHTI</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDrhti">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_drhti($db); ?>
                </tbody>
            </table>
        </div>
                    <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnalise">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEGER</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDeger">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_deger($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfm">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfm($db); ?>
                </tbody>
            </table>
        </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEC</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDec">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dec($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DRMSU</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDrmsu">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_drmsu($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM CR</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfmcr">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfmcr($db); ?>
                </tbody>
            </table>
        </div>
    </div>
      
    <div id="content3" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos para confirmação de conclusão</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_para_confirmacao_conclusao_drhtiDafsg($db); ?>
                </tbody>
            </table>
        </div>
        
        <!--div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos por colaborador do < ?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="25%">Projecto</th>
                        <th width="15%">Nome</th>
                        <th width="10%">Início</th>
                        <th width="10%">Fim</th>
                        <th width="10%">( % )</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    < ?php echo listar_projectos_perUser($db); ?>
                </tbody>
            </table>
        </div-->
    </div>
</div>
        <?php
    }elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'ale.fernandes') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Alé Fernandes ?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class=".add--box">
                <button class="btn__ca btn-bkg-darkBlue" id="addProjecModal"><i class="material-icons">add</i><span>Adicionar</span></button>
            </div>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do CA</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosCa">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_ca($db); ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do DEGER</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosDeger">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_deger($db); ?>
                </tbody>
            </table>
        </div>
    
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do DFM</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosDfm">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_dfm($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DACA</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDaca">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEETI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DAFSG</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDafsg">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dafsg($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DRHTI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDrhti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_drhti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEC</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDec">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dec($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DRMSU</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDrmsu">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_drmsu($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DFM CR</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDfmcr">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dfmcr($db); ?>
                    </tbody>
                </table>
            </div>
    </div>
    <div id="content2" class="content__tab">  
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEGER</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDeger">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_deger($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfm">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfm($db); ?>
                </tbody>
            </table>
        </div>
        
                    <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDaca">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DAFSG</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDafsg">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dafsg($db); ?>
                </tbody>
            </table>
        </div>
        
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DRHTI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDrhti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_drhti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEC</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDec">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dec($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DRMSU</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDrmsu">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_drmsu($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM CR</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfmcr">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfmcr($db); ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="content3" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos para confirmação de conclusão</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_para_confirmacao_conclusao_dfmDeger($db); ?>
                </tbody>
            </table>
        </div>
        
        <!--div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos por colaborador do < ?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="25%">Projecto</th>
                        <th width="15%">Nome</th>
                        <th width="10%">Início</th>
                        <th width="10%">Fim</th>
                        <th width="10%">( % )</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    < ?php echo listar_projectos_perUser($db); ?>
                </tbody>
            </table>
        </div-->
    </div>
</div>
        <?php
    }elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'antonio.moniz') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin António Moniz ?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class=".add--box">
                <button class="btn__ca btn-bkg-darkBlue" id="addProjecModal"><i class="material-icons">add</i><span>Adicionar</span></button>
            </div>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do CA</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosCa">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_ca($db); ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do DEC</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosDec">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_dec($db); ?>
                </tbody>
            </table>
        </div>

        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do DRMSU</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosDrmsu">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_drmsu($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DACA</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDaca">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEETI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DAFSG</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDafsg">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dafsg($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DRHTI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDrhti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_drhti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEGER</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeger">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deger($db); ?>
                    </tbody>
                </table>
            </div>
    
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DFM</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDfm">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dfm($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DFM CR</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDfmcr">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dfmcr($db); ?>
                    </tbody>
                </table>
            </div>
    </div>
    <div id="content2" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEC</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDec">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dec($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DRMSU</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDrmsu">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_drmsu($db); ?>
                </tbody>
            </table>
        </div>
        
                    <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDaca">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DAFSG</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDafsg">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dafsg($db); ?>
                </tbody>
            </table>
        </div>
        
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DRHTI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDrhti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_drhti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEGER</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDeger">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_deger($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfm">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfm($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM CR</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfmcr">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfmcr($db); ?>
                </tbody>
            </table>
        </div>
    </div>
        
    <div id="content3" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos para confirmação de conclusão</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_para_confirmacao_conclusao_drmsuDec($db); ?>
                </tbody>
            </table>
        </div>
        
        <!--div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos por colaborador do < ?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="25%">Projecto</th>
                        <th width="15%">Nome</th>
                        <th width="10%">Início</th>
                        <th width="10%">Fim</th>
                        <th width="10%">( % )</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    < ?php echo listar_projectos_perUser($db); ?>
                </tbody>
            </table>
        </div-->
    </div>
</div>
        <?php
    }elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'alvaro.santos') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Álvaro Santos ?>
<div class="tab__content">
    <div id="content1" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class=".add--box">
                <button class="btn__ca btn-bkg-darkBlue" id="addProjecModal"><i class="material-icons">add</i><span>Adicionar</span></button>
            </div>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do CA</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosCa">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_ca($db); ?>
                </tbody>
            </table>
        </div>
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos do DFM CR</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosDfmcr">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_dfmcr($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DACA</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDaca">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEETI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DAFSG</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDafsg">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dafsg($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DRHTI</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDrhti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_drhti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEGER</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDeger">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_deger($db); ?>
                    </tbody>
                </table>
            </div>
    
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DFM</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDfm">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dfm($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DEC</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDec">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_dec($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos do DRMSU</h2>
                </div>
                <hr class="gray--hr">

                <table class="content-table" id="tableProjectosDrmsu">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectos_drmsu($db); ?>
                    </tbody>
                </table>
            </div>
    </div>
    
    <div id="content2" class="content__tab"> 
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM CR</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfmcr">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfmcr($db); ?>
                </tbody>
            </table>
        </div>
        
                    <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDaca">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_daca($db); ?>
                    </tbody>
                </table>
            </div>

            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDeeti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_deeti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DAFSG</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDafsg">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dafsg($db); ?>
                </tbody>
            </table>
        </div>
        
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">business_center</i> Projectos em análise do DRHTI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="projectosEmAnaliseDrhti">
                    <thead>
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="8%">( % )</th>
                            <th width="15%">Responsável</th>
                            <th width="20%">Fase</th>
                            <th width="8%">Início</th>
                            <th width="10%">Chef. Dpto.</th>
                            <th width="10%">C.A.</th>
                            <th width="10%">Status</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo listar_projectosEmAnalise_drhti($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEGER</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDeger">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_deger($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DFM</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDfm">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dfm($db); ?>
                </tbody>
            </table>
        </div>
            
            <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DEC</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDec">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_dec($db); ?>
                </tbody>
            </table>
        </div>
        
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos em análise do DRMSU</h2>
            </div>
            <hr class="gray--hr">
            <table class="content-table" id="projectosEmAnaliseDrmsu">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="20%">Fase</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectosEmAnalise_drmsu($db); ?>
                </tbody>
            </table>
        </div>
    </div>
       
    <div id="content3" class="content__tab">
        <div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos para confirmação de conclusão</h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="8%">( % )</th>
                        <th width="15%">Responsável</th>
                        <th width="8%">Início</th>
                        <th width="10%">Chef. Dpto.</th>
                        <th width="10%">C.A.</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo listar_projectos_para_confirmacao_conclusao_dfmcr($db); ?>
                </tbody>
            </table>
        </div>
        
        <!--div class="container animate__moveInBottom">
            <div class="table_menu">
                <h2><i class="material-icons">business_center</i> Projectos por colaborador do <?php echo $usuario_departamento; ?></h2>
            </div>
            <hr class="gray--hr">

            <table class="content-table" id="tableProjectosPeruser">
                <thead>
                    <tr>
                        <th width="25%">Projecto</th>
                        <th width="15%">Nome</th>
                        <th width="10%">Início</th>
                        <th width="10%">Fim</th>
                        <th width="10%">( % )</th>
                        <th width="10%">Status</th>
                        <th width="5%"><i class="material-icons">settings</i></th>
                    </tr>
                </thead>
                <tbody>
                    < ?php echo listar_projectos_perUser($db); ?>
                </tbody>
            </table>
        </div-->
    </div>
</div>
        <?php
    }
?>


