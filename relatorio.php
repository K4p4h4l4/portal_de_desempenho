<?php
    include("./fpdf/fpdf.php");
    include("./includes/conexao.php");
    //$con = mysqli_connect('localhost','root','');
    //mysqli_select_db($con, 'avaliacao_de_desempenho');
    if(isset($_GET['user'])){
        $ano = $_GET['ano'];
        $mes = $_GET['mes'];
        $query = "select * from tb_av_usuarios where av_ano = '$ano' and av_mes = '{$mes}' and usuario_id='".$_GET['user']."'";
        $query2 = "select * from tb_usuarios where usuario_id='".$_GET['user']."'";
        $result = mysqli_query($db, $query);
        $result2 = mysqli_query($db, $query2);
        $row = mysqli_fetch_array($result);
        $row2 = mysqli_fetch_array($result2);
	$comp_prof = '';
	$dina_ini = '';
	$cumpri_tarefas = '';
	$rel_hum = '';
	$adpt_func = '';

	if(($row['av_competencia_profissional'] >= 13) && ($row['av_competencia_profissional'] <= 17)){
	    $comp_prof = 'Excelente';
	}elseif(($row['av_competencia_profissional'] >= 9) && ($row['av_competencia_profissional'] <= 12)){
	    $comp_prof = 'Bom';
	}elseif(($row['av_competencia_profissional'] >= 5) && ($row['av_competencia_profissional'] <= 8)){
	    $comp_prof = iconv('UTF-8', 'windows-1252', 'Razoável');
	}else{
	    $comp_prof = 'Deficiente';
	}

	if(($row['av_dinamismo_iniciativa'] >= 13) && ($row['av_dinamismo_iniciativa'] <= 15)){
        $dina_ini = 'Excelente';
    }elseif(($row['av_dinamismo_iniciativa'] >= 7) && ($row['av_dinamismo_iniciativa'] <= 12)){
        $dina_ini = 'Bom';
    }elseif(($row['av_dinamismo_iniciativa'] >= 3) && ($row['av_dinamismo_iniciativa'] <= 6)){
        $dina_ini = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $dina_ini = 'Deficiente';
    }

	if(($row['av_cumprimento_tarefa'] >= 13) && ($row['av_cumprimento_tarefa'] <= 17)){
        $cumpri_tarefas = 'Excelente';
    }elseif(($row['av_cumprimento_tarefa'] >= 9) && ($row['av_cumprimento_tarefa'] <= 12)){
        $cumpri_tarefas = 'Bom';
    }elseif(($row['av_cumprimento_tarefa'] >= 13) && ($row['av_cumprimento_tarefa'] <= 8)){
        $cumpri_tarefas = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $cumpri_tarefas = 'Deficiente';
    }

	if(($row['av_rel_hum_trab'] >= 13) && ($row['av_rel_hum_trab'] <= 15)){
        $rel_hum = 'Excelente';
    }elseif(($row['av_rel_hum_trab'] >= 7) && ($row['av_rel_hum_trab'] <= 9)){
        $rel_hum = 'Bom';
    }elseif(($row['av_rel_hum_trab'] >= 3) && ($row['av_rel_hum_trab'] <= 6)){
        $rel_hum = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $rel_hum = 'Deficiente';
    }

	if(($row['av_adpt_func'] >= 13) && ($row['av_adpt_func'] <= 16)){
        $adpt_func = 'Excelente';
    }elseif(($row['av_adpt_func'] >= 9) && ($row['av_adpt_func'] <= 12)){
        $adpt_func = 'Bom';
    }elseif(($row['av_adpt_func'] >= 4) && ($row['av_adpt_func'] <= 8)){
        $adpt_func = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $adpt_func = 'Deficiente';
    }

	if(($row['av_assiduidade'] >= 8) && ($row['av_assiduidade'] <= 10)){
        $ass = 'Excelente';
    }elseif(($row['av_assiduidade'] >= 4) && ($row['av_assiduidade'] <= 7)){
        $ass = 'Bom';
    }elseif(($row['av_assiduidade'] >= 1) && ($row['av_assiduidade'] <= 3)){
        $ass = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $ass = 'Deficiente';
    }

	if(($row['av_pontualidade'] >= 8) && ($row['av_pontualidade'] <= 10)){
        $pont = 'Excelente';
    }elseif(($row['av_pontualidade'] >= 4) && ($row['av_pontualidade'] <= 7)){
        $pont = 'Bom';
    }elseif(($row['av_pontualidade'] >= 1) && ($row['av_pontualidade'] <= 3)){
        $pont = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $pont = 'Deficiente';
    }

	if(($row['av_disciplina'] >= 13) && ($row['av_disciplina'] <= 15)){
        $disc = 'Excelente';
    }elseif(($row['av_disciplina'] >= 10) && ($row['av_disciplina'] <= 12)){
        $disc = 'Bom';
    }elseif(($row['av_disciplina'] >= 4) && ($row['av_disciplina'] <= 9)){
        $disc = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $disc = 'Deficiente';
    }
	
	if(($row['av_uso_correcto_equip'] >= 13) && ($row['av_uso_correcto_equip'] <= 17)){
            $uso_equip = 'Excelente';
        }elseif(($row['av_uso_correcto_equip'] >= 10) && ($row['av_uso_correcto_equip'] <= 12)){
            $uso_equip = 'Bom';
        }elseif(($row['av_uso_correcto_equip'] >= 4) && ($row['av_uso_correcto_equip'] <= 9)){
            $uso_equip = iconv('UTF-8', 'windows-1252', 'Razoável');
        }else{
            $uso_equip= 'Deficiente';
        }

	if(($row['av_apresentacao_compostura'] >= 8) && ($row['av_apresentacao_compostura'] <= 10)){
        $apr_comp = 'Excelente';
    }elseif(($row['av_apresentacao_compostura'] >= 4) && ($row['av_apresentacao_compostura'] <= 7)){
        $apr_comp = 'Bom';
    }elseif(($row['av_apresentacao_compostura'] >= 1) && ($row['av_apresentacao_compostura'] <= 3)){
        $apr_comp = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $apr_comp = 'Deficiente';
    }

	if(($row['av_reuniao_mat'] >= 8) && ($row['av_reuniao_mat'] <= 10)){
        $r_mat = 'Excelente';
    }elseif(($row['av_reuniao_mat'] >= 4) && ($row['av_reuniao_mat'] <= 7)){
        $r_mat = 'Bom';
    }elseif(($row['av_reuniao_mat'] >= 2) && ($row['av_reuniao_mat'] <= 3)){
        $r_mat = iconv('UTF-8', 'windows-1252', 'Razoável');
    }else{
        $r_mat = 'Deficiente';
    }

	if(($row['av_reuniao_op'] >= 8) && ($row['av_reuniao_op'] <= 10)){
            $r_op = 'Excelente';
        }elseif(($row['av_reuniao_op'] >= 4) && ($row['av_reuniao_op'] <= 7)){
            $r_op = 'Bom';
        }elseif(($row['av_reuniao_op'] >= 2) && ($row['av_reuniao_op'] <= 3)){
            $r_op = iconv('UTF-8', 'windows-1252', 'Razoável');
        }else{
            $r_op = 'Deficiente';
        }
    } 
    
    $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage();
    //A4 width : 219mm
    //default margin : 10mm each side
    //writable horizontal : 219-(10*2) = 199

    //class myPDF extends FPDF{
        //unction header(){
            // horizontal positioning, vertical positioning and width
            
            $pdf->Image('./imagens/logoRed.png',10,6,50);
            
            //Set font to arial, bold, 17pt
            $pdf->SetFont('Arial','B',17);
            // SetFillColor(0-255, 0-255, 0-255) formato RGB
            $pdf->SetFillColor(192,192,192);
            //Rect(Starting point na horizontal, starting point na vertical,width,cell heght,)
            $pdf->Rect(57, 14, 160,20, 'F'); 
            $pdf->Cell(220,30,iconv('UTF-8', 'windows-1252', 'Avaliação de Desempenho do Colaborador'),0,0,'C');
            $pdf->Ln(50);
            
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(45,10,'Departamento:',1,0,'L');
            $pdf->Cell(145,10, $row2['usuario_departamento'],1,1,'C');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(45,10,'Nome do Colaborador:',1,0,'L');
            $pdf->Cell(145,10,  iconv('UTF-8', 'windows-1252', $row2['usuario_nome'].' '.$row2['usuario_sobrenome']),1,1,'C');
            $pdf->Cell(45,10,'Categoria:',1,0,'L');
            $pdf->Cell(80,10,  iconv('UTF-8', 'windows-1252', $row2['categoria']),1,0,'C');
            $pdf->Cell(35,10,iconv('UTF-8', 'windows-1252', 'Mês de avaliação: '),1,0,'L');
            $pdf->Cell(30,10,$row['av_mes'].' / '.$row['av_ano'],1,1,'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(100,10,iconv('UTF-8', 'windows-1252', 'Parâmetro'),1,0,'C');
            $pdf->Cell(60,10,'Resultados',1,0,'C');
            $pdf->Cell(30,10,iconv('UTF-8', 'windows-1252', 'Pontuação'),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 110.3, 190,2, 'F');
            $pdf->Ln(2);
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(10,7,'1',1,0,'C');
            $pdf->Cell(90,7,iconv('UTF-8', 'windows-1252', 'Competência profissional'),1,0,'L');
	    $pdf->Cell(60,7,$comp_prof,1,0,'C');
            $pdf->Cell(30,7, number_format($row['av_competencia_profissional']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 119.3, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'2',1,0,'C');
            $pdf->Cell(90,7,'Dinamismo e iniciativa',1,0,'L');
	    $pdf->Cell(60,7,$dina_ini,1,0,'C');
            $pdf->Cell(30,7, number_format($row['av_dinamismo_iniciativa']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 128.7, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'3',1,0,'C');
            $pdf->Cell(90,7,'Cumprimento das tarefas',1,0,'L');
	    $pdf->Cell(60,7,$cumpri_tarefas,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_cumprimento_tarefa']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 138.3, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'4',1,0,'C');
            $pdf->Cell(90,7,iconv('UTF-8', 'windows-1252', 'Relações humanas no trabalho'),1,0,'L');
	    $pdf->Cell(60,7,$rel_hum,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_rel_hum_trab']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 147.7, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'5',1,0,'C');
            $pdf->Cell(90,7,iconv('UTF-8', 'windows-1252', 'Adaptação a função'),1,0,'L');
	    $pdf->Cell(60,7,$adpt_func,1,0,'C');
            $pdf->Cell(30,7, number_format($row['av_adpt_func']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 157.3, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'6',1,0,'C');
            $pdf->Cell(90,7,'Assiduidade',1,0,'L');
	    $pdf->Cell(60,7,$ass,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_assiduidade']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 166.7, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'7',1,0,'C');
            $pdf->Cell(90,7,'Pontualidade',1,0,'L');
	    $pdf->Cell(60,7,$pont,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_pontualidade']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 176.3, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'8',1,0,'C');
            $pdf->Cell(90,7,'Disciplina',1,0,'L');
	    $pdf->Cell(60,7,$disc,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_disciplina']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 185.7, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'9',1,0,'C');
            $pdf->Cell(90,7,'Uso correcto dos equipamentos',1,0,'L');
	    $pdf->Cell(60,7,$uso_equip,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_uso_correcto_equip']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 195.3, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'10',1,0,'C');
            $pdf->Cell(90,7,iconv('UTF-8', 'windows-1252', 'Apresentação e compostura'),1,0,'L');
	    $pdf->Cell(60,7,$apr_comp,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_apresentacao_compostura']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 204.7, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'11',1,0,'C');
            $pdf->Cell(90,7,iconv('UTF-8', 'windows-1252', 'Presenças nos Briefings matinais'),1,0,'L');
	    $pdf->Cell(60,7,$r_mat,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_reuniao_mat']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 214.3, 190,2, 'F');
            $pdf->Ln(2.5);
            $pdf->Cell(10,7,'12',1,0,'C');
            $pdf->Cell(90,7,iconv('UTF-8', 'windows-1252', 'Participação nas reuniões operacionais'),1,0,'L');
	    $pdf->Cell(60,7,$r_op,1,0,'C');
            $pdf->Cell(30,7,number_format($row['av_reuniao_op']),1,1,'C');
            $pdf->SetFillColor(192,192,192);
            $pdf->Rect(10, 223.7, 190,2, 'F');
            $pdf->Ln(2.5);
            //$pdf->SetFont('Arial','B',11);
            //$pdf->Cell(160,7,iconv('UTF-8', 'windows-1252', 'Pontuação Obtida: '),1,0,'R');
            //$pdf->Cell(30,7,number_format($row['media_total']),1,1,'C');
            $pdf->SetFont('Arial','B',11);
            $pdf->Cell(160,7,iconv('UTF-8', 'windows-1252', 'Média Final: '),1,0,'R');
            $pdf->Cell(30,7,number_format($row['media_ponderada'])."%",1,1,'C');
            // Position at 1.5 cm from bottom
            $pdf->SetY(-40);
            // Arial italic 8
            $pdf->SetFont('Arial','I',8);
            // Page number
            $pdf->Cell(0,10,'Page '.$pdf->PageNo(),0,0,'C');
            $pdf->Ln(40);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(190,8,iconv('UTF-8', 'windows-1252', 'Faltas do mês anterior'),1,1,'C');
            $pdf->SetFont('Arial','I',10);
            $pdf->Cell(95,8,'Justificadas',1,0,'C');
            $pdf->Cell(95,8,'Injustificadas',1,1,'C');
            $pdf->Cell(95,8,number_format($row['faltas_justificadas']),1,0,'C');
            $pdf->Cell(95,8,number_format($row['faltas_injustificadas']),1,1,'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(190,8,iconv('UTF-8', 'windows-1252', 'Observações'),1,1,'C');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(190,16, iconv('UTF-8', 'windows-1252', $row['obs']),1,1,'C');
            $pdf->Ln(20);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(95,8,'O Administrador(a) de Pelouro:',0,0,'L');
            $pdf->Cell(95,8,'Homologado Exmo. PCA do INACOM Leonel Augusto:',0,1,'L');
            $pdf->Ln(1);
            $pdf->Cell(90,30, '',1,0,'C');
            $pdf->Cell(5,30, '',0,0,'C');
            $pdf->Cell(90,30, '',1,1,'C');
            $pdf->Ln(100);
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(110,7,'O Avaliado:________________________________',0,0,'L');
            $pdf->Cell(80,7,'      Data      : ______/______/______',1,1,'L');
            $pdf->Ln(5.5);
            $pdf->Cell(110,7,'O Avaliador:________________________________',0,0,'L');
            $pdf->Cell(80,7,'      Data      : ______/______/______',1,1,'L');
            // Position at 1.5 cm from bottom
            $pdf->SetY(-40);
            // Arial italic 8
            $pdf->SetFont('Arial','I',8);
            // Page number
            $pdf->Cell(0,10,'Page '.$pdf->PageNo(),0,0,'C');
        //}
    //}

    //$pdf = new myPDF();
    //$pdf->AliasNbPages();
    //$pdf->addPage('P','A4',0);
    $pdf->Output();

?>
