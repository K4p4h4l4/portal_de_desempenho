<?php

    require("conexao.php");

    $query = "";
    $output = array();

/*************************************************************************
                 Função para actualizar avaliações
*************************************************************************/
    function actualizar_av($db, $compt_prof, $din_inic, $cumpr_tpc, $rel_hum_trab, $adpt_func, $disc, $corr_eqpt, $apr_compst, $rm, $ro, $avl){
        
        $query = "update tb_av_usuarios set av_competencia_profissional='$compt_prof', av_dinamismo_iniciativa='$din_inic', av_cumprimento_tarefa='$cumpr_tpc', av_rel_hum_trab='$rel_hum_trab', av_adpt_func='$adpt_func', av_disciplina='$disc', av_uso_correcto_equip='$corr_eqpt', av_apresentacao_compostura='$apr_compst', av_reuniao_op='$ro', av_reuniao_mat='$rm' where id = '$avl' ";
        
        /*?>
        <script>alert("Avaliado com sucesso!"); </script>
        <?php*/
        
        return mysqli_query($db, $query);
    }

/*************************************************************************
                Função para actualizar utilizadores
*************************************************************************/
    function actualizar_usr($db, $usr_nome, $usr_sobrenome, $usr_login, $usr_senha, $usr_email, $usr_departamento, $usr_tipo, $usr_contacto, $usr_categoria, $usr_id){
        
        if(strcmp($usr_senha,'')==0){
            $query = "update tb_usuarios set usuario_nome='$usr_nome', usuario_sobrenome='$usr_sobrenome', usuario_login='$usr_login', usuario_email='$usr_email', usuario_departamento='$usr_departamento', usuario_tipo='$usr_tipo', usuario_contacto='$usr_contacto', categoria='$usr_categoria' where usuario_id = '$usr_id'";

            return mysqli_query($db, $query);
        }else{
            $hashed = password_hash($usr_senha, PASSWORD_DEFAULT);
            $query = "update tb_usuarios set usuario_nome='$usr_nome', usuario_sobrenome='$usr_sobrenome', usuario_login='$usr_login', usuario_senha='$hashed', usuario_email='$usr_email', usuario_departamento='$usr_departamento', usuario_tipo='$usr_tipo', usuario_contacto='$usr_contacto', categoria='$usr_categoria' where usuario_id = '$usr_id'";

            return mysqli_query($db, $query);
        }
        
    }

/*************************************************************************
                Função para actualizar as páginas
*************************************************************************/
    function actualizar_page_views(){
        $query1 = "select * from tb_historico_visitantes";
    }

/*************************************************************************
            Método Post para actualizar avaliação do utilizador 
*************************************************************************/
    if(isset($_POST['actualizar_av'])){
        $compt_prof = mysqli_real_escape_string($db,filter_var($_POST['compt_prof'],FILTER_SANITIZE_NUMBER_INT));
        $din_inic = mysqli_real_escape_string($db,filter_var($_POST['din_inic'],FILTER_SANITIZE_NUMBER_INT));
        $cumpr_tpc = mysqli_real_escape_string($db,filter_var($_POST['cumpr_tpc'],FILTER_SANITIZE_NUMBER_INT));
        $rel_hum_trab = mysqli_real_escape_string($db,filter_var($_POST['rel_hum_trab'],FILTER_SANITIZE_NUMBER_INT));
        $adpt_func = mysqli_real_escape_string($db,filter_var($_POST['adpt_func'],FILTER_SANITIZE_NUMBER_INT));
        $disc = mysqli_real_escape_string($db,filter_var($_POST['disc'],FILTER_SANITIZE_NUMBER_INT));
        $corr_eqpt = mysqli_real_escape_string($db,filter_var($_POST['corr_eqpt'],FILTER_SANITIZE_NUMBER_INT));
        $apr_compst = mysqli_real_escape_string($db,filter_var($_POST['apr_compst'],FILTER_SANITIZE_NUMBER_INT));
        $rm = mysqli_real_escape_string($db,filter_var($_POST['rm'],FILTER_SANITIZE_NUMBER_INT));
        $ro = mysqli_real_escape_string($db,filter_var($_POST['ro'],FILTER_SANITIZE_NUMBER_INT));
        $avl = $_POST['avl'];
        
        $status = actualizar_av($db, $compt_prof, $din_inic, $cumpr_tpc, $rel_hum_trab, $adpt_func, $disc, $corr_eqpt, $apr_compst, $rm, $ro, $avl);
        
        if($status == 1){
            header("location: ../admin/users.php");
        }
        
        
    }

/*************************************************************************
    Método Post para actualizar utilizador pela página do Administrador
*************************************************************************/
    if(isset($_POST['actualizar_usr'])){
        $usr_nome = mysqli_real_escape_string($db,filter_var($_POST["usr_nome"], FILTER_SANITIZE_STRING));
        $usr_sobrenome = mysqli_real_escape_string($db,filter_var($_POST["usr_sobrenome"], FILTER_SANITIZE_STRING));
        $usr_login = mysqli_real_escape_string($db,filter_var($_POST["usr_login"], FILTER_SANITIZE_STRING));
        $usr_senha = mysqli_real_escape_string($db,filter_var($_POST["usr_senha"],FILTER_SANITIZE_STRING));
        $usr_email = mysqli_real_escape_string($db,filter_var($_POST["usr_email"],FILTER_SANITIZE_EMAIL));
        $usr_departamento = mysqli_real_escape_string($db,filter_var($_POST["usr_departamento"],FILTER_SANITIZE_STRING));
        $usr_contacto = mysqli_real_escape_string($db,filter_var($_POST["usr_contacto"],FILTER_SANITIZE_STRING));
        $usr_categoria = mysqli_real_escape_string($db,filter_var($_POST["usr_categoria"],FILTER_SANITIZE_STRING));
        $usr_tipo = mysqli_real_escape_string($db,filter_var($_POST["usr_tipo"],FILTER_SANITIZE_STRING));
        $usr_contacto = mysqli_real_escape_string($db, filter_var($_POST['usr_contacto'],FILTER_SANITIZE_NUMBER_INT));
        $usr_movel = mysqli_real_escape_string($db, filter_var($_POST['usr_movel'],FILTER_SANITIZE_NUMBER_INT));
        $usr_id = $_POST["usr_id"];
        
        $status = actualizar_usr($db, $usr_nome, $usr_sobrenome, $usr_login, $usr_senha, $usr_email, $usr_departamento, $usr_tipo, $usr_contacto, $usr_categoria, $usr_id);
        
        if($status == 1){
            header("location: ../admin/users.php");
        }
    }

