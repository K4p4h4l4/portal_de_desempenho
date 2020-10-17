<?php 
require_once("conexao.php");

$ano = date('Y', strtotime('- 1 year'));

$mes = date('m', strtotime('- 1 year'));

$dpto = $_SESSION['usuario_dpto'];

$query = "select usuario_id from tb_usuarios where usuario_departamento='$dpto'";
$result = mysqli_query($db, $query);

/*********************************************
*Cálculo da média ponderada dos usuários por *
*meses sem avaliação                         *
*********************************************/
while($row = mysqli_fetch_assoc($result)){
    
    for($i = 12; $i>0;$i--){
        $ano = date('Y', strtotime('- '.$i.' months'));
        $mes = date('m', strtotime('- '.$i.' months'));
        $query = "select media_ponderada from tb_av_usuarios where usuario_id='".$row['usuario_id']."' and av_mes='$mes' and av_ano='$ano'";
        $result2 = mysqli_query($db, $query);
        if(mysqli_num_rows($result2)==0){
            $query = "insert into tb_av_usuarios (id, av_ano, av_mes, usuario_id, av_competencia_profissional, av_cumprimento_tarefa, av_rel_hum_trab, av_adpt_func, av_uso_correcto_equip, av_reuniao_mat, av_reuniao_op, media_total, media_ponderada, obs) values (null, '$ano', '$mes', '".$row['usuario_id']."', 0, 0, 0, 0, 0, 0, 0, 0, 0, '')";
            
            mysqli_query($db, $query);
        }
    }
}


/*******************************************
*Cálculo da média ponderada do dpto por mês*
*******************************************/
for($i = 12; $i>0;$i--){
    $ano = date('Y', strtotime('- '.$i.' months'));
    $mes = date('m', strtotime('- '.$i.' months'));
    $data = date('m-Y', strtotime('- '.$i.' months'));
    $query = "select desempenho_media from tb_desempenho where desempenho_mes='$mes' and desempenho_ano='$ano' and desempenho_nome='$dpto'";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)==0){
        $query = "SELECT media_ponderada FROM tb_av_usuarios INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_departamento='$dpto' AND tb_av_usuarios.media_ponderada>0 AND tb_usuarios.usuario_id = tb_av_usuarios.usuario_id AND tb_av_usuarios.av_mes='$mes' AND tb_av_usuarios.av_ano='$ano'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)==0){
            $query = "insert into tb_desempenho (desempenho_id, desempenho_nome, desempenho_mes, desempenho_ano, desempenho_media, desempenho_data) values (null, '$dpto', '$mes', '$ano', 0, '$data')";
            mysqli_query($db, $query);
        }else{
            $media_pond_dpto = 0;
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                $media_pond_dpto += $row['media_ponderada'];
                $count++;
            }
            $media_pond_dpto = $media_pond_dpto/$count;
            $query = "insert into tb_desempenho (desempenho_id, desempenho_nome, desempenho_mes, desempenho_ano, desempenho_media, desempenho_data) values (null, '$dpto', '$mes', '$ano', '$media_pond_dpto', '$data')";
            mysqli_query($db, $query);
        }
        
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $media_actual = $row['desempenho_media'];
            $query = "SELECT media_ponderada FROM tb_av_usuarios INNER JOIN tb_usuarios WHERE tb_usuarios.usuario_departamento='$dpto' AND tb_av_usuarios.media_ponderada>0 AND tb_usuarios.usuario_id = tb_av_usuarios.usuario_id AND tb_av_usuarios.av_mes='$mes' AND tb_av_usuarios.av_ano='$ano'";
            $result2 = mysqli_query($db, $query);
            
            $media_encontrada = 0;
            $count = 0;
            while($row2 = mysqli_fetch_assoc($result2)){
                $media_encontrada += $row2['media_ponderada'];
                $count++;
            }
            
            $media_encontrada = $media_encontrada/$count;
            if($media_actual != $media_encontrada){
                $query = "update tb_desempenho set desempenho_media=$media_encontrada where desempenho_mes='$mes' and desempenho_ano='$ano' and desempenho_nome = '$dpto'";
                mysqli_query($db, $query);
            }
        }
    }
}

/********************************************
*Cálculo da média ponderada do INACOM por mês*
*********************************************/
for($i = 12; $i>0;$i--){
    $ano = date('Y', strtotime('- '.$i.' months'));
    $mes = date('m', strtotime('- '.$i.' months'));
    $data = date('m-Y', strtotime('- '.$i.' months'));
    $query = "select desempenho_media from tb_desempenho where desempenho_mes='$mes' and desempenho_ano='$ano' and desempenho_nome='INACOM'";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result)==0){
        $query = "SELECT desempenho_media FROM tb_desempenho WHERE (desempenho_nome='DEETI' || desempenho_nome='DACA' || desempenho_nome='DFM' || desempenho_nome='DEGER' || desempenho_nome='DEC' || desempenho_nome='DRMSU' || desempenho_nome='DRHTI' || desempenho_nome='DRHTI') AND desempenho_mes='$mes' AND desempenho_ano='$ano' AND desempenho_media>0";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)==0){
            $query = "insert into tb_desempenho (desempenho_id, desempenho_nome, desempenho_mes, desempenho_ano, desempenho_media, desempenho_data) values (null, 'INACOM', '$mes', '$ano', 0, '$data')";
            mysqli_query($db, $query);
        }else{
            $media_pond_dpto = 0;
            $count = 0;
            while($row = mysqli_fetch_assoc($result)){
                $media_pond_dpto += $row['desempenho_media'];
                $count++;
            }
            $media_pond_dpto = $media_pond_dpto/$count;
            $query = "insert into tb_desempenho (desempenho_id, desempenho_nome, desempenho_mes, desempenho_ano, desempenho_media, desempenho_data) values (null, 'INACOM', '$mes', '$ano', '$media_pond_dpto', '$data')";
            mysqli_query($db, $query);
        }
        
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $media_actual = $row['desempenho_media'];
            $query = "SELECT desempenho_media FROM tb_desempenho WHERE (desempenho_nome='DEETI' || desempenho_nome='DACA' || desempenho_nome='DFM' || desempenho_nome='DEGER' || desempenho_nome='DEC' || desempenho_nome='DRMSU' || desempenho_nome='DRHTI' || desempenho_nome='DRHTI') AND desempenho_mes='$mes' AND desempenho_ano='$ano' AND desempenho_media>0";
            $result2 = mysqli_query($db, $query);
            
            $media_encontrada = 0;
            $count = 0;
            while($row2 = mysqli_fetch_assoc($result2)){
                $media_encontrada += $row2['desempenho_media'];
                $count++;
            }
            
            $media_encontrada = $media_encontrada/$count;
            if($media_actual != $media_encontrada){
                $query = "update tb_desempenho set desempenho_media=$media_encontrada where desempenho_mes='$mes' and desempenho_ano='$ano' and desempenho_nome = 'INACOM'";
                mysqli_query($db, $query);
            }
        }
    }
}

?>