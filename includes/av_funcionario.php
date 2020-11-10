<?php
    include("./conexao.php");

    $ano = date("Y");
    $mes = date("m");
    $med_pond = 0;
    $med_pond_compt = 0;
    $med_pond_din_ini = 0;
    $med_pond_cump_tpc = 0;
    $med_pond_rel_hum = 0;
    $med_pond_adpt_func = 0;
    $med_pond_disc = 0;
    $med_pond_uso_correcto_equip = 0;
    $med_pond_apr_comp = 0;
    $med_pond_ro = 0;
    $med_pond_rm = 0;
    $med_pond_assid = 0;
    $med_pond_pont = 0;
    $currentDay = date('d');
    
    if($currentDay <= 10){   
        $proper_mes = date('m', strtotime($ano.' - 1 months'));
    }elseif($currentDay >= 20){
        $proper_mes = date('m', strtotime($ano));
    }

    /* Verifica se o id do funcionário esta set */
    if(isset($_GET["funcionario"])){
        $med_pond = 0;
        $usuario_id = $_GET['funcionario'];
        $query = "select * from tb_usuarios where usuario_id = '$usuario_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $usuario_media_geral = $row['usuario_media_geral'];
        $query = "select * from tb_av_usuarios where av_ano = '$ano' and av_mes = '$proper_mes' and usuario_id = '$usuario_id'";
        $result2 = mysqli_query($db, $query);
        $row2 = mysqli_fetch_assoc($result2);
        $av_compt_prof = $row2['av_competencia_profissional'];
        $media_pond_result = $row2['media_ponderada'];
        
        if(($row['categoria'] == 'Técnico(a) Superior 2 ª Classe') || ($row['categoria'] == 'Técnico(a) Médio(a) 3 ª Classe') || ($row['categoria'] == 'Técnico(a) Médio(a) Principal de 1 ª Classe') || ($row['categoria'] == 'Técnico(a) Médio(a) Principal de 2 ª Classe') || ($row['categoria'] == 'Técnico(a) Médio(a) Principal de 3 ª Classe')){
            
            /* Média ponderada de Competência profissional */
            if(($_GET["compt_prof"] >= 16) && ($_GET["compt_prof"] <= 17)){
                if($_GET["compt_prof"] == 17 ){
                    $med_pond_compt = 7;
                }elseif($_GET["compt_prof"] == 16 ){
                    $med_pond_compt = 6.475;
                }
            }elseif(($_GET["compt_prof"]>=13) && ($_GET["compt_prof"] <= 15)){
                if($_GET["compt_prof"] == 15 ){
                    $med_pond_compt = 5.95;
                }elseif($_GET["compt_prof"] == 14 ){
                    $med_pond_compt = 5.366666666666666;
                }elseif($_GET["compt_prof"] == 13 ){
                    $med_pond_compt = 4.783333333333333;
                }
            }
            elseif(($_GET["compt_prof"] >= 8) && ($_GET["compt_prof"] <= 12)){
                if($_GET["compt_prof"] == 12 ){
                    $med_pond_compt = 4.2;
                }elseif($_GET["compt_prof"] == 11 ){
                    $med_pond_compt = 3.78;
                }elseif($_GET["compt_prof"] == 10 ){
                    $med_pond_compt = 3.36;
                }elseif($_GET["compt_prof"] == 9 ){
                    $med_pond_compt = 2.94;
                }elseif($_GET["compt_prof"] == 8 ){
                    $med_pond_compt = 2.52;
                }
            }elseif(($_GET["compt_prof"] >= 0) && ($_GET["compt_prof"] <= 7)){
                if($_GET["compt_prof"] == 7 ){
                    $med_pond_compt = 2.1;
                }elseif($_GET["compt_prof"] == 6 ){
                    $med_pond_compt = 1.8;
                }elseif($_GET["compt_prof"] == 5 ){
                    $med_pond_compt = 1.5;
                }elseif($_GET["compt_prof"] == 4 ){
                    $med_pond_compt = 1.2;
                }elseif($_GET["compt_prof"] == 3 ){
                    $med_pond_compt = 0.9;
                }elseif($_GET["compt_prof"] == 2 ){
                    $med_pond_compt = 0.6;
                }elseif($_GET["compt_prof"] == 1 ){
                    $med_pond_compt = 0.3; //0.3 0.3
                }elseif($_GET["compt_prof"] == 0 ){
                    $med_pond_compt = 0;
                }
            }
            
            /* Média ponderada de Dinamismo e Iniciativa */
            if(($_GET["din_inic"]>=13) && ($_GET["din_inic"]<=15)){
                if($_GET["din_inic"] == 15){
                    $med_pond_din_ini = 7;
                }elseif($_GET["din_inic"] == 14 ){
                    $med_pond_din_ini = 6.65;
                }elseif($_GET["din_inic"] == 13 ){
                    $med_pond_din_ini = 6.3; // 0.35 6.3
                }
            }elseif( ($_GET["din_inic"] >= 7) && ($_GET["din_inic"] <= 12) ){
                if($_GET["din_inic"] == 12){
                    $med_pond_din_ini = 5.95;
                }elseif($_GET["din_inic"] == 11 ){
                    $med_pond_din_ini = 5.6585;
                }elseif($_GET["din_inic"] == 10 ){
                    $med_pond_din_ini = 5.3668;
                }elseif($_GET["din_inic"] == 9 ){
                    $med_pond_din_ini = 5.0751;
                }elseif($_GET["din_inic"] == 8 ){
                    $med_pond_din_ini = 4.7834;
                }elseif($_GET["din_inic"] == 7 ){
                    $med_pond_din_ini = 4.4917; // 0.2917 4.4917
                }
            }
            elseif( ($_GET["din_inic"]>=2) && ($_GET["din_inic"] <= 6) ){
                if($_GET["din_inic"] == 6){
                    $med_pond_din_ini = 4.2;
                }elseif($_GET["din_inic"] == 5 ){
                    $med_pond_din_ini = 3.78;
                }elseif($_GET["din_inic"] == 4 ){
                    $med_pond_din_ini = 3.36;
                }elseif($_GET["din_inic"] == 3 ){
                    $med_pond_din_ini = 2.94;
                }elseif($_GET["din_inic"] == 2 ){
                    $med_pond_din_ini = 2.52; // 0.42 2.52
                }
            }elseif( ($_GET["din_inic"]>=0) && ($_GET["din_inic"]<= 1) ){
                if($_GET["din_inic"] == 1){
                    $med_pond_din_ini = 2.1;
                }elseif($_GET["din_inic"] == 0 ){
                    $med_pond_din_ini = 0;
                }
            }
            
            /* Média ponderada de Cumprimento das Tarefas*/
            if( ($_GET["cump_tarefas"]>=13) && ($_GET["cump_tarefas"] <= 17) ){
                if($_GET["cump_tarefas"]==17){
                    $med_pond_cump_tpc = 7;
                }elseif($_GET["cump_tarefas"]==16){
                     $med_pond_cump_tpc = 6.79;
                }elseif($_GET["cump_tarefas"]==15){
                     $med_pond_cump_tpc = 6.58;
                }elseif($_GET["cump_tarefas"]==14){
                     $med_pond_cump_tpc = 6.37;
                }elseif($_GET["cump_tarefas"]==13){
                     $med_pond_cump_tpc = 6.16; //0.21 6.76
                }
            }elseif( ($_GET["cump_tarefas"]>=9) && ($_GET["cump_tarefas"]<=12) ){
                if($_GET["cump_tarefas"]==12){
                    $med_pond_cump_tpc = 5.95;
                }elseif($_GET["cump_tarefas"]==11){
                     $med_pond_cump_tpc = 5.5125;
                }elseif($_GET["cump_tarefas"]==10){
                     $med_pond_cump_tpc = 5.075;
                }elseif($_GET["cump_tarefas"]==9){
                     $med_pond_cump_tpc = 4.6375; //0.4375 4.6375
                }
            }
            elseif( ($_GET["cump_tarefas"]>=2) && ($_GET["cump_tarefas"]<=8) ){
                if($_GET["cump_tarefas"]==8){
                    $med_pond_cump_tpc = 4.2;
                }elseif($_GET["cump_tarefas"]==7){
                     $med_pond_cump_tpc = 3.9;
                }elseif($_GET["cump_tarefas"]==6){
                     $med_pond_cump_tpc = 3.6;
                }elseif($_GET["cump_tarefas"]==5){
                     $med_pond_cump_tpc = 3.3;
                }elseif($_GET["cump_tarefas"]==4){
                     $med_pond_cump_tpc = 3;
                }elseif($_GET["cump_tarefas"]==3){
                     $med_pond_cump_tpc = 2.7;
                }elseif($_GET["cump_tarefas"]==2){
                     $med_pond_cump_tpc = 2.4; //0.3 2.1
                }
                
            }elseif( ($_GET["cump_tarefas"]>=0) && ($_GET["cump_tarefas"]<=1) ){
                if($_GET["cump_tarefas"]==1){
                    $med_pond_cump_tpc = 2.1;
                }elseif($_GET["cump_tarefas"]==0){
                     $med_pond_cump_tpc = 0;
                }
            }
            
            /* Média ponderada de Relações Humanas no Trabalho */
            if( ($_GET["rel_hum_trab"]>=10) && ($_GET["rel_hum_trab"]<=15) ){
                if($_GET["rel_hum_trab"]==15){
                    $med_pond_rel_hum = 7;
                }elseif($_GET["rel_hum_trab"]==14){
                    $med_pond_rel_hum = 6.825;
                }elseif($_GET["rel_hum_trab"]==13){
                    $med_pond_rel_hum = 6.65;
                }elseif($_GET["rel_hum_trab"]==12){
                    $med_pond_rel_hum = 6.475;
                }elseif($_GET["rel_hum_trab"]==11){
                    $med_pond_rel_hum = 6.3;
                }elseif($_GET["rel_hum_trab"]==10){
                    $med_pond_rel_hum = 6.125; //0.175 6.125
                }
            }elseif( ($_GET["rel_hum_trab"]>=7) && ($_GET["rel_hum_trab"]<=9)){
                if($_GET["rel_hum_trab"]==9){
                    $med_pond_rel_hum = 5.95;
                }elseif($_GET["rel_hum_trab"]==8){
                    $med_pond_rel_hum = 5.36666;
                }elseif($_GET["rel_hum_trab"]==7){
                    $med_pond_rel_hum = 4.783333;    //0.58333 
                }
            }
            elseif( ($_GET["rel_hum_trab"]>=1) && ($_GET["rel_hum_trab"]<=6) ){
                if($_GET["rel_hum_trab"]==6){
                    $med_pond_rel_hum = 4.2;
                }elseif($_GET["rel_hum_trab"]==5){
                    $med_pond_rel_hum = 3.5;
                }elseif($_GET["rel_hum_trab"]==4){
                    $med_pond_rel_hum = 2.8;
                }elseif($_GET["rel_hum_trab"]==3){
                    $med_pond_rel_hum = 2.1;
                }elseif($_GET["rel_hum_trab"]==2){
                    $med_pond_rel_hum = 1.4;
                }elseif($_GET["rel_hum_trab"]==1){
                    $med_pond_rel_hum = 0.7; //0.7 0.7
                }
            }elseif($_GET["rel_hum_trab"]==0){
                $med_pond_rel_hum = 0;
            }
            
            /* Média ponderada de Adpatação a função*/
            if(($_GET["adpt_func"]>=13) && ($_GET["adpt_func"]<=16) ){
                if($_GET["adpt_func"]==16){
                    $med_pond_adpt_func = 7;
                }elseif($_GET["adpt_func"]==15){
                    $med_pond_adpt_func = 6.7375;
                }elseif($_GET["adpt_func"]==14){
                    $med_pond_adpt_func = 6.475;
                }elseif($_GET["adpt_func"]==13){
                    $med_pond_adpt_func = 6.2125; //0,2625 6.2125
                }
            }elseif(($_GET["adpt_func"]>=9) && ($_GET["adpt_func"]<=12)){
                if($_GET["adpt_func"]==12){
                    $med_pond_adpt_func = 5.95;
                }elseif($_GET["adpt_func"]==11){
                    $med_pond_adpt_func = 5.5125;
                }elseif($_GET["adpt_func"]==10){
                    $med_pond_adpt_func = 5.075;
                }elseif($_GET["adpt_func"]==9){
                    $med_pond_adpt_func = 4.6375; //0,4375 4.6375
                }
            }
            elseif(($_GET["adpt_func"]>=1) && ($_GET["adpt_func"]<=8)){
                if($_GET["adpt_func"]==8){
                    $med_pond_adpt_func = 4.2;
                }elseif($_GET["adpt_func"]==7){
                    $med_pond_adpt_func = 3.675;
                }elseif($_GET["adpt_func"]==6){
                    $med_pond_adpt_func = 3.15;
                }elseif($_GET["adpt_func"]==5){
                    $med_pond_adpt_func = 2.625;
                }elseif($_GET["adpt_func"]==4){
                    $med_pond_adpt_func = 2.1;
                }elseif($_GET["adpt_func"]==3){
                    $med_pond_adpt_func = 1.575;
                }elseif($_GET["adpt_func"]==2){
                    $med_pond_adpt_func = 1.05;
                }elseif($_GET["adpt_func"]==1){
                    $med_pond_adpt_func = 0.525; //0,525 0.525
                }
            }elseif($_GET["adpt_func"]==0){
                $med_pond_adpt_func = 0;
            }
            
            /* Média ponderada de Disciplina */
            if(($_GET["disc"]>=13) && ($_GET["disc"]<=15)){
                if($_GET["disc"] == 15){
                    $med_pond_disc = 7;
                }elseif($_GET["disc"] == 14 ){
                    $med_pond_disc = 6.65;
                }elseif($_GET["disc"] == 13 ){
                    $med_pond_disc = 6.3; // 0.35 6.3
                }
            }elseif(($_GET["disc"]>=10) && ($_GET["disc"]<=12)){
                if($_GET["disc"] == 12){
                    $med_pond_disc = 5.95;
                }elseif($_GET["disc"] == 11 ){
                    $med_pond_disc = 5.36666;
                }elseif($_GET["disc"] == 10 ){
                    $med_pond_disc = 4.78333; // 0.583333 4.78333
                }
            }
            elseif(($_GET["disc"]>=1) && ($_GET["disc"]<=9)){
                if($_GET["disc"] == 9){
                    $med_pond_disc = 4.2;
                }elseif($_GET["disc"] == 8 ){
                    $med_pond_disc = 3.733334;
                }elseif($_GET["disc"] == 7 ){
                    $med_pond_disc = 3.26667;
                }elseif($_GET["disc"] == 6 ){
                    $med_pond_disc = 2.8;
                }elseif($_GET["disc"] == 5 ){
                    $med_pond_disc = 2.33334;
                }elseif($_GET["disc"] == 4 ){
                    $med_pond_disc = 1.86667;
                }elseif($_GET["disc"] == 3 ){
                    $med_pond_disc = 1.4;
                }elseif($_GET["disc"] == 2 ){
                    $med_pond_disc = 0.93333;
                }elseif($_GET["disc"] == 1 ){
                    $med_pond_disc = 0.4667; // 0.4667 0.4667
                }
            }elseif($_GET["disc"]==0){
                $med_pond_disc = 0;
            }
            
            /* Média ponderada de Uso Correcto de Equipamentos */
            if(($_GET["uso_correcto_equip"]>=13) && ($_GET["uso_correcto_equip"]<=17)){
                if($_GET["uso_correcto_equip"]==17){
                    $med_pond_uso_correcto_equip = 7;
                }elseif($_GET["uso_correcto_equip"]==16){
                     $med_pond_uso_correcto_equip = 6.79;
                }elseif($_GET["uso_correcto_equip"]==15){
                     $med_pond_uso_correcto_equip = 6.58;
                }elseif($_GET["uso_correcto_equip"]==14){
                     $med_pond_uso_correcto_equip = 6.37;
                }elseif($_GET["uso_correcto_equip"]==13){
                     $med_pond_uso_correcto_equip = 6.16; //0.21 6.76
                }
            }elseif(($_GET["uso_correcto_equip"]>=10) && ($_GET["uso_correcto_equip"]<=12)){
                if($_GET["uso_correcto_equip"] == 12){
                    $med_pond_uso_correcto_equip = 5.95;
                }elseif($_GET["uso_correcto_equip"] == 11 ){
                    $med_pond_uso_correcto_equip = 5.36666;
                }elseif($_GET["uso_correcto_equip"] == 10 ){
                    $med_pond_uso_correcto_equip = 4.78333; // 0.583333 4.78333
                }
            }
            elseif(($_GET["uso_correcto_equip"]>=1) && ($_GET["uso_correcto_equip"]<=9)){
                if($_GET["uso_correcto_equip"] == 9){
                    $med_pond_uso_correcto_equip = 4.2;
                }elseif($_GET["uso_correcto_equip"] == 8 ){
                    $med_pond_uso_correcto_equip = 3.733334;
                }elseif($_GET["uso_correcto_equip"] == 7 ){
                    $med_pond_uso_correcto_equip = 3.26667;
                }elseif($_GET["uso_correcto_equip"] == 6 ){
                    $med_pond_uso_correcto_equip = 2.8;
                }elseif($_GET["uso_correcto_equip"] == 5 ){
                    $med_pond_uso_correcto_equip = 2.33334;
                }elseif($_GET["uso_correcto_equip"] == 4 ){
                    $med_pond_uso_correcto_equip = 1.86667;
                }elseif($_GET["uso_correcto_equip"] == 3 ){
                    $med_pond_uso_correcto_equip = 1.4;
                }elseif($_GET["uso_correcto_equip"] == 2 ){
                    $med_pond_uso_correcto_equip = 0.93333;
                }elseif($_GET["uso_correcto_equip"] == 1 ){
                    $med_pond_uso_correcto_equip = 0.4667; // 0.4667 0.4667
                }
            }elseif($_GET["uso_correcto_equip"]==0){
                $med_pond_uso_correcto_equip = 0;
            }
            
            /* Média ponderada de Apresentação e Compostura */
            if(($_GET["apr_comp"]>=8) && ($_GET["apr_comp"]<=10)){
                if($_GET["apr_comp"] == 10){
                    $med_pond_apr_comp = 7;
                }elseif($_GET["apr_comp"] == 9 ){
                    $med_pond_apr_comp = 6.65;
                }elseif($_GET["apr_comp"] == 8 ){
                    $med_pond_apr_comp = 6.3; // 0.35 6.3
                }
            }elseif(($_GET["apr_comp"]>=4) && ($_GET["apr_comp"]<=7)){
                if($_GET["apr_comp"]==7){
                    $med_pond_apr_comp = 5.95;
                }elseif($_GET["apr_comp"]==6){
                    $med_pond_apr_comp = 5.5125;
                }elseif($_GET["apr_comp"]==5){
                    $med_pond_apr_comp = 5.075;
                }elseif($_GET["apr_comp"]==4){
                    $med_pond_apr_comp = 4.6375; //0,4375 4.6375
                }
            }
            elseif(($_GET["apr_comp"]>=1) && ($_GET["apr_comp"]<=3)){
                if($_GET["apr_comp"]==3){
                    $med_pond_apr_comp = 4.2;
                }elseif($_GET["apr_comp"]==2){
                    $med_pond_apr_comp = 2.8;
                }elseif($_GET["apr_comp"]==1){
                    $med_pond_apr_comp = 1.4;
                }
            }elseif($_GET["apr_comp"]==0){
                $med_pond_apr_comp = 0;
            }
            
            /* Média ponderada de Reuniões Operacionais*/
            if(($_GET["ro"]>=8) && ( $_GET["ro"]<=10)){
                if($_GET["ro"] == 10){
                    $med_pond_ro = 7;
                }elseif($_GET["ro"] == 9 ){
                    $med_pond_ro = 6.65;
                }elseif($_GET["ro"] == 8 ){
                    $med_pond_ro = 6.3; // 0.35 6.3
                }
            }elseif(($_GET["ro"]>=4) && ($_GET["ro"]<=7)){
                if($_GET["ro"]==7){
                    $med_pond_ro = 5.95;
                }elseif($_GET["ro"]==6){
                    $med_pond_ro = 5.5125;
                }elseif($_GET["ro"]==5){
                    $med_pond_ro = 5.075;
                }elseif($_GET["ro"]==4){
                    $med_pond_ro = 4.6375; //0,4375 4.6375
                }
            }
            elseif(($_GET["ro"]>=1) && ($_GET["ro"]<=3) ){
                if($_GET["ro"]==3){
                    $med_pond_ro = 4.2;
                }elseif($_GET["ro"]==2){
                    $med_pond_ro = 2.8;
                }elseif($_GET["ro"]==1){
                    $med_pond_ro = 1.4;
                }
            }elseif($_GET["ro"]==0){
                $med_pond_ro = 0;
            }
            
            /* Média ponderada de Briefings matinais*/
            if(($_GET["rm"]>=8) && ($_GET["rm"]<=10)){
                if($_GET["rm"] == 10){
                    $med_pond_rm = 7;
                }elseif($_GET["rm"] == 9 ){
                    $med_pond_rm = 6.65;
                }elseif($_GET["rm"] == 8 ){
                    $med_pond_rm = 6.3; // 0.35 6.3
                }
                $med_pond_rm = 7;
            }elseif(($_GET["rm"]>=4) && ($_GET["rm"]<=7)){
                if($_GET["rm"]==7){
                    $med_pond_rm = 5.95;
                }elseif($_GET["rm"]==6){
                    $med_pond_rm = 5.5125;
                }elseif($_GET["rm"]==5){
                    $med_pond_rm = 5.075;
                }elseif($_GET["rm"]==4){
                    $med_pond_rm = 4.6375; //0,4375 4.6375
                }
            }
            elseif(($_GET["rm"]>=1) && ($_GET["rm"]<=3)){
                if($_GET["rm"]==3){
                    $med_pond_rm = 4.2;
                }elseif($_GET["rm"]==2){
                    $med_pond_rm = 2.8;
                }elseif($_GET["rm"]==1){
                    $med_pond_rm = 1.4;
                }
            }elseif($_GET["rm"]==0){
                $med_pond_rm = 0;
            }
            

            $compt_prof = $_GET["compt_prof"];
            $din_inic = $_GET["din_inic"];
            $cump_tarefas = $_GET["cump_tarefas"];
            $rel_hum_trab = $_GET["rel_hum_trab"];
            $adpt_func = $_GET["adpt_func"];
            $disc = $_GET["disc"];
            $uso_correcto_equip = $_GET["uso_correcto_equip"];
            $apr_comp = $_GET["apr_comp"];
            $ro = $_GET["ro"];
            $rm = $_GET["rm"];
            $media_total = $_GET['total'];
            $obs = $_GET["obs"];
        
            if(mysqli_num_rows($result2) == 0 ){
                
                $media_pond = $med_pond_compt + $med_pond_din_ini + $med_pond_cump_tpc + $med_pond_rel_hum + $med_pond_adpt_func + $med_pond_disc + $med_pond_uso_correcto_equip + $med_pond_apr_comp + $med_pond_ro + $med_pond_rm;
                
                $query = "insert into tb_av_usuarios (id, av_ano, av_mes, usuario_id, av_competencia_profissional, av_dinamismo_iniciativa, av_cumprimento_tarefa, av_rel_hum_trab, av_adpt_func, av_disciplina, av_uso_correcto_equip, av_apresentacao_compostura, av_reuniao_mat, av_reuniao_op, media_total, media_ponderada, obs) values (null, YEAR(CURDATE()), '$proper_mes', '$usuario_id', '$compt_prof', '$din_inic', '$cump_tarefas', '$rel_hum_trab', '$adpt_func', '$disc', '$uso_correcto_equip', '$apr_comp', '$rm', '$ro', '$media_total', '$media_pond', '$obs')";
                mysqli_query($db, $query);
              
                
            }elseif(mysqli_num_rows($result2) == 1){
                
                if($media_pond_result <= 30){
                    $media_pond = $media_pond_result + $med_pond_compt + $med_pond_din_ini + $med_pond_cump_tpc + $med_pond_rel_hum + $med_pond_adpt_func + $med_pond_disc + $med_pond_uso_correcto_equip + $med_pond_apr_comp + $med_pond_ro + $med_pond_rm;
                    
                }elseif($media_pond_result > 30){
                    $query = "select av_assiduidade, av_pontualidade from tb_av_usuarios where av_ano = YEAR(CURDATE()) and av_mes = '$proper_mes' and usuario_id = '$usuario_id'";
                    
                    $result3 = mysqli_query($db, $query);
                    $row3 = mysqli_fetch_assoc($result3);
                    
                    $ass = $row3['av_assiduidade'];
                    $pont = $row3['av_pontualidade'];
                    
                    
                    /* Média ponderada de Assiduidade*/
                    if(($ass>=8) && ($ass<=10)){
                        if($ass==10){
                            $med_pond_assid = 15;
                        }elseif($ass==9){
                             $med_pond_assid = 14;
                        }elseif($ass==8){
                             $med_pond_assid = 13;
                        }
                    }elseif(($ass>=4) && ($ass<=7)){
                        if($ass==7){
                            $med_pond_assid = 12;
                        }elseif($ass==6){
                             $med_pond_assid = 10.5;
                        }elseif($ass==5){
                             $med_pond_assid = 9;
                        }elseif($ass==4){
                             $med_pond_assid = 7.5;      //1.5  7.5
                        }
                    }
                    elseif(($ass>=1) && ($ass<=3)){
                        if($ass==3){
                            $med_pond_assid = 6;
                        }elseif($ass==2){
                             $med_pond_assid = 4;
                        }elseif($ass==1){
                             $med_pond_assid = 2;    //4 4
                        }
                    }elseif($ass==0){
                        $med_pond_assid = 0;
                    }

                    /* Média ponderada de Pontualidade*/
                    if(($pont>=1) && ($pont<=10)){
                        if($pont==10){
                            $med_pond_pont = 15;
                        }elseif($pont==9){
                             $med_pond_pont = 14;
                        }elseif($pont==8){
                             $med_pond_pont = 13;
                        }
                    }elseif(($pont>=1) && ($pont <= 7)){
                        if($pont==7){
                            $med_pond_pont = 12;
                        }elseif($pont==6){
                             $med_pond_pont = 10.5;
                        }elseif($pont==5){
                             $med_pond_pont = 9;
                        }elseif($pont==4){
                             $med_pond_pont = 7.5;      //1.25  13.25
                        }
                    }
                    elseif(($pont>=1) && ($pont <= 3)){
                        if($pont==3){
                            $med_pond_pont = 6;
                        }elseif($pont==2){
                             $med_pond_pont = 4;
                        }elseif($pont==1){
                             $med_pond_pont = 2;       //4 4
                        }
                    }elseif($pont==0){
                        $med_pond_pont = 0;
                    }
                    
                    $media_pond = $med_pond_compt + $med_pond_din_ini + $med_pond_cump_tpc + $med_pond_rel_hum + $med_pond_adpt_func + $med_pond_disc + $med_pond_uso_correcto_equip + $med_pond_apr_comp + $med_pond_ro + $med_pond_rm + $med_pond_assid + $med_pond_pont;
                }
                
                $query = "update tb_av_usuarios set av_competencia_profissional = '$compt_prof', av_dinamismo_iniciativa = '$din_inic', av_cumprimento_tarefa = '$cump_tarefas', av_rel_hum_trab = '$rel_hum_trab', av_adpt_func = '$adpt_func', av_disciplina = '$disc', av_uso_correcto_equip = '$uso_correcto_equip', av_apresentacao_compostura = '$apr_comp', av_reuniao_op = '$ro', av_reuniao_mat = '$rm', media_total = '$media_total', media_ponderada = '$media_pond', obs = '$obs' where av_ano = YEAR(CURDATE()) and av_mes = '$proper_mes' and usuario_id = '$usuario_id'";
                mysqli_query($db, $query);
            }
        }else{
            
            /* Média ponderada de Competência profissional */
            if(($_GET["compt_prof"]>=13) && ($_GET["compt_prof"]<=17)){
                if($_GET["compt_prof"]==17){
                    $med_pond_compt = 10;
                }elseif($_GET["compt_prof"]==16){
                     $med_pond_compt = 9.7;
                }elseif($_GET["compt_prof"]==15){
                     $med_pond_compt = 9.4;
                }elseif($_GET["compt_prof"]==14){
                     $med_pond_compt = 9.1;
                }elseif($_GET["compt_prof"]==13){
                     $med_pond_compt = 8.8; //0.3 6.76
                }
            }elseif(($_GET["compt_prof"]>=6) && ($_GET["compt_prof"]<=12)){
                if($_GET["compt_prof"]==12){
                    $med_pond_compt = 8.5;
                }elseif($_GET["compt_prof"]==11){
                     $med_pond_compt = 8.142857;
                }elseif($_GET["compt_prof"]==10){
                     $med_pond_compt = 7.785714;
                }elseif($_GET["compt_prof"]==9){
                     $med_pond_compt = 7.428571;
                }elseif($_GET["compt_prof"]==8){
                     $med_pond_compt = 7.071429;
                }elseif($_GET["compt_prof"]==7){
                     $med_pond_compt = 6.714286;
                }elseif($_GET["compt_prof"]==6){
                     $med_pond_compt = 6.357143; //0.357143 6.76
                }
            }
            elseif(($_GET["compt_prof"]>=1) && ($_GET["compt_prof"]<=5)){
                if($_GET["compt_prof"]==5){
                    $med_pond_compt = 6;
                }elseif($_GET["compt_prof"]==4){
                     $med_pond_compt = 4.8;
                }elseif($_GET["compt_prof"]==3){
                     $med_pond_compt = 3.6;
                }elseif($_GET["compt_prof"]==2){
                     $med_pond_compt = 2.4;
                }elseif($_GET["compt_prof"]==1){
                     $med_pond_compt = 1.2;
                }
            }elseif($_GET["compt_prof"]==0){
                $med_pond_compt = 0;
            }
            
            
            /* Média ponderada de Cumprimento das Tarefas*/
            if(($_GET["cump_tarefas"]>=13) && ($_GET["cump_tarefas"]<=17)){
                if($_GET["cump_tarefas"]==17){
                    $med_pond_cump_tpc = 10;
                }elseif($_GET["cump_tarefas"]==16){
                     $med_pond_cump_tpc = 9.7;
                }elseif($_GET["cump_tarefas"]==15){
                     $med_pond_cump_tpc = 9.4;
                }elseif($_GET["cump_tarefas"]==14){
                     $med_pond_cump_tpc = 9.1;
                }elseif($_GET["cump_tarefas"]==13){
                     $med_pond_cump_tpc = 8.8; //0.3 6.76
                }
            }elseif(($_GET["cump_tarefas"]>=9) && ($_GET["cump_tarefas"]<=12)){
                if($_GET["cump_tarefas"]==12){
                    $med_pond_cump_tpc = 8.5;
                }elseif($_GET["cump_tarefas"]==11){
                     $med_pond_cump_tpc = 7.875;
                }elseif($_GET["cump_tarefas"]==10){
                     $med_pond_cump_tpc = 7.25;
                }elseif($_GET["cump_tarefas"]==9){
                     $med_pond_cump_tpc = 6.625; //0.625 6.625
                }
            }
            elseif(($_GET["cump_tarefas"]>=1) && ($_GET["cump_tarefas"]<=8)){
                if($_GET["cump_tarefas"]==8){
                    $med_pond_cump_tpc = 6;
                }elseif($_GET["cump_tarefas"]==7){
                     $med_pond_cump_tpc = 5.25;
                }elseif($_GET["cump_tarefas"]==6){
                     $med_pond_cump_tpc = 4.5;
                }elseif($_GET["cump_tarefas"]==5){
                     $med_pond_cump_tpc = 3.75; 
                }elseif($_GET["cump_tarefas"]==4){
                     $med_pond_cump_tpc = 3; 
                }elseif($_GET["cump_tarefas"]==3){
                     $med_pond_cump_tpc = 2.25; 
                }elseif($_GET["cump_tarefas"]==2){
                     $med_pond_cump_tpc = 1.5; 
                }elseif($_GET["cump_tarefas"]==1){
                     $med_pond_cump_tpc = 0.75; //0.75 6.625
                }
            }elseif($_GET["cump_tarefas"]==0){
                $med_pond_cump_tpc = 0;
            }
            
            /* Média ponderada de Relações Humanas no Trabalho */
            if(($_GET["rel_hum_trab"]>=10) && ( $_GET["rel_hum_trab"]<=15)){
                if($_GET["rel_hum_trab"]==15){
                    $med_pond_rel_hum = 10;
                }elseif($_GET["rel_hum_trab"]==14){
                     $med_pond_rel_hum = 9.75;
                }elseif($_GET["rel_hum_trab"]==13){
                     $med_pond_rel_hum = 9.5;
                }elseif($_GET["rel_hum_trab"]==12){
                     $med_pond_rel_hum = 9.25; 
                }elseif($_GET["rel_hum_trab"]==11){
                     $med_pond_rel_hum = 9; 
                }elseif($_GET["rel_hum_trab"]==10){
                     $med_pond_rel_hum = 8.75; //0.25 8.75
                }
            }elseif(($_GET["rel_hum_trab"]>=7) && ($_GET["rel_hum_trab"]<=9)){
                if($_GET["rel_hum_trab"]==9){
                    $med_pond_rel_hum = 8.5;
                }elseif($_GET["rel_hum_trab"]==8){
                     $med_pond_rel_hum = 7.6667;
                }elseif($_GET["rel_hum_trab"]==7){
                     $med_pond_rel_hum = 6.833334; //0.83333
                }
            }
            elseif(($_GET["rel_hum_trab"]>=1) && ( $_GET["rel_hum_trab"]<=6)){
                if($_GET["rel_hum_trab"]==6){
                    $med_pond_rel_hum = 6;
                }elseif($_GET["rel_hum_trab"]==5){
                     $med_pond_rel_hum = 5;
                }elseif($_GET["rel_hum_trab"]==4){
                     $med_pond_rel_hum = 4;
                }elseif($_GET["rel_hum_trab"]==3){
                     $med_pond_rel_hum = 3; 
                }elseif($_GET["rel_hum_trab"]==2){
                     $med_pond_rel_hum = 2; 
                }elseif($_GET["rel_hum_trab"]==1){
                     $med_pond_rel_hum = 1; //1 1
                }
            }elseif($_GET["rel_hum_trab"]==0){
                $med_pond_rel_hum = 0;
            }
            
            /* Média ponderada de Adpatação a função*/
            if(($_GET["adpt_func"]>=13) && ($_GET["adpt_func"]<=16)){
                if($_GET["adpt_func"]==16){
                    $med_pond_adpt_func = 10;
                }elseif($_GET["adpt_func"]==15){
                     $med_pond_adpt_func = 9.625;
                }elseif($_GET["adpt_func"]==14){
                     $med_pond_adpt_func = 9.25;
                }elseif($_GET["adpt_func"]==13){
                     $med_pond_adpt_func = 8.875; //0.375 8.875
                }
            }elseif(($_GET["adpt_func"]>=9) && ($_GET["adpt_func"]<=12)){
                if($_GET["adpt_func"]==12){
                    $med_pond_adpt_func = 8.5;
                }elseif($_GET["adpt_func"]==11){
                     $med_pond_adpt_func = 7.875;
                }elseif($_GET["adpt_func"]==10){
                     $med_pond_adpt_func = 7.25;
                }elseif($_GET["adpt_func"]==9){
                     $med_pond_adpt_func = 6.625; //0.625 8.875
                }
            }
            elseif(($_GET["adpt_func"]>=1) && ($_GET["adpt_func"]<=8)){
                if($_GET["adpt_func"]==8){
                    $med_pond_adpt_func = 6;
                }elseif($_GET["adpt_func"]==7){
                     $med_pond_adpt_func = 5.25;
                }elseif($_GET["adpt_func"]==6){
                     $med_pond_adpt_func = 4.5;
                }elseif($_GET["adpt_func"]==5){
                     $med_pond_adpt_func = 3.75; 
                }elseif($_GET["adpt_func"]==4){
                     $med_pond_adpt_func = 3; 
                }elseif($_GET["adpt_func"]==3){
                     $med_pond_adpt_func = 2.25; 
                }elseif($_GET["adpt_func"]==2){
                     $med_pond_adpt_func = 1.5; 
                }elseif($_GET["adpt_func"]==1){
                     $med_pond_adpt_func = 0.75; //0.75 6.625
                }
            }elseif($_GET["adpt_func"]==0){
                $med_pond_adpt_func = 0;
            }
            
            /* Média ponderada de Uso Correcto de Equipamentos */
            if(($_GET["uso_correcto_equip"]>=13) && ($_GET["uso_correcto_equip"]<=17)){
                if($_GET["uso_correcto_equip"]==17){
                    $med_pond_uso_correcto_equip = 10;
                }elseif($_GET["uso_correcto_equip"]==16){
                     $med_pond_uso_correcto_equip = 9.7;
                }elseif($_GET["uso_correcto_equip"]==15){
                     $med_pond_uso_correcto_equip = 9.4;
                }elseif($_GET["uso_correcto_equip"]==14){
                     $med_pond_uso_correcto_equip = 9.1;
                }elseif($_GET["uso_correcto_equip"]==13){
                     $med_pond_uso_correcto_equip = 8.8; //0.3 6.76
                }
            }elseif(($_GET["uso_correcto_equip"]>=10) && ($_GET["uso_correcto_equip"]<=12)){
                if($_GET["uso_correcto_equip"]==12){
                    $med_pond_uso_correcto_equip = 8.5;
                }elseif($_GET["uso_correcto_equip"]==11){
                     $med_pond_uso_correcto_equip = 7.6667;
                }elseif($_GET["uso_correcto_equip"]==10){
                     $med_pond_uso_correcto_equip = 6.833334; //0.83333
                }
            }
            elseif(($_GET["uso_correcto_equip"]>=1) && ($_GET["uso_correcto_equip"]<=9)){
                if($_GET["uso_correcto_equip"]==9){
                    $med_pond_uso_correcto_equip = 6;
                }elseif($_GET["uso_correcto_equip"]==8){
                     $med_pond_uso_correcto_equip = 9.7;
                }elseif($_GET["uso_correcto_equip"]==7){
                     $med_pond_uso_correcto_equip = 9.4;
                }elseif($_GET["uso_correcto_equip"]==6){
                     $med_pond_uso_correcto_equip = 9.1;
                }elseif($_GET["uso_correcto_equip"]==5){
                     $med_pond_uso_correcto_equip = 8.8; 
                }elseif($_GET["uso_correcto_equip"]==4){
                     $med_pond_uso_correcto_equip = 8.8; 
                }elseif($_GET["uso_correcto_equip"]==3){
                     $med_pond_uso_correcto_equip = 8.8;
                }elseif($_GET["uso_correcto_equip"]==2){
                     $med_pond_uso_correcto_equip = 8.8;
                }elseif($_GET["uso_correcto_equip"]==1){
                     $med_pond_uso_correcto_equip = 0.666667; //0.666667‬ 0.666667‬
                } 
            }elseif($_GET["uso_correcto_equip"]==0){
                $med_pond_uso_correcto_equip = 0;
            }
            
            /* Média ponderada de Reuniões Operacionais*/
            if(($_GET["ro"]>=8) && ($_GET["ro"]<=10)){
                if($_GET["ro"]==10){
                    $med_pond_ro = 10;
                }elseif($_GET["ro"]==9){
                     $med_pond_ro = 9.5;
                }elseif($_GET["ro"]==8){
                     $med_pond_ro = 9;
                }
            }elseif(($_GET["ro"]>=4) && ($_GET["ro"]<=7)){
                if($_GET["ro"]==7){
                    $med_pond_ro = 8.5;
                }elseif($_GET["ro"]==6){
                     $med_pond_ro = 7.875;
                }elseif($_GET["ro"]==5){
                     $med_pond_ro = 7.25;
                }elseif($_GET["ro"]==4){
                     $med_pond_ro = 6.625;  // .625 6.625 
                }
            }
            elseif(($_GET["ro"]>=1) && ($_GET["ro"]<=3)){
                if($_GET["ro"]==3){
                    $med_pond_ro = 6;
                }elseif($_GET["ro"]==2){
                     $med_pond_ro = 4;
                }elseif($_GET["ro"]==1){
                     $med_pond_ro = 2;
                }
            }elseif($_GET["ro"]==0){
                $med_pond_ro = 0;
            }
            
            /* Média ponderada de Briefings matinais*/
            if(($_GET["rm"]>=8) && ($_GET["rm"]<=10)){
                if($_GET["rm"]==10){
                    $med_pond_rm = 10;
                }elseif($_GET["rm"]==9){
                     $med_pond_rm = 9.5;
                }elseif($_GET["rm"]==8){
                     $med_pond_rm = 9;
                }
            }elseif(($_GET["rm"]>=4) && ($_GET["rm"]<=7)){
                if($_GET["rm"]==7){
                    $med_pond_rm = 8.5;
                }elseif($_GET["rm"]==6){
                     $med_pond_rm = 7.875;
                }elseif($_GET["rm"]==5){
                     $med_pond_rm = 7.25;
                }elseif($_GET["rm"]==4){
                     $med_pond_rm = 6.625;  // .625 6.625 
                }
            }
            elseif(($_GET["rm"]>=1) && ($_GET["rm"]<=3)){
                if($_GET["rm"]==3){
                    $med_pond_rm = 6;
                }elseif($_GET["rm"]==2){
                     $med_pond_rm = 4;
                }elseif($_GET["rm"]==1){
                     $med_pond_rm = 2;
                }
            }elseif($_GET["rm"]==0){
                $med_pond_rm = 0;
            }
            
            $usuario_id = $_GET['funcionario'];
            $compt_prof = $_GET["compt_prof"];
            $cump_tarefas = $_GET["cump_tarefas"];
            $adpt_func = $_GET["adpt_func"];
            $uso_correcto_equip = $_GET["uso_correcto_equip"];
            $rel_hum_trab = $_GET["rel_hum_trab"];
            $ro = $_GET["ro"];
            $rm = $_GET["rm"];
            $media_total = $_GET['total'];
            $obs = $_GET["obs"];

            if(mysqli_num_rows($result2) == 0){
                
                        $media_pond = $media_pond_result + $med_pond_compt + $med_pond_cump_tpc + $med_pond_rel_hum + $med_pond_adpt_func + $med_pond_uso_correcto_equip + $med_pond_ro + $med_pond_rm;
                
                        $query = "insert into tb_av_usuarios (id, av_ano, av_mes, usuario_id, av_competencia_profissional, av_cumprimento_tarefa, av_rel_hum_trab, av_adpt_func, av_uso_correcto_equip, av_reuniao_mat, av_reuniao_op, media_total, media_ponderada, obs) values (null, YEAR(CURDATE()), '$proper_mes', '$usuario_id', '$compt_prof', '$cump_tarefas', '$rel_hum_trab', '$adpt_func', '$uso_correcto_equip', '$rm', '$ro', '$media_total', '$media_pond', '$obs')";
                        mysqli_query($db, $query);
                
            }elseif(mysqli_num_rows($result2) == 1){
                
                if($media_pond_result <= 30){
                    $media_pond = $media_pond_result + $med_pond_compt + $med_pond_din_ini + $med_pond_cump_tpc + $med_pond_rel_hum + $med_pond_adpt_func + $med_pond_disc + $med_pond_uso_correcto_equip + $med_pond_apr_comp + $med_pond_ro + $med_pond_rm;
                    
                }elseif($media_pond_result > 30){
                    $query = "select av_assiduidade, av_pontualidade from tb_av_usuarios where av_ano = YEAR(CURDATE()) and av_mes = '$proper_mes' and usuario_id = '$usuario_id'";
                    
                    $result3 = mysqli_query($db, $query);
                    $row3 = mysqli_fetch_assoc($result3);
                    
                    $ass = $row3['av_assiduidade'];
                    $pont = $row3['av_pontualidade'];
                    
                    
                    /* Média ponderada de Assiduidade*/
                    if(($ass>=8) && ($ass<=10)){
                        if($ass==10){
                            $med_pond_assid = 15;
                        }elseif($ass==9){
                             $med_pond_assid = 14;
                        }elseif($ass==8){
                             $med_pond_assid = 13;
                        }
                    }elseif(($ass>=4) && ($ass<=7)){
                        if($ass==7){
                            $med_pond_assid = 12;
                        }elseif($ass==6){
                             $med_pond_assid = 10.5;
                        }elseif($ass==5){
                             $med_pond_assid = 9;
                        }elseif($ass==4){
                             $med_pond_assid = 7.5;      //1.5  7.5
                        }
                    }
                    elseif(($ass>=1) && ($ass<=3)){
                        if($ass==3){
                            $med_pond_assid = 6;
                        }elseif($ass==2){
                             $med_pond_assid = 4;
                        }elseif($ass==1){
                             $med_pond_assid = 2;    //4 4
                        }
                    }elseif($ass==0){
                        $med_pond_assid = 0;
                    }

                    /* Média ponderada de Pontualidade*/
                    if(($pont>=1) && ($pont<=10)){
                        if($pont==10){
                            $med_pond_pont = 15;
                        }elseif($pont==9){
                             $med_pond_pont = 14;
                        }elseif($pont==8){
                             $med_pond_pont = 13;
                        }
                    }elseif(($pont>=1) && ($pont <= 7)){
                        if($pont==7){
                            $med_pond_pont = 12;
                        }elseif($pont==6){
                             $med_pond_pont = 10.5;
                        }elseif($pont==5){
                             $med_pond_pont = 9;
                        }elseif($pont==4){
                             $med_pond_pont = 7.5;      //1.25  13.25
                        }
                    }
                    elseif(($pont>=1) && ($pont <= 3)){
                        if($pont==3){
                            $med_pond_pont = 6;
                        }elseif($pont==2){
                             $med_pond_pont = 4;
                        }elseif($pont==1){
                             $med_pond_pont = 2;       //4 4
                        }
                    }elseif($pont==0){
                        $med_pond_pont = 0;
                    }
                    
                    $media_pond = $med_pond_compt + $med_pond_din_ini + $med_pond_cump_tpc + $med_pond_rel_hum + $med_pond_adpt_func + $med_pond_disc + $med_pond_uso_correcto_equip + $med_pond_apr_comp + $med_pond_ro + $med_pond_rm;
                }
                
                $query = "update tb_av_usuarios set av_competencia_profissional = '$compt_prof', av_cumprimento_tarefa = '$cump_tarefas', av_rel_hum_trab = '$rel_hum_trab', av_adpt_func = '$adpt_func', av_uso_correcto_equip = 'uso_correcto_equip', av_reuniao_op = '$ro', av_reuniao_mat = '$rm', media_total = '$media_total', media_ponderada = '$media_pond', obs = '$obs' where av_ano = YEAR(CURDATE()) and av_mes = '$proper_mes' and usuario_id = '$usuario_id'";
                mysqli_query($db, $query);
            }
        }    
    }

    if(isset($_GET['assiduidade'])){
        $usuario_id = $_GET['usuario_id'];
        $ass = $_GET['assiduidade'];
        $pont = $_GET['pontualidade'];
        $faltas_injustificadas = $_GET["faltas_injustificadas"];
        $faltas_justificadas = $_GET["faltas_justificadas"];
        
        $query = "select * from tb_av_usuarios where av_ano = '$ano' and av_mes = '$proper_mes' and usuario_id = '$usuario_id'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        
        $as = $row['av_assiduidade'];
        $pon = $row['av_pontualidade'];
        $media_pond_result = $row['media_ponderada'];
	    $existe = count($row); 
        
        $query = "select * from tb_usuarios where usuario_id = '$usuario_id'";
        $result = mysqli_query($db, $query);
        $row2 = mysqli_fetch_assoc($result);
        $usuario_media_geral = $row2['usuario_media_geral'];
        
        if( ($row2['categoria'] == 'Técnico(a) Superior 2 ª Classe') || ($row2['categoria'] == 'Técnico(a) Médio(a) 3 ª Classe') || ($row2['categoria'] == 'Técnico(a) Médio(a) Principal de 1 ª Classe') || ($row2['categoria'] == 'Técnico(a) Médio(a) Principal de 2 ª Classe') || ($row2['categoria'] == 'Técnico(a) Médio(a) Principal de 3 ª Classe') ){
            
            /* Média ponderada de Assiduidade*/
            if(($_GET["assiduidade"]>=8) && ($_GET["assiduidade"]<=10)){
                if($_GET["assiduidade"]==10){
                    $med_pond_assid = 15;
                }elseif($_GET["assiduidade"]==9){
                     $med_pond_assid = 14;
                }elseif($_GET["assiduidade"]==8){
                     $med_pond_assid = 13;
                }
            }elseif(($_GET["assiduidade"]>=4) && ($_GET["assiduidade"]<=7)){
                if($_GET["assiduidade"]==7){
                    $med_pond_assid = 12;
                }elseif($_GET["assiduidade"]==6){
                     $med_pond_assid = 10.5;
                }elseif($_GET["assiduidade"]==5){
                     $med_pond_assid = 9;
                }elseif($_GET["assiduidade"]==4){
                     $med_pond_assid = 7.5;      //1.5  7.5
                }
            }
            elseif(($_GET["assiduidade"]>=1) && ($_GET["assiduidade"]<=3)){
                if($_GET["assiduidade"]==3){
                    $med_pond_assid = 6;
                }elseif($_GET["assiduidade"]==2){
                     $med_pond_assid = 4;
                }elseif($_GET["assiduidade"]==1){
                     $med_pond_assid = 2;    //4 4
                }
            }elseif($_GET["assiduidade"]==0){
                $med_pond_assid = 0;
            }
            
            /* Média ponderada de Pontualidade*/
            if(($_GET["pontualidade"]>=1) && ($_GET["pontualidade"]<=10)){
                if($_GET["pontualidade"]==10){
                    $med_pond_pont = 15;
                }elseif($_GET["pontualidade"]==9){
                     $med_pond_pont = 14;
                }elseif($_GET["pontualidade"]==8){
                     $med_pond_pont = 13;
                }
            }elseif(($_GET["pontualidade"]>=1) && ($_GET["pontualidade"] <= 7)){
                if($_GET["pontualidade"]==7){
                    $med_pond_pont = 12;
                }elseif($_GET["pontualidade"]==6){
                     $med_pond_pont = 10.5;
                }elseif($_GET["pontualidade"]==5){
                     $med_pond_pont = 9;
                }elseif($_GET["pontualidade"]==4){
                     $med_pond_pont = 7.5;      //1.25  13.25
                }
            }
            elseif(($_GET["pontualidade"]>=1) && ($_GET["pontualidade"] <= 3)){
                if($_GET["pontualidade"]==3){
                    $med_pond_pont = 6;
                }elseif($_GET["pontualidade"]==2){
                     $med_pond_pont = 4;
                }elseif($_GET["pontualidade"]==1){
                     $med_pond_pont = 2;       //4 4
                }
            }elseif($_GET["pontualidade"]==0){
                $med_pond_pont = 0;
            }
        }elseif( $row2['categoria'] == 'Auxiliar Administrativo(a)' ){
            /* Média ponderada de Competência profissional */
            if(($_GET["assiduidade"]>=8) && ($_GET["assiduidade"]<=10)){
                if($_GET["assiduidade"]==10){
                    $med_pond_assid = 15;
                }elseif($_GET["assiduidade"]==9){
                     $med_pond_assid = 14.25;
                }elseif($_GET["assiduidade"]==8){
                     $med_pond_assid = 13.5;   //0.75 13.5
                }
            }elseif(($_GET["assiduidade"]>=4) && ($_GET["assiduidade"]<=7)){
                if($_GET["assiduidade"]==7){
                    $med_pond_assid = 12.75;
                }elseif($_GET["assiduidade"]==6){
                     $med_pond_assid = 11.8175;
                }elseif($_GET["assiduidade"]==5){
                     $med_pond_assid = 10.875;   
                }elseif($_GET["assiduidade"]==4){
                     $med_pond_assid = 9.9375;   //0.9375 9.9375
                }
            }
            elseif(($_GET["assiduidade"]>=1) && ($_GET["assiduidade"]<=3)){
                if($_GET["assiduidade"]==3){
                    $med_pond_assid = 9;
                }elseif($_GET["assiduidade"]==2){
                     $med_pond_assid = 6;
                }elseif($_GET["assiduidade"]==1){
                     $med_pond_assid = 3;   
                }
            }elseif($_GET["assiduidade"]==0){
                $med_pond_assid = 0;
            }
            
            
            /* Média ponderada de Cumprimento das Tarefas*/
            if(($_GET["pontualidade"]>=8) && ($_GET["pontualidade"]<=10)){
                if($_GET["pontualidade"]==10){
                    $med_pond_pont = 15;
                }elseif($_GET["pontualidade"]==9){
                     $med_pond_pont = 14.25;
                }elseif($_GET["pontualidade"]==8){
                     $med_pond_pont = 13.5;   //2.416667 15.166667
                }
            }elseif(($_GET["pontualidade"]>=4) && ($_GET["pontualidade"]<=7)){
                if($_GET["pontualidade"]==7){
                    $med_pond_pont = 12.75;
                }elseif($_GET["pontualidade"]==6){
                     $med_pond_pont = 11.8175;
                }elseif($_GET["pontualidade"]==5){
                     $med_pond_pont = 10.875;   
                }elseif($_GET["pontualidade"]==4){
                     $med_pond_pont = 9.9375;   //0.9375 9.9375
                }
            }
            elseif(($_GET["pontualidade"]>=1) && ($_GET["pontualidade"]<=3)){
                if($_GET["pontualidade"]==3){
                    $med_pond_pont = 9;
                }elseif($_GET["pontualidade"]==2){
                     $med_pond_pont = 6;
                }elseif($_GET["pontualidade"]==1){
                     $med_pond_pont = 3;   
                }
            }elseif($_GET["pontualidade"]==0){
                $med_pond_pont = 0;
            }
        }
        
        
        
        if(($as == 0) && ($pon == 0)){
            if($existe == 0){
                    $med_pond = $med_pond_assid + $med_pond_pont;
                    $query = "insert into tb_av_usuarios (id, av_ano, av_mes, usuario_id, av_assiduidade, av_pontualidade, faltas_injustificadas, faltas_justificadas, media_ponderada) values (null, '$ano', '$proper_mes', '$usuario_id', '$ass', '$pont', '$faltas_injustificadas', '$faltas_justificadas', '$med_pond')"; 
                    mysqli_query($db, $query);

                    /*if($usuario_media_geral == 0){
                        $query = "update tb_usuarios set usuario_media_geral = '$med_pond' where usuario_id = '$usuario_id'";

                        mysqli_query($db,$query);
                    }else{
                        $usuario_media_geral = $usuario_media_geral + $med_pond_assid + $med_pond_pont;
                        $query = "update tb_usuarios set usuario_media_geral = '$usuario_media_geral' where usuario_id = '$usuario_id'";
                        mysqli_query($db,$query);
                    }*/
            }elseif($existe > 0){
                    $med_pond = $med_pond_assid + $med_pond_pont + $media_pond_result;
                    $query = "update tb_av_usuarios set av_assiduidade = '$ass', av_pontualidade = '$pont', faltas_injustificadas = '$faltas_injustificadas', faltas_justificadas = '$faltas_justificadas', media_ponderada = '$med_pond' where av_ano = '$ano' and av_mes = '$proper_mes' and usuario_id = '$usuario_id'";         
                    mysqli_query($db, $query);

                    /*if($usuario_media_geral == 0){
                        
                        $query = "update tb_usuarios set usuario_media_geral='$med_pond' where usuario_id = '$usuario_id'";
                        mysqli_query($db,$query);
                        
                    }elseif($usuario_media_geral != 0){
                        
                        
                        $usuario_media_geral = ($usuario_media_geral + $med_pond)/2;
                        $query = "update tb_usuarios set usuario_media_geral='$usuario_media_geral' where usuario_id = '$usuario_id'";
                        mysqli_query($db,$query);
                        
                    }*//*else{
                        $usuario_media_geral = $usuario_media_geral + $med_pond_assid + $med_pond_pont;
                        $query = "update tb_usuarios set usuario_media_geral='$usuario_media_geral' where usuario_id = '$usuario_id'";
                        mysqli_query($db,$query);
                    }*/
            }
        }else{
            echo json_encode(1);
        }
    }
?>