/*************************************************************************
    Método Post para actualizar utilizador pela sua página de perfil
*************************************************************************/
    if(isset($_POST['usr_type'])){
        $usr_nome = mysqli_real_escape_string($db,filter_var($_POST["usr_nome"], FILTER_SANITIZE_STRING));
        $usr_sobrenome = mysqli_real_escape_string($db,filter_var($_POST["usr_sobrenome"], FILTER_SANITIZE_STRING));
        $usr_login = mysqli_real_escape_string($db,filter_var($_POST["usr_login"], FILTER_SANITIZE_STRING));
        $usr_email = mysqli_real_escape_string($db,filter_var($_POST["usr_email"],FILTER_SANITIZE_EMAIL));
        $old_pw = mysqli_real_escape_string($db,filter_var($_POST['old_pw'],FILTER_SANITIZE_STRING));
        $new_pw = mysqli_real_escape_string($db,filter_var($_POST['new_pw'],FILTER_SANITIZE_STRING));
        $confirm_pw = mysqli_real_escape_string($db,filter_var($_POST['confirm_pw'],FILTER_SANITIZE_STRING));
        $usr_contacto = mysqli_real_escape_string($db, filter_var($_POST['usr_contacto'], FILTER_SANITIZE_NUMBER_INT));
        $usr_movel = mysqli_real_escape_string($db, filter_var($_POST['usr_movel'], FILTER_SANITIZE_NUMBER_INT));
        
        $query = "select * from tb_usuarios where usuario_nome='$usr_nome'and usuario_sobrenome='$usr_sobrenome' and usuario_login='$usr_login'";
        $result = mysqli_query($db, $query);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            
            if(password_verify($old_pw,$row['usuario_senha'])){
                $id = $row['usuario_id'];
                if(($new_pw =='')&&($confirm_pw=='')){
                    $query = "update tb_usuarios set usuario_login='$usr_login', usuario_email='$usr_email', usuario_contacto='$usr_contacto', usuario_movel='$usr_movel' where usuario_id='$id'";
                    $output['msg'] = "Usuário actualizado com sucesso";
                    mysqli_query($db, $query);

                    echo json_encode($output);
                }elseif((($new_pw !='')&&($confirm_pw!='')) && strcmp($new_pw,$confirm_pw) == 0){
                    
                    $hashed = password_hash($new_pw, PASSWORD_DEFAULT);
                    $output['usr_login'] = $usr_login;
                    $output['usr_email'] = $usr_email;
                    $output['usr_senha'] = $hashed;
                    $output['msg'] = "Usuário actualizado com sucesso";                          
                                
                    $query = "update tb_usuarios set usuario_login='$usr_login', usuario_email='$usr_email', usuario_senha='$hashed', usuario_contacto='$usr_contacto', usuario_movel='$usr_movel' where usuario_id='$id'";

                    mysqli_query($db, $query);                 
                    
                }else{
                    $output['msg'] = "As senhas não correspondem!!!";
                    echo json_encode($output);
                }
            }else{
                $output['msg'] = "Senha inválida!!!";
                echo json_encode($output);
            }
        }else{
            $output['msg'] = "Usuário inválido!!!";
            echo json_encode($output);
        }
    }

