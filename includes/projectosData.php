<?php 

    Class ProjectoInfo{
        
        public function get_project_data($db, $id){
            $query = "select * from tb_projectos where projecto_id='$id' ";
            $result = mysqli_query($db,$query);
            $row = mysqli_fetch_assoc($result);
            
            return $row;
        }
        
        public function get_user_project_data($db){
            $output = array();
            
            $query = "SELECT tb_projectos.projecto_id, tb_projectos.projecto_uid, tb_projectos.projecto_nome, tb_projectos.projecto_inicio, tb_projectos.projecto_fim, tb_projectos.projecto_status, tb_projectos.projecto_aprovacao_ca,  tb_projectos.projecto_aprovacao_chefeDpto, tb_projectos.projecto_percent, tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome FROM tb_projectos INNER JOIN tb_usuarios INNER JOIN tb_membrosproject WHERE tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid and tb_membrosproject.membrosproject_uid = tb_usuarios.usuario_id AND tb_usuarios.usuario_id = '".$_SESSION['usuario_id']."' order by tb_projectos.projecto_id desc limit 100";
            $result = mysqli_query($db,$query);
            
            while($row = mysqli_fetch_assoc($result)){
                $output[] = array(
                    "projecto_id" => $row['projecto_id'],
                    "projecto_uid" => $row['projecto_uid'],
                    "usuario_nome_sobrenome" => $row['usuario_nome'].' '.$row['usuario_sobrenome'],
                    "projecto_nome" => $row['projecto_nome'],
                    "projecto_inicio" => $row['projecto_inicio'],
                    "projecto_fim" => $row['projecto_fim'],
                    "projecto_status" => $row['projecto_status'],
                    "projecto_aprovacao_ca" => $row['projecto_aprovacao_ca'],
                    "projecto_aprovacao_chefeDpto" => $row['projecto_aprovacao_chefeDpto'],
                    "projecto_percent" => $row['projecto_percent']
                );
            }
            
            return $output;
        }
        
        public function get_projecto_fases($db, $id){
            $ouput = array();
            $query = "select * from tb_fasesproject where faseproject_pid='$id'";
            $result = mysqli_query($db,$query);

            while($row = mysqli_fetch_assoc($result)){
                $ouput[] = array(
                    "id" => $row['faseproject_id'],
                    "faseproject_pid" => $row['faseproject_pid'],
                    "name" => $row['faseproject_nome'],
                    "fromDate" => $row['faseproject_inicio']." 8:00",
                    "toDate" => $row['faseproject_fim']." 15:30",
                    "faseproject_duracao" => $row['faseproject_duracao'],
                    "color" => "colorSet.getIndex(6).brighten(0.4)"
                );
            }
            return $ouput;
        }
        
        public function get_projecto_fases_table($db, $id){
            $output = '';
            $query = "select * from tb_fasesproject where faseproject_pid='$id'";
            $result = mysqli_query($db,$query);
            $count = 1;
            
            while($row = mysqli_fetch_assoc($result)){
                
                $output .= '<tr valign="top">
                                        <td>'.$count.'</td>
                                        <td>'.$row['faseproject_nome'].'</td>
                                        <td>'.$row['faseproject_inicio'].'</td>
                                        <td>'.$row['faseproject_duracao'].'</td>
                                        <td>'.$row['faseproject_fim'].'</td>
                                    </tr>';
                $count++;
            }
            return $output;
        }
        
        public function get_project_risks($db, $id){
            $output = '';
            $query = "select * from tb_riscosproject where riscosproject_pid='$id'";
            $result = mysqli_query($db, $query);
            
            while($row = mysqli_fetch_assoc($result)){
                $output .= '<tr valign="top">
                                        <td>'.$row['riscosproject_nome'].'</td>
                                        <td>'.$row['riscosproject_descricao'].'</td>
                                        <td>'.$row['riscosproject_impacto'].'</td>
                                        <td>'.$row['riscosproject_acc_mtgcao'].'</td>
                                        <td>'.$row['riscosproject_prob'].'</td>
                                        <td>'.$row['riscosproject_impt'].'</td>
                                    </tr>';
            }
            
            return $output;
        }
        
        public function get_project_risks_inputTag($db, $id){
            $output = '';
            $query = "select * from tb_riscosproject where riscosproject_pid='$id'";
            $result = mysqli_query($db, $query);
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                $count++;
                $output .= '
                                <div class="risk__box">
                                    <input type="text" class="activity__inputText" id="data-risk_nameUpdt'.$count.'" name="risk_nameUpdt[]" placeholder="Nome do risco" value="'.$row['riscosproject_nome'].'" required>
                                    <input type="text" class="activity__inputText" id="data-risk_causeUpdt'.$count.'" name="risk_causeUpdt[]" placeholder="Descrição do risco e causa" value="'.$row['riscosproject_descricao'].'" required>
                                    <input type="text" class="activity__inputText" id="data-risk_impactUpdt'.$count.'" name="risk_impactUpdt[]" placeholder="Impacto do risco" value="'.$row['riscosproject_impacto'].'" required>
                                    <input type="text" class="activity__inputText" id="data-risk_mitigationUpdt'.$count.'" name="risk_mitigationUpdt[]" placeholder="Acção de Mitigação" value="'.$row['riscosproject_acc_mtgcao'].'" required>
                                    <input type="number" class="activity__inputNumber" id="data-risk_probUpdt'.$count.'" name="risk_probUpdt[]" placeholder="Probabilidade" min="1" max="3" value="'.$row['riscosproject_prob'].'" required>
                                    <input type="number" class="activity__inputNumber" id="data-risk_impUpdt'.$count.'" name="risk_impUpdt[]" placeholder="Impacto" min="1" max="3" value="'.$row['riscosproject_impt'].'" required>
                                    <div class="checklist__buttons2"><button class="checklist__remove removeRisk" id="removeWorkerUpdt"><i class="material-icons">remove</i></button></div>
                                </div>
                            ';
            }
            
            return $output;
        }
        
        public function get_project_members($db, $id){
            $output = '';
            $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome FROM tb_usuarios INNER JOIN tb_membrosproject WHERE tb_membrosproject.membrosproject_pid = '$id' and tb_usuarios.usuario_id = tb_membrosproject.membrosproject_uid;";
            $result = mysqli_query($db, $query);
            
            while($row = mysqli_fetch_assoc($result)){
                $output .= '<li>'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</li>';
            }
            
            return $output;
        }
        
        /***************************************
        *Carrega os Departamentos              *
        ***************************************/
        private function get_projectDpto($db, $dpto){
            $output = '';
            $query = "select * from tb_departamentos";
            $result = mysqli_query($db, $query);

            while($row = mysqli_fetch_assoc($result)){
                if($row['dpto_sigla'] == $dpto){
                    $output .= '<option value="'.$row['dpto_sigla'].'" selected > '.$row['dpto_sigla'].' </option>';
                }else{
                    $output .= '<option value="'.$row['dpto_sigla'].'" > '.$row['dpto_sigla'].' </option>';
                }

            }

            return $output;
        }
        
        /***********************************************
        *Carrega os membros que fazem parte da equipa  *
        *do Projecto                                   *
        ***********************************************/
        private function get_projectMember_team($db, $user_id, $user_dpto){
            $output = '';
            $query = "select * from tb_usuarios where usuario_departamento ='".$user_dpto."' and (usuario_tipo='tecnico' or usuario_tipo='chefe' or usuario_tipo='admin') ";
            $result = mysqli_query($db, $query);

            while($row = mysqli_fetch_assoc($result)){
                if($row['usuario_id'] == $user_id){
                    $output .= '<option value="'.$row['usuario_id'].'" selected > '.$row['usuario_nome'].' '.$row['usuario_sobrenome']. '</option>';
                }else{
                    $output .= '<option value="'.$row['usuario_id'].'"> '.$row['usuario_nome'].' '.$row['usuario_sobrenome'].' </option>';
                }
            }

            return $output;
        }
        
        /************************************************
        *Função para carregar membros na modal de actua-*
        *lizar projecto                                 *
        ************************************************/
        public function get_project_members_inputTag($db, $id){
            $output = '';
            $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_id, tb_usuarios.usuario_departamento FROM tb_usuarios INNER JOIN tb_membrosproject WHERE tb_membrosproject.membrosproject_pid = '$id' and tb_usuarios.usuario_id = tb_membrosproject.membrosproject_uid;";
            $result = mysqli_query($db, $query);
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                $count++;
                $dpto = $this->get_projectDpto($db, $row['usuario_departamento']);
                $members = $this->get_projectMember_team($db, $row['usuario_id'], $row['usuario_departamento']);
                $output .= '<div class="workers">
                                        <select name="worker_dptoUpdt[]" class="select selectUpdt" data-dpto_idUpdt="'.$count.'" required>
                                            <option value="S">--- Selecione o Departamento ---</option>
                                            '.$dpto.'
                                        </select>

                                        <div id="workers__selector">
                                            <select name="worker_idUpdt[]" class="selectd" id="worker-idupdt'.$count.'" required >
                                                <option value="">--- Selecione o Colaborador ---</option>
                                                '.$members.'
                                            </select>
                                            <div class="checklist__buttons2"><button class="checklist__remove removeWorkers" id="removeWorker"><i class="material-icons">remove</i></button></div>
                                        </div>
                                    </div>';
            }
            
            return $output;
        }
        
        
        
        /************************************************
        *Função para carregar responsáveis na modal de  *
        *actualizar projecto                            *
        ************************************************/
        public function get_project_responsaveis($db, $id){
            $output = '';
            $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_id, tb_usuarios.usuario_departamento, tb_projectos.projecto_uid FROM tb_usuarios INNER JOIN tb_membrosproject INNER JOIN tb_projectos WHERE tb_membrosproject.membrosproject_pid = '$id' and tb_usuarios.usuario_id = tb_membrosproject.membrosproject_uid AND tb_membrosproject.membrosproject_pid=tb_projectos.projecto_id;";
            $result = mysqli_query($db, $query);
        
            while($row = mysqli_fetch_assoc($result)){
                
                if($row['usuario_id'] == $row['projecto_uid']){
                    $output .= '<option value="'.$row['usuario_id'].'" selected > '.$row['usuario_nome'].' '.$row['usuario_sobrenome']. '</option>';
                }else{
                    $output .= '<option value="'.$row['usuario_id'].'"> '.$row['usuario_nome'].' '.$row['usuario_sobrenome'].' </option>';
                }
            }
            
            return $output;
        }
        
        public function get_project_fases_inputTag($db, $id){
            $output = '';
            $query = "select * from tb_fasesproject where faseproject_pid = '$id'";
            $result = mysqli_query($db, $query);
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                $count++;
                $output .='<div class="activity__box boxUpdt">
                                        <input type="text" class="activity__inputText" id="data-act_textUpdt'.$count.'" name="act_textUpdt[]" placeholder="Nome da Actividade" value="'.$row['faseproject_nome'].'" required>
                                        <input type="date" class="activity__inputDate" id="data-act_dataUpdt'.$count.'" name="act_dataUpdt[]" placeholder="data" value="'.date('Y-m-d', strtotime($row['faseproject_inicio'])).'"required>
                                        <input type="number" class="activity__inputNumber" id="data-act_numberUpdt'.$count.'" name="act_numberUpdt[]" min="1" placeholder="Dias" value="'.$row['faseproject_duracao'].'" required>
                                        <div class="checklist__buttons2">
                                          <button class="checklist__remove removeActivity" id="removeWorker"><i class="material-icons">remove</i></button> 
                                       </div>
                                   </div>';
            }
            
            return $output;
        }
        
        /****************************************************
        *Pegar o número de projectos de um departamento     *
        ****************************************************/
        public function get_dptoProject_counter($db){
            $output = array();
            $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='".$_SESSION['usuario_dpto']."'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            if( $row['COUNT(*)'] >0){
                
                $total_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='".$_SESSION['usuario_dpto']."' AND tb_projectos.projecto_status='Em curso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $inProgress_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='".$_SESSION['usuario_dpto']."' AND tb_projectos.projecto_status='Por iniciar'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $toStart_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='".$_SESSION['usuario_dpto']."' AND tb_projectos.projecto_status='Em atraso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $inDelay_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='".$_SESSION['usuario_dpto']."' AND tb_projectos.projecto_status='Parado'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $stopped_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='".$_SESSION['usuario_dpto']."' AND tb_projectos.projecto_status='Concluido'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $concluded_projects = $row['COUNT(*)'];
            }else{
                $total_projects = 1;
                $inProgress_projects = 0;
                $toStart_projects = 0;
                $inDelay_projects = 0;
                $stopped_projects = 0;
                $concluded_projects = 0;
            }
            
            
            //queries para contar os projectos dos colaboradores
            $query = "SELECT COUNT(*) FROM tb_projectos INNER JOIN tb_membrosproject WHERE tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid  AND tb_membrosproject.membrosproject_uid='".$_SESSION['usuario_id']."';";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            if($row['COUNT(*)']>0){
                
                $myTotal_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos INNER JOIN tb_membrosproject WHERE tb_projectos.projecto_status='Em curso' AND tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid  AND tb_membrosproject.membrosproject_uid='".$_SESSION['usuario_id']."';";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myInProgress_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos INNER JOIN tb_membrosproject WHERE tb_projectos.projecto_status='Por iniciar' AND tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid  AND tb_membrosproject.membrosproject_uid='".$_SESSION['usuario_id']."';";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myToStart_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos INNER JOIN tb_membrosproject WHERE tb_projectos.projecto_status='Em atraso' AND tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid  AND tb_membrosproject.membrosproject_uid='".$_SESSION['usuario_id']."';";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myDelayed_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos INNER JOIN tb_membrosproject WHERE tb_projectos.projecto_status='Parado' AND tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid  AND tb_membrosproject.membrosproject_uid='".$_SESSION['usuario_id']."';";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myStopped_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos INNER JOIN tb_membrosproject WHERE tb_projectos.projecto_status='Concluido' AND tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid  AND tb_membrosproject.membrosproject_uid='".$_SESSION['usuario_id']."';";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myConcluded_projects = $row['COUNT(*)'];
            }else{
                $myTotal_projects = 1;
                $myInProgress_projects = 0;
                $myToStart_projects = 0;
                $myDelayed_projects = 0;
                $myStopped_projects = 0;
                $myConcluded_projects = 0;
            }
            
            
            $output[] = array(
                "projectos_emProgresso_stats" => round(  ($inProgress_projects/$total_projects)*100),
                "projectos_porIniciar_stats" => round(  ($toStart_projects/$total_projects)*100),
                "projectos_emAtraso_stats" => round(  ($inDelay_projects/$total_projects)*100),
                "projectos_parados_stats" => round(  ($stopped_projects/$total_projects)*100),
                "projectos_concluidos_stats" => round(  ($concluded_projects/$total_projects)*100),
                "meusProjectos_emProgresso_stats" => round(($myInProgress_projects/$myTotal_projects)*100),
                "meusProjectos_porIniciar_stats" => round(($myToStart_projects/$myTotal_projects)*100),
                "meusProjectos_emAtraso_stats" => round(($myDelayed_projects/$myTotal_projects)*100),
                "meusProjectos_parados_stats" => round(($myStopped_projects/$myTotal_projects)*100),
                "meusProjectos_concluidos_stats" => round(($myConcluded_projects/$myTotal_projects)*100)
            );
            
            return $output;
        }
        
        
        /*******************************************************************************
        *Pegar o número de projectos de um departamento para o Administrador de pelouro*
        *******************************************************************************/
        public function get_dptoProject_counter_ca($db, $dpto){
            $output = array();
            $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            if( $row['COUNT(*)'] >0){
                
                $total_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Em curso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $inProgress_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Por iniciar'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $toStart_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Em atraso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $inDelay_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Parado'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $stopped_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Concluido'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $concluded_projects = $row['COUNT(*)'];
            }else{
                $total_projects = 1;
                $inProgress_projects = 0;
                $toStart_projects = 0;
                $inDelay_projects = 0;
                $stopped_projects = 0;
                $concluded_projects = 0;
            }            
            
            $output[] = array(
                "projectos_emProgresso_stats" => round(  ($inProgress_projects/$total_projects)*100),
                "projectos_porIniciar_stats" => round(  ($toStart_projects/$total_projects)*100),
                "projectos_emAtraso_stats" => round(  ($inDelay_projects/$total_projects)*100),
                "projectos_parados_stats" => round(  ($stopped_projects/$total_projects)*100),
                "projectos_concluidos_stats" => round(  ($concluded_projects/$total_projects)*100),
                "projectos_dpto" => $dpto
            );
            
            return $output;
        }
        
        /*******************************************************************************
        *Pegar o número de projectos de um departamento para o Administrador de pelouro*
        *******************************************************************************/
        public function get_dptoProject_counter_ca2($db, $dpto){
            $output = array();
            $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            if( $row['COUNT(*)'] >0){
                
                $total_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Em curso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $inProgress_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Por iniciar'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $toStart_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Em atraso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $inDelay_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Parado'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $stopped_projects = $row['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM tb_projectos WHERE tb_projectos.projecto_dpto='$dpto' AND tb_projectos.projecto_status='Concluido'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $concluded_projects = $row['COUNT(*)'];
            }else{
                $total_projects = 1;
                $inProgress_projects = 0;
                $toStart_projects = 0;
                $inDelay_projects = 0;
                $stopped_projects = 0;
                $concluded_projects = 0;
            }            
            
            $output[] = array(
                "projectos_emProgresso_stats" => round(  ($inProgress_projects/$total_projects)*100),
                "projectos_porIniciar_stats" => round(  ($toStart_projects/$total_projects)*100),
                "projectos_emAtraso_stats" => round(  ($inDelay_projects/$total_projects)*100),
                "projectos_parados_stats" => round(  ($stopped_projects/$total_projects)*100),
                "projectos_concluidos_stats" => round(  ($concluded_projects/$total_projects)*100),
                "projectos_dpto" => $dpto
            );
            
            return $output;
        }
        
    }

    

?>