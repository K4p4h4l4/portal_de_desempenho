<?php

require_once("conexao.php");
require("usuarioData.php");
require("projectosData.php");
require("formacaoData.php");
require("tarefasData.php");
require("cryptor.php");

function inserir_usuarios($db){
    $output = '';
    $query = "select * from tb_usuarios";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        
        $usr_nome = $row['usuario_nome'];
        $usr_sobrenome = $row['usuario_sobrenome'];
        $usr_login = $row['usuario_login'];
        $usr_email = $row['usuario_email'];
        $usr_contacto = $row['usuario_contacto'];
        $usr_senha = $row['usuario_senha'];
        $usr_tipo = $row['usuario_tipo'];
        $usr_departamento = $row['usuario_departamento'];
        $usr_categoria = $row['categoria'];
        $usuario_media_geral = $row['usuario_media_geral'];
        $usr_id = $row['usuario_id'];
        
        $output.= "<tr>
                       <td><span>{$usr_nome} {$usr_sobrenome}</span></td>
                       <td>{$usr_email}</td>
                       <td>{$usr_contacto}</td>
                       <td>{$usr_departamento}</td>
                       <td>{$usr_categoria}</td>
                       <td>{$usuario_media_geral}</td>
                       <td><button class='btn btn-edit-user' id='{$usr_id}'><i class='fa fa-edit'></i></button> <button class='btn btn-delete-user' id='{$usr_id}'><i class='fa fa-trash'></i></button></td>
                   </tr>";
    }
    
    echo $output;
}

function inserir_avaliacao($db){
    $output = '';
    $query = "select * from tb_av_usuarios limit 200";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $usr_id = $row['usuario_id'];
        $av_id = $row['id'];
        $cmpt_prof = $row['av_competencia_profissional'];
        $inic = $row['av_dinamismo_iniciativa'];
        $tpc = $row['av_cumprimento_tarefa'];
        $trab = $row['av_rel_hum_trab'];
        $func = $row['av_adpt_func'];
        $disc = $row['av_disciplina'];
        $equip = $row['av_uso_correcto_equip'];
        $apr_cmpst = $row['av_apresentacao_compostura'];
        $rmat = $row['av_reuniao_mat'];
        $ro = $row['av_reuniao_op'];
        $mes = $row['av_mes'];
        $ano = $row['av_ano'];
        $query2 = "select * from tb_usuarios where usuario_id='$usr_id'";
        $result2 = mysqli_query($db, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $usr_nome = $row2['usuario_nome'];
        $usr_sobrenome = $row2['usuario_sobrenome'];
        
        $output.= "<tr>
                       <td><span>{$usr_nome} {$usr_sobrenome}</span></td>
                       <td>{$cmpt_prof}</td>
                       <td>{$inic}</td>
                       <td>{$tpc}</td>
                       <td>{$trab}</td>
                       <td>{$func}</td>
                       <td>{$disc}</td>
                       <td>{$equip}</td>
                       <td>{$apr_cmpst}</td>
                       <td>{$rmat}</td>
                       <td>{$ro}</td>
                       <td>{$mes}</td>
                       <td>{$ano}</td>
                       <td><button class='btn btn-edit' id='{$av_id}'><i class='fa fa-edit'></i></button> <button class='btn btn-delete' id='{$av_id}'><i class='fa fa-trash'></i></button></td>
                   </tr>";
    }
    
    echo $output;
}

function ler_ip_visitantes($db){
    $output = '';
    $query = "select * from tb_ips_visitantes limit 10";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $visitante_id = $row['id'];
        $visitante_ip = $row['usr_ip'];
        
        $query = "SELECT * FROM tb_historico_visitantes WHERE visitante_id='$visitante_id' ORDER BY id desc LIMIT 1";
        
        $result2 = mysqli_query($db, $query);
        $row2 = mysqli_fetch_assoc($result2);
        $data = $row2['usr_data'];
            
        $output .="<tr>
                       <td>
                           <span>{$visitante_ip}</span>
                        </td>
                       <td>
                           {$data}
                        </td>
                   </tr>";
    }
    
    echo $output;
}

function ler_paginas_views($db){
    $output = '';
    $query = "select usr_page, COUNT(*) from tb_historico_visitantes group by usr_page order by COUNT(*) desc limit 7";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $page_name = $row['usr_page'];
        $page_views = $row['COUNT(*)'];
        $new_page_name = substr($page_name,0,45)."...";
        $output .= "<tr>
                       <td>
                           <span>{$new_page_name}</span>
                        </td>
                       <td>
                           {$page_views}
                        </td>
                   </tr>";
    }
    
    echo $output;
}

function ler_computer($db){
    $query = "select usr_dispositivo, COUNT(DISTINCT visitante_id) from tb_historico_visitantes";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $total = $row['COUNT(DISTINCT visitante_id)'];
    
    $query = "select usr_dispositivo, COUNT(DISTINCT visitante_id) from tb_historico_visitantes where usr_dispositivo = 'Computer'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $computer_total = $row['COUNT(DISTINCT visitante_id)'];
    
    return (round(($computer_total/$total)*100));
}


function ler_tablet($db){
    $query = "select usr_dispositivo, COUNT(DISTINCT visitante_id) from tb_historico_visitantes";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $total = $row['COUNT(DISTINCT visitante_id)'];
    
    $query = "select usr_dispositivo, COUNT(DISTINCT visitante_id) from tb_historico_visitantes where usr_dispositivo = 'Tablet'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $tablet_total = $row['COUNT(DISTINCT visitante_id)'];
    
    return (round(($tablet_total/$total)*100));
}

function ler_mobile($db){
    $query = "select usr_dispositivo, COUNT(DISTINCT visitante_id) from tb_historico_visitantes";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $total = $row['COUNT(DISTINCT visitante_id)'];
    
    $query = "select usr_dispositivo, COUNT(DISTINCT visitante_id) from tb_historico_visitantes where usr_dispositivo = 'Mobile'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $mobile_total = $row['COUNT(DISTINCT visitante_id)'];
    
    return (round(($mobile_total/$total)*100));
}

function ler_active_sessions($db){
    $query = "select state, COUNT(*) as active from tb_usuarios_activos where state = 'on' ";
    
    $result = mysqli_query($db, $query);
    
    $row = mysqli_fetch_assoc($result);
    
    return $row['active'];
}

if(isset($_POST['n_sessions'])){
    $r = ler_active_sessions($db);
    echo json_encode($r);
}

function ler_historico_visitantes($db){
    $output = '';
    $query = "select * from tb_historico_visitantes order by id desc limit 200";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $visitante_id = $row['visitante_id'];
        $query2 = "select usr_ip from tb_ips_visitantes where id='$visitante_id'";
        $result2 = mysqli_query($db,$query2);
        $row2 = mysqli_fetch_assoc($result2);
        
        $output .= "<tr>
                        <td>".$row2['usr_ip']."</td>
                        <td>".$row['usr_dispositivo']."</td>
                        <td>".$row['usr_so']."</td>
                        <td>".$row['usr_navegador']."</td>
                        <td>".$row['usr_page']."</td>
                        <td>".$row['usr_data']."</td>
                        <td>".$row['usr_hora']."</td>
                        <td><button class='btn btn-view' id='".$row['id']."'><i class='fa fa-eye'></i></button></td>
                    </tr>";
    }
    
    echo $output;
}

function inserir_dicas_saude($db){
    $output = '';
    $query = "select * from tb_dicas_saude";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<tr>
                        <td><img src='../imagens/saude/".$row['dica_imagem']."' alt='imagem de saude'></td>
                        <td>".$row['dica_titulo']."</td>
                        <td>".$row['dica_mensagem']."</td>
                        <td>".$row['dica_data']."</td>
                        <td><button class='btn btn-view' id='".$row['id']."'><i class='fa fa-eye'></i></button><button class='btn btn-delete' id='".$row['id']."'><i class='fa fa-trash'></i></button></td>
                    </tr>";
    }
    
    echo $output;
}

function read_dicas_saude_media($db){
    $output = '';
    $query = "select * from tb_dicas_saude";
    $result = mysqli_query($db, $query);
    $count = 1;
    $usuario = new UsuarioDados;
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['dica_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['dica_uid']);
        $output .= '<tr valign="top">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Imagem"><img src="../imagens/saude/'.$row['dica_imagem'].'" alt="imagem de saude"></td>
                        <td data-label="Título">'.$row['dica_titulo'].'</td>
                        <td data-label="Mensagem">'.$row['dica_mensagem'].'</td>
                        <td data-label="Data">'.$row['dica_data'].'</td>
                        <td data-label="Por">'.$nome.' '.$sobrenome.'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view" id="'.$row['id'].'"><i class="material-icons">edit</i></button><button class="btn-normal btn-darkBlue btn-delete" id="'.$row['id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
        $count++;
    }
    
    echo $output;
}


function read_dicas_saude($db){
    $output = '';
    $query = "select * from tb_dicas_saude order by dica_data desc limit 4";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<div class='saude'>
                            <div class='saude--imagem'>
                                <img src='../imagens/teste/".$row['dica_imagem']."' alt='imagem de saude'>
                            </div>
                            <div class='saude--box'>
                                <span>".$row['dica_titulo']."</span>
                                <p>".$row['dica_mensagem']."</p>
                            </div>
                        </div>";
    }
    
    echo $output;
}

function read_corrida_data($db){
    $query = "select * from tb_corridas where corrida_uid = '".$_SESSION['usuario_id']."' order by corrida_id desc limit 1";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row;
}

function read_exercicio_data($db){
    $query = "select * from tb_exercicios where exercicio_uid = '".$_SESSION['usuario_id']."' order by exercicio_id desc limit 1";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row;
}

function read_desporto_data($db){
    $query = "select * from tb_desportos where desporto_uid = '".$_SESSION['usuario_id']."' order by desporto_id desc limit 1";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row;
}

function read_ciclismo_data($db){
    $query = "select * from tb_ciclismo where ciclismo_uid = '".$_SESSION['usuario_id']."' order by ciclismo_id desc limit 1";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row;
}


