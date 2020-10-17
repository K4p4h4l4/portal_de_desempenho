<?php
    require("conexao.php");
    require("usuarioData.php");
    require("cryptor.php");

    /********************************
    *Função para inserir usuário    *
    ********************************/
    function inserir_usr($db, $novo_nome, $novo_sobrenome, $novo_login, $novo_senha, $novo_email, $novo_contacto, $novo_departamento, $novo_tipo, $novo_categoria){
        
        $hashed = password_hash($novo_senha, PASSWORD_DEFAULT);
        
        $query = "insert into tb_usuarios (usuario_id, usuario_nome, usuario_sobrenome, usuario_login, usuario_email, usuario_contacto, usuario_senha, usuario_foto, usuario_tipo, usuario_departamento, categoria) values (null, '$novo_nome', '$novo_sobrenome', '$novo_login', '$novo_email', '$novo_contacto', '$hashed', 'warren-wong-bh4LQHcOcxE-unsplash.jpg', '$novo_tipo', '$novo_departamento', '$novo_categoria' )";
        
        return mysqli_query($db, $query);
    }

    /**************************************
    *Criação de novo usuário na plataforma*
    **************************************/
    if(isset($_POST['criar_usr'])){
        $novo_nome = mysqli_real_escape_string($db,filter_var($_POST["novo_nome"],FILTER_SANITIZE_STRING));
        $novo_sobrenome = mysqli_real_escape_string($db,filter_var($_POST["novo_sobrenome"],FILTER_SANITIZE_STRING));
        $novo_login = mysqli_real_escape_string($db,filter_var($_POST["novo_login"],FILTER_SANITIZE_STRING));
        $novo_senha = mysqli_real_escape_string($db,filter_var($_POST["novo_senha"],FILTER_SANITIZE_STRING));
        $novo_email = mysqli_real_escape_string($db,filter_var($_POST["novo_email"],FILTER_SANITIZE_STRING));
        $novo_departamento = mysqli_real_escape_string($db,filter_var($_POST["novo_departamento"],FILTER_SANITIZE_STRING));
        $novo_contacto = mysqli_real_escape_string($db,filter_var($_POST["novo_contacto"],FILTER_SANITIZE_STRING));
        $novo_categoria = mysqli_real_escape_string($db,filter_var($_POST["novo_categoria"],FILTER_SANITIZE_STRING));
        $novo_tipo = mysqli_real_escape_string($db,filter_var($_POST["novo_tipo"],FILTER_SANITIZE_STRING));
        
        $status = inserir_usr($db, $novo_nome, $novo_sobrenome, $novo_login, $novo_senha, $novo_email, $novo_contacto, $novo_departamento, $novo_tipo, $novo_categoria);
        
        if($status == 1){
            header("location: ../admin/users.php");
        }else{        
            ?>
            <script>alert("Dados incorrectos!!!");</script>
            <?php
        }
    }

    /**************************************
    *Criação de nova dica de saude no     *
    *portal                               *
    **************************************/
    if(isset($_POST['inserir_dica_saude'])){
        $dica_mensagem = mysqli_real_escape_string($db, filter_var($_POST['dica_mensagem'],FILTER_SANITIZE_STRING));
        $dica_titulo = mysqli_real_escape_string($db, filter_var($_POST['dica_titulo'], FILTER_SANITIZE_STRING));
        $dica_data = date('d-m-Y H:i:s');
        $dica_imagem_type = $_FILES['dica_imagem']['type'];
        $dica_imagem_error = $_FILES['dica_imagem']['error'];
        $dica_imagem_name = $_FILES['dica_imagem']['name'];
        $dica_imagem_tmp = $_FILES['dica_imagem']['tmp_name'];
        $dica_imagem_size = $_FILES['dica_imagem']['size'];
        
        $image_extension = explode('.',$dica_imagem_name);
        
        $actual_image_extension = strtolower(end($image_extension));
        
        $allowed = array('jpeg','jpg','png','bmp','jfif','xbm');
        
        if(in_array($actual_image_extension , $allowed)){
            if($dica_imagem_error === 0){
                if($dica_imagem_size < 8000000){
                    echo $dica_imagem_name;
                    $target = "../imagens/saude/".basename($dica_imagem_name);
                    
                    move_uploaded_file($dica_imagem_tmp, $target);
                    
                    $query = "insert into tb_dicas_saude (id, dica_imagem, dica_titulo, dica_mensagem, dica_data) values (null, '$dica_imagem_name', '$dica_titulo', '$dica_mensagem', '$dica_data')";
                    mysqli_query($db, $query);
                    header('location: ../admin/saude');
                }else{
                    echo "Tamanho muito grande";
                }
            }else{
                echo "Erro no upload da imagem";
            }
        }else{
            echo "Extensão não válida";
        }
    }

    /******************************************************
    *Para inserir um novo objectivo da semana para corrida*
    ******************************************************/
    if(isset($_POST['run_creatorID'])){
        $uid = $_POST['run_creatorID'];
        $create_input_RunGoal = $_POST['create_input_RunGoal'];
        $date = date('d-m-Y');
        $corrida_fim = date('d-m-Y', strtotime($date. ' + 7 days'));
        
        $query = "insert into tb_corridas (corrida_id, corrida_uid, corrida_inicio, corrida_goal, corrida_fim) values (null, '$uid', '$date', '$create_input_RunGoal', '$corrida_fim')";
        $result = mysqli_query($db, $query);
        
    }

    /*********************************************************
    *Para inserir um novo objectivo da semana para exercícios*
    *********************************************************/
    if(isset($_POST['ex_creatorID'])){
        $uid = $_POST['ex_creatorID'];
        $create_input_ExGoal = $_POST['create_input_ExGoal'];
        $date = date('d-m-Y');
        $exercicio_fim = date('d-m-Y', strtotime($date. ' + 7 days'));
        
        echo $uid." ".$create_input_ExGoal." ".$date." ".$exercicio_fim;
        
        $query = "insert into tb_exercicios (exercicio_id, exercicio_uid, exercicio_inicio, exercicio_goal, exercicio_fim) values (null, '$uid', '$date', '$create_input_ExGoal', '$exercicio_fim')";
        $result = mysqli_query($db, $query);
        
    }

    /******************************************************
    *Para inserir um novo objectivo da semana para Corrida*
    ******************************************************/
    if(isset($_POST['desp_creatorID'])){
        $uid = $_POST['desp_creatorID'];
        $create_input_DespGoal = $_POST['create_input_DespGoal'];
        $date = date('d-m-Y');
        $desporto_fim = date('d-m-Y', strtotime($date. ' + 7 days'));
        
        $query = "insert into tb_desportos (desporto_id, desporto_uid, desporto_inicio, desporto_goal, desporto_fim) values (null, '$uid', '$date', '$create_input_DespGoal', '$desporto_fim')";
        $result = mysqli_query($db, $query);
        
    }

    /*******************************************************
    *Para inserir um novo objectivo da semana para Ciclismo*
    *******************************************************/
    if(isset($_POST['cic_creatorID'])){
        $uid = $_POST['cic_creatorID'];
        $create_input_CicGoal = $_POST['create_input_CicGoal'];
        $date = date('d-m-Y');
        $ciclismo_fim = date('d-m-Y', strtotime($date. ' + 7 days'));
        echo $uid." ".$create_input_CicGoal." ".$date." ".$ciclismo_fim;
        $query = "insert into tb_ciclismo (ciclismo_id, ciclismo_uid, ciclismo_inicio, ciclismo_goal, ciclismo_fim) values (null, '$uid', '$date', '$create_input_CicGoal', '$ciclismo_fim')";
        $result = mysqli_query($db, $query);
        
    }
    
    /******************************************************
    *Post para inserir ideias no banco de dados           *
    ******************************************************/
    if(isset($_POST['inserir_ideia'])){
        $ideia_assunto = mysqli_real_escape_string($db, filter_var($_POST['ideia_assunto'], FILTER_SANITIZE_STRING));
        $ideia_descricao = $_POST['ideia_descricao'];
        $date = date('d/m/Y');
        
        $query = "insert into tb_ideias (ideia_id, ideia_uid, ideia_assunto, ideia_descricao, ideia_data, ideia_status) values (null, '".$_SESSION['usuario_id']."', '$ideia_assunto', '$ideia_descricao', '$date', 'Em analise')";
        mysqli_query($db,$query);
        $ideia_id = mysqli_insert_id($db);
        
        $data = array(
            'ideia_criada' => $ideia_id
        );

        $str = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/includes/e-mail.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
        $saida = curl_exec($ch);
        curl_close($ch);
        
        header('location: ../col/col_ideias');
    }
    
    /******************************************************
    *Post para inserir tarefas no banco de dados          *
    ******************************************************/
    if(isset($_POST['add_tarefa'])){
        $tarefa_nome = mysqli_real_escape_string($db, filter_var($_POST['input_TaskName'], FILTER_SANITIZE_STRING));
        $tarefa_prioridade = $_POST['task__priority'];
        $tarefa_startDate = date( 'd-m-Y', strtotime($_POST['input_StartDate']));
        $tarefa_endDate = date( 'd-m-Y', strtotime($_POST['input_EndtDate']));
        
        echo'<script>
                console.log("teste");
            </script>';
        $query = "insert into tb_tarefas (tarefa_id, tarefa_uid, tarefa_nome, tarefa_prioridade, tarefa_inicio, tarefa_fim, tarefa_dpto) values (null, '".$_SESSION['usuario_id']."', '$tarefa_nome', '$tarefa_prioridade', '$tarefa_startDate', '$tarefa_endDate', '".$_SESSION['usuario_dpto']."')";
        
        mysqli_query($db, $query);
        
        $query = "select * from tb_tarefas where tarefa_nome='$tarefa_nome' and tarefa_uid='".$_SESSION['usuario_id']."' and tarefa_prioridade='$tarefa_prioridade'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        
        $tpc_id = $row['tarefa_id'];
        
        if(is_array($_POST['input_checklistAdd'])){
            while(list($key,$value) = each($_POST['input_checklistAdd'])){
                $value = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
                $query = "insert into tb_checklist (checklist_id, checklist_tid, checklist_nome, checklist_status) values (null, '$tpc_id', '$value', 'Nao feito')";
                mysqli_query($db,$query);
            }
        }
        
        if(is_array($_POST['worker_id'])){
            while(list($key, $value) = each($_POST['worker_id'])){
                $query = "insert into tb_membrostpc (membrotpc_id, membrotpc_tid, membrotpc_uid) values (null, '$tpc_id', '$value')";
                mysqli_query($db,$query);
            }
        }
        
        $data = array(
            'work_id' => $tpc_id
        );
        
        $str = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/includes/e-mail.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);       
        $saida = curl_exec($ch);
        curl_close($ch);
        $usuario_nome = '';
        $usuario_sobrenome = '';
        if(isset($_SESSION['usuario_id'])){
            $id = $_SESSION['usuario_id'];

            $query = "select * from tb_usuarios where usuario_id='$id'";
            $result = mysqli_query($db,$query);
            $row = mysqli_fetch_assoc($result);

            $usuario_nome = $row['usuario_nome'];
            $usuario_sobrenome = $row['usuario_sobrenome'];
            $usuario_departamento = $row['usuario_departamento'];
            /*$usuario_login = $row['usuario_login'];
            $usuario_email = $row['usuario_email'];
            $usuario_contacto = $row['usuario_contacto'];
            $usuario_tipo = $row['usuario_tipo'];*/
        }
        
        $query = "insert into tb_notificacoes (notificacao_id, notificacao_titulo, notificacao_texto, notificacao_url) values (null, '".$usuario_nome." ".$usuario_sobrenome."', 'Adicionou uma nova tarefa á lista de tarefas do ".$usuario_departamento."', 'col_tarefas')";
        mysqli_query($db,$query);
        $notification_id = mysqli_insert_id($db);
        
        $query = "select * from tb_usuarios where usuario_departamento='".$_SESSION['usuario_dpto']."'";
        $result = mysqli_query($db,$query);
        
        while($row = mysqli_fetch_assoc($result)){
            $query = "insert into tb_notifuservis (notifuservis_nid, notifuservis_uid, notifuservis_dpto, notifUserVis_status) values ('$notification_id', '".$row['usuario_id']."', '".$_SESSION['usuario_dpto']."', '0')";
            mysqli_query($db,$query);
        }
        
        if($_SESSION['usuario_tipo'] == 'tecnico'){
            header("location: ../col/col_tarefas");
        }elseif($_SESSION['usuario_tipo'] == 'chefe'){
            header("location: ../chef/tarefas");
        }elseif($_SESSION['usuario_tipo'] == 'admin'){
            header("location: ../ca/ca_tarefas");
        }
        
    }

    /*********************************************
    * Adicionar Projecto no banco de dados       * 
    *********************************************/
    if(isset($_POST['add_projecto'])){
        $msg = '';
        $projectImage_type = $_FILES['projectImage']['type'];
        $projectImage_error = $_FILES['projectImage']['error'];
        $projectImage_name = $_FILES['projectImage']['name'];
        $projectImage_tmp = $_FILES['projectImage']['tmp_name'];
        $projectImage_size = $_FILES['projectImage']['size'];
        $usuario = new UsuarioDados;
        $nome = $usuario->get_user_first_name($db, $_SESSION['usuario_id']);
        $sobrenome = $usuario->get_user_last_name($db, $_SESSION['usuario_id']);
        
        $image_extension = explode('.',$projectImage_name);
        
        $actual_image_extension = strtolower(end($image_extension));
        
        $allowed = array('jpeg','jpg','png','bmp','jfif','xbm');
        
        if(in_array($actual_image_extension , $allowed)){
            if($projectImage_error === 0){
                if($projectImage_size <= 5000000){
                    $target = "../imagens/projectos/".basename($projectImage_name);
                    move_uploaded_file($projectImage_tmp, $target);
                    $projecto_inicio = date('d-m-Y');
                    $projecto_nome = mysqli_real_escape_string($db, filter_var($_POST['projectName'], FILTER_SANITIZE_STRING));
                    
                    if($_SESSION['usuario_tipo']=='tecnico'){
                        $query = "insert into tb_projectos (projecto_id, projecto_uid, projecto_dpto, projecto_nome, projecto_imagem, projecto_contexto, projecto_missao, projecto_objectivo, projecto_metodologia, projecto_entregaveis, projecto_inicio, projecto_status, projecto_aprovacao_ca, projecto_aprovacao_chefeDpto, projecto_percent) values (null, '".$_SESSION['usuario_id']."', '".$_SESSION['usuario_dpto']."', '$projecto_nome', '$projectImage_name', '".$_POST['project__context']."', '".$_POST['project__mission']."', '".$_POST['project__goal']."', '".$_POST['project__metodology']."', '".$_POST['project__entregaveis']."', '$projecto_inicio', 'Por iniciar', 'Em analise', 'Em analise', 0)";
                    }elseif($_SESSION['usuario_tipo']=='admin'){
                        $query = "insert into tb_projectos (projecto_id, projecto_uid, projecto_dpto, projecto_nome, projecto_imagem, projecto_contexto, projecto_missao, projecto_objectivo, projecto_metodologia, projecto_entregaveis, projecto_inicio, projecto_status, projecto_aprovacao_ca, projecto_aprovacao_chefeDpto, projecto_percent) values (null, '".$_SESSION['usuario_id']."', '".$_SESSION['usuario_dpto']."', '$projecto_nome', '$projectImage_name', '".$_POST['project__context']."', '".$_POST['project__mission']."', '".$_POST['project__goal']."', '".$_POST['project__metodology']."', '".$_POST['project__entregaveis']."', '$projecto_inicio', 'Por iniciar', 'Aprovado', 'Aprovado', 0)";
                    }
                    
                    mysqli_query($db,$query);
                    $project_id = mysqli_insert_id($db);
                    
                    if(is_array($_POST['risk_name'])){
                        while((list($key, $risk_name) = each($_POST['risk_name'])) && (list($key, $risk_cause) = each($_POST['risk_cause'])) && (list($key, $risk_impact) = each($_POST['risk_impact'])) && (list($key, $risk_mitigation) = each($_POST['risk_mitigation'])) && (list($key, $risk_prob) = each($_POST['risk_prob'])) && (list($key, $risk_imp) = each($_POST['risk_imp'])) ){
                            
                            $risk_name = mysqli_real_escape_string($db, filter_var($risk_name, FILTER_SANITIZE_STRING));
                            $risk_cause = mysqli_real_escape_string($db, filter_var($risk_cause, FILTER_SANITIZE_STRING));
                            $risk_impact = mysqli_real_escape_string($db, filter_var($risk_impact, FILTER_SANITIZE_STRING));
                            $risk_mitigation = mysqli_real_escape_string($db, filter_var($risk_mitigation, FILTER_SANITIZE_STRING));
                            
                            $query = "insert into tb_riscosproject (riscosproject_id, riscosproject_pid, riscosproject_nome, riscosproject_descricao, riscosproject_impacto, riscosproject_acc_mtgcao, riscosproject_prob, riscosproject_impt) values (null, '$project_id', '$risk_name', '$risk_cause', '$risk_impact', '$risk_mitigation', '$risk_prob', '$risk_imp')";
                            
                            mysqli_query($db,$query);
                        }
                    }
                    
                    if(is_array($_POST['worker_id'])){
                        while(list($key, $worker_id) = each($_POST['worker_id'])){
                            $query = "insert into tb_membrosproject (membrosproject_pid, membrosproject_uid) values ('$project_id', '$worker_id')";
                            mysqli_query($db,$query);
                        }
                    }
                    
                    if(is_array($_POST['act_text'])){
                        $last_date = '13-10-2001';
                        $start_date = date('d-m-Y');
                        while((list($key, $act_text) = each($_POST['act_text'])) && (list($key, $act_data) = each($_POST['act_data'])) && (list($key, $act_number) = each($_POST['act_number']))){
                            $fase_startDate = date( 'd-m-Y', strtotime($act_data));
                            $duracao = $_POST['act_number'];
                            //$endDate = strtotime('+'.$duracao.' days', strtotime($fase_startDate));
                            $fase_endDate = date('d-m-Y', strtotime($act_data. ' + '.$act_number.' days'));
                            $act_text = mysqli_real_escape_string($db, filter_var($act_text, FILTER_SANITIZE_STRING));
                            if($key == 0){
                                $query = "insert into tb_fasesproject (faseproject_id, faseproject_pid, faseproject_nome, faseproject_inicio, faseproject_fim, faseproject_duracao, faseproject_em_curso) values (null, '$project_id', '$act_text', '$fase_startDate', '$fase_endDate', '$act_number', '1' )";
                                
                                mysqli_query($db,$query);
                            }else{
                                $query = "insert into tb_fasesproject (faseproject_id, faseproject_pid, faseproject_nome, faseproject_inicio, faseproject_fim, faseproject_duracao, faseproject_em_curso) values (null, '$project_id', '$act_text', '$fase_startDate', '$fase_endDate', '$act_number', '0' )";
                                
                                mysqli_query($db,$query);
                            }
                            
                            if(strtotime($last_date) < strtotime($fase_endDate)){
                                $last_date = $fase_endDate;
                                $query2 = "update tb_projectos set projecto_fim = '$last_date' where projecto_id ='$project_id'";
                                mysqli_query($db,$query2);
                            }
                            
                            if(strtotime($fase_startDate) < strtotime($start_date)){
                                $start_date = $fase_startDate;
                                $query2 = "update tb_projectos set projecto_inicio = '$start_date' where projecto_id ='$project_id'";
                                mysqli_query($db,$query2);
                            }
                            
                        }
                    }
                    
                    $query = "insert into tb_notificacoes (notificacao_id, notificacao_titulo, notificacao_texto, notificacao_url) values (null, '".$_SESSION['usuario_nome']." ".$_SESSION['usuario_sobrenome']."', 'Adicionou uma novo projecto á lista de projectos do ".$_SESSION['usuario_dpto']."', 'col_projectos')";
                    mysqli_query($db,$query);
                    $notification_id = mysqli_insert_id($db);

                    $query = "select * from tb_usuarios where usuario_departamento='".$_SESSION['usuario_dpto']."'";
                    $result = mysqli_query($db,$query);

                    while($row = mysqli_fetch_assoc($result)){
                        $query = "insert into tb_notifuservis (notifuservis_nid, notifuservis_uid, notifuservis_dpto, notifUserVis_status) values ('$notification_id', '".$row['usuario_id']."', '".$_SESSION['usuario_dpto']."', '0')";
                        mysqli_query($db,$query);
                    }
                    
                    $data = array(
                        'projecto_id' => $project_id
                    );

                    $str = http_build_query($data);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://localhost/includes/e-mail.php");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $saida = curl_exec($ch);
                    curl_close($ch);
                    
                    $msg .= "Sucesso";
                }else{
                    $msg .= "Imagem muito grande";
                }
            }else{
                $msg .= "Erro ao carregar a imagem";
            }
        }
        
        if($_SESSION['usuario_tipo']=='tecnico'){
            header("location: ../col/col_projectos.php?state=$msg");
        }elseif($_SESSION['usuario_tipo']=='admin'){
            header("location: ../ca/ca_projectos.php?state=$msg");
        } 
        
    }

