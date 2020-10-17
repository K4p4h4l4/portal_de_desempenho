<?php 

    Class TarefasInfo{

        public function get_task_data($db){
            $query = "select * from tb_tarefas where tarefa_dpto ='".$_SESSION['usuario_dpto']."'";
            $result = mysqli_query($db, $query);
        }
        
        public function get_tasks_dpto_stats($db){
            $output = array();
            
            $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='".$_SESSION['usuario_dpto']."'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            if($row['COUNT(*)']>0){
                $total_tasks = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='".$_SESSION['usuario_dpto']."' AND tb_tarefas.tarefa_status='Em analise'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inAnalysis = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='".$_SESSION['usuario_dpto']."' AND tb_tarefas.tarefa_status='Em curso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inProgress = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='".$_SESSION['usuario_dpto']."' AND tb_tarefas.tarefa_status='Em revisao'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inRevision = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='".$_SESSION['usuario_dpto']."' AND tb_tarefas.tarefa_status='Concluida'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_concluded = $row['COUNT(*)'];
                
            }else{
                $total_tasks = 1;
                $tasks_inAnalysis = 0;
                $tasks_inProgress = 0;
                $tasks_inRevision = 0;
                $tasks_concluded = 0;
            }
            
            $query = "SELECT COUNT(*) FROM tb_tarefas INNER JOIN tb_membrostpc WHERE tb_tarefas.tarefa_id = tb_membrostpc.membroTPC_tid AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            if($row['COUNT(*)']>0){
                $myTasks_total = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas INNER JOIN tb_membrostpc WHERE tb_tarefas.tarefa_id = tb_membrostpc.membroTPC_tid AND tb_tarefas.tarefa_status='Em analise' AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myTasks_inAnalysis = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas INNER JOIN tb_membrostpc WHERE tb_tarefas.tarefa_id = tb_membrostpc.membroTPC_tid AND tb_tarefas.tarefa_status='Em curso' AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myTasks_inProgress = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas INNER JOIN tb_membrostpc WHERE tb_tarefas.tarefa_id = tb_membrostpc.membroTPC_tid AND tb_tarefas.tarefa_status='Em revisao' AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myTasks_inRevision = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas INNER JOIN tb_membrostpc WHERE tb_tarefas.tarefa_id = tb_membrostpc.membroTPC_tid AND tb_tarefas.tarefa_status='Concluida' AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $myTasks_concluded = $row['COUNT(*)'];
                
            }else{
                $myTasks_total = 1;
                $myTasks_inAnalysis = 0;
                $myTasks_inProgress = 0;
                $myTasks_inRevision = 0;
                $myTasks_concluded = 0;
            }
            
            $output[] = array(
                "tarefas_emAnalise" => round( ($tasks_inAnalysis/$total_tasks)*100 ),
                "tarefas_emCurso" => round( ($tasks_inProgress/$total_tasks)*100 ),
                "tarefas_emRevisao" => round( ($tasks_inRevision/$total_tasks)*100 ),
                "tarefas_concluidas" => round( ($tasks_concluded/$total_tasks)*100 ),
                "minhasTarefas_emAnalise" => round( ($myTasks_inAnalysis/$myTasks_total)*100 ),
                "minhasTarefas_emCurso" => round( ($myTasks_inProgress/$myTasks_total)*100 ),
                "minhasTarefas_emRevisao" => round( ($myTasks_inRevision/$myTasks_total)*100 ),
                "minhasTarefas_concluidas" => round( ($myTasks_concluded/$myTasks_total)*100 )
            );
            
            return $output;
        }
        
        //Recolha dos dados estatísticos das tarefas de um departamento, para preencher o primeiro gráfico
        public function get_tasks_dpto_stats_ca($db, $dpto){
            $output = array();
            
            $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            if($row['COUNT(*)']>0){
                $total_tasks = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto' AND tb_tarefas.tarefa_status='Em analise'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inAnalysis = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto' AND tb_tarefas.tarefa_status='Em curso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inProgress = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto' AND tb_tarefas.tarefa_status='Em revisao'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inRevision = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto' AND tb_tarefas.tarefa_status='Concluida'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_concluded = $row['COUNT(*)'];
                
            }else{
                $total_tasks = 1;
                $tasks_inAnalysis = 0;
                $tasks_inProgress = 0;
                $tasks_inRevision = 0;
                $tasks_concluded = 0;
            }
            
            
            $output[] = array(
                "tarefas_emAnalise" => round( ($tasks_inAnalysis/$total_tasks)*100 ),
                "tarefas_emCurso" => round( ($tasks_inProgress/$total_tasks)*100 ),
                "tarefas_emRevisao" => round( ($tasks_inRevision/$total_tasks)*100 ),
                "tarefas_concluidas" => round( ($tasks_concluded/$total_tasks)*100 ),
                "tarefas_dpto" => $dpto
            );
            
            return $output;
        }
        
        //Recolha dos dados estatísticos de um departamento, para preencher o segundo gráfico
        public function get_tasks_dpto_stats_ca2($db, $dpto){
            $output = array();
            
            $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            
            if($row['COUNT(*)']>0){
                $total_tasks = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto' AND tb_tarefas.tarefa_status='Em analise'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inAnalysis = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto' AND tb_tarefas.tarefa_status='Em curso'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inProgress = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto' AND tb_tarefas.tarefa_status='Em revisao'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_inRevision = $row['COUNT(*)'];
                
                $query = "SELECT COUNT(*) FROM tb_tarefas WHERE tb_tarefas.tarefa_dpto ='$dpto' AND tb_tarefas.tarefa_status='Concluida'";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $tasks_concluded = $row['COUNT(*)'];
                
            }else{
                $total_tasks = 1;
                $tasks_inAnalysis = 0;
                $tasks_inProgress = 0;
                $tasks_inRevision = 0;
                $tasks_concluded = 0;
            }
            
            
            $output[] = array(
                "tarefas_emAnalise" => round( ($tasks_inAnalysis/$total_tasks)*100 ),
                "tarefas_emCurso" => round( ($tasks_inProgress/$total_tasks)*100 ),
                "tarefas_emRevisao" => round( ($tasks_inRevision/$total_tasks)*100 ),
                "tarefas_concluidas" => round( ($tasks_concluded/$total_tasks)*100 ),
                "tarefas_dpto" => $dpto
            );
            
            return $output;
        }
    }

?>