/********************************
*Actualizar imagem de perfil do *
*utilizador                     *
********************************/
if(isset($_SESSION['usuario_id'])){
    if($_FILES['usr_photo']['name']!=''){
        $usuario_imagem_type = $_FILES['usr_photo']['type'];
        $usuario_imagem_error = $_FILES['usr_photo']['error'];
        $usuario_imagem_name = $_FILES['usr_photo']['name'];
        $usuario_imagem_tmp = $_FILES['usr_photo']['tmp_name'];
        $usuario_imagem_size = $_FILES['usr_photo']['size'];

        $image_extension = explode('.', $usuario_imagem_name);

        $actual_image_extension = strtolower(end($image_extension));

        $allowed = array('jpeg','jpg','png','jfif');

        if(in_array($actual_image_extension , $allowed)){
            if($usuario_imagem_error === 0){
                if($usuario_imagem_size < 8000000){

                    $target = "../imagens/perfil/".basename($usuario_imagem_name);

                    move_uploaded_file($usuario_imagem_tmp, $target);

                    $query = "update tb_usuarios set usuario_foto='$usuario_imagem_name' where usuario_id = '".$_SESSION['usuario_id']."'";
                    mysqli_query($db, $query);
                    /*header('location: ../admin/saude');*/
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
}


/*************************************************************************
            Método Post para actualizar dados do Administrador 
*************************************************************************/

    if(isset($_POST['usr_admin'])){
        $usr_nome = mysqli_real_escape_string($db,filter_var($_POST['usr_nome'],FILTER_SANITIZE_STRING));
        $usr_sobrenome = mysqli_real_escape_string($db,filter_var($_POST['usr_sobrenome'],FILTER_SANITIZE_STRING));
        $usr_login = mysqli_real_escape_string($db,filter_var($_POST['usr_login'],FILTER_SANITIZE_STRING));
        $usr_email = mysqli_real_escape_string($db,filter_var($_POST['usr_email'],FILTER_SANITIZE_STRING));
        $old_pw = mysqli_real_escape_string($db,filter_var($_POST['old_pw'],FILTER_SANITIZE_STRING));
        $new_pw = mysqli_real_escape_string($db,filter_var($_POST['new_pw'],FILTER_SANITIZE_STRING));
        $confirm_pw = mysqli_real_escape_string($db,filter_var($_POST['confirm_pw'],FILTER_SANITIZE_STRING));
        
        //$usr_picture = $_FILES['usr_picture'];
        $usr_picture_name = $_FILES['usr_picture']['name'];
        $usr_picture_type = $_FILES['usr_picture']['type'];
        $usr_picture_size = $_FILES['usr_picture']['size'];
        $usr_picture_tmp_name = $_FILES['usr_picture']['tmp_name'];
        $usr_picture_error = $_FILES['usr_picture']['error'];
        
        $image_extension = explode('.',$usr_picture_name);
        
        $actual_image_extension = strtolower(end($image_extension));
        
        $allowed = array('jpeg','jpg','png','bmp','jfif','xbm');
        
        $query = "select * from tb_usuarios where usuario_nome='$usr_nome'and usuario_sobrenome='$usr_sobrenome'";
        $result = mysqli_query($db, $query);
        
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            
            if(password_verify($old_pw,$row['usuario_senha'])){
                $id = $row['usuario_id'];
                if(strcmp($new_pw,$confirm_pw) == 0){
                    
                    $hashed = password_hash($new_pw, PASSWORD_DEFAULT);
                    $output['usr_login'] = $usr_login;
                    $output['usr_email'] = $usr_email;
                    $output['usr_senha'] = $hashed;
                    $output['msg'] = "Usuário actualizado com sucesso";
                    
                    if(in_array($actual_image_extension , $allowed)){
                        if($usr_picture_error === 0){
                            if($usr_picture_size < 8000000){
                                $target = "../imagens/perfil/".basename($usr_picture_name);
                                
                                move_uploaded_file($usr_picture_tmp_name, $target);
                                
                                if(!empty($usr_picture_name)){
                                    $query = "update tb_usuarios set usuario_login='$usr_login', usuario_email='$usr_email', usuario_senha='$hashed', usuario_foto='$usr_picture_name' where usuario_id='$id'";
                    
                                    mysqli_query($db, $query);

                                    echo json_encode($output);
                                }
                            }else{
                               $output['msg'] = "Tamanho muito grande"; 
                            }
                        }else{
                            $output['msg'] = "Erro no upload da imagem";
                        }
                    }else{
                        $output['msg'] = "Formato inválido";
                    }
                    
                    if(empty($usr_picture_name)){
                        $query = "update tb_usuarios set usuario_login='$usr_login', usuario_email='$usr_email', usuario_senha='$hashed' where usuario_id='$id'";
                    
                        mysqli_query($db, $query);

                        echo json_encode($output);
                    }
                    
                }else{
                    $output['msg'] = "As senhas não correspondem!!!";
                    echo json_encode($output);
                }
            }else{
                $output['msg'] = "Senha inválida!!!";
                echo json_encode($output);
            }
        }else{
            $output['msg'] = "Usuário inválido!!!";
            echo json_encode($output);
        }
    }

/***********************************************
        Actualizar dica de saude
***********************************************/

if(isset($_POST['update_dica_saude'])){
    $dica_id = $_POST['update_dica_id'];
    $dica_titulo = $_POST['update_dica_titulo'];
    $dica_mensagem = $_POST['uptade_dica_mensagem'];
    
    $query = "update tb_dicas_saude set dica_titulo='$dica_titulo', dica_mensagem='$dica_mensagem', dica_uid='".$_SESSION['usuario_id']."' where id = '$dica_id'";
    mysqli_query($db, $query);
    
    if($_SESSION['usuario_tipo'] == 'manager'){
        header('location: ../admin/saude');
    }elseif($_SESSION['usuario_tipo'] == 'media'){
        header('location: ../media/media_saude');
    }
    
}

/********************************
para preencjer a modal de corrida
em objectivo da semana
*********************************/

if(isset($_POST['runGoalIDInfo'])){
    $corrida_id = $_POST['runGoalIDInfo'];
    
    $query = "select * from tb_corridas where corrida_id = '$corrida_id'";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_assoc($result);
    
    echo json_encode($row);
    
}

/************************************************
Actualizar a corrida no objectivo da semana 
************************************************/

if(isset($_POST['runGoalID'])){
    $input_curRunState = $_POST['input_curRunState'];
    $input_RunGoal = $_POST['input_RunGoal'];
    $runGoalID = $_POST['runGoalID'];
    
    $query = "update tb_corridas set corrida_goal='$input_RunGoal', corrida_state='$input_curRunState' where corrida_id='$runGoalID'";
    mysqli_query($db, $query);
}

/********************************
para preencher a modal de exercício
em objectivo da semana
*********************************/

if(isset($_POST['exGoalIDInfo'])){
    $exercicio_id = $_POST['exGoalIDInfo'];
    
    $query = "select * from tb_exercicios where exercicio_id = '$exercicio_id'";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_assoc($result);
    
    echo json_encode($row);
    
}

/************************************************
Actualizar o exercício no objectivo da semana 
************************************************/

if(isset($_POST['exGoalID'])){
    $input_curExState = $_POST['input_curExState'];
    $input_ExGoal = $_POST['input_ExGoal'];
    $exGoalID = $_POST['exGoalID'];
    
    $query = "update tb_exercicios set exercicio_goal='$input_ExGoal', exercicio_state='$input_curExState' where exercicio_id='$exGoalID'";
    mysqli_query($db, $query);
}


/********************************
para preencher a modal de desporto
em objectivo da semana
*********************************/

if(isset($_POST['despGoalIDInfo'])){
    $desporto_id = $_POST['despGoalIDInfo'];
    
    $query = "select * from tb_desportos where desporto_id = '$desporto_id'";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_assoc($result);
    
    echo json_encode($row);
    
}

/************************************************
Actualizar o desporto no objectivo da semana 
************************************************/

if(isset($_POST['despGoalID'])){
    $input_curDespState = $_POST['input_curDespState'];
    $input_DespGoal = $_POST['input_DespGoal'];
    $despGoalID = $_POST['despGoalID'];
    
    $query = "update tb_desportos set desporto_goal='$input_DespGoal', desporto_state='$input_curDespState' where desporto_id='$despGoalID'";
    mysqli_query($db, $query);
}

/********************************
para preencher a modal de ciclismo
em objectivo da semana
*********************************/

if(isset($_POST['cicGoalIDInfo'])){
    $ciclismo_id = $_POST['cicGoalIDInfo'];
    
    $query = "select * from tb_ciclismo where ciclismo_id = '$ciclismo_id'";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_assoc($result);
    
    echo json_encode($row);
    
}

/************************************************
Actualizar o desporto no objectivo da semana 
************************************************/

if(isset($_POST['cicGoalID'])){
    $input_curCicState = $_POST['input_curCicState'];
    $input_CicGoal = $_POST['input_CicGoal'];
    $cicGoalID = $_POST['cicGoalID'];
    
    $query = "update tb_ciclismo set ciclismo_goal='$input_CicGoal', ciclismo_state='$input_curCicState' where ciclismo_id='$cicGoalID'";
    mysqli_query($db, $query);
}

/************************************************
Actualizar o desporto no objectivo da semana 
************************************************/
if(isset($_POST['update_ideia'])){
    $ideia_assunto = mysqli_real_escape_string($db, filter_var($_POST['update_ideia_assunto'], FILTER_SANITIZE_STRING));
    $ideia_descricao = $_POST['update_ideia_descricao'];
    $ideia_id = $_POST['update_ideia_id'];
    
    $query = "update tb_ideias set ideia_assunto = '$ideia_assunto', ideia_descricao = '$ideia_descricao' where ideia_id = '$ideia_id'";
    
    mysqli_query($db, $query);
    
    header("location: ../col/col_ideias");
}

/**********************************************
Actualizar o estado da checklist
**********************************************/
if(isset($_POST['checklistvalue'])){
    $query = "select * from tb_checklist where checklist_id='".$_POST['checklistvalue']."'";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_assoc($result);
    $percent = 0;
    
    if(strcmp($row['checklist_status'], 'Feito')==0){
        $query = "update tb_checklist set checklist_status='Nao feito', checklist_check='unchecked' where checklist_id='".$_POST['checklistvalue']."'";
        mysqli_query($db,$query);
        $query = "select * from tb_checklist where checklist_id='".$_POST['checklistvalue']."'";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);
        $query = "select count(*) from tb_checklist where checklist_tid='".$row['checklist_tid']."' and checklist_status='Feito'";
        $result = mysqli_query($db,$query);
        $row2 = mysqli_fetch_assoc($result);
        $checklist_doneTasks = $row2['count(*)'];
        
        $query = "select count(*) from tb_checklist where checklist_tid='".$row['checklist_tid']."'";
        $result = mysqli_query($db,$query);
        $row3 = mysqli_fetch_assoc($result);
        $checklist_total = $row3['count(*)'];
        
        $percent = round(($checklist_doneTasks/$checklist_total)*100, 2);
        
        if(($checklist_doneTasks==0) && ($checklist_doneTasks < $checklist_total)){
            $query = "update tb_tarefas set tarefa_status='Em analise', tarefa_percent='$percent' where tarefa_id='".$row['checklist_tid']."'";
            mysqli_query($db,$query);
        }elseif(($checklist_doneTasks>0) && ($checklist_doneTasks < $checklist_total)){
            $query = "update tb_tarefas set tarefa_status='Em curso', tarefa_percent='$percent' where tarefa_id='".$row['checklist_tid']."'";
            mysqli_query($db,$query);
        }
    }elseif(strcmp($row['checklist_status'], 'Nao feito')==0){
        $query = "update tb_checklist set checklist_status='Feito', checklist_check='checked' where checklist_id='".$_POST['checklistvalue']."'";
        mysqli_query($db,$query);
        $query = "select * from tb_checklist where checklist_id='".$_POST['checklistvalue']."'";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);
        $query = "select count(*) from tb_checklist where checklist_tid='".$row['checklist_tid']."' and checklist_status='Feito'";
        $result = mysqli_query($db,$query);
        $row2 = mysqli_fetch_assoc($result);
        $checklist_doneTasks = $row2['count(*)'];
        
        $query = "select count(*) from tb_checklist where checklist_tid='".$row['checklist_tid']."'";
        $result = mysqli_query($db,$query);
        $row3 = mysqli_fetch_assoc($result);
        $checklist_total = $row3['count(*)'];
        
        $percent = round(($checklist_doneTasks/$checklist_total)*100, 2);
        
        if(($checklist_doneTasks>0) && ($checklist_doneTasks < $checklist_total)){
            $query = "update tb_tarefas set tarefa_status='Em curso', tarefa_percent='$percent' where tarefa_id='".$row['checklist_tid']."'";
            mysqli_query($db,$query);
        }elseif(($checklist_doneTasks>0) && ($checklist_doneTasks == $checklist_total)){
            $query = "update tb_tarefas set tarefa_status='Em revisao', tarefa_percent='$percent' where tarefa_id='".$row['checklist_tid']."'";
            mysqli_query($db,$query);
            
            $data = array(
                'task_forRevision' => $row['checklist_tid']
            );
            
            $str = http_build_query($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost/includes/e-mail.php");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $saida = curl_exec($ch);
            curl_close($ch);
        }
    }
    
    //header("location: ../col/col_tarefas");
    
}

/******************************************************************************
Actualizar os dados das tarefas - para tal definimos algumas coias importantes
como actualizar o nome, prioridade, data de inicio, data de fim.
No entanto para actualizar a Checklist da tarefa utilizou-se o seguinte recio-
cínio: 
    verificar se os campos da checklist são iguais aos que já existem no 
    banco, se sim então actualiza-se o nome da checklist. 
    
    Caso a nova checklist seja maior do que a que existe no banco de dados en-
    tão para além de actualizar os dados insere-se no novo campo que falta.
    
    Caso a nova checklist seja menor que os dados que já existem no banco en-
    tão actualiza-se até ao tamanho da nova checklist e todo o resto elimina-
    -se do banco.
******************************************************************************/
if(isset($_POST['uptd_tarefa'])){
    
    $query = "update tb_tarefas set tarefa_nome='".$_POST['input_uptdTaskName']."', tarefa_prioridade='".$_POST['task__uptdPriority']."', tarefa_inicio='".date('d-m-Y', strtotime($_POST['input_uptdStartDate']))."', tarefa_fim='".date('d-m-Y', strtotime($_POST['input_uptdEndtDate']))."' where tarefa_id='".$_POST['task_id']."' "; 
    mysqli_query($db,$query);
    
    $query = "select * from tb_checklist where checklist_tid='".$_POST['task_id']."'";
    $result = mysqli_query($db,$query);
    
    //Actualização da Checklist
    if(mysqli_num_rows($result) == count($_POST['input_uptdChecklistAdd'])){     
        while((list($key,$value) = each($_POST['input_uptdChecklistAdd'])) && ($row = mysqli_fetch_assoc($result))){
            $query = "update tb_checklist set checklist_nome='$value' where checklist_tid ='".$_POST['task_id']."' and checklist_id='".$row['checklist_id']."' ";
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) <= count($_POST['input_uptdChecklistAdd'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($count,$value) = each($_POST['input_uptdChecklistAdd']);
            $query = "update tb_checklist set checklist_nome='$value' where checklist_tid ='".$_POST['task_id']."' and checklist_id='".$row['checklist_id']."' ";
            mysqli_query($db,$query);
            $count++;
        }
        
        while(list($count,$value) = each($_POST['input_uptdChecklistAdd'])){
            $query="insert into tb_checklist (checklist_id, checklist_tid, checklist_nome, checklist_status, checklist_check) values (null, '".$_POST['task_id']."', '$value', 'Nao Feito', 'unchecked')";
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) >= count($_POST['input_uptdChecklistAdd'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['input_uptdChecklistAdd']);
            if($key == $count){
                $query = "update tb_checklist set checklist_nome='$value' where checklist_tid ='".$_POST['task_id']."' and checklist_id='".$row['checklist_id']."' ";
                mysqli_query($db,$query);
            }else if($key < $count){
                $query = "delete from tb_checklist where checklist_id='".$row['checklist_id']."'";
                mysqli_query($db,$query);
            }
            $count++;
        }
    }
    
    //Actualização dos participantes da tarefa
    $query = "select * from tb_membrostpc where membroTPC_tid='".$_POST['task_id']."'";
    $result = mysqli_query($db,$query);
    
    if(mysqli_num_rows($result) == count($_POST['worker_uptdId'])){     
        while((list($key,$value) = each($_POST['worker_uptdId'])) && ($row = mysqli_fetch_assoc($result))){
            $query = "update tb_membrostpc set membroTPC_uid='$value' where membroTPC_tid ='".$_POST['task_id']."' and membroTPC_id='".$row['membroTPC_id']."' ";
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) <= count($_POST['worker_uptdId'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['worker_uptdId']);
            $query = "update tb_membrostpc set membroTPC_uid='$value' where membroTPC_tid ='".$_POST['task_id']."' and membroTPC_id='".$row['membroTPC_id']."' ";
            mysqli_query($db,$query);
            $count++;
        }
        while(list($count,$value) = each($_POST['worker_uptdId'])){
            $query = "insert into tb_membrostpc (membroTPC_id, membroTPC_tid, membroTPC_uid) values (null, '".$_POST['task_id']."', '$value') ";
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) >= count($_POST['worker_uptdId'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['worker_uptdId']);
            if($key == $count){
                $query = "update tb_membrostpc set membroTPC_uid='$value' where membroTPC_tid ='".$_POST['task_id']."' and membroTPC_id='".$row['membroTPC_id']."' ";
                mysqli_query($db,$query);
            }else if($key < $count){
                $query = "delete from tb_membrostpc where membroTPC_id='".$row['membroTPC_id']."'";
                mysqli_query($db,$query);
            }
            $count++;    
        }
    }
    
    header("location: ../col/col_tarefas");
}


/*******************************************
*Método Post para actualizar projectos     *
*******************************************/
if(isset($_POST['updt_projecto'])){
    $project_id = $_POST['project_id'];
    $projecto_nome = mysqli_real_escape_string($db, filter_var($_POST['projectUpdtName'], FILTER_SANITIZE_STRING));
    $projecto__contexto = $_POST['projectUpdt__context'];
    $projecto__missao = $_POST['projectUpdt__mission'];
    $projecto__objectivo = $_POST['projectUpdt__goal'];
    $projecto__metodologia = $_POST['projectUpdt__metodology'];
    $projecto__entregaveis = $_POST['projectUpdt__entregaveis'];
    $projecto__responsavel = $_POST['responsavel_id'];
    
    if($_FILES['projectUpdtImage']['name']!=''){
        
        $projecto_imagem_type = $_FILES['projectUpdtImage']['type'];
        $projecto_imagem_error = $_FILES['projectUpdtImage']['error'];
        $projecto_imagem_name = $_FILES['projectUpdtImage']['name'];
        $projecto_imagem_tmp = $_FILES['projectUpdtImage']['tmp_name'];
        $projecto_imagem_size = $_FILES['projectUpdtImage']['size'];
        
        $query = "select projecto_imagem from tb_projectos where projecto_id='$project_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        
        $target = "../imagens/projectos/".basename($row['projecto_imagem']);
        unlink($target);
        
        $image_extension = explode('.', $projecto_imagem_name);

        $actual_image_extension = strtolower(end($image_extension));

        $allowed = array('jpeg','jpg','png','jfif');

        if(in_array($actual_image_extension , $allowed)){
            if($projecto_imagem_error === 0){
                if($projecto_imagem_size < 8000000){

                    $target = "../imagens/projectos/".basename($projecto_imagem_name);

                    move_uploaded_file($projecto_imagem_tmp, $target);

                    $query = "update tb_projectos set projecto_imagem='$projecto_imagem_name' where projecto_id = '$project_id'";
                    mysqli_query($db, $query);
                    
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
    
    $query = "update tb_projectos set projecto_nome='$projecto_nome', projecto_contexto='$projecto__contexto', projecto_missao='$projecto__missao', projecto_objectivo='$projecto__objectivo', projecto_metodologia='$projecto__metodologia', projecto_entregaveis='$projecto__entregaveis', projecto_uid = '$projecto__responsavel' where projecto_id='$project_id'";
    
    mysqli_query($db, $query);
    
    /************************************
    *Actualização dos Riscos do projec- *
    *to                                 *
    ************************************/
    
    $query = "select * from tb_riscosproject where riscosproject_pid='$project_id'";
    $result = mysqli_query($db,$query);
    
    if(mysqli_num_rows($result) == count($_POST['risk_nameUpdt'])){
        while((list($key,$value) = each($_POST['risk_nameUpdt'])) && (list($key,$cause) = each($_POST['risk_causeUpdt'])) && (list($key,$impact) = each($_POST['risk_impactUpdt'])) && (list($key,$mitigation) = each($_POST['risk_mitigationUpdt'])) && (list($key,$prob) = each($_POST['risk_probUpdt'])) && (list($key,$imp) = each($_POST['risk_impUpdt'])) && ($row = mysqli_fetch_assoc($result))){
            $riscosproject_nome = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
            $riscosproject_descricao = mysqli_real_escape_string($db, filter_var($cause, FILTER_SANITIZE_STRING));
            $riscosproject_impacto = mysqli_real_escape_string($db, filter_var($impact, FILTER_SANITIZE_STRING));
            $riscosproject_mitigacao = mysqli_real_escape_string($db, filter_var($mitigation, FILTER_SANITIZE_STRING));
            $riscosproject_prob = mysqli_real_escape_string($db, filter_var($prob, FILTER_SANITIZE_NUMBER_INT));
            $riscosproject_imp = mysqli_real_escape_string($db, filter_var($imp, FILTER_SANITIZE_NUMBER_INT));
            
            $query = "update tb_riscosproject set riscosproject_nome='$riscosproject_nome', riscosproject_descricao='$riscosproject_descricao', riscosproject_impacto='$riscosproject_impacto', riscosproject_acc_mtgcao='$riscosproject_mitigacao', riscosproject_prob='$riscosproject_prob', riscosproject_impt='$riscosproject_imp' where riscosproject_id='".$row['riscosproject_id']."'";
            
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) < count($_POST['risk_nameUpdt'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['risk_nameUpdt']);
            list($key,$cause) = each($_POST['risk_causeUpdt']);
            list($key,$impact) = each($_POST['risk_impactUpdt']);
            list($key,$mitigation) = each($_POST['risk_mitigationUpdt']);
            list($key,$prob) = each($_POST['risk_probUpdt']);
            list($key,$imp) = each($_POST['risk_impUpdt']);
            
            $riscosproject_nome = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
            $riscosproject_descricao = mysqli_real_escape_string($db, filter_var($cause, FILTER_SANITIZE_STRING));
            $riscosproject_impacto = mysqli_real_escape_string($db, filter_var($impact, FILTER_SANITIZE_STRING));
            $riscosproject_mitigacao = mysqli_real_escape_string($db, filter_var($mitigation, FILTER_SANITIZE_STRING));
            $riscosproject_prob = mysqli_real_escape_string($db, filter_var($prob, FILTER_SANITIZE_NUMBER_INT));
            $riscosproject_imp = mysqli_real_escape_string($db, filter_var($imp, FILTER_SANITIZE_NUMBER_INT));
            
            $query = "update tb_riscosproject set riscosproject_nome='$riscosproject_nome', riscosproject_descricao='$riscosproject_descricao', riscosproject_impacto='$riscosproject_impacto', riscosproject_acc_mtgcao='$riscosproject_mitigacao', riscosproject_prob='$riscosproject_prob', riscosproject_impt='$riscosproject_imp' where riscosproject_id='".$row['riscosproject_id']."'";
            
            mysqli_query($db,$query);
            $count++;
        }
        
        while((list($count,$value) = each($_POST['risk_nameUpdt'])) && (list($count,$cause) = each($_POST['risk_causeUpdt'])) && (list($count,$impact) = each($_POST['risk_impactUpdt'])) && (list($count,$mitigation) = each($_POST['risk_mitigationUpdt'])) && (list($count,$prob) = each($_POST['risk_probUpdt'])) && (list($count,$imp) = each($_POST['risk_impUpdt']))){
            
            $riscosproject_nome = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
            $riscosproject_descricao = mysqli_real_escape_string($db, filter_var($cause, FILTER_SANITIZE_STRING));
            $riscosproject_impacto = mysqli_real_escape_string($db, filter_var($impact, FILTER_SANITIZE_STRING));
            $riscosproject_mitigacao = mysqli_real_escape_string($db, filter_var($mitigation, FILTER_SANITIZE_STRING));
            $riscosproject_prob = mysqli_real_escape_string($db, filter_var($prob, FILTER_SANITIZE_NUMBER_INT));
            $riscosproject_imp = mysqli_real_escape_string($db, filter_var($imp, FILTER_SANITIZE_NUMBER_INT));
            
            $query = "insert into tb_riscosproject (riscosproject_id, riscosproject_pid, riscosproject_nome, riscosproject_descricao, riscosproject_impacto, riscosproject_acc_mtgcao, riscosproject_prob, riscosproject_impt) values (null, '$project_id', '$riscosproject_nome', '$riscosproject_descricao', '$riscosproject_impacto', '$riscosproject_mitigacao', '$riscosproject_prob', '$riscosproject_imp')";
            
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) > count($_POST['risk_nameUpdt'])){
        $count = 0;
        echo ("Contagem: ".mysqli_num_rows($result));
        echo ("<br>");
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['risk_nameUpdt']);
            list($key,$cause) = each($_POST['risk_causeUpdt']);
            list($key,$impact) = each($_POST['risk_impactUpdt']);
            list($key,$mitigation) = each($_POST['risk_mitigationUpdt']);
            list($key,$prob) = each($_POST['risk_probUpdt']);
            list($key,$imp) = each($_POST['risk_impUpdt']);
            
            $riscosproject_nome = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
            $riscosproject_descricao = mysqli_real_escape_string($db, filter_var($cause, FILTER_SANITIZE_STRING));
            $riscosproject_impacto = mysqli_real_escape_string($db, filter_var($impact, FILTER_SANITIZE_STRING));
            $riscosproject_mitigacao = mysqli_real_escape_string($db, filter_var($mitigation, FILTER_SANITIZE_STRING));
            $riscosproject_prob = mysqli_real_escape_string($db, filter_var($prob, FILTER_SANITIZE_NUMBER_INT));
            $riscosproject_imp = mysqli_real_escape_string($db, filter_var($imp, FILTER_SANITIZE_NUMBER_INT));
            
            if($key === $count){
                $query = "update tb_riscosproject set riscosproject_nome='$riscosproject_nome', riscosproject_descricao='$riscosproject_descricao', riscosproject_impacto='$riscosproject_impacto', riscosproject_acc_mtgcao='$riscosproject_mitigacao', riscosproject_prob='$riscosproject_prob', riscosproject_impt='$riscosproject_imp' where riscosproject_id='".$row['riscosproject_id']."'";
            
                mysqli_query($db,$query);
                
            }else if($key < $count){
                $query = "delete from tb_riscosproject where riscosproject_id='".$row['riscosproject_id']."'";
                
                mysqli_query($db,$query);
            }
            $count++;
        }
    }
    
    /********************************************
    *Actualização dos membros do projecto       *
    ********************************************/
    $query = "select * from tb_membrosproject where membrosproject_pid='$project_id'";
    $result = mysqli_query($db, $query);
    
    if(mysqli_num_rows($result) == count($_POST['worker_idUpdt'])){     
        while((list($key,$value) = each($_POST['worker_idUpdt'])) && ($row = mysqli_fetch_assoc($result))){
            $query = "update tb_membrosproject set membrosproject_uid='$value' where membrosproject_id ='".$row['membrosproject_id']."'";
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) < count($_POST['worker_idUpdt'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['worker_idUpdt']);
            $query = "update tb_membrosproject set membrosproject_uid='$value' where membrosproject_id ='".$row['membrosproject_id']."'";
            mysqli_query($db,$query);
            $count++;
        }
        while(list($count,$value) = each($_POST['worker_idUpdt'])){
            $query = "insert into tb_membrosproject (membrosproject_id, membrosproject_pid, membrosproject_uid) values (null, '$project_id', '$value') ";
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) > count($_POST['worker_idUpdt'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['worker_idUpdt']);
            if($key == $count){
                $query = "update tb_membrosproject set membrosproject_uid='$value' where membrosproject_id ='".$row['membrosproject_id']."'";
                mysqli_query($db,$query);
            }else if($key < $count){
                $query = "delete from tb_membrosproject where membrosproject_id='".$row['membrosproject_id']."'";
                mysqli_query($db,$query);
            }
            $count++;    
        }
    }
    
    /*******************************************
    *Actualização do cronograma dos projectos  *
    *******************************************/
    $query = "select * from tb_fasesproject where faseproject_pid='".$project_id."'";
    $result = mysqli_query($db, $query);
    $last_date = '13-10-2001';
    $start_date = date('d-m-Y');
    if(mysqli_num_rows($result) === count($_POST['act_textUpdt'])){
        
        while((list($key,$value) = each($_POST['act_textUpdt'])) && (list($key,$start) = each($_POST['act_dataUpdt'])) && (list($key,$duration) = each($_POST['act_numberUpdt'])) && ($row = mysqli_fetch_assoc($result))){
            $fase_nome = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
            $fase_data_inicio = date('d-m-Y', strtotime($start));
            $fase_duracao = mysqli_real_escape_string($db, filter_var($duration, FILTER_SANITIZE_NUMBER_INT));
            $fase_data_fim = date('d-m-Y', strtotime($start.' + '.$duration.' days - 1 days'));
            
            $query="update tb_fasesproject set faseproject_nome='$fase_nome', faseproject_inicio='$fase_data_inicio', faseproject_duracao='$fase_duracao', faseproject_fim='$fase_data_fim' where faseproject_id='".$row['faseproject_id']."'";
            mysqli_query($db,$query);
            
            if(strtotime($last_date) < strtotime($fase_data_fim)){
                $last_date = $fase_data_fim;
                $query2 = "update tb_projectos set projecto_fim = '$last_date' where projecto_id ='$project_id'";
                mysqli_query($db,$query2);
            }
            
            if(strtotime($fase_data_inicio) < strtotime($start_date)){
                $start_date = $fase_data_inicio;
                $query2 = "update tb_projectos set projecto_inicio = '$start_date' where projecto_id ='$project_id'";
                mysqli_query($db,$query2);
            }
        }
    }else if(mysqli_num_rows($result) < count($_POST['act_textUpdt'])){
        $count = 0;
        
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['act_textUpdt']);
            list($key,$start) = each($_POST['act_dataUpdt']);
            list($key,$duration) = each($_POST['act_numberUpdt']);
            
            $fase_nome = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
            $fase_data_inicio = date('d-m-Y', strtotime($start));
            $fase_duracao = mysqli_real_escape_string($db, filter_var($duration, FILTER_SANITIZE_NUMBER_INT));
            $fase_data_fim = date('d-m-Y', strtotime($start.' + '.$duration.' days - 1 days'));
            
            $query="update tb_fasesproject set faseproject_nome='$fase_nome', faseproject_inicio='$fase_data_inicio', faseproject_duracao='$fase_duracao', faseproject_fim='$fase_data_fim' where faseproject_id='".$row['faseproject_id']."'";
            mysqli_query($db,$query);
            
            if(strtotime($last_date) < strtotime($fase_data_fim)){
                $last_date = $fase_data_fim;
                $query2 = "update tb_projectos set projecto_fim = '$last_date' where projecto_id ='$project_id'";
                mysqli_query($db,$query2);
            }
            
            if(strtotime($fase_data_inicio) < strtotime($start_date)){
                $start_date = $fase_data_inicio;
                $query2 = "update tb_projectos set projecto_inicio = '$start_date' where projecto_id ='$project_id'";
                mysqli_query($db,$query2);
            }
            $count++;
        }
        while((list($count,$value) = each($_POST['act_textUpdt'])) && (list($count,$start) = each($_POST['act_dataUpdt'])) && (list($count,$duration) = each($_POST['act_numberUpdt']))){
            $fase_nome = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
            $fase_data_inicio = date('d-m-Y', strtotime($start));
            $fase_duracao = mysqli_real_escape_string($db, filter_var($duration, FILTER_SANITIZE_NUMBER_INT));
            $fase_data_fim = date('d-m-Y', strtotime($start.' + '.$duration.' days - 1 days'));
            
            $query="insert into tb_fasesproject (faseproject_id, faseproject_pid, faseproject_nome, faseproject_inicio, faseproject_duracao, faseproject_fim) values (null, '$project_id', '$fase_nome', '$fase_data_inicio', '$fase_duracao', '$fase_data_fim')";
            mysqli_query($db,$query);
            
            if(strtotime($last_date) < strtotime($fase_data_fim)){
                $last_date = $fase_data_fim;
                $query2 = "update tb_projectos set projecto_fim = '$last_date' where projecto_id ='$project_id'";
                mysqli_query($db,$query2);
            }
            
            if(strtotime($fase_data_inicio) < strtotime($start_date)){
                $start_date = $fase_data_inicio;
                $query2 = "update tb_projectos set projecto_inicio = '$start_date' where projecto_id ='$project_id'";
                mysqli_query($db,$query2);
            }
        }
    }else if(mysqli_num_rows($result) > count($_POST['act_textUpdt'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['act_textUpdt']);
            list($key,$start) = each($_POST['act_dataUpdt']);
            list($key,$duration) = each($_POST['act_numberUpdt']);
            
            $fase_nome = mysqli_real_escape_string($db, filter_var($value, FILTER_SANITIZE_STRING));
            $fase_data_inicio = date('d-m-Y', strtotime($start));
            $fase_duracao = mysqli_real_escape_string($db, filter_var($duration, FILTER_SANITIZE_NUMBER_INT));
            $fase_data_fim = date('d-m-Y', strtotime($start.' + '.$duration.' days - 1 days'));
            
            if($key == $count){
                
                $query="update tb_fasesproject set faseproject_nome='$fase_nome', faseproject_inicio='$fase_data_inicio', faseproject_duracao='$fase_duracao', faseproject_fim='$fase_data_fim' where faseproject_id='".$row['faseproject_id']."'";
                mysqli_query($db,$query);
                
            }elseif($key < $count){
                $query="delete from tb_fasesproject where faseproject_id='".$row['faseproject_id']."'";
                mysqli_query($db,$query);
            }
            
            if(strtotime($last_date) < strtotime($fase_data_fim)){
                $last_date = $fase_data_fim;
                $query2 = "update tb_projectos set projecto_fim = '$last_date' where projecto_id ='$project_id'";
                mysqli_query($db,$query2);
            }
            if(strtotime($fase_data_inicio) < strtotime($start_date)){
                $start_date = $fase_data_inicio;
                $query2 = "update tb_projectos set projecto_inicio = '$start_date' where projecto_id ='$project_id'";
                mysqli_query($db,$query2);
            }
            $count++;
        }
    }
    
    if($_SESSION['usuario_tipo']=='tecnico'){
        header('location: ../col/col_projectos');
    }elseif($_SESSION['usuario_tipo']=='admin'){
        header('location: ../ca/ca_projectos');
    }
    
}

/***********************************
*Verificar se o estado do projecto *
*já passou algum tempo sem comentá-*
*rios                              *
***********************************/

if(isset($_POST['check'])){
    $query = "SELECT tb_comentarios_projecto.comentario_time, MAX(tb_comentarios_projecto.comentario_id), tb_projectos.projecto_nome, tb_comentarios_projecto.comentario_pid FROM tb_comentarios_projecto INNER JOIN tb_projectos INNER JOIN tb_membrosproject WHERE tb_comentarios_projecto.comentario_pid=tb_projectos.projecto_id AND tb_projectos.projecto_status='Em curso' AND tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid AND tb_membrosproject.membrosproject_uid='".$_SESSION['usuario_id']."' GROUP by tb_comentarios_projecto.comentario_pid";
    
    $result = mysqli_query($db, $query);
    print_r( $result);
    while($row = mysqli_fetch_assoc($result)){
        $query = "SELECT tb_comentarios_projecto.comentario_time FROM tb_comentarios_projecto WHERE tb_comentarios_projecto.comentario_id = '".$row['MAX(tb_comentarios_projecto.comentario_id)']."'";      
        $result2 = mysqli_query($db, $query);
        $row2 = mysqli_fetch_assoc($result2);
        
        $state ='';
        $last_comment = $row2['comentario_time'];
        $project_id = $row['comentario_pid'];
        $comment_limit = date('d-m-Y H:i', strtotime($last_comment.' + 7 days'));
        $current_time = date('d-m-Y H:i');
        
        if(strtotime($comment_limit) < strtotime($current_time)){
            $state = 'Parado';
            $query = "update tb_projectos set projecto_status='$state' where projecto_id ='$project_id' ";
            mysqli_query($db, $query);
            
            $data = array(
                'stopped_project' => $project_id
            );
            
            $str = http_build_query($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://localhost/includes/e-mail.php");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $saida = curl_exec($ch);
            curl_close($ch);
        }
    }
}

/***************************************
*Post para actualizar dados da formação*
***************************************/
if(isset($_POST['updt_formacao'])){
    $formacao_nomeupdt = mysqli_real_escape_string($db,filter_var($_POST['formacao__nomeupdt'],FILTER_SANITIZE_STRING));
    $formacao_entidadeupdt = mysqli_real_escape_string($db,filter_var($_POST['formacao__entidadeupdt'],FILTER_SANITIZE_STRING));
    $formacao_localupdt = mysqli_real_escape_string($db,filter_var($_POST['formacao__localupdt'],FILTER_SANITIZE_STRING));
    $formacao_custoupdt = mysqli_real_escape_string($db,filter_var($_POST['formacao__custoupdt'],FILTER_SANITIZE_NUMBER_INT));
    $formacao_tipoupdt = mysqli_real_escape_string($db,filter_var($_POST['formacao__tipoupdt'],FILTER_SANITIZE_STRING));
    $formacao_gruposupdt = mysqli_real_escape_string($db,filter_var($_POST['formacao__gruposupdt'],FILTER_SANITIZE_NUMBER_INT));
    $formacao_inicioupdt = date('d-m-Y', strtotime($_POST['formacao__inicioupdt']));
    $formacao_duracaoupdt = mysqli_real_escape_string($db,filter_var($_POST['formacao__duracaoupdt'],FILTER_SANITIZE_NUMBER_INT));
    $formacao_fimupdt = date('d-m-Y', strtotime($formacao_inicioupdt.' + '.$formacao_duracaoupdt.' days - 1 days'));
    $formacao_hinicioupdt = date('H:i', strtotime($_POST['formacao__hinicioupdt']));
    $formacao_hfimupdt = date('H:i', strtotime($_POST['formacao__hfimupdt']));
    $formacao_idupdt = $_POST['formacao__idupdt'];
    
    $query = "update tb_formacoes set formacao_nome='$formacao_nomeupdt', formacao_entidade='$formacao_entidadeupdt', formacao_local='$formacao_localupdt', formacao_custo='$formacao_custoupdt', formacao_tipo='$formacao_tipoupdt', formacao_grupos='$formacao_gruposupdt', formacao_inicio='$formacao_inicioupdt', formacao_duracao='$formacao_duracaoupdt', formacao_fim='$formacao_fimupdt', formacao_hinicio='$formacao_hinicioupdt', formacao_hfim='$formacao_hfimupdt' where formacao_id='$formacao_idupdt'";
    
    mysqli_query($db, $query);
    
    /*******************************************
    *Actualizar os colaboradores das formações *
    *******************************************/
    
    $query = "select * from tb_formacoes_membros where formacoes_membros_fid='$formacao_idupdt'";
    $result = mysqli_query($db, $query);
    $nmembros = 0;
    
    if(mysqli_num_rows($result) == count($_POST['formacao__membroupdt'])){     
        while((list($key,$value) = each($_POST['formacao__membroupdt'])) && ($row = mysqli_fetch_assoc($result))){
            $query = "update tb_formacoes_membros set formacoes_membros_uid='$value' where formacoes_membros_id ='".$row['formacoes_membros_id']."'";
            mysqli_query($db,$query);
        }
    }else if(mysqli_num_rows($result) < count($_POST['formacao__membroupdt'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['formacao__membroupdt']);
            $query = "update tb_formacoes_membros set formacoes_membros_uid='$value' where formacoes_membros_id ='".$row['formacoes_membros_id']."'";
            mysqli_query($db,$query);
            $count++;
        }
        while(list($count,$value) = each($_POST['formacao__membroupdt'])){
            $query = "insert into tb_formacoes_membros (formacoes_membros_id, formacoes_membros_fid, formacoes_membros_uid) values (null, '$formacao_idupdt', '$value') ";
            mysqli_query($db,$query);
            $nmembros = $count;
        }
        $nmembros+=1;
    }else if(mysqli_num_rows($result) > count($_POST['formacao__membroupdt'])){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            list($key,$value) = each($_POST['formacao__membroupdt']);
            if($key == $count){
                $query = "update tb_formacoes_membros set formacoes_membros_uid='$value' where formacoes_membros_id ='".$row['formacoes_membros_id']."'";
                mysqli_query($db,$query);
                $nmembros = $count;
            }else if($key < $count){
                $query = "delete from tb_formacoes_membros where formacoes_membros_id='".$row['formacoes_membros_id']."'";
                mysqli_query($db,$query);
            }
            $count++;    
        }
        $nmembros+=1;
    }
    
    $query = "update tb_formacoes set formacao_nmembros='$nmembros' where formacao_id = '$formacao_idupdt'";
    mysqli_query($db, $query);
    
    header('location: ../col/col_formacoes');
}

/*****************************************
*Actualizar a tarefa como vericada pelo  *
*chefe de departamento                   *
******************************************/
if(isset($_POST['approved_task'])){
    $query = "update tb_tarefas set tarefa_status='Concluida' where tarefa_id='".$_POST['approved_task']."' ";
    mysqli_query($db, $query);
    echo "sucesso";
}

if(isset($_POST['refused_task'])){
    $refused_task = $_POST['refused_task'];
    $query = "update tb_tarefas set tarefa_status='Em analise', tarefa_percent=0 where tarefa_id='$refused_task' ";
    mysqli_query($db, $query);
    
    $query = "select * from tb_checklist where checklist_tid ='$refused_task'";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $query = "update tb_checklist set checklist_status='Nao feito', checklist_check='unchecked' where checklist_tid='$refused_task'";
        mysqli_query($db, $query);
    }
    
    echo "sucesso";
}

    /**********************************************
    *Método para aprovar projectos pelo chefe dpto*
    **********************************************/
    if(isset($_POST['approved_project'])){
        $project_id = $_POST['approved_project'];
        
        if($_SESSION['usuario_tipo'] == 'admin'){
            $query="update tb_projectos set projecto_aprovacao_ca='Aprovado' where projecto_id='$project_id'";
            mysqli_query($db, $query);
        }elseif($_SESSION['usuario_tipo'] == 'chefe'){
            $query="update tb_projectos set projecto_aprovacao_chefeDpto='Aprovado' where projecto_id='$project_id'";
            mysqli_query($db, $query);
        }
        
    }

    if(isset($_POST['approved_project_concluded'])){
        $project_id = $_POST['approved_project_concluded'];
        
        if($_SESSION['usuario_tipo'] == 'admin'){
            $query="update tb_projectos set projecto_percent=100, projecto_status='concluido' where projecto_id='$project_id'";
            mysqli_query($db, $query);
        }
        
    }

    if(isset($_POST['denied_project'])){
        $project_id = $_POST['denied_project'];
        
        if($_SESSION['usuario_tipo'] == 'admin'){
            $query="update tb_projectos set projecto_aprovacao_ca='Recusado', projecto_status='Suspenso' where projecto_id='$project_id'";
            mysqli_query($db, $query);
        }elseif($_SESSION['usuario_tipo'] == 'chefe'){
            $query="update tb_projectos set projecto_aprovacao_chefeDpto='Recusado', projecto_status='Suspenso' where projecto_id='$project_id'";
            mysqli_query($db, $query);
        }
        
    }

    /**********************************************
    *Método post para aprovar formações em análise*
    **********************************************/
    if(isset($_POST['approved_formation'])){
        $formation_id = $_POST['approved_formation'];
        
        if($_SESSION['usuario_tipo'] == 'admin'){
            $query = "update tb_formacoes set formacao_admin='Aprovada' where formacao_id='$formation_id'";
            mysqli_query($db, $query);
        }elseif( ($_SESSION['usuario_tipo'] == 'chefe') && ($_SESSION['usuario_dpto'] != 'DRHTI')){
            $query = "update tb_formacoes set formacao_chefdpto='Aprovada' where formacao_id='$formation_id'";
            mysqli_query($db, $query);
        }elseif( ($_SESSION['usuario_tipo'] == 'chefe') && ($_SESSION['usuario_dpto'] == 'DRHTI') ){
            $query ="select formacao_dpto from tb_formacoes where formacao_id='$formation_id'";
            $result = mysqli_query($db,$query);
            $row = mysqli_fetch_assoc($result);
            
            if($row['formacao_dpto'] == 'DRHTI'){
                $query = "update tb_formacoes set formacao_chefdpto='Aprovada' and formacao_rh='Aprovada' where formacao_id='$formation_id'";
                mysqli_query($db, $query);
            }else{
                $query = "update tb_formacoes set formacao_rh='Aprovada' where formacao_id='$formation_id'";
                mysqli_query($db, $query);
            }
            
        }
    }
    
    /**********************************************
    *Método post para recusar formações em análise*
    **********************************************/
    if(isset($_POST['dennied_formation'])){
        $formation_id = $_POST['dennied_formation'];
        if($_SESSION['usuario_tipo'] == 'admin'){
            $query = "update tb_formacoes set formacao_admin='Recusada' where formacao_id='$formation_id'";
            mysqli_query($db, $query);
        }elseif($_SESSION['usuario_tipo'] == 'chefe'){
            $query = "update tb_formacoes set formacao_chefdpto='Recusada' where formacao_id='$formation_id'";
            mysqli_query($db, $query);
        }
        
    }

    /***********************************
    *Método Post para checar se a tarefa
    *************************************/

/*******************************
*Método para actualizar notícia*
*******************************/
if(isset($_POST['noticia_id'])){
    $noticia_id = $_POST['noticia_id'];
    $noticia_tipo = $_POST['noticiaTipoEdit'];
    $noticia_manchete = $_POST['noticiaMancheteEdit'];
    $noticia_titulo = $_POST['noticiaTituloEdit'];
    $noticia_contexto = $_POST['noticiaContextEdit'];
    
    $noticia_imagem_nome = $_FILES['noticiaImageEdit']['name'];
    $noticia_imagem_tamanho = $_FILES['noticiaImageEdit']['size'];
    $noticia_imagem_tmp = $_FILES['noticiaImageEdit']['tmp_name'];
    $noticia_imagem_error = $_FILES['noticiaImageEdit']['error'];
    $noticia_imagem_tipo = $_FILES['noticiaImageEdit']['type'];
    
    if($noticia_imagem_nome ==''){
        
        if($noticia_manchete == 0){
            $query ="update tb_noticias set noticia_tipo='$noticia_tipo', noticia_titulo='$noticia_titulo', noticia_contexto='$noticia_contexto' where noticia_id='$noticia_id'";
            mysqli_query($db, $query);
        }elseif($noticia_manchete == 1){
            $query="select noticia_id from tb_noticias where noticia_manchete='1'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);

            $query="update tb_noticias set noticia_manchete='0' where noticia_id='".$row['noticia_id']."'";
            mysqli_query($db, $query);
            
            $query ="update tb_noticias set noticia_tipo='$noticia_tipo', noticia_manchete='1', noticia_titulo='$noticia_titulo', noticia_contexto='$noticia_contexto' where noticia_id='$noticia_id'";
            mysqli_query($db, $query);
        }
        
        
    }else{
        $query = "select noticia_imagem from tb_noticias where noticia_id='$noticia_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        
        $target = "../imagens/noticias/".basename($row['noticia_imagem']);
        unlink($target);
        
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
                        $query ="update tb_noticias set noticia_tipo='$noticia_tipo', noticia_titulo='$noticia_titulo', noticia_imagem='$noticia_imagem_nome', noticia_contexto='$noticia_contexto' where noticia_id='$noticia_id'";
                        mysqli_query($db, $query);
                        $msg = "Actualizacao de noticia com imagem com sucesso";
                    }elseif($noticia_manchete == 1){
                        $query="select noticia_id from tb_noticias where noticia_manchete=1";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_assoc($result);

                        $query="update tb_noticias set noticia_manchete='0' where noticia_id='".$row['noticia_id']."'";
                        mysqli_query($db, $query);

                        $query ="update tb_noticias set noticia_tipo='$noticia_tipo', noticia_manchete='1', noticia_titulo='$noticia_titulo', noticia_imagem='$noticia_imagem_nome', noticia_contexto='$noticia_contexto' where noticia_id='$noticia_id'";
                        mysqli_query($db, $query);
                        $msg = "Actualizacao de noticia com imagem com sucesso";
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
    }
    
    header("location: ../media/media_noticias");
}

/**********************************
*check se o usuário está on ou não*
**********************************/
if(isset($_POST['check_user'])){
    $query = "update tb_usuarios_activos set status = now() where uid = '".$_SESSION['usuario_id']."'";
}

/************************************************
*Actulizar mensagens não lidas se o remetente e *
*o receptor estiverem no mesmo chat             *
************************************************/
if(isset($_POST['mensagem_lida'])){
    $my_id = $_POST['my_id'];
    $other_id = $_POST['other_id'];
    
    $query = "update tb_chat set chat_lida='1' where chat_de='$other_id' and chat_para='$my_id' and chat_lida='0'";
    mysqli_query($db, $query);
}
?>