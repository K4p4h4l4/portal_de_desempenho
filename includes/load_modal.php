<?php 

    require("./conexao.php");
    require("projectosData.php");
    require("formacaoData.php");
    
    $query = '';
    $output = array();

    function buscar_detalhes($db, $usr_id){
        $query = "select * from tb_usuarios where usuario_id = '$usr_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        
        return $row;
    }
    
    function buscar_avaliacao($db, $av_id){
        $query = "select * from tb_av_usuarios where id='$av_id' limit 1";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        
        $output["id"] = $av_id;
        $output["usuario_id"] = $row["usuario_id"];
        $output["av_competencia_profissional"] = $row["av_competencia_profissional"];
        $output["av_dinamismo_iniciativa"] = $row["av_dinamismo_iniciativa"];
        $output["av_cumprimento_tarefa"] = $row["av_cumprimento_tarefa"];
        $output["av_rel_hum_trab"] = $row["av_rel_hum_trab"];
        $output["av_adpt_func"] = $row["av_adpt_func"];
        $output["av_disciplina"] = $row["av_disciplina"];
        $output["av_uso_correcto_equip"] = $row["av_uso_correcto_equip"];
        $output["av_apresentacao_compostura"] = $row["av_apresentacao_compostura"];
        $output["av_reuniao_mat"] = $row["av_reuniao_mat"];
        $output["av_reuniao_op"] = $row["av_reuniao_op"];
        $output["av_mes"] = $row["av_mes"];
        $output["av_ano"] = $row["av_ano"];
        
        $user_details = buscar_detalhes($db, $row["usuario_id"]);
        $output["usuario_nome"] = $user_details["usuario_nome"];
        $output["usuario_sobrenome"] = $user_details["usuario_sobrenome"];
        $output["usuario_login"] = $user_details["usuario_login"];
        $output["usuario_senha"] = $user_details["usuario_senha"];
        $output["usuario_email"] = $user_details["usuario_email"];
        $output["usuario_departamento"] = $user_details["usuario_departamento"];
        echo json_encode($output);
    }

    function buscar_usuario($db, $usr_id){
        $query = "select * from tb_usuarios where usuario_id='$usr_id' limit 1";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST["av_id"])){
        $av_id = $_POST["av_id"];
        
        buscar_avaliacao($db, $av_id);
        
    }

    if(isset($_POST["usr_id"])){
        
        $usr_id = $_POST["usr_id"];
        
        $user_details = buscar_detalhes($db, $usr_id);
        $output["usuario_nome"] = $user_details["usuario_nome"];
        $output["usuario_sobrenome"] = $user_details["usuario_sobrenome"];
        $output["usuario_login"] = $user_details["usuario_login"];
        $output["usuario_senha"] = $user_details["usuario_senha"];
        $output["usuario_email"] = $user_details["usuario_email"];
        $output["usuario_departamento"] = $user_details["usuario_departamento"];
        $output["usuario_contacto"] = $user_details["usuario_contacto"];
        $output["usuario_categoria"] = $user_details["categoria"];
        $output["usuario_tipo"] = $user_details["usuario_tipo"];
        $output["usuario_id"] = $user_details["usuario_id"];
        echo json_encode($output);
        
    }

    function ler_detalhes_visita($db, $ip_id){

        $query = "select * from tb_historico_visitantes where id='$ip_id'";
        $result = mysqli_query($db, $query);

        $row = mysqli_fetch_assoc($result);

        $visitante_id = $row['visitante_id'];
        $query2 = "select usr_ip from tb_ips_visitantes where id='$visitante_id'";
        $result2 = mysqli_query($db,$query2);
        $row2 = mysqli_fetch_assoc($result2);

        $output['usr_ip'] = $row2['usr_ip'];
        $output['usr_so'] = $row['usr_so'];
        $output['usr_navegador'] = $row['usr_navegador'];
        $output['usr_dispositivo'] = $row['usr_dispositivo'];
        $output['usr_pais'] = $row['usr_pais'];
        $output['usr_pais_codigo'] = $row['usr_pais_codigo'];
        $output['usr_regiao'] = $row['usr_regiao'];
        $output['usr_cidade'] = $row['usr_cidade'];
        $output['usr_latitude'] = $row['usr_latitude'];
        $output['usr_longitude'] = $row['usr_longitude'];
        $output['usr_timezone'] = $row['usr_timezone'];
        $output['usr_isp'] = $row['usr_isp'];
        $output['usr_org'] = $row['usr_org'];
        $output['usr_as'] = $row['usr_as'];
        $output['usr_data'] = $row['usr_data'];
        $output['usr_hora'] = $row['usr_hora'];
        $output['usr_page'] = $row['usr_page'];

        echo json_encode($output);
}

if(isset($_POST['ip_id'])){
    $ip_id = $_POST['ip_id'];

    ler_detalhes_visita($db, $ip_id);
}


/*************************************************
Carrega as informações necessárias para carregar
a modal de actualização das dicas de saúde
*************************************************/
if(isset($_POST['dica_id'])){
    $id = $_POST['dica_id'];
    $query = "select * from tb_dicas_saude where id ='$id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $output['dica_titulo'] = $row['dica_titulo'];
    $output['dica_mensagem'] = $row['dica_mensagem'];
    $output['dica_id'] = $row['id'];
    
    echo json_encode($output);
}

/***********************************
*Eliminar dica de saude            *
***********************************/
if(isset($_POST['del_dica_id'])){
    $id = $_POST['del_dica_id'];
    
    $output['del_dica_id'] = $id;
    
    echo json_encode($output);
}

/*************************************************
Carrega as informações necessárias para carregar
a modal de actualização das dicas de saúde
*************************************************/
if(isset($_POST['ideia_id'])){
    $id = $_POST['ideia_id'];
    $query = "select * from tb_ideias where ideia_id ='$id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $output['ideia_assunto'] = $row['ideia_assunto'];
    $output['ideia_descricao'] = $row['ideia_descricao'];
    $output['ideia_id'] = $row['ideia_id'];
    
    echo json_encode($output);
}

if(isset($_POST['del_ideia_id'])){
    $id = $_POST['del_ideia_id'];
    
    $output['del_ideia_id'] = $id;
    
    echo json_encode($output);
}

/**********************************************
Carregar a modal com as devidas infos da tarefa
**********************************************/
function checklist($db, $id){
    $output = '';
    $query = "select * from tb_checklist where checklist_tid='".$id."' ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<li>
                        '.$row['checklist_nome'].'
                    </li>';
    }
    
    return $output;
}

function members($db, $id){
    $output = '';
    $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome FROM tb_usuarios INNER JOIN tb_membrostpc WHERE tb_usuarios.usuario_id = tb_membrostpc.membroTPC_uid AND tb_membrostpc.membroTPC_tid = '".$id."' ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<li>
                        '.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'
                    </li> ';
    }
    
    return $output;
}


if(isset($_POST['work_id'])){
    $query = "select * from tb_tarefas where tarefa_id ='".$_POST['work_id']."'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $output['tarefa_nome'] = $row['tarefa_nome'];
    $output['tarefa_prioridade'] = $row['tarefa_prioridade'];
    $output['tarefa_inicio'] = $row['tarefa_inicio'];
    $output['tarefa_fim'] = $row['tarefa_fim'];
    $output['tarefa_status'] = $row['tarefa_status'];
    $output['tarefa_percent'] = $row['tarefa_percent'];
    $checklist = checklist($db,$_POST['work_id']);
    $members = members($db,$_POST['work_id']);
    $output['tarefa_checklist'] = $checklist;
    $output['tarefa_members'] = $members;
    
    echo json_encode($output);
}
function checklistUptd($db, $id){
    $output = '';
    $query = "select * from tb_checklist where checklist_tid='".$id."' ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<input type="text" class="task__checklistUpdt"  name="input_uptdChecklistAdd[]" id='.$row['checklist_id'].'  value="'.$row['checklist_nome'].'" required>
                    ';
    }
    
    return $output;
}