function read_minhas_ideias($db){
    $output = '';
    $query = "select * from tb_ideias where ideia_uid = '".$_SESSION['usuario_id']."' order by ideia_id desc";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $ideia_descricao = $row['ideia_descricao'];
        $ideia_descricao = substr($ideia_descricao,0,100)." ...";
        $output .= "<tr valign='top'>
                        <td data-label='Assunto'>".$row['ideia_assunto']."</td>
                        <td data-label='Ideia'>".$ideia_descricao."</td>
                        <td data-label='Data'>".$row['ideia_data']."</td>
                        <td data-label='Status'>".$row['ideia_status']."</td>
                        <td data-label='Settings' class='settings'><button class='btn-normal btn-darkBlue btn-edit-ideia' id='".$row['ideia_id']."'><i class='material-icons'>create</i></button><button class='btn-normal btn-darkBlue btn-delete-ideia' id='".$row['ideia_id']."'><i class='material-icons'>delete</i></button></td>
                    </tr>"; 
        
    }
    
    echo $output;
}

if(isset($_POST['worker_dptoID'])){
    $output = array();
    $dpto = $_POST['worker_dptoID'];
    
    $query = "select * from tb_usuarios where usuario_departamento ='$dpto'";
    
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "avaliacao_de_desempenho";
    
    $conn = new PDO("mysql:host=$server;dbname=$dbname;","$username","$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetchAll();
    
    foreach($row as $user){
        $output[] = array(
            "usuario_id" => $user['usuario_id'],
            "usuario_nome" => $user['usuario_nome'],
            "usuario_sobrenome" => $user['usuario_sobrenome']
        );
    }
    
    echo json_encode($output);
    
}

function read_tarefas($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='".$_SESSION['usuario_dpto']."' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_chedDpto($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='".$_SESSION['usuario_dpto']."' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_deeti($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DEETI' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_daca($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DACA' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_dafsg($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DAFSG' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_drhti($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DRHTI' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_dfm($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DFM' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_dfmcr($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DFMCR' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_deger($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DEGER' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_dec($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DEC' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/***********************************************************
*Listar as tarefas do chefe de depertamento que fez o login*
***********************************************************/
function read_tarefas_drmsu($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DRMSU' and tarefa_status!='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_chedDpto_revisao($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='".$_SESSION['usuario_dpto']."' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-verified-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-clear-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_deeti($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DEETI' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_daca($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DACA' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_dafsg($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DAFSG' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_drhti($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DRHTI' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_dfm($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DFM' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_deger($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DEGER' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_dec($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DEC' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_drmsu($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DRMSU' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************
*Função para ver apenas as tarefas em revisão*
*********************************************/
function read_tarefas_revisao_dfmcr($db){
    $output = '';
    $query = "select * from tb_tarefas where tarefa_dpto='DFMCR' and tarefa_status='Em revisao' order by tarefa_id desc limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}


//Para contar as tarefas por iniciar de um determinado colaborador
function tasksInAnalisys_counterUser($db, $id){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='$id' AND tb_tarefas.tarefa_status='Em analise'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

//Para contar as tarefas em curso de um determinado colaborador
function tasksInProgress_counterUser($db,$id){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='$id' AND tb_tarefas.tarefa_status='Em curso'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

//Para contar as tarefas em revisao de um determinado colaborador
function tasksInRevision_counterUser($db, $id){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='$id' AND tb_tarefas.tarefa_status='Em revisao'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

//Para contar as tarefas concluídas de um determinado colaborador
function tasksConcluded_counterUser($db, $id){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='$id' AND tb_tarefas.tarefa_status='Concluida'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

//Para contar o total de tarefas que um colaborador possui
function tasksTotal_counterUser($db, $id){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='$id' ";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

//Contar o total de tarefas com prioridade baixa de um usuário
function tasksLowPriority_counterUser($db, $id){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='$id' AND tb_tarefas.tarefa_prioridade='Baixa'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

//Contar o total de tarefas com prioridade baixa de um usuário
function tasksMediumPriority_counterUser($db, $id){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='$id' AND tb_tarefas.tarefa_prioridade='Media'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

//Contar o total de tarefas com prioridade baixa de um usuário
function tasksHightPriority_counterUser($db, $id){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='$id' AND tb_tarefas.tarefa_prioridade='Alta'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='".$_SESSION['usuario_dpto']."' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_daca($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DACA' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_deeti($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DEETI' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_drhti($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DRHTI' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_dafsg($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DAFSG' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_deger($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DEGER' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_dfm($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DFM' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_dfmcr($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DFMCR' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_drmsu($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DRMSU' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/************************************************
*Função para ler tarefas por cada colaborador de* 
*um determinado departamento                    *
************************************************/
function read_tarefas_per_user_dec($db){
    $output = '';
    $query = "select usuario_id, usuario_nome, usuario_sobrenome from tb_usuarios where usuario_departamento ='DEC' and usuario_tipo='tecnico' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $tarefas_porIniciar = tasksInAnalisys_counterUser($db, $row['usuario_id']);
        $tarefas_emProgresso = tasksInProgress_counterUser($db,$row['usuario_id']);
        $tarefas_emRevisao = tasksInRevision_counterUser($db, $row['usuario_id']);
        $tarefas_concluidas = tasksConcluded_counterUser($db, $row['usuario_id']);
        $tarefaPrioBaixa = tasksLowPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioMedia = tasksMediumPriority_counterUser($db, $row['usuario_id']);
        $tarefaPrioAlta = tasksHightPriority_counterUser($db, $row['usuario_id']);
        $tarefas_total = tasksTotal_counterUser($db, $row['usuario_id']);
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prio. Alta">0'.$tarefaPrioAlta.'</td>
                        <td data-label="Prio. Média">0'.$tarefaPrioMedia.'</td>
                        <td data-label="Prio. Baixa">0'.$tarefaPrioBaixa.'</td>
                        <td data-label="Por iniciar">0'.$tarefas_porIniciar.'</td>
                        <td data-label="Em progresso">0'.$tarefas_emProgresso.'</td>
                        <td data-label="Em revisão">0'.$tarefas_emRevisao.'</td>
                        <td data-label="Concluídas">0'.$tarefas_concluidas.'</td>
                        <td data-label="Total">0'.$tarefas_total.'</td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = '".$_SESSION['usuario_dpto']."' limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_deeti($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DEETI' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_daca($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DACA' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_drhti($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DRHTI' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_dafsg($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DAFSG' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_dfm($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DFM' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_dfmcr($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DFMCR' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}


/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_deger($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DEGER' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_dec($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DEC' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*********************************************************
*Listar todas as tarefas com os respectivos participantes*
*para realização da tarefa                               *
*********************************************************/
function read_allUser_tasks_drmsu($db){
    $output ='';    
    
    $query="SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent, tb_tarefas.tarefa_status FROM tb_membrostpc INNER JOIN tb_tarefas INNER JOIN tb_usuarios WHERE tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid=tb_usuarios.usuario_id AND tb_tarefas.tarefa_dpto = 'DRMSU' ORDER BY tb_tarefas.tarefa_id DESC limit 100";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr valign="top">
                        <td data-label="Tarefa">'.$row['tarefa_nome'].'</td>
                        <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Prioridade">'.$row['tarefa_prioridade'].'</td>
                        <td data-label="Início">'.$row['tarefa_inicio'].'</td>
                        <td data-label="Fim">'.$row['tarefa_fim'].'</td>
                        <td data-label="Status">'.$row['tarefa_status'].'</td>
                        <td data-label="(%)">'.$row['tarefa_percent'].' %</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-tarefa" id="'.$row['tarefa_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}




/**********************************************
*Selecionar a checklist de uma tarefa
**********************************************/
function checklist($db, $id){
    $output = '';
    $query = "select * from tb_checklist where checklist_tid='".$id."' ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<li class="checkilist__details">
                        <input type="checkbox" id="task-'.$row['checklist_id'].'" value="'.$row['checklist_id'].'" '.$row['checklist_check'].'>
                        <label class="toDo" for="task-'.$row['checklist_id'].'" id="'.$row['checklist_id'].'">
                            <span class="custom-checkbox"></span>
                            <p>'.$row['checklist_nome'].'</p>
                        </label>
                    </li>';
    }
    
    return $output;
}

function checklist_doneTask($db, $id){
     $query = "select count(*) from tb_checklist where checklist_tid='$id' and checklist_status='Feito'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['count(*)'];
}

function checklist_total($db, $id){
    $query = "select count(*) from tb_checklist where checklist_tid='$id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['count(*)'];
}

function fetchUser_data($db,$id){
    $query = "select * from tb_usuarios where usuario_id='$id'";
    $result = mysqli_query($db,$query);
    
    $row = mysqli_fetch_assoc($result);
    
    return $row;
}

//Função para selecionar os participantes de uma determinada tarefa
function members($db, $id){
    $output = '';
    $query = "select * from tb_membrostpc where membroTPC_tid='".$id."' ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $user = fetchUser_data($db,$row['membroTPC_uid']);
        $output .= '<div class="members__card"><div class="member__img">
                        <img src="../imagens/perfil/'.$user['usuario_foto'].'" alt="Foto de colaborador">
                    </div><p>'.$user['usuario_nome'].'</p><p>'.$user['usuario_sobrenome'].'</p></div> ';
    }
    
    return $output;
}

function tasksInAnalisys_counter($db){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."' AND tb_tarefas.tarefa_status='Em analise'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

function read_tasksInAnalisys($db){
    $output = '';
    $query = "SELECT tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."' AND tb_tarefas.tarefa_status='Em analise' order by tb_tarefas.tarefa_id desc";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $checklist = checklist($db,$row['tarefa_id']);
        $members = members($db,$row['tarefa_id']);
        $checklistTotal = checklist_total($db, $row['tarefa_id']);
        $checklist_doneTask=checklist_doneTask($db, $row['tarefa_id']);
        if($_SESSION['usuario_tipo']=='admin'){
            $output.='<div class="task">
                        <button class="accordion">
                            <div class="task__top">
                                <div class="task__priority">
                                    <span>'.$row['tarefa_prioridade'].'</span>
                                </div>
                                <div class="task__dots"><i class="material-icons">more_horiz</i></div>
                                <div class="task__action">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                            </div>
                            <div class="task__head">
                                <div class="task__name">
                                    <span>'.$row['tarefa_nome'].'</span>
                                </div>
                                <div class="task__time">
                                    <p>'.$row['tarefa_inicio'].'</p>
                                </div>
                            </div>
                        </button>
                        <div class="task__body">
                            <div class="task__progress">
                                <span class="myState"></span><span class="myGoal"></span>
                                <div class="progress--bar">
                                    <div class="current--progress" style="width:'.$row['tarefa_percent'].'%"></div>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>CHECKLIST</span>
                                <ul class="checklist__list">
                                    '.$checklist.'
                                </ul>
                            </div>
                            <div class="task__checklist">
                                <span>DEADLINE</span>
                                <div class="task__time">
                                    <p>'.$row['tarefa_fim'].'</p>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>MEMBROS</span>
                                <div class="members">
                                    '.$members.'
                                </div>
                                <div class="add_members">
                                    <button class="add__member"><i class="material-icons">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="task__footer">
                            <div class="task__done">
                                <p>'.$checklist_doneTask.'/'.$checklistTotal.'</p>
                            </div>
                            <div class="task__attachment">
                                <button class="attach edit__task" id='.$row['tarefa_id'].'><i class="material-icons">edit</i></button>
                                <button class="attach btn-delete-tarefa" id='.$row['tarefa_id'].'><i class="material-icons">delete</i></button>
                            </div>
                            
                        </div>
                    </div>';
        }else{
            $output.='<div class="task">
                        <button class="accordion">
                            <div class="task__top">
                                <div class="task__priority">
                                    <span>'.$row['tarefa_prioridade'].'</span>
                                </div>
                                <div class="task__dots"><i class="material-icons">more_horiz</i></div>
                                <div class="task__action">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                            </div>
                            <div class="task__head">
                                <div class="task__name">
                                    <span>'.$row['tarefa_nome'].'</span>
                                </div>
                                <div class="task__time">
                                    <p>'.$row['tarefa_inicio'].'</p>
                                </div>
                            </div>
                        </button>
                        <div class="task__body">
                            <div class="task__progress">
                                <span class="myState"></span><span class="myGoal"></span>
                                <div class="progress--bar">
                                    <div class="current--progress" style="width:'.$row['tarefa_percent'].'%"></div>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>CHECKLIST</span>
                                <ul class="checklist__list">
                                    '.$checklist.'
                                </ul>
                            </div>
                            <div class="task__checklist">
                                <span>DEADLINE</span>
                                <div class="task__time">
                                    <p>'.$row['tarefa_fim'].'</p>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>MEMBROS</span>
                                <div class="members">
                                    '.$members.'
                                </div>
                                <div class="add_members">
                                    <button class="add__member"><i class="material-icons">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="task__footer">
                            <div class="task__done">
                                <p>'.$checklist_doneTask.'/'.$checklistTotal.'</p>
                            </div>
                            <div class="task__attachment">
                                <button class="attach edit__task" id='.$row['tarefa_id'].'><i class="material-icons">edit</i></button>
                                <button class="attach btn-delete-tarefa" id='.$row['tarefa_id'].'><i class="material-icons">delete</i></button>
                            </div>
                            
                        </div>
                    </div>';
        }
        
    }
    
    /*<div class="task__attachment">
                                <button class="attach del__task"><i class="material-icons">delete</i></button>
                            </div>*/
    
    echo $output;
}

function tasksInProgress_counter($db){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."' AND tb_tarefas.tarefa_status='Em curso'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

/*************************************************************
*Função para listar as tarefas em progresso de um colaborador*
*************************************************************/
function read_tasksInProgress($db){
    $output = '';    
    $query = "SELECT tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."' AND tb_tarefas.tarefa_status='Em curso' order by tb_tarefas.tarefa_id desc";
    
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){

        $checklist = checklist($db,$row['tarefa_id']);
        $members = members($db,$row['tarefa_id']);
        $checklistTotal = checklist_total($db, $row['tarefa_id']);
        $checklist_doneTask=checklist_doneTask($db, $row['tarefa_id']);
        if($_SESSION['usuario_tipo']=='admin'){
            $output.='<div class="task">
                        <button class="accordion">
                            <div class="task__top">
                                <div class="task__priority">
                                    <span>'.$row['tarefa_prioridade'].'</span>
                                </div>
                                <div class="task__dots"><i class="material-icons">more_horiz</i></div>
                                <div class="task__action">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                            </div>
                            <div class="task__head">
                                <div class="task__name">
                                    <span>'.$row['tarefa_nome'].'</span>
                                </div>
                                <div class="task__time">
                                    <p>'.$row['tarefa_inicio'].'</p>
                                </div>
                            </div>
                        </button>
                        <div class="task__body">
                            <div class="task__progress">
                                <span class="myState"></span><span class="myGoal"></span>
                                <div class="progress--bar">
                                    <div class="current--progress" style="width:'.$row['tarefa_percent'].'%"></div>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>CHECKLIST</span>
                                <ul class="checklist__list">
                                    '.$checklist.'
                                </ul>
                            </div>
                            <div class="task__checklist">
                                <span>DEADLINE</span>
                                <div class="task__time">
                                    <p>'.$row['tarefa_fim'].'</p>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>MEMBROS</span>
                                <div class="members">
                                    '.$members.'
                                </div>
                                <div class="add_members">
                                    <button class="add__member"><i class="material-icons">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="task__footer">
                            <div class="task__done">
                                <p>'.$checklist_doneTask.'/'.$checklistTotal.'</p>
                            </div>
                            <div class="task__attachment">
                                <button class="attach edit__task" id='.$row['tarefa_id'].'><i class="material-icons">edit</i></button>
                                <button class="attach btn-delete-tarefa" id='.$row['tarefa_id'].'><i class="material-icons">delete</i></button>
                            </div>
                            
                        </div>
                    </div>';
        }else{
            $output.='<div class="task">
                        <button class="accordion">
                            <div class="task__top">
                                <div class="task__priority">
                                    <span>'.$row['tarefa_prioridade'].'</span>
                                </div>
                                <div class="task__dots"><i class="material-icons">more_horiz</i></div>
                                <div class="task__action">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                            </div>
                            <div class="task__head">
                                <div class="task__name">
                                    <span>'.$row['tarefa_nome'].'</span>
                                </div>
                                <div class="task__time">
                                    <p>'.$row['tarefa_inicio'].'</p>
                                </div>
                            </div>
                        </button>
                        <div class="task__body">
                            <div class="task__progress">
                                <span class="myState"></span><span class="myGoal"></span>
                                <div class="progress--bar">
                                    <div class="current--progress" style="width:'.$row['tarefa_percent'].'%"></div>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>CHECKLIST</span>
                                <ul class="checklist__list">
                                    '.$checklist.'
                                </ul>
                            </div>
                            <div class="task__checklist">
                                <span>DEADLINE</span>
                                <div class="task__time">
                                    <p>'.$row['tarefa_fim'].'</p>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>MEMBROS</span>
                                <div class="members">
                                    '.$members.'
                                </div>
                                <div class="add_members">
                                    <button class="add__member"><i class="material-icons">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="task__footer">
                            <div class="task__done">
                                <p>'.$checklist_doneTask.'/'.$checklistTotal.'</p>
                            </div>
                            <div class="task__attachment">
                                <button class="attach edit__task" id='.$row['tarefa_id'].'><i class="material-icons">edit</i></button>
                                <button class="attach btn-delete-tarefa" id='.$row['tarefa_id'].'><i class="material-icons">delete</i></button>
                            </div>
                            
                        </div>
                    </div>';
        }
        
        
    }
    
    /*<div class="task__attachment">
                                <button class="attach del__task" id='.$row['tarefa_id'].'><i class="material-icons">delete</i></button>
                            </div>*/
    
    echo $output;
}

/********************************************************************
*Função para contar o número de tarefas em revisão de um colaborador*
********************************************************************/
function tasksInRevision_counter($db){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."' AND tb_tarefas.tarefa_status='Em revisao'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

/***********************************************************
*Função para listar as tarefas em revisão de um colaborador*
***********************************************************/
function read_tasksInRevision($db){
    $output = '';    
    $query = "SELECT tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."' AND tb_tarefas.tarefa_status='Em revisao' order by tb_tarefas.tarefa_id desc";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $checklist = checklist($db,$row['tarefa_id']);
        $members = members($db,$row['tarefa_id']);
        $checklistTotal = checklist_total($db, $row['tarefa_id']);
        $checklist_doneTask=checklist_doneTask($db, $row['tarefa_id']);
        
        if($_SESSION['usuario_tipo']=='admin'){
            $output.='<div class="task">
                        <button class="accordion">
                            <div class="task__top">
                                <div class="task__priority">
                                    <span>'.$row['tarefa_prioridade'].'</span>
                                </div>
                                <div class="task__dots"><i class="material-icons">more_horiz</i></div>
                                <div class="task__action">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                            </div>
                            <div class="task__head">
                                <div class="task__name">
                                    <span>'.$row['tarefa_nome'].'</span>
                                </div>
                                <div class="task__time">
                                    <p>'.$row['tarefa_inicio'].'</p>
                                </div>
                            </div>
                        </button>
                        <div class="task__body">
                            <div class="task__progress">
                                <span class="myState"></span><span class="myGoal"></span>
                                <div class="progress--bar">
                                    <div class="current--progress" style="width:'.$row['tarefa_percent'].'%"></div>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>CHECKLIST</span>
                                <ul class="checklist__list">
                                    '.$checklist.'
                                </ul>
                            </div>
                            <div class="task__checklist">
                                <span>DEADLINE</span>
                                <div class="task__time">
                                    <p>'.$row['tarefa_fim'].'</p>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>MEMBROS</span>
                                <div class="members">
                                    '.$members.'
                                </div>
                                <div class="add_members">
                                    <button class="add__member"><i class="material-icons">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="task__footer">
                            <div class="task__done">
                                <p>'.$checklist_doneTask.'/'.$checklistTotal.'</p>
                            </div>
                            <div class="task__attachment">
                                <button class="attach edit__task" id='.$row['tarefa_id'].'><i class="material-icons">edit</i></button>
                                <button class="attach btn-verified-tarefa" id='.$row['tarefa_id'].'><i class="material-icons">check_circle</i></button>
                                <button class="attach btn-delete-tarefa" id='.$row['tarefa_id'].'><i class="material-icons">delete</i></button>
                            </div>
                            
                        </div>
                    </div>';
        }else{
            $output.='<div class="task">
                        <button class="accordion">
                            <div class="task__top">
                                <div class="task__priority">
                                    <span>'.$row['tarefa_prioridade'].'</span>
                                </div>
                                <div class="task__dots"><i class="material-icons">more_horiz</i></div>
                                <div class="task__action">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                            </div>
                            <div class="task__head">
                                <div class="task__name">
                                    <span>'.$row['tarefa_nome'].'</span>
                                </div>
                                <div class="task__time">
                                    <p>'.$row['tarefa_inicio'].'</p>
                                </div>
                            </div>
                        </button>
                        <div class="task__body">
                            <div class="task__progress">
                                <span class="myState"></span><span class="myGoal"></span>
                                <div class="progress--bar">
                                    <div class="current--progress" style="width:'.$row['tarefa_percent'].'%"></div>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>CHECKLIST</span>
                                <ul class="checklist__list">
                                    '.$checklist.'
                                </ul>
                            </div>
                            <div class="task__checklist">
                                <span>DEADLINE</span>
                                <div class="task__time">
                                    <p>'.$row['tarefa_fim'].'</p>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>MEMBROS</span>
                                <div class="members">
                                    '.$members.'
                                </div>
                                <div class="add_members">
                                    <button class="add__member"><i class="material-icons">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="task__footer">
                            <div class="task__done">
                                <p>'.$checklist_doneTask.'/'.$checklistTotal.'</p>
                            </div>
                            <div class="task__attachment">
                                <button class="attach edit__task" id='.$row['tarefa_id'].'><i class="material-icons">edit</i></button>
                                <button class="attach btn-delete-tarefa" id='.$row['tarefa_id'].'><i class="material-icons">delete</i></button>
                            </div>
                            
                        </div>
                    </div>';
        }
        
    }
    
    /*<div class="task__attachment">
                                <button class="attach del__task"><i class="material-icons">delete</i></button>
                            </div>*/
    
    echo $output;
}

/***********************************************************
*Função para contar as tarefas concluídas de um colaborador*
***********************************************************/
function tasksConcluded_counter($db){
    $query = "SELECT COUNT(*) FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."' AND tb_tarefas.tarefa_status='Concluida'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row['COUNT(*)'];
}

/***********************************************************
*Função para listar as tarefas concluídas de um colaborador*
***********************************************************/
function read_tasksConcluded($db){
    $output = '';    
    $query = "SELECT tb_tarefas.tarefa_id, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_prioridade, tb_tarefas.tarefa_inicio, tb_tarefas.tarefa_fim, tb_tarefas.tarefa_percent FROM tb_membrostpc INNER JOIN tb_tarefas on tb_membrostpc.membroTPC_tid=tb_tarefas.tarefa_id AND tb_membrostpc.membroTPC_uid='".$_SESSION['usuario_id']."' AND tb_tarefas.tarefa_status='Concluida' order by tb_tarefas.tarefa_id desc limit 20";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $checklist = checklist($db,$row['tarefa_id']);
        $members = members($db,$row['tarefa_id']);
        $checklistTotal = checklist_total($db, $row['tarefa_id']);
        $checklist_doneTask=checklist_doneTask($db, $row['tarefa_id']);
        if($_SESSION['usuario_tipo']=='admin'){
            $output.='<div class="task">
                        <button class="accordion">
                            <div class="task__top">
                                <div class="task__priority">
                                    <span>'.$row['tarefa_prioridade'].'</span>
                                </div>
                                <div class="task__dots"><i class="material-icons">more_horiz</i></div>
                                <div class="task__action">
                                    <i class="material-icons">add_circle_outline</i> 
                                </div>
                            </div>
                            <div class="task__head">
                                <div class="task__name">
                                    <span>'.$row['tarefa_nome'].'</span>
                                </div>
                                <div class="task__time">
                                    <p>'.$row['tarefa_inicio'].'</p>
                                </div>
                            </div>
                        </button>
                        <div class="task__body">
                            <div class="task__progress">
                                <span class="myState"></span><span class="myGoal"></span>
                                <div class="progress--bar">
                                    <div class="current--progress" style="width:'.$row['tarefa_percent'].'%"></div>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>CHECKLIST</span>
                                <ul class="checklist__list">
                                    '.$checklist.'
                                </ul>
                            </div>
                            <div class="task__checklist">
                                <span>DEADLINE</span>
                                <div class="task__time">
                                    <p>'.$row['tarefa_fim'].'</p>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>MEMBROS</span>
                                <div class="members">
                                    '.$members.'
                                </div>
                                <div class="add_members">
                                    <button class="add__member"><i class="material-icons">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="task__footer">
                            <div class="task__done">
                                <p>'.$checklist_doneTask.'/'.$checklistTotal.'</p>
                            </div>
                            <div class="task__attachment">
                                <button class="attach btn-delete-tarefa" id='.$row['tarefa_id'].'><i class="material-icons">delete</i></button>
                            </div>
                        </div>
                    </div>';
        }else{
            $output.='<div class="task">
                        <button class="accordion">
                            <div class="task__top">
                                <div class="task__priority">
                                    <span>'.$row['tarefa_prioridade'].'</span>
                                </div>
                                <div class="task__dots"><i class="material-icons">more_horiz</i></div>
                                <div class="task__action">
                                    <i class="material-icons">add_circle_outline</i> 
                                </div>
                            </div>
                            <div class="task__head">
                                <div class="task__name">
                                    <span>'.$row['tarefa_nome'].'</span>
                                </div>
                                <div class="task__time">
                                    <p>'.$row['tarefa_inicio'].'</p>
                                </div>
                            </div>
                        </button>
                        <div class="task__body">
                            <div class="task__progress">
                                <span class="myState"></span><span class="myGoal"></span>
                                <div class="progress--bar">
                                    <div class="current--progress" style="width:'.$row['tarefa_percent'].'%"></div>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>CHECKLIST</span>
                                <ul class="checklist__list">
                                    '.$checklist.'
                                </ul>
                            </div>
                            <div class="task__checklist">
                                <span>DEADLINE</span>
                                <div class="task__time">
                                    <p>'.$row['tarefa_fim'].'</p>
                                </div>
                            </div>
                            <div class="task__checklist">
                                <span>MEMBROS</span>
                                <div class="members">
                                    '.$members.'
                                </div>
                                <div class="add_members">
                                    <button class="add__member"><i class="material-icons">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="task__footer">
                            <div class="task__done">
                                <p>'.$checklist_doneTask.'/'.$checklistTotal.'</p>
                            </div>
                            
                        </div>
                    </div>';
        }
        
    }
    
    echo $output;
}

/***********************************
* Listar notificações              *
***********************************/
if(isset($_POST['view'])){
    if($_POST['view'] != ''){
        $update_query = "update tb_notifuservis set notifUserVis_status=1 where notifUserVis_status=0 and notifUserVis_uid='".$_SESSION['usuario_id']."'";
        $result = mysqli_query($db, $update_query);
    }
    $query = "select tb_notificacoes.notificacao_titulo, tb_notificacoes.notificacao_texto, tb_notificacoes.notificacao_url, tb_notifuservis.notifUserVis_status from tb_notificacoes inner join tb_notifuservis where tb_notificacoes.notificacao_id = tb_notifuservis.notifUserVis_nid and tb_notifuservis.notifUserVis_dpto = '".$_SESSION['usuario_dpto']."' and tb_notifuservis.notifUserVis_uid = '".$_SESSION['usuario_id']."'  order by tb_notifuservis.notifUserVis_nid desc limit 5"; //where notificacao_status=0
    $result = mysqli_query($db, $query);
    $output = '';
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $output .= '<li>
                            <a href="'.$row['notificacao_url'].'">
                                <button class="menu__listNot">
                                    <span><strong>'.$row['notificacao_titulo'].'</strong></span>
                                    <span><i class="notification__text">'.$row['notificacao_texto'].'</i></span>
                                </button>
                            </a>
                        </li>
            ';
        }
    }else{
        $output .= '<li>
                        <a href="">
                            <button class="menu__listNot">
                                <span><i class="notification__text">Nenhuma notificação encontrada</i></span>
                            </button>
                        </a>
                    </li>
        ';
    }
    
    $query = 'select * from tb_notifuservis where notifUserVis_status=0 and notifUserVis_uid="'.$_SESSION['usuario_id'].'" ';
    $result = mysqli_query($db,$query);
    $count = mysqli_num_rows($result);
    
    $data = array(
        'notification' => $output,
        'unseen_notification' => $count
    );
    
    echo json_encode($data);
}


/***************************************
* Listar projectos do seu Departamento *
***************************************/
function fetch_last_fase($db, $id){
    $query = "SELECT tb_projectos.projecto_id, tb_projectos.projecto_nome, tb_projectos.projecto_percent, tb_projectos.projecto_nome, tb_projectos.projecto_aprovacao_ca, tb_projectos.projecto_status, tb_fasesproject.faseproject_nome FROM tb_projectos INNER JOIN tb_fasesproject WHERE tb_projectos.projecto_dpto = '".$_SESSION['usuario_dpto']."' and tb_fasesproject.faseproject_em_curso = '1' and tb_fasesproject.faseproject_pid = ".$id." ORDER BY tb_fasesproject.faseproject_id DESC limit 1";
    
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['faseproject_nome'];
}

/***************************************
* Listar projectos do seu Departamento *
***************************************/
function fetch_last_fase_for_ca($db, $id, $dpto){
    $query = "SELECT tb_projectos.projecto_id, tb_projectos.projecto_nome, tb_projectos.projecto_percent, tb_projectos.projecto_nome, tb_projectos.projecto_aprovacao_ca, tb_projectos.projecto_status, tb_fasesproject.faseproject_nome FROM tb_projectos INNER JOIN tb_fasesproject WHERE tb_projectos.projecto_dpto = '$dpto' and tb_fasesproject.faseproject_em_curso = '1' and tb_fasesproject.faseproject_pid = ".$id." ORDER BY tb_fasesproject.faseproject_id DESC limit 1";
    
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['faseproject_nome'];
}

/***********************************************
*Função para lista os projectos do departamento*
***********************************************/
function listar_projectos($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = '".$_SESSION['usuario_dpto']."' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Aprovado' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase($db, $row['projecto_id']);
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td class="settings" data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos do departamento*
***********************************************/
function listar_projectosChefDpto($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = '".$_SESSION['usuario_dpto']."' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase($db, $row['projecto_id']);
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = '".$_SESSION['usuario_dpto']."' and projecto_aprovacao_chefeDpto='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase($db, $row['projecto_id']);
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    //
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*DACA                                          *
***********************************************/
function listar_projectosEmAnalise_daca($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DACA' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DACA');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="FChef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise_deeti($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DEETI' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEETI');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise_drhti($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DRHTI' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DRHTI');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise_dafsg($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DAFSG' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DAFSG');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise_dfm($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DFM' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DFM');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise_dfmcr($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DFMCR' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DFMCR');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise_dec($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DEC' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEC');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise_drmsu($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DRMSU' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DRMSU');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectosEmAnalise_deger($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DEGER' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Em analise' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEGER');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-project" id="'.$row['projecto_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectos_para_confirmacao_conclusao_deetiDaca($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE (projecto_dpto = 'DEETI' or projecto_dpto = 'DACA') and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Aprovado' and projecto_percent = 90 ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        /*$fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEETI'); <td>'.$fase.'</td>*/
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project-concluded" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectos_para_confirmacao_conclusao_drhtiDafsg($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE (projecto_dpto = 'DRHTI' or projecto_dpto = 'DAFSG') and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Aprovado' and projecto_percent = 90 ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        /*$fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEETI'); <td>'.$fase.'</td>*/
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project-concluded" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectos_para_confirmacao_conclusao_dfmDeger($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE (projecto_dpto = 'DFM' or projecto_dpto = 'DEGER') and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Aprovado' and projecto_percent = 90 ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        /*$fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEETI'); <td>'.$fase.'</td>*/
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project-concluded" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectos_para_confirmacao_conclusao_dfmcr($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DFMCR' and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Aprovado' and projecto_percent = 90 ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        /*$fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEETI'); <td>'.$fase.'</td>*/
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status" ><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project-concluded" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************************
*Função para listar os projectos em análise do *
*departamento                                  *
***********************************************/
function listar_projectos_para_confirmacao_conclusao_drmsuDec($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE (projecto_dpto = 'DRMSU' or projecto_dpto = 'DEC') and projecto_aprovacao_chefeDpto='Aprovado' and projecto_aprovacao_ca='Aprovado' and projecto_percent = 90 ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        /*$fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEETI'); <td>'.$fase.'</td>*/
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-project-concluded" id="'.$row['projecto_id'].'"><i class="material-icons">check_circle</i></button></td>
                </tr>';
    }
    
    return $output;
}


/************************************************
*Função para listar os projectos do departamento*
*por colaborador                                *
************************************************/
function listar_projectos_perUser($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT tb_projectos.projecto_id, tb_projectos.projecto_nome, tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_projectos.projecto_percent, tb_projectos.projecto_inicio, tb_projectos.projecto_fim, tb_projectos.projecto_status FROM tb_projectos INNER JOIN tb_membrosproject INNER JOIN tb_usuarios WHERE projecto_dpto = '".$_SESSION['usuario_dpto']."' AND tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid AND tb_membrosproject.membrosproject_uid = tb_usuarios.usuario_id ORDER BY projecto_id DESC limit 200";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        /*$nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase($db, $row['projecto_id']);*/
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="Colaborador">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                    <td data-label="Início">'.$row['projecto_inicio'].'</td>
                    <td data-label="Fim">'.$row['projecto_fim'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                </tr>';
    }
    
    return $output;
}


/*************************************************************************
*Função para listar os projectos do deeti para o administrador de pelouro*
*************************************************************************/
function listar_projectos_deeti($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DEETI' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEETI');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/************************************************************************
*Função para listar os projectos do ca para o administrador de pelouro  *
************************************************************************/
function listar_projectos_ca($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'CA' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'CA');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-open-updtProject" id="'.$row['projecto_id'].'"><i class="material-icons">edit</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/************************************************************************
*Função para listar os projectos do daca para o administrador de pelouro*
************************************************************************/
function listar_projectos_daca($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DACA' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DACA');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/************************************************************************
*Função para listar os projectos do daca para o administrador de pelouro*
************************************************************************/
function listar_projectos_dafsg($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DAFSG' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DAFSG');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/************************************************************************
*Função para listar os projectos do daca para o administrador de pelouro*
************************************************************************/
function listar_projectos_drhti($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DRHTI' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DRHTI');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/************************************************************************
*Função para listar os projectos do daca para o administrador de pelouro*
************************************************************************/
function listar_projectos_dec($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DEC' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEC');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/************************************************************************
*Função para listar os projectos do daca para o administrador de pelouro*
************************************************************************/
function listar_projectos_drmsu($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DRMSU' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DRMSU');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/************************************************************************
*Função para listar os projectos do daca para o administrador de pelouro*
************************************************************************/
function listar_projectos_dfm($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DFM' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DFM');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}

/************************************************************************
*Função para listar os projectos do daca para o administrador de pelouro*
************************************************************************/
function listar_projectos_dfmcr($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DFMCR' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DFMCR');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}



/************************************************************************
*Função para listar os projectos do daca para o administrador de pelouro*
************************************************************************/
function listar_projectos_deger($db){
    $output = '';
    $usuario = new UsuarioDados;
    $query = "SELECT * FROM tb_projectos WHERE projecto_dpto = 'DEGER' ORDER BY projecto_id DESC limit 100";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result)){
        $nome = $usuario->get_user_first_name($db, $row['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $row['projecto_uid']);
        $fase = fetch_last_fase_for_ca($db, $row['projecto_id'], 'DEGER');
        
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$row['projecto_nome'].'</td>
                    <td data-label="(%)">'.$row['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$row['projecto_inicio'].'</td>
                    <td data-label="Chef. Dpto">'.$row['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$row['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$row['projecto_status'].'<div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-project-comments" id="'.$row['projecto_id'].'"><i class="material-icons">notes</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$row['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$row['projecto_id'].'"><i class="material-icons">message</i></button><button class="btn-normal btn-darkBlue btn-delete-project" id="'.$row['projecto_id'].'"><i class="material-icons">delete</i></button></td>
                </tr>';
    }
    
    return $output;
}


/*********************************************************
*Função para pegar as fases do poejecto de um colaborador*
*********************************************************/
function fetch_last_fase2($db, $id){
    $query = "SELECT tb_projectos.projecto_id, tb_projectos.projecto_nome, tb_projectos.projecto_percent, tb_projectos.projecto_nome, tb_projectos.projecto_aprovacao_ca, tb_projectos.projecto_status, tb_fasesproject.faseproject_nome FROM tb_projectos INNER JOIN tb_fasesproject WHERE  tb_fasesproject.faseproject_em_curso = '1' and tb_fasesproject.faseproject_pid = ".$id." ORDER BY tb_fasesproject.faseproject_id DESC limit 1";
    
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['faseproject_nome'];
}

/***************************************
*Função para lista projectos do usuário*
***************************************/
function listar_user_projects($db){
    $output = '';
    $projectos = new ProjectoInfo();
    $usuario = new UsuarioDados;
    $user_projects = $projectos->get_user_project_data($db);
    //$i = 0;
    for($i=0; $i < count($user_projects); $i++){
        $fase = fetch_last_fase2($db, $user_projects[$i]['projecto_id']);
        $nome = $usuario->get_user_first_name($db, $user_projects[$i]['projecto_uid']);
        $sobrenome = $usuario->get_user_last_name($db, $user_projects[$i]['projecto_uid']);
        $output .= '<tr valign="top">
                    <td data-label="Nome">'.$user_projects[$i]['projecto_nome'].'</td>
                    <td data-label="(%)">'.$user_projects[$i]['projecto_percent'].' %</td>
                    <td data-label="Responsável">'.$nome.' '.$sobrenome.'</td>
                    <td data-label="Fase">'.$fase.'</td>
                    <td data-label="Inicio">'.$user_projects[$i]['projecto_inicio'].'</td>
                    <td data-label="Fim">'.$user_projects[$i]['projecto_fim'].'</td>
                    <td data-label="Chef. Dpto">'.$user_projects[$i]['projecto_aprovacao_chefeDpto'].'</td>
                    <td data-label="CA">'.$user_projects[$i]['projecto_aprovacao_ca'].'</td>
                    <td data-label="Status"><div class="status">'.$user_projects[$i]['projecto_status'].'</div></td>
                    <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-open-updtProject" id="'.$user_projects[$i]['projecto_id'].'"><i class="material-icons">edit</i></button><button class="btn-normal btn-darkBlue btn-view-project" id="'.$user_projects[$i]['projecto_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-open-comment-modal" id="'.$user_projects[$i]['projecto_id'].'"><i class="material-icons">comment</i></button></td>
                </tr>';
    }
    
    return $output;
}

/***********************************
*Método post para pegar as fases do*
*projecto e preencher na modal de  *
*comentários                       *
***********************************/

if(isset($_POST['get_fases'])){
    $output = array();
    $projecto_id = $_POST['get_fases'];
    
    $query="select * from tb_fasesproject where faseproject_pid='$projecto_id'";
    $result = mysqli_query($db,$query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output[] = array(
            "fase_id" => $row['faseproject_id'],
            "fase_nome" => $row['faseproject_nome']
        );
    }
    
    echo json_encode($output);
}

/************************************
*Metodo para carregar comentarios   *
************************************/
if(isset($_POST['get_comentario'])){
    $output = '';
    $projecto_id = $_POST['get_comentario'];
    $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_foto, tb_fasesproject.faseproject_nome, tb_comentarios_projecto.comentario_text, tb_comentarios_projecto.comentario_time from tb_comentarios_projecto INNER JOIN tb_fasesproject INNER JOIN tb_usuarios WHERE tb_comentarios_projecto.comentario_pid = '$projecto_id' and tb_comentarios_projecto.comentario_fid = tb_fasesproject.faseproject_id and tb_comentarios_projecto.comentario_uid=tb_usuarios.usuario_id order by tb_comentarios_projecto.comentario_id desc limit 20";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $usuario = new UsuarioDados();
        $user = $usuario->get_user_data($db, $_SESSION['usuario_id']);
        
        $output .='<div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                              <h4>Fase: '.$row['faseproject_nome'].'</h4>
                              <span>'.$row['comentario_text'].'</span>
                          </div>
                          <div class="comment__time">
                              <span>'.$row['comentario_time'].'</span>
                          </div>
                      </div>
                  </div>';
    }
    
    echo $output;   
}

/**************************************
*Metodo para carregar comentarios para* 
*a área dos chefes  de departamtno    *
**************************************/
if(isset($_POST['get_comentarios'])){
    $output = '';
    $projecto_id = $_POST['get_comentarios'];
    $query = "SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_foto, tb_fasesproject.faseproject_nome, tb_comentarios_projecto.comentario_text, tb_comentarios_projecto.comentario_time from tb_comentarios_projecto INNER JOIN tb_fasesproject INNER JOIN tb_usuarios WHERE tb_comentarios_projecto.comentario_pid = '$projecto_id' and tb_comentarios_projecto.comentario_fid = tb_fasesproject.faseproject_id and tb_comentarios_projecto.comentario_uid=tb_usuarios.usuario_id order by tb_comentarios_projecto.comentario_id desc limit 20";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $usuario = new UsuarioDados();
        $user = $usuario->get_user_data($db, $_SESSION['usuario_id']);
        
        $output .='<div class="comment">
                      <div class="comment__img--box">
                          <div class="comment__img">
                              <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="comment__usr--img" alt="Imagem do usuario">
                              <div class="comment_userDetails">
                                  <span>'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</span>
                              </div>
                          </div>
                      </div>
                      <div class="comment__text--box">
                          <div class="comment__text">
                              <h4>Fase: '.$row['faseproject_nome'].'</h4>
                              <span>'.$row['comentario_text'].'</span>
                          </div>
                          <div class="comment__time">
                              <span>'.$row['comentario_time'].'</span>
                          </div>
                      </div>
                  </div>';
    }
    
    echo $output;   
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_formacoes_dpto($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo($db, $_SESSION['usuario_dpto']);
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_dpto($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, $_SESSION['usuario_dpto']);
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_deeti($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DEETI');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_daca($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DACA');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_dafsg($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DAFSG');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_drhti($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DRHTI');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_deger($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DEGER');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_dfm($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DFM');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_dfmcr($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DFMCR');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_dec($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DEC');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/********************************************
*Função para listar as formações do DPTO    *
********************************************/
function listar_allformacoes_drmsu($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_dtpo_acompanhamento($db, 'DRMSU');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}


/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacaoChef($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_chef_aproval($db, $_SESSION['usuario_dpto']);
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*pelo RH para aprovação de formações de outros     *
*departamentos                                     *
***************************************************/
function listar_formacoes_para_aprovacao_outros_dpto($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_aproval_other($db);
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Dpto">'.$formacao[$i]['formacao_dpto'].'</td>
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_deeti($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DEETI');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_daca($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DACA');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_dafsg($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DAFSG');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_drhti($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DRHTI');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_dfm($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DFM');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_dfmcr($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DFMCR');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_deger($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DEGER');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_dec($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DEC');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/***************************************************
*Função para listar as formações a serem analisadas*
*para aprovação do Chefe de departamento           *
***************************************************/
function listar_formacoes_para_aprovacao_drmsu($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_formation_for_admin_aproval($db, 'DRMSU');
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-approve-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">check_circle</i></button><button class="btn-normal btn-darkBlue btn-deny-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">cancel</i></button><button class="btn-normal btn-darkBlue btn-delete-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/**********************************************
*Função para lista as formações do colaborador*
**********************************************/
function listar_usuario_formacoes($db){
    
    $output = '';
    $formacao_dpto = new FormacaoInfo();
    $formacao = $formacao_dpto->get_user_formation($db, $_SESSION['usuario_id']);
    
    for($i =0; $i < count($formacao); $i++ ){
        $output .= '<tr valign="top">
                        <td data-label="Nome">'.$formacao[$i]['formacao_nome'].'</td>
                        <td data-label="Entidade">'.$formacao[$i]['formacao_entidade'].'</td>
                        <td data-label="Local">'.$formacao[$i]['formacao_local'].'</td>                        
                        <td data-label="Duração">'.$formacao[$i]['formacao_duracao'].' dias</td>
                        <td data-label="Início">'.$formacao[$i]['formacao_inicio'].'</td>
                        <td data-label="Horário">'.$formacao[$i]['formacao_hinicio'].'-'.$formacao[$i]['formacao_hfim'].'</td>
                        <td data-label="Chef. Dpto">'.$formacao[$i]['formacao_chefdpto'].'</td>
                        <td data-label="CA">'.$formacao[$i]['formacao_admin'].'</td>
                        <td data-label="RH">'.$formacao[$i]['formacao_rh'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-edit-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">edit</i></button><button class="btn-normal btn-darkBlue btn-view-formation" id="'.$formacao[$i]['formacao_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
    
}

/*******************************************
*Post para pegar os dados estatísticos de  *
*projectos do departamento e do colaborador*
*******************************************/
if(isset($_POST['project_stats'])){
    $projectos = new ProjectoInfo();
    
    $total_projectos = $projectos->get_dptoProject_counter($db);
    
    echo json_encode($total_projectos);
}

/*******************************************
*Post para pegar os dados estatísticos de  *
*projectos do departamento para o conselho *
*administrativo                            *
*******************************************/
if(isset($_POST['project_stats_ca'])){
    $projectos = new ProjectoInfo();
    
    if($_SESSION['usuario_login'] == 'leonel.augusto'){
        $total_projectos = $projectos->get_dptoProject_counter_ca($db,'DACA');
    }elseif($_SESSION['usuario_login'] == 'luisa.augusto'){
        $total_projectos = $projectos->get_dptoProject_counter_ca($db,'DAFSG');
    }elseif($_SESSION['usuario_login'] == 'ale.fernandes'){
        $total_projectos = $projectos->get_dptoProject_counter_ca($db,'DEGER');
    }elseif($_SESSION['usuario_login'] == 'alvaro.santos'){
        $total_projectos = $projectos->get_dptoProject_counter_ca($db,'DFMCR');
    }elseif($_SESSION['usuario_login'] == 'antonio.moniz'){
        $total_projectos = $projectos->get_dptoProject_counter_ca($db,'DEC');
    }
    
    
    echo json_encode($total_projectos);
}

/*******************************************
*Post para pegar os dados estatísticos de  *
*projectos do departamento para o conselho *
*administrativo                            *
*******************************************/
if(isset($_POST['project_stats_ca2'])){
    $projectos = new ProjectoInfo();
    
    if($_SESSION['usuario_login'] == 'leonel.augusto'){
        $total_projectos = $projectos->get_dptoProject_counter_ca2($db,'DEETI');
    }elseif($_SESSION['usuario_login'] == 'luisa.augusto'){
        $total_projectos = $projectos->get_dptoProject_counter_ca2($db,'DRHTI');
    }elseif($_SESSION['usuario_login'] == 'ale.fernandes'){
        $total_projectos = $projectos->get_dptoProject_counter_ca2($db,'DFM');
    }elseif($_SESSION['usuario_login'] == 'antonio.moniz'){
        $total_projectos = $projectos->get_dptoProject_counter_ca2($db,'DRMSU');
    }
    
    
    echo json_encode($total_projectos);
}

/*******************************************
*Post para pegar os dados estatísticos de  *
*tarefas do departamento e do colaborador  *
*******************************************/
if(isset($_POST['tasks_stats'])){
    $tarefas = new TarefasInfo();
    
    $total_tarefas = $tarefas->get_tasks_dpto_stats($db);
    
    echo json_encode($total_tarefas);
}

/*******************************************
*Post para pegar os dados estatísticos de  *
*tarefas do departamento e do colaborador  *
*******************************************/
if(isset($_POST['tasks_stats_ca'])){
    $tarefas = new TarefasInfo();
    
    if($_SESSION['usuario_login'] == 'leonel.augusto'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca($db, 'DACA');
    }elseif($_SESSION['usuario_login'] == 'luisa.augusto'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca($db, 'DAFSG');
    }elseif($_SESSION['usuario_login'] == 'ale.fernandes'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca($db, 'DEGER');
    }elseif($_SESSION['usuario_login'] == 'alvaro.santos'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca($db, 'DFMCR');
    }elseif($_SESSION['usuario_login'] == 'antonio.moniz'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca($db, 'DEC');
    }
    
    
    echo json_encode($total_tarefas);
}

/*******************************************
*Post para pegar os dados estatísticos de  *
*tarefas do departamento e do colaborador  *
*******************************************/
if(isset($_POST['tasks_stats_ca2'])){
    $tarefas = new TarefasInfo();
    
    if($_SESSION['usuario_login'] == 'leonel.augusto'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca2($db, 'DEETI');
    }elseif($_SESSION['usuario_login'] == 'luisa.augusto'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca2($db, 'DRHTI');
    }elseif($_SESSION['usuario_login'] == 'ale.fernandes'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca2($db, 'DFM');
    }elseif($_SESSION['usuario_login'] == 'antonio.moniz'){
        $total_tarefas = $tarefas->get_tasks_dpto_stats_ca2($db, 'DRMSU');
    }
    
    
    echo json_encode($total_tarefas);
}

if(isset($_POST['inacom_desempenho_stats'])){
    $output = array();
    $data = date('m-Y', strtotime('- 1 year'));
    //echo $data;
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='INACOM' order by desempenho_id desc limit 12)var1 order by desempenho_id asc";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output[] = array(
            "inacom_data" => $row['desempenho_data'],
            "inacom_media" => $row['desempenho_media']
        ); 
    }
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='".$_SESSION['usuario_dpto']."' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output[] = array(
            "dpto_data" => $row['desempenho_data'],
            "dpto_media" => $row['desempenho_media']
        ); 
    }
    
    $ano = date('Y', strtotime('- 1 year'));
    $mes = date('m', strtotime('- 1 year'));
    $query = "select * from (select av_mes, av_ano, media_ponderada from tb_av_usuarios where av_ano>=$ano and usuario_id='".$_SESSION['usuario_id']."' order by av_ano desc, av_mes desc limit 12)var1 order by av_ano asc, av_mes asc";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output[] = array(
            "usuario_data" => $row['av_mes'].'-'.$row['av_ano'],
            "usuario_media" => $row['media_ponderada']
        ); 
    }
    
    echo json_encode($output);
}

/*************************************************
*Método Post para pegar as médias do INACOM, DPTO*
*e dos colaboradores do dpto                     *
*************************************************/
if(isset($_POST['inacom_desempenho_stats_chef_dpto'])){
    $output = array();
    $datas = array();
    $inacom_medias = array();
    $dpto_medias = array();
    $user_medias = array();
    $data = date('m-Y', strtotime('- 1 year'));
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='INACOM' order by desempenho_id desc limit 12)var1 order by desempenho_id asc";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        array_push($datas, $row['desempenho_data']);
        array_push($inacom_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["INACOM"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $inacom_medias,
        "borderColor" => ['#002060'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#002060',
        "hoverBackgroundColor" =>'#002060',
        "fill" => false,
        "datas" => $datas
    );
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='".$_SESSION['usuario_dpto']."' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["Departamento"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#34a853'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#34a853',
        "hoverBackgroundColor" =>'#34a853',
        "fill" => false
    );
    
    $query = "select tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_id from tb_usuarios where tb_usuarios.usuario_departamento='".$_SESSION['usuario_dpto']."' AND tb_usuarios.usuario_tipo='tecnico';";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $user_nome = $row['usuario_nome'];
        $user_sobrenome = $row['usuario_sobrenome'];
        $user_id = $row['usuario_id'];
        
        $ano = date('Y', strtotime('- 1 year'));
        $mes = date('m', strtotime('- 1 year'));
        $query = "select * from (select av_mes, av_ano, media_ponderada from tb_av_usuarios where av_ano>=$ano and usuario_id='$user_id' order by av_ano desc, av_mes desc limit 12)var1 order by av_ano asc, av_mes asc";
        $result2 = mysqli_query($db, $query);

        while($row2 = mysqli_fetch_assoc($result2)){
            array_push($user_medias, $row2['media_ponderada']); 
        }
        
        $output[] = array(
            "label" => ["$user_nome $user_sobrenome"],
            "lineTension" => 0,
            "pointRadius" => 5,
            "data" => $user_medias,
            "borderColor" => ['#2fa8cb'],
            "boderDash" => [10, 10],
            "backgroundColor" =>'#2fa8cb',
            "hoverBackgroundColor" =>'#2fa8cb',
            "fill" => false
        );
        
        $user_medias = array();
    }
    
    echo json_encode($output);
}

/********************************************
*Função para carregar o desempenho dos dptos*
*do INACOM                                  *
********************************************/
if(isset($_POST['inacom_desempenho_stats_ca'])){
    $output = array();
    $datas = array();
    $inacom_medias = array();
    $dpto_medias = array();
    $data = date('m-Y', strtotime('- 1 year'));
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='INACOM' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        array_push($datas, $row['desempenho_data']);
        array_push($inacom_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["INACOM"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $inacom_medias,
        "borderColor" => ['#002060'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#002060',
        "hoverBackgroundColor" =>'#002060',
        "fill" => false,
        "datas" => $datas
    );
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DEETI' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DEETI"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#34a853'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#34a853',
        "hoverBackgroundColor" =>'#34a853',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DACA' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DACA"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#fb8b24'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#fb8b24',
        "hoverBackgroundColor" =>'#fb8b24',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DRHTI' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DRHTI"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#ffca3a'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#ffca3a',
        "hoverBackgroundColor" =>'#ffca3a',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DAFSG' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DAFSG"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#457b9d'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#457b9d',
        "hoverBackgroundColor" =>'#457b9d',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DRMSU' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DRMSU"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#d62828'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#d62828',
        "hoverBackgroundColor" =>'#d62828',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DEC' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DEC"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#8d99ae'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#8d99ae',
        "hoverBackgroundColor" =>'#8d99ae',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DFM' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DFM"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#772e25'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#772e25',
        "hoverBackgroundColor" =>'#772e25',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DFMCR' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DFMCR"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#4cc9f0'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#4cc9f0',
        "hoverBackgroundColor" =>'#4cc9f0',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    $query = "select * from (select * from tb_desempenho where desempenho_data>$data and desempenho_nome='DEGER' order by desempenho_id desc limit 12)var1 order by desempenho_id asc ";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){     
            array_push($dpto_medias, $row['desempenho_media']);
    }
    
    $output[] = array(
        "label" => ["DEGER"],
        "lineTension" => 0,
        "pointRadius" => 5,
        "data" => $dpto_medias,
        "borderColor" => ['#6a4c93'],
        "boderDash" => [10, 10],
        "backgroundColor" =>'#6a4c93',
        "hoverBackgroundColor" =>'#6a4c93',
        "fill" => false
    );
    
    $dpto_medias = array();
    
    echo json_encode($output);

}

/***************************************
*Função para carregar as últimas ideias*
*sugeridas para o inacom               *
***************************************/
function get_lastIdeas($db){
    $output = '';
    $query = "select * from tb_ideias where ideia_uid ='".$_SESSION['usuario_id']."' order by ideia_id desc limit 3";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<div class="staff__content">
                        <div class="staff__title">
                            <span>'.$row['ideia_assunto'].'</span> <span class="date">'.$row['ideia_data'].'</span>
                        </div>
                        <div class="staff__context">
                            '.$row['ideia_descricao'].'
                        </div>
                    </div>';
    }
    
    echo $output;
}

function get_lastFormations($db){
    $output = '';
    $query='SELECT tb_formacoes.formacao_nome, tb_formacoes.formacao_inicio, tb_formacoes.formacao_fim, tb_formacoes.formacao_rh, tb_formacoes.formacao_local, tb_formacoes.formacao_entidade FROM tb_formacoes INNER JOIN tb_formacoes_membros WHERE tb_formacoes.formacao_id = tb_formacoes_membros.formacoes_membros_fid AND tb_formacoes_membros.formacoes_membros_uid = '.$_SESSION['usuario_id'].' ORDER BY tb_formacoes.formacao_id DESC LIMIT 3';
    
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<div class="staff__content">
                        <div class="staff__title">
                            <span>'.$row['formacao_nome'].' - '.$row['formacao_rh'].'</span>
                        </div>
                        <div class="staff__date">
                            <span>'.$row['formacao_inicio'].' - '.$row['formacao_fim'].'</span>
                        </div>
                        <div class="staff__context">
                            '.$row['formacao_entidade'].' - '.$row['formacao_local'].'
                        </div>
                    </div>';
    }
    
    echo $output;
}

function get_lastProjects($db){
    $output = '';
    
    $query='SELECT tb_projectos.projecto_nome, tb_projectos.projecto_status, tb_projectos.projecto_inicio, tb_projectos.projecto_fim, tb_projectos.projecto_contexto FROM tb_projectos INNER JOIN tb_membrosproject WHERE tb_projectos.projecto_id = tb_membrosproject.membrosproject_pid AND tb_membrosproject.membrosproject_uid = '.$_SESSION['usuario_id'].' ORDER BY tb_projectos.projecto_id DESC LIMIT 3';
    
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<div class="staff__content">
                        <div class="staff__title">
                            <span>'.$row['projecto_nome'].' - '.$row['projecto_status'].'</span>
                        </div>
                        <div class="staff__date">
                            <span>'.$row['projecto_inicio'].' - '.$row['projecto_fim'].'</span>
                        </div>
                        <div class="staff__context">
                            '.$row['projecto_contexto'].'
                        </div>
                    </div>';
    }
    
    echo $output;
}

function read_contactos_ca($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='CA'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_daca($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DACA'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_dec($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DEC'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_dfm($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DFM'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_deger($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DEGER'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_drhti($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DRHTI'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_dafsg($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DAFSG'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_drmsu($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DRMSU'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_deeti($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DEETI'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

function read_contactos_dfmcr($db){
    $output = '';
    $query = "select usuario_foto, usuario_nome, usuario_sobrenome, usuario_contacto, usuario_email from tb_usuarios where usuario_departamento='DFMCR'";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $output .= '<tr valign="center">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Foto">
                            <div class="logo--container">
                                <img src="../imagens/perfil/'.$row['usuario_foto'].'" class="myImage" alt="imagem de usuario">
                            </div>
                        </td>
                        <td data-label="Nome">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="E-mail">'.$row['usuario_contacto'].'</td>
                        <td data-label="E-mail">'.$row['usuario_email'].'</td>                        
                    </tr>';
    }
    
    echo $output;
}

/**************************************
*Função para ler as notícias principal*
**************************************/
function read_principal_news($db){
    $output = '';
    $query = "SELECT tb_noticias.noticia_id, tb_noticias.noticia_titulo, tb_noticias.noticia_imagem, tb_noticias.noticia_contexto, tb_noticias.noticia_data, tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome FROM tb_noticias INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_id = tb_noticias.noticia_uid AND tb_noticias.noticia_manchete = '1' ORDER BY tb_noticias.noticia_id DESC";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $noticia_contexto = substr($row['noticia_contexto'],0,300)."...";
        $output.='<tr valign="top">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Imagem">
                            <div class="news__imgBox">
                                <img src="../imagens/noticias/'.$row['noticia_imagem'].'" class="newsImage" alt="Imagem da notícia">
                            </div>
                        </td>
                        <td data-label="Título" >'.$row['noticia_titulo'].'</td>
                        <td data-label="Contexto">'.$noticia_contexto.'</td>
                        <td data-label="Data">'.$row['noticia_data'].'</td>
                        <td data-label="Por">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-view-noticia" id="'.$row['noticia_id'].'"><i class="material-icons">remove_red_eye</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*************************************
*Função para ler as notícias públicas*
*************************************/
function read_external_news($db){
    $output = '';
    $query = "SELECT tb_noticias.noticia_id, tb_noticias.noticia_titulo, tb_noticias.noticia_imagem, tb_noticias.noticia_contexto, tb_noticias.noticia_data, tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome FROM tb_noticias INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_id = tb_noticias.noticia_uid AND tb_noticias.noticia_tipo = 'externa' AND tb_noticias.noticia_manchete = '0' ORDER BY tb_noticias.noticia_id DESC";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $noticia_contexto = substr($row['noticia_contexto'],0,300)."...";
        $output.='<tr valign="top">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Imagem">
                            <div class="news__imgBox">
                                <img src="../imagens/noticias/'.$row['noticia_imagem'].'" class="newsImage" alt="Imagem da notícia">
                            </div>
                        </td>
                        <td data-label="Título" >'.$row['noticia_titulo'].'</td>
                        <td data-label="Contexto">'.$noticia_contexto.'</td>
                        <td data-label="Data">'.$row['noticia_data'].'</td>
                        <td data-label="Por">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-edit-noticia" id="'.$row['noticia_id'].'"><i class="material-icons">create</i></button><button class="btn-normal btn-darkBlue btn-view-noticia" id="'.$row['noticia_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-noticia" id="'.$row['noticia_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

/*************************************
*Função para ler as notícias internas*
*************************************/
function read_internal_news($db){
    $output = '';
    $query = "SELECT tb_noticias.noticia_id, tb_noticias.noticia_titulo, tb_noticias.noticia_imagem, tb_noticias.noticia_contexto, tb_noticias.noticia_data, tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome FROM tb_noticias INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_id = tb_noticias.noticia_uid AND tb_noticias.noticia_tipo = 'interna' AND tb_noticias.noticia_manchete = '0' ORDER BY tb_noticias.noticia_id DESC";
    $result = mysqli_query($db, $query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($result)){
        $count++;
        $noticia_contexto = substr($row['noticia_contexto'],0,300)."...";
        $output.='<tr valign="top">
                        <td data-label="Nº">'.$count.'</td>
                        <td data-label="Imagem">
                            <div class="news__imgBox">
                                <img src="../imagens/noticias/'.$row['noticia_imagem'].'" class="newsImage" alt="Imagem da notícia">
                            </div>
                        </td>
                        <td data-label="Título">'.$row['noticia_titulo'].'</td>
                        <td data-label="Contexto">'.$noticia_contexto.'</td>
                        <td data-label="Data">'.$row['noticia_data'].'</td>
                        <td data-label="Por">'.$row['usuario_nome'].' '.$row['usuario_sobrenome'].'</td>
                        <td data-label="Settings" class="settings"><button class="btn-normal btn-darkBlue btn-edit-noticia" id="'.$row['noticia_id'].'"><i class="material-icons">create</i></button><button class="btn-normal btn-darkBlue btn-view-noticia" id="'.$row['noticia_id'].'"><i class="material-icons">remove_red_eye</i></button><button class="btn-normal btn-darkBlue btn-delete-noticia" id="'.$row['noticia_id'].'"><i class="material-icons">delete</i></button></td>
                    </tr>';
    }
    
    echo $output;
}

if(isset($_POST['noticia_principal'])){
    $query = "SELECT tb_noticias.noticia_id, tb_noticias.noticia_titulo, tb_noticias.noticia_imagem, tb_noticias.noticia_contexto, tb_noticias.noticia_data, tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome FROM tb_noticias INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_id = tb_noticias.noticia_uid AND tb_noticias.noticia_manchete = '1' ORDER BY tb_noticias.noticia_id DESC";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    $output['noticia_id'] = $row['noticia_id'];
    $output['noticia_imagem'] = $row['noticia_imagem'];
    $output['noticia_titulo'] = $row['noticia_titulo'];
    
    echo json_encode($output);
}

function read_external_news_user($db){
    $output ='';
    $query = "SELECT noticia_id, noticia_titulo, noticia_imagem, noticia_contexto, noticia_data FROM tb_noticias WHERE noticia_tipo='externa' and noticia_manchete = '0' ORDER BY noticia_id DESC limit 9";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        
        $output.='<div class="news__card" id="'.$row['noticia_id'].'">                                
                    <div class="news__cardImg">                                    
                        <img src="../imagens/noticias/'.$row['noticia_imagem'].'" alt="Noticia Externa">                                
                    </div>                                
                    <div class="news__cardWrapper">                                    
                        <div class="news__cardTitle">'.$row['noticia_titulo'].'</div>                                    
                        <hr class="marker">                                    
                        <div class="news__cardDate">'.$row['noticia_data'].'</div> 
                        <div class="news__cardResume">'.substr($row['noticia_contexto'],0,200)."...".'</div>                                
                    </div>                            
                </div>';
    }
    
    echo $output;
}

function read_internal_news_user($db){
    $output ='';
    $query = "SELECT noticia_id, noticia_titulo, noticia_imagem, noticia_contexto, noticia_data FROM tb_noticias WHERE noticia_tipo='interna' and noticia_manchete = '0' ORDER BY noticia_id DESC limit 9";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        
        $output.='<div class="news__card" id="'.$row['noticia_id'].'">                                
                    <div class="news__cardImg">                                    
                        <img src="../imagens/noticias/'.$row['noticia_imagem'].'" alt="Noticia Externa">                                
                    </div>                                
                    <div class="news__cardWrapper">                                    
                        <div class="news__cardTitle">'.$row['noticia_titulo'].'</div>                                    
                        <hr class="marker">                                    
                        <div class="news__cardDate">'.$row['noticia_data'].'</div> 
                        <div class="news__cardResume">'.substr($row['noticia_contexto'],0,200)."...".'</div>                                
                    </div>                            
                </div>';
    }
    
    echo $output;
}

function read_popular_news($db){
    $output ='';
    $query = "SELECT noticia_id, noticia_titulo, noticia_imagem, noticia_contexto, noticia_data FROM tb_noticias WHERE 1 ORDER BY noticia_acessos DESC limit 10";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        
        $output.='<div class="news__card--long" id="'.$row['noticia_id'].'">
                    <div class="news__card--img2">
                        <img src="../imagens/noticias/'.$row['noticia_imagem'].'" alt="Noticias populares">
                    </div>
                    <div class="card__rightWrapper">
                        <span>'.$row['noticia_titulo'].'</span>
                    </div>
                </div>';
    }
    
    echo $output;
}

/******************************
*POST para listar os usuarios *
******************************/
if(isset($_POST['chat_users'])){
    $output ='';
    $usuario = new UsuarioDados;
    $users = $usuario->get_users_for_chat($db,$_SESSION['usuario_id']);
    
    for($i=0; $i<count($users); $i++){
        
        $user_last_activity = $usuario->get_user_last_activity($db, $users[$i]['usuario_id']);
        $query = "SELECT tb_chat.chat_mensagem, tb_chat.chat_data FROM tb_chat WHERE ((tb_chat.chat_de='".$_SESSION['usuario_id']."' and tb_chat.chat_para='".$users[$i]['usuario_id']." ') OR (tb_chat.chat_de = '".$users[$i]['usuario_id']."' and tb_chat.chat_para = '".$_SESSION['usuario_id']."')) ORDER BY tb_chat.chat_time DESC LIMIT 1";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        
        if(isset($row['chat_data'])){//$user_last_activity[0]['last_activity']
            $date = $row['chat_data'];//date("d-m-Y", strtotime($user_last_activity[0]['last_activity']));
            $state = $user_last_activity[0]['state'];
            $encryption_key = 'CKXH2U9RPY3EFD70TLS1ZG4N8WQBOVI6AMJ5';
            $cipher_method = 'aes-128-cfb';
            $cryptor = new Cryptor($encryption_key, $cipher_method);
            $mensagem = substr($cryptor->decrypt($row['chat_mensagem']),0,30).'...';
        }else{
            $date="Sem dados";
            $state ='off';
            $mensagem = 'Envie uma mensagem';
        }
        
        $query="SELECT COUNT(chat_lida) AS por_ler FROM tb_chat WHERE chat_de =".$users[$i]['usuario_id']." AND chat_para=".$_SESSION['usuario_id']." AND chat_lida='0'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        
        if($row['por_ler']>0){
            $por_ler = '<div class="chat__notification">
                               '.$row['por_ler'].'
                           </div>';
        }elseif($row['por_ler']==0){
            $por_ler = '<div class="chat__notification" style="visibility: hidden;">
                           </div>';
        }
            
        $output.='<div class="chart__usersCard" id="'.$users[$i]['usuario_id'].'">
                           <div class="chat__userImgBox">
                               <img src="../imagens/perfil/'.$users[$i]['usuario_foto'].'" alt="imagem de perfil" class="chat__userImg">
                               <div class="user__status '.$state.'"></div>
                           </div>
                           <div class="user__detailsBox">
                               <div class="user__boxTop">
                                   <div class="user__name">'.$users[$i]['usuario_nome'].' '.$users[$i]['usuario_sobrenome'].'</div>
                                   <div class="user__lastSeenDate">'.$date.'</div>
                               </div>
                               <div class="user__lastMessage">
                                   <span>'.$mensagem.'</span>
                               </div>
                           </div>
                           '.$por_ler.'
                       </div>';
        $por_ler ='';
    }
    
    echo $output;
}

/****************************************************************
*POST para carregar os dados do usuário seleccionado para o chat*
****************************************************************/
if(isset($_POST['fetch_user_for_chat'])){
    $user_id = $_POST['fetch_user_for_chat'];
    $usuario = new UsuarioDados;
    $nome = $usuario->get_user_first_name($db,$user_id);
    $sobrenome = $usuario->get_user_last_name($db,$user_id);
    $foto = $usuario->get_user_foto($db,$user_id);
    $state = $usuario->get_user_state($db,$user_id);
    
    $output = array();
    
    $query = "update tb_chat set chat_lida='1' where chat_de='".$user_id."' and chat_para='".$_SESSION['usuario_id']."' and chat_lida='0'";
    mysqli_query($db, $query);
    
    $output[] = array(
        "nome" => $nome,
        "sobrenome" => $sobrenome,
        "foto" => $foto,
        "state" => $state,
        "usuario_id" => $user_id
    );
    
    echo json_encode($output);
}


/******************************************************************
*POST para carregar as mensagens do usuário seleccionado para chat*
******************************************************************/
if(isset($_POST['fetch_chat_messages'])){
    $to_user_id = $_POST['to_user_id'];
    $from_user_id = $_SESSION['usuario_id'];
    $output = '';
    $query = "select * from (SELECT tb_chat.chat_time, tb_chat.chat_id, tb_usuarios.usuario_id, tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_usuarios.usuario_foto, tb_chat.chat_mensagem FROM tb_chat INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_id = tb_chat.chat_de and ((tb_chat.chat_de='$from_user_id' and tb_chat.chat_para='$to_user_id') OR (tb_chat.chat_de = '$to_user_id' and tb_chat.chat_para = '$from_user_id')) order by tb_chat.chat_id DESC limit 150 )var1 order by chat_id asc";
    //order by tb_chat.chat_time DESC, tb_chat.chat_time ASC limit 150
    
    $result = mysqli_query($db, $query);
    $encryption_key = 'CKXH2U9RPY3EFD70TLS1ZG4N8WQBOVI6AMJ5';
    $cipher_method = 'aes-128-cfb';
    $cryptor = new Cryptor($encryption_key, $cipher_method);
    
    foreach($result as $row){
        $date = date("d-m-Y H:i:s", strtotime($row['chat_time']));
        
        $message = $cryptor->decrypt($row['chat_mensagem']);
        
        if($row['usuario_id'] == $_SESSION['usuario_id']){
            $output.='<div class="my__messageBox">
                           <div class="message__box">
                               <div class="message my">'.$message.'</div>
                               <div class="message__timeMy">'.$date.'</div>
                           </div>
                           <div class="img__box">
                               <img src="../imagens/perfil/'.$row['usuario_foto'].'" alt="Imagem de perfil" class="user__chatImgMy">
                           </div>
                       </div>
            ';
        }else{
            $output.='<div class="other__messageBox">
                           <div class="img__box">
                               <img src="../imagens/perfil/'.$row['usuario_foto'].'" alt="Imagem de perfil" class="user__chatImg">
                           </div>
                           <div class="message__box">
                               <div class="message other">'.$message.'</div>
                               <div class="message__time">'.$date.'</div>
                           </div>
                       </div>
            ';
        }
        
    }
    
    echo $output;
}

/************************************************************
* POST para contar todas as mensagens que o usuário não leu *
************************************************************/
if(isset($_POST['not_red_msg'])){
    $query="SELECT COUNT(chat_lida) AS por_ler FROM tb_chat WHERE chat_para=".$_SESSION['usuario_id']." AND chat_lida='0'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    
    echo $row['por_ler'];
}

?>