/**********************************************
*Método post para inserir comentários relacio-*
*nados á um projecto                          *
**********************************************/
if(isset($_POST['projecto'])){
    if($_POST['fase_id']!=""){
        $status='';
        $comentario = mysqli_real_escape_string($db, filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
        $comentario_time = date('d-m-Y H:i');
        $fase_id = $_POST['fase_id'];
        $projecto_id =$_POST['projecto'];

        $query = "insert into tb_comentarios_projecto (comentario_id, comentario_pid, comentario_uid, comentario_fid, comentario_text, comentario_time) values (null, '$projecto_id', '".$_SESSION['usuario_id']."', '$fase_id', '$comentario', '$comentario_time')";
        mysqli_query($db, $query);

        /******************************************
        *Verificar a data de fim do projecto para *
        *saber se esta em atraso ou em curso      *
        ******************************************/
        $query = "select projecto_fim from tb_projectos where projecto_id='$projecto_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);

        $data_fim = $row['projecto_fim'];
        $data_hoje = date('d-m-Y');

        if(strtotime($data_fim) < strtotime($data_hoje)){
            $status = "Em atraso";
        }else{
            $status = "Em curso";
        }

        /******************************************
        *Actualizar as fases do feitas do projecto*
        ******************************************/
        $query = "select * from tb_fasesproject where faseproject_pid='$projecto_id'";
        $result = mysqli_query($db, $query);
        $fase = 1;
        while($row = mysqli_fetch_assoc($result)){
            if($fase_id == $row['faseproject_id']){
                $query = "update tb_fasesproject set faseproject_em_curso='$fase' where faseproject_id='$fase_id'";
                mysqli_query($db, $query);
                $fase = 0;
            }else{
                $query = "update tb_fasesproject set faseproject_em_curso='$fase' where faseproject_id='".$row['faseproject_id']."'";
                mysqli_query($db, $query);
            }

        }

        $query = "SELECT COUNT(*) FROM tb_fasesproject WHERE faseproject_em_curso = '1' and faseproject_pid='$projecto_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $fase_feitos = $row['COUNT(*)'];

        $query = "SELECT COUNT(faseproject_id) FROM tb_fasesproject WHERE faseproject_pid='$projecto_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $fase_total = $row['COUNT(faseproject_id)'];

        $percent = round(($fase_feitos/$fase_total)*100);

        if($percent == 100){
            $percent = 90;
        }

        $query = "update tb_projectos set projecto_status='$status', projecto_percent='$percent' where projecto_id = '$projecto_id'";
        mysqli_query($db, $query);

        echo json_encode('sucesso');
    }
    
    unset($_POST['fase_id']);
    
}

/***************************************
*Post para inserir uma nova formação   *
***************************************/
if(isset($_POST['add_formacao'])){
    $formacao_nome = mysqli_real_escape_string($db,filter_var($_POST['formacao__nome'],FILTER_SANITIZE_STRING));
    $formacao_entidade = mysqli_real_escape_string($db,filter_var($_POST['formacao__entidade'],FILTER_SANITIZE_STRING));
    $formacao_local = mysqli_real_escape_string($db,filter_var($_POST['formacao__local'],FILTER_SANITIZE_STRING));
    $formacao_custo = mysqli_real_escape_string($db,filter_var($_POST['formacao__custo'],FILTER_SANITIZE_NUMBER_INT));
    $formacao_tipo = mysqli_real_escape_string($db,filter_var($_POST['formacao__tipo'],FILTER_SANITIZE_STRING));
    $formacao_grupos = mysqli_real_escape_string($db,filter_var($_POST['formacao__grupos'],FILTER_SANITIZE_NUMBER_INT));
    $formacao_inicio = date('d-m-Y', strtotime($_POST['formacao__inicio']));
    $formacao_duracao = mysqli_real_escape_string($db,filter_var($_POST['formacao__duracao'],FILTER_SANITIZE_NUMBER_INT));
    $formacao_fim = date('d-m-Y', strtotime($formacao_inicio.' + '.$formacao_duracao.' weekdays - 1 days'));
    $formacao_hinicio = date('H:i', strtotime($_POST['formacao__hinicio']));
    $formacao_hfim = date('H:i', strtotime($_POST['formacao__hfim']));
    $formacao_dpto = $_SESSION['usuario_dpto'];
    $formacao_uid = $_SESSION['usuario_id'];
    
    $query = "insert into tb_formacoes (formacao_id, formacao_nome, formacao_entidade, formacao_local, formacao_custo, formacao_tipo, formacao_grupos, formacao_inicio, formacao_duracao, formacao_fim, formacao_hinicio, formacao_hfim, formacao_dpto, formacao_uid) values (null, '$formacao_nome', '$formacao_entidade', '$formacao_local', '$formacao_custo', '$formacao_tipo', '$formacao_grupos', '$formacao_inicio', '$formacao_duracao', '$formacao_fim', '$formacao_hinicio', '$formacao_hfim', '$formacao_dpto', '$formacao_uid')";
    
    mysqli_query($db, $query); 
    $formacao_id = mysqli_insert_id($db);
    $count = 0;
    if(is_array($_POST['formacao__membro'])){
        while(list($key, $formacao_membro) = each($_POST['formacao__membro'])){
            $query = "insert into tb_formacoes_membros (formacoes_membros_id, formacoes_membros_fid, formacoes_membros_uid) values (null, '$formacao_id', '$formacao_membro')";
            $count = $key;
            mysqli_query($db, $query);
        }
    }
    
    $count +=1;
    
    $query = "update tb_formacoes set formacao_nmembros='$count' where formacao_id = '$formacao_id'";
    mysqli_query($db, $query);
    
    $data = array(
        'formacao_criada' => $formacao_id
    );

    $str = http_build_query($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/includes/e-mail.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
    $saida = curl_exec($ch);
    curl_close($ch);
    
    if($_SESSION['usuario_tipo']=='tecnico'){
        header('location: ../col/col_formacoes');
    }elseif($_SESSION['usuario_tipo']=='chefe'){
        header('location: ../chef/formacoes');
    }elseif(($_SESSION['usuario_tipo']=='chefe') && ($_SESSION['usuario_tipo']=='chefe')){
        
    }
    
    
}

/***********************
*Inserir nova notícia  *
***********************/
if(isset($_POST['add_noticia'])){
    $noticia_tipo = $_POST['noticiaTipo'];
    $noticia_manchete = $_POST['noticiaManchete'];
    $noticia_titulo = mysqli_real_escape_string($db, filter_var($_POST['noticiaTitulo'], FILTER_SANITIZE_STRING));
    $noticia_context = $_POST['noticiaContext'];
    
    $noticia_imagem_nome = $_FILES['noticiaImage']['name'];
    $noticia_imagem_tamanho = $_FILES['noticiaImage']['size'];
    $noticia_imagem_tmp = $_FILES['noticiaImage']['tmp_name'];
    $noticia_imagem_error = $_FILES['noticiaImage']['error'];
    $noticia_imagem_tipo = $_FILES['noticiaImage']['type'];
    $noticia_uid = $_SESSION['usuario_id'];
    
    $image_extension = explode('.',$noticia_imagem_nome);
        
    $actual_image_extension = strtolower(end($image_extension));

    $allowed = array('jpeg','jpg','png','bmp','jfif','xbm');
    
    if(in_array($actual_image_extension , $allowed)){
        if($noticia_imagem_error === 0){
            if($noticia_imagem_tamanho <= 5000000){
                $target = "../imagens/noticias/".basename($noticia_imagem_nome);
                move_uploaded_file($noticia_imagem_tmp, $target);
                $data = date("d-m-Y");
                $horario = date("d-m-Y H:i:s");
                if($noticia_manchete == 0){
                    $query = "insert into tb_noticias (noticia_id, noticia_uid, noticia_tipo, noticia_titulo, noticia_imagem, noticia_contexto, noticia_data, noticia_hora) values (null, '$noticia_uid', '$noticia_tipo', '$noticia_titulo', '$noticia_imagem_nome', '$noticia_context', '$data', '$horario')";
                    mysqli_query($db, $query);
                    $msg = "sucesso";
                }elseif($noticia_manchete == 1){
                    $query="select noticia_id from tb_noticias where noticia_manchete='1'";
                    $result = mysqli_query($db, $query);
                    $row = mysqli_fetch_assoc($result);
                    
                    $query="update tb_noticias set noticia_manchete='0' where noticia_id='".$row['noticia_id']."'";
                    mysqli_query($db, $query);
                    
                    $query = "insert into tb_noticias (noticia_id, noticia_uid, noticia_tipo, noticia_manchete, noticia_titulo, noticia_imagem, noticia_contexto, noticia_data, noticia_hora) values (null, '$noticia_uid', '$noticia_tipo', '1', '$noticia_titulo', '$noticia_imagem_nome', '$noticia_context', '$data', '$horario')";
                    mysqli_query($db, $query);
                    $msg = "sucesso";
                }
                
            }else{
                $msg = "Imagem muito grande";
            }
        }else{
            $msg = "Erro ao carregar a imagem";
        }
    }else{
        $msg = "Formato invalido";
    }
    
    header("location: ../media/media_noticias.php?state=".$msg);
}

if(isset($_POST['to_user_id'])){
    $to_user_id = $_POST['to_user_id'];
    $message = $_POST['chat_message'];
    $from_user_id = $_SESSION['usuario_id'];
    $data = date("d-m-Y");
    
    $encryption_key = 'CKXH2U9RPY3EFD70TLS1ZG4N8WQBOVI6AMJ5';
    $cipher_method = 'aes-128-cfb';
    $cryptor = new Cryptor($encryption_key,$cipher_method);
    $crypted_token = $cryptor->encrypt($message);
    unset($message);
    
    $query = "insert into tb_chat (chat_id, chat_de, chat_para, chat_mensagem, chat_data) values (null, '$from_user_id', '$to_user_id', '$crypted_token', '$data')";
    mysqli_query($db, $query);
    
}
?>