function fecthDpto($db, $id, $dpto){
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

function fetchMember($db, $tpc_id, $user_id, $user_dpto){
    $output = '';
    $query = "select * from tb_usuarios where usuario_departamento ='".$user_dpto."'";
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

/**********************************************
*Função para pegar os membros da tarefa as ser*
*actualizada                                  *
**********************************************/
function membersUptd($db, $id){
    $output = '';
    $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_departamento, tb_usuarios.usuario_id FROM tb_usuarios INNER JOIN tb_membrostpc WHERE tb_usuarios.usuario_id = tb_membrostpc.membroTPC_uid AND tb_membrostpc.membroTPC_tid = '".$id."' ";
    $result = mysqli_query($db, $query);
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $dpto = fecthDpto($db, $id, $row['usuario_departamento']);
        $users = fetchMember($db, $id, $row['usuario_id'], $row['usuario_departamento']);
        $output .= '<select name="worker_uptdDpto[]" class="selectUptd" data-dpto_id="'.$count.'" required>
                                        '.$dpto.'
                                    </select>
                                    
                                    <div id="workers__selector">
                                        <select name="worker_uptdId[]" class="selectdUptd" id="worker-idUptd'.$count.'" required >
                                            <option value="" >--- Selecione o Colaborador ---</option>
                                            '.$users.'
                                        </select>
                                    </div>
                                    <div class="checklist__buttons2"><button class="checklist__remove" id="removeWorker"><i class="material-icons">remove</i></button></div>
                    ';
    }
    
    return $output;
}

/***********************************
*Post para carregar a tarefa       *
***********************************/
if(isset($_POST['load_tpc'])){
    $query = "select * from tb_tarefas where tarefa_id ='".$_POST['load_tpc']."'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $output['tarefa_nome'] = $row['tarefa_nome'];
    $output['tarefa_prioridade'] = $row['tarefa_prioridade'];
    $output['tarefa_inicio'] = date('Y-m-d',strtotime($row['tarefa_inicio']));
    $output['tarefa_fim'] = date('Y-m-d',strtotime($row['tarefa_fim']));
    $checklist = checklistUptd($db,$_POST['load_tpc']);
    $members = membersUptd($db,$_POST['load_tpc']);
    $output['tarefa_checklist'] = $checklist;
    $output['tarefa_members'] = $members;
    $output['tarefa_id'] = $row['tarefa_id'];
    
    echo json_encode($output);
}

/**************************************
*Método Post para preencher a modal de* 
*visualizar o projecto                *
**************************************/
if(isset($_POST['projecto_id'])){
    
    $projecto = new ProjectoInfo;
    
    $p = $projecto->get_project_data($db, $_POST['projecto_id']);
    $riscos = $projecto->get_project_risks($db, $_POST['projecto_id']);
    $membros = $projecto->get_project_members($db, $_POST['projecto_id']);
    $fases = $projecto->get_projecto_fases($db, $_POST['projecto_id']);
    $fases_table = $projecto->get_projecto_fases_table($db, $_POST['projecto_id']);
    
    $output['projecto_nome'] = $p['projecto_nome'];
    $output['projecto_imagem'] = '<img src="../imagens/projectos/'.$p['projecto_imagem'].'" class="project__img" alt="Imagem do Projecto">';
    $output['projecto_contexto'] = $p['projecto_contexto'];
    $output['projecto_missao'] = $p['projecto_missao'];
    $output['projecto_objectivo'] = $p['projecto_objectivo'];
    $output['projecto_metodologia'] = $p['projecto_metodologia'];
    $output['projecto_entregaveis'] = $p['projecto_entregaveis'];
    $output['projecto_riscos'] = $riscos;
    $output['projecto_membros'] = $membros;
    $output['projecto_fases'] = $fases;
    $output['projecto_fases_table'] = $fases_table;
    
    echo json_encode($output); 
}

/**************************************
*Método Post para preencher a modal de* 
*Actualizar o projecto                *
**************************************/
if(isset($_POST['projectoUpdt_id'])){
    
    $projecto = new ProjectoInfo;
    
    $p = $projecto->get_project_data($db, $_POST['projectoUpdt_id']);
    $riscos = $projecto->get_project_risks_inputTag($db, $_POST['projectoUpdt_id']);
    $membros = $projecto->get_project_members_inputTag($db, $_POST['projectoUpdt_id']);
    $fases = $projecto->get_project_fases_inputTag($db, $_POST['projectoUpdt_id']);
    $fases_table = $projecto->get_projecto_fases_table($db, $_POST['projectoUpdt_id']);
    $responsaveis = $projecto->get_project_responsaveis($db, $_POST['projectoUpdt_id']);
    
    $output['projecto_nome'] = $p['projecto_nome'];
    $output['projecto_imagem'] = '<img src="../imagens/projectos/'.$p['projecto_imagem'].'" class="project__img" alt="Imagem do Projecto">';
    $output['projecto_contexto'] = $p['projecto_contexto'];
    $output['projecto_missao'] = $p['projecto_missao'];
    $output['projecto_objectivo'] = $p['projecto_objectivo'];
    $output['projecto_metodologia'] = $p['projecto_metodologia'];
    $output['projecto_entregaveis'] = $p['projecto_entregaveis'];
    $output['projecto_riscos'] = $riscos;
    $output['projecto_membros'] = $membros;
    $output['projecto_responsaveis'] = $responsaveis;
    $output['projecto_fases'] = $fases;
    $output['projecto_fases_table'] = $fases_table;
    $output['projecto_id'] = $_POST['projectoUpdt_id'];
    
    echo json_encode($output); 
}

/****************************************
*Post para carreagar a modal de ver for-*
*mações                                 *
****************************************/
if(isset($_POST['formacao_id'])){
    $formacao_id = $_POST['formacao_id'];
    
    $formacao_detais = new FormacaoInfo;
    
    $formacao = $formacao_detais->get_formation_details($db, $formacao_id);  
    $membros = $formacao_detais->get_formation_members($db, $formacao_id);
    
    $output['formacao_id'] = $formacao[0]['formacao_id'];
    $output['formacao_nome'] = $formacao[0]['formacao_nome'];
    $output['formacao_entidade'] = $formacao[0]['formacao_entidade'];
    $output['formacao_local'] = $formacao[0]['formacao_local'];
    $output['formacao_custo'] = $formacao[0]['formacao_custo'];
    $output['formacao_tipo'] = $formacao[0]['formacao_tipo'];
    $output['formacao_grupos'] = $formacao[0]['formacao_grupos'];
    $output['formacao_nmembros'] = $formacao[0]['formacao_nmembros'];
    $output['formacao_membros'] = $membros;
    $output['formacao_inicio'] = $formacao[0]['formacao_inicio'];
    $output['formacao_inicio_especial'] = $formacao[0]['formacao_inicio_especial'];
    $output['formacao_duracao'] = $formacao[0]['formacao_duracao'];
    $output['formacao_fim'] = $formacao[0]['formacao_fim'];
    $output['formacao_hinicio'] = $formacao[0]['formacao_hinicio'];
    $output['formacao_hfim'] = $formacao[0]['formacao_hfim'];
    $output['formacao_dpto'] = $formacao[0]['formacao_dpto'];
    $output['formacao_uid'] = $formacao[0]['formacao_uid'];
    $output['formacao_chefdpto'] = $formacao[0]['formacao_chefdpto'];
    $output['formacao_admin'] = $formacao[0]['formacao_admin'];
    $output['formacao_rh'] = $formacao[0]['formacao_rh'];
    $output['formacao_exame'] = $formacao[0]['formacao_exame'];
    $output['formacao_exame_data'] = $formacao[0]['formacao_exame_data'];
    
    echo json_encode($output);       
}

/***************************************************
*Script para carregar a modal de edição de notícias*
***************************************************/
if(isset($_POST['noticia_id'])){
    $noticia_id = $_POST['noticia_id'];
    $query="select noticia_id, noticia_titulo, noticia_contexto, noticia_tipo from tb_noticias where noticia_id='$noticia_id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    $output['noticia_id'] = $row['noticia_id'];
    $output['noticia_titulo'] = $row['noticia_titulo'];
    $output['noticia_contexto'] = $row['noticia_contexto'];
    $output['noticia_tipo'] = $row['noticia_tipo'];
    
    echo json_encode($output);
}

/***************************************
*Método post para visualizar a notícia *
***************************************/
if(isset($_POST['noticia_view'])){
    $noticia_id = $_POST['noticia_view'];
    $query="select noticia_id, noticia_imagem, noticia_titulo, noticia_data, noticia_contexto, noticia_acessos from tb_noticias where noticia_id='$noticia_id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $noticia_acessos = $row['noticia_acessos'];
    
    $output['noticia_id'] = $row['noticia_id'];
    $output['noticia_imagem'] = $row['noticia_imagem'];
    $output['noticia_titulo'] = $row['noticia_titulo'];
    $output['noticia_data'] = $row['noticia_data'];
    $output['noticia_contexto'] = $row['noticia_contexto'];
    
    if( ($_SESSION['usuario_dpto'] != 'MEDIA') && ($_SESSION['usuario_dpto'] != 'ADMIN') ){
        $noticia_acessos+=1;
        $query="update tb_noticias set noticia_acessos='$noticia_acessos' where noticia_id='$noticia_id'";
        mysqli_query($db, $query);
    }
    
    echo json_encode($output);
}

?>