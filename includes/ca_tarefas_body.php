<?php

if(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'leonel.augusto') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Leonel Augusto ?>
    <div class="tab__content">
        <div id="content1" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class=".add--box">
                    <button class="btn__ca btn-bkg-darkBlue" id="openAddTarefa"><i class="material-icons">add</i><span>Adicionar</span></button>
                </div>
            </div>
            
            <div class="container3">
        <div class="tasks">
            <!--   Tarefas em curso -->
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInAnalisys_counter($db)?></div>
                        <div class="task__header"><span>Tarefas em análise</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Lista de Tarefas</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInAnalisys($db);?>
                </div>
            </div>
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_ind</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInProgress_counter($db); ?></div>
                        <div class="task__header"><span>Tarefas em Curso</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Em Curso</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInProgress($db);?>
                    
                </div>
            </div>
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_late</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInRevision_counter($db);?></div>
                        <div class="task__header"><span>Tarefas em Revisão</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Em Revisão</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInRevision($db);?>
                    
                </div>
            </div>
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_turned_in</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksConcluded_counter($db); ?></div>
                        <div class="task__header"><span>Tarefas Conluídas</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Concluídas</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksConcluded($db);?>
                </div>
            </div>
            
        </div>
    </div>
        </div>
        <div id="content2" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefas">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_daca($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefasDeeti">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_deeti($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content3" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisao">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_daca($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisaoDeeti">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_deeti($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content4" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuario">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_daca($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuarioDeeti">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_deeti($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content5" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefas">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_daca($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DEETI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefasDeeti">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_deeti($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
<?php }elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'luisa.augusto') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Luísa Augusto ?>
    <div class="tab__content">
        <div id="content1" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class=".add--box">
                    <button class="btn__ca btn-bkg-darkBlue" id="openAddTarefa"><i class="material-icons">add</i><span>Adicionar</span></button>
                </div>
            </div>
            
            <div class="container3">
        <div class="tasks">
            <!--   Tarefas em curso -->
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInAnalisys_counter($db)?></div>
                        <div class="task__header"><span>Tarefas em análise</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Lista de Tarefas</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInAnalisys($db);?>
                </div>
            </div>
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_ind</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInProgress_counter($db); ?></div>
                        <div class="task__header"><span>Tarefas em Curso</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Em Curso</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInProgress($db);?>
                    
                </div>
            </div>
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_late</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInRevision_counter($db);?></div>
                        <div class="task__header"><span>Tarefas em Revisão</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Em Revisão</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInRevision($db);?>
                    
                </div>
            </div>
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_turned_in</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksConcluded_counter($db); ?></div>
                        <div class="task__header"><span>Tarefas Conluídas</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Concluídas</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksConcluded($db);?>
                </div>
            </div>
            
        </div>
    </div>
        </div>
        <div id="content2" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DAFSG</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefas">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_dafsg($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DRHTI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefasDeeti">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_drhti($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content3" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DAFSG</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisao">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_dafsg($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DRHTI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisaoDeeti">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_drhti($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content4" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DAFSG</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuario">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_dafsg($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DRHTI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuarioDeeti">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_drhti($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content5" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DAFSG</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefas">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_dafsg($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DRHTI</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefasDeeti">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_drhti($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
<?php }elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'ale.fernandes') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Alé Fernandes ?>
    <div class="tab__content">
        <div id="content1" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class=".add--box">
                    <button class="btn__ca btn-bkg-darkBlue" id="openAddTarefa"><i class="material-icons">add</i><span>Adicionar</span></button>
                </div>
            </div>
            
            <div class="container3">
                <div class="tasks">
                    <!--   Tarefas em curso -->
                    <div class="task__card">
                        <div class="task__counter">
                            <div class="task__icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <div class="task__counterHolder">
                                <div class="task__numbers"><?php echo "0".tasksInAnalisys_counter($db)?></div>
                                <div class="task__header"><span>Tarefas em análise</span></div>
                            </div>
                        </div>
                        <div class="list__header">
                            <span>Lista de Tarefas</span>
                        </div>
                        <div class="list__card">
                            <?php echo read_tasksInAnalisys($db);?>
                        </div>
                    </div>

                    <div class="task__card">
                        <div class="task__counter">
                            <div class="task__icon">
                                <i class="material-icons">assignment_ind</i>
                            </div>
                            <div class="task__counterHolder">
                                <div class="task__numbers"><?php echo "0".tasksInProgress_counter($db); ?></div>
                                <div class="task__header"><span>Tarefas em Curso</span></div>
                            </div>
                        </div>
                        <div class="list__header">
                            <span>Em Curso</span>
                        </div>
                        <div class="list__card">
                            <?php echo read_tasksInProgress($db);?>

                        </div>
                    </div>


                    <div class="task__card">
                        <div class="task__counter">
                            <div class="task__icon">
                                <i class="material-icons">assignment_late</i>
                            </div>
                            <div class="task__counterHolder">
                                <div class="task__numbers"><?php echo "0".tasksInRevision_counter($db);?></div>
                                <div class="task__header"><span>Tarefas em Revisão</span></div>
                            </div>
                        </div>
                        <div class="list__header">
                            <span>Em Revisão</span>
                        </div>
                        <div class="list__card">
                            <?php echo read_tasksInRevision($db);?>

                        </div>
                    </div>


                    <div class="task__card">
                        <div class="task__counter">
                            <div class="task__icon">
                                <i class="material-icons">assignment_turned_in</i>
                            </div>
                            <div class="task__counterHolder">
                                <div class="task__numbers"><?php echo "0".tasksConcluded_counter($db); ?></div>
                                <div class="task__header"><span>Tarefas Conluídas</span></div>
                            </div>
                        </div>
                        <div class="list__header">
                            <span>Concluídas</span>
                        </div>
                        <div class="list__card">
                            <?php echo read_tasksConcluded($db);?>
                        </div>
                    </div>

                </div>
        </div>
        </div>
        <div id="content2" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DEGER</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefas">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_deger($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DFM</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefasDeeti">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_dfm($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content3" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DEGER</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisao">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_deger($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DFM</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisaoDeeti">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_dfm($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content4" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DEGER</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuario">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_deger($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DFM</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuarioDeeti">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_dfm($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content5" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DEGER</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefas">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_deger($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DFM</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefasDeeti">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_dfm($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
<?php }elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'antonio.moniz') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin António Moniz ?>
    <div class="tab__content">
        <div id="content1" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class=".add--box">
                    <button class="btn__ca btn-bkg-darkBlue" id="openAddTarefa"><i class="material-icons">add</i><span>Adicionar</span></button>
                </div>
            </div>
            <div class="container3">
        <div class="tasks">
            <!--   Tarefas em curso -->
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInAnalisys_counter($db)?></div>
                        <div class="task__header"><span>Tarefas em análise</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Lista de Tarefas</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInAnalisys($db);?>
                </div>
            </div>
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_ind</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInProgress_counter($db); ?></div>
                        <div class="task__header"><span>Tarefas em Curso</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Em Curso</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInProgress($db);?>
                    
                </div>
            </div>
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_late</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksInRevision_counter($db);?></div>
                        <div class="task__header"><span>Tarefas em Revisão</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Em Revisão</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksInRevision($db);?>
                    
                </div>
            </div>
            
            
            <div class="task__card">
                <div class="task__counter">
                    <div class="task__icon">
                        <i class="material-icons">assignment_turned_in</i>
                    </div>
                    <div class="task__counterHolder">
                        <div class="task__numbers"><?php echo "0".tasksConcluded_counter($db); ?></div>
                        <div class="task__header"><span>Tarefas Conluídas</span></div>
                    </div>
                </div>
                <div class="list__header">
                    <span>Concluídas</span>
                </div>
                <div class="list__card">
                    <?php echo read_tasksConcluded($db);?>
                </div>
            </div>
            
        </div>
    </div>
        </div>
        <div id="content2" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DEC</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefas">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_dec($db); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DRMSU</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefasDeeti">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_drmsu($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content3" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DEC</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisao">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_dec($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DRMSU</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisaoDeeti">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_drmsu($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content4" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DEC</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuario">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_dec($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DRMSU</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuarioDeeti">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_drmsu($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content5" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DEC</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefas">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_dec($db); ?>
                    </tbody>
                </table>
            </div>
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DRMSU</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefasDeeti">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_drmsu($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
<?php }elseif(isset($_SESSION['usuario_id']) && ($_SESSION['usuario_login'] == 'alvaro.santos') && ($_SESSION['usuario_tipo'] == 'admin')){ //Admin Álvaro Santos ?>
    <div class="tab__content">
        <div id="content1" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class=".add--box">
                    <button class="btn__ca btn-bkg-darkBlue" id="openAddTarefa"><i class="material-icons">add</i><span>Adicionar</span></button>
                </div>
            </div>
            
            <div class="container3">
                <div class="tasks">
                    <!--   Tarefas em curso -->
                    <div class="task__card">
                        <div class="task__counter">
                            <div class="task__icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <div class="task__counterHolder">
                                <div class="task__numbers"><?php echo "0".tasksInAnalisys_counter($db)?></div>
                                <div class="task__header"><span>Tarefas em análise</span></div>
                            </div>
                        </div>
                        <div class="list__header">
                            <span>Lista de Tarefas</span>
                        </div>
                        <div class="list__card">
                            <?php echo read_tasksInAnalisys($db);?>
                        </div>
                    </div>

                    <div class="task__card">
                        <div class="task__counter">
                            <div class="task__icon">
                                <i class="material-icons">assignment_ind</i>
                            </div>
                            <div class="task__counterHolder">
                                <div class="task__numbers"><?php echo "0".tasksInProgress_counter($db); ?></div>
                                <div class="task__header"><span>Tarefas em Curso</span></div>
                            </div>
                        </div>
                        <div class="list__header">
                            <span>Em Curso</span>
                        </div>
                        <div class="list__card">
                            <?php echo read_tasksInProgress($db);?>

                        </div>
                    </div>


                    <div class="task__card">
                        <div class="task__counter">
                            <div class="task__icon">
                                <i class="material-icons">assignment_late</i>
                            </div>
                            <div class="task__counterHolder">
                                <div class="task__numbers"><?php echo "0".tasksInRevision_counter($db);?></div>
                                <div class="task__header"><span>Tarefas em Revisão</span></div>
                            </div>
                        </div>
                        <div class="list__header">
                            <span>Em Revisão</span>
                        </div>
                        <div class="list__card">
                            <?php echo read_tasksInRevision($db);?>

                        </div>
                    </div>


                    <div class="task__card">
                        <div class="task__counter">
                            <div class="task__icon">
                                <i class="material-icons">assignment_turned_in</i>
                            </div>
                            <div class="task__counterHolder">
                                <div class="task__numbers"><?php echo "0".tasksConcluded_counter($db); ?></div>
                                <div class="task__header"><span>Tarefas Conluídas</span></div>
                            </div>
                        </div>
                        <div class="list__header">
                            <span>Concluídas</span>
                        </div>
                        <div class="list__card">
                            <?php echo read_tasksConcluded($db);?>
                        </div>
                    </div>

                </div>
        </div>
        </div>
        <div id="content2" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas do DFM CR</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tableTarefas">           
                    <thead>
                        <tr>
                            <th width="20%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="5%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_dfmcr($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content3" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas em revisão do DFM CR</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasEmRevisao">           
                    <thead>
                        <tr>
                            <th width="25%">Tarefas</th>
                            <th width="10%">Prioridade</th>
                            <th width="15%">Início</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_revisao_dfmcr($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content4" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i>Número de tarefas por colaborador do DACA</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="tarefasPorUsuario">           
                    <thead>
                        <tr>
                            <th width="25%">Nome</th>
                            <th width="9%">Prio. Alta</th>
                            <th width="9%">Prio. Média</th>
                            <th width="9%">Prio. Baixa</th>
                            <th width="9%">Por iniciar</th>
                            <th width="9%">Em curso</th>
                            <th width="9%">Em revisão</th>
                            <th width="9%">Concluídas</th>
                            <th width="9%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_tarefas_per_user_dfmcr($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="content5" class="content__tab">
            <div class="container animate__moveInBottom">
                <div class="table_menu">
                    <h2><i class="material-icons">assignment</i> Tarefas dos colaboradores do DFM CR</h2>
                </div>
                <hr class="gray--hr">
                <table class="content-table" id="todasTarefas">           
                    <thead>
                        <tr>
                            <th width="15%">Tarefas</th>
                            <th width="15%">Nome</th>
                            <th width="15%">Prioridade</th>
                            <th width="15%">Inicio</th>
                            <th width="15%">Fim</th>
                            <th width="15%">Status</th>
                            <th width="10%">(%)</th>
                            <th width="10%"><i class="material-icons">settings</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php read_allUser_tasks_dfmcr($db); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
<?php }                                                                                                                                       
?>