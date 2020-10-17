<?php 
//AddPage(orientção[PORTRAIT, LANDSCAPE], tamanho[A3, A4, LETTER, LEGAL]),
//SetFont(tipo[COURIER, HELVETICA, ARIAL, TIMES, SYMBOL, ZAPDINGBATS], estilo[normal, B, I, U], tamanho),
//Cell(ancho, altura, texto, bordes, ?, alineaction, rellenar, link),
//OutPut(destino[I, D, F, S], nome_do_arquivo, utf8);
//$fpdf->Image(rotação, posiçãoX, posiçãoY, largura, altura, tipo, link)

require('../includes/conexao.php');
require('../fpdf/fpdf.php');
//$fpdf = new FPDF();
//$fpdf->AddPage('portrait','A4');

class pdf extends FPDF{
    
    public function header(){
        $this->Image('../imagens/logoRed.png', 6, 2, 30, '', 'png');
        $this->Cell(0, 0, '', 0, 1);
    }
    
    public function footer(){
        $this->SetFont('Arial', '', 8);
        $this->SetY(-20);
        $this->Cell(0, 5, utf8_decode('INACOM - Instituto Angolano das Comunicações'), 0, 0, 'C');
        $this->SetY(-16);
        $this->Cell(0, 5, utf8_decode('Avenida Dr. António Agostinho Neto, nº 25. Zona C, Praia do Bispo'), 0, 0, 'C');
        $this->SetY(-12);
        $this->Cell(0, 5, utf8_decode('Tel: +244 222 210 666 | Fax: +244 222 210 670'), 0, 0, 'C');
        $this->SetY(-8);
        $this->Cell(0, 5, utf8_decode('Cx. Postal, 1459 - Luanda - Angola'), 0, 0, 'C');
        $this->SetX(174);
        $this->AliasNbPages('tpagina');
        $this->Write(5, $this->PageNo().'/tpagina');
        
    }
}

$reportDpto='';
$nome='';
$sobrenome='';
$tarefa_nome ='';
$tarefa_status ='';
$data = '';
if(isset($_GET['reportDpto']) && isset($_GET['reportType']) && isset($_GET['reportTime'])){
    $reportDpto = $_GET['reportDpto'];
    $reportType = $_GET['reportType'];
    $reportTime = $_GET['reportTime'];
    
    $query = 'SELECT usuario_nome, usuario_sobrenome FROM `tb_usuarios` WHERE usuario_departamento="'.$reportDpto.'" AND usuario_tipo="chefe" ';
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $nome = $row['usuario_nome'];
    $sobrenome = $row['usuario_sobrenome'];
    $data = date('d-m-Y');
}

$fpdf = new pdf();
$fpdf->AddPage('portrait','A4');
$fpdf->SetMargins(10, 30, 20, 20);
$fpdf->SetFont('Arial', 'B', 14);
$fpdf->SetY(30);
$fpdf->SetTextColor(16, 87, 97);
$fpdf->Cell(0, 5, 'Lista de tarefas', 0,1, 'C');
$fpdf->SetDrawColor(61, 174, 233);
$fpdf->SetLineWidth(1.2);
$fpdf->Line(70, 37, 130, 37);
$fpdf->SetTextColor(0, 0, 0);
$fpdf->Ln(8);
$fpdf->SetDrawColor(0, 0, 0);
$fpdf->SetLineWidth(0);
$fpdf->SetFont('Arial','B',11);
$fpdf->Cell(50,8,'Departamento:',1,0,'L');
$fpdf->SetFont('Arial','',11);
$fpdf->Cell(140,8, $reportDpto, 1,1,'C');
$fpdf->SetFont('Arial','B',11);
$fpdf->Cell(50,8,'Chefe de Departamento:',1,0,'L');
$fpdf->SetFont('Arial','',11);
$fpdf->Cell(140,8,  iconv('UTF-8', 'windows-1252', $nome.' '.$sobrenome),1,1,'C');
$fpdf->SetFont('Arial','B',11);
$fpdf->Cell(50,8,'Data:',1,0,'L');
$fpdf->SetFont('Arial','',11);
$fpdf->Cell(140,8,  iconv('UTF-8', 'windows-1252', $data),1,1,'C');
$fpdf->Ln(10);

$fpdf->SetFillColor(255, 255, 255);// 44, 127, 189 //11, 63, 71
$fpdf->SetTextColor(40, 40, 40);
//$fpdf->SetDrawColor(88, 88, 88);
$fpdf->SetFont('Arial','B',10);
$fpdf->Cell(50,8,iconv('UTF-8', 'windows-1252', 'Técnico'), 0, 0, 'C', 1);
$fpdf->SetFont('Arial','B',10);
$fpdf->Cell(100,8,  iconv('UTF-8', 'windows-1252', 'Tarefas'), 0, 0, 'C', 1);
$fpdf->SetFont('Arial','B',10);
$fpdf->Cell(40,8,  iconv('UTF-8', 'windows-1252', 'Status'), 0, 1, 'C', 1);
$fpdf->SetDrawColor(61, 174, 233);
$fpdf->SetLineWidth(1);
$fpdf->Line(10, 84, 200, 84);
$fpdf->Ln(3);


$fpdf->SetFillColor(240, 240, 240);
$fpdf->SetDrawColor(255, 255, 255);
$fpdf->SetTextColor(40, 40, 40);
$fpdf->SetLineWidth(0.2);
$fpdf->SetFont('Arial','',9);

if($reportType ==='tarefas'){
    $query = 'SELECT tb_usuarios.usuario_nome, tb_usuarios.usuario_sobrenome, tb_tarefas.tarefa_nome, tb_tarefas.tarefa_status FROM tb_usuarios INNER JOIN tb_tarefas INNER JOIN tb_membrostpc WHERE tb_usuarios.usuario_tipo="tecnico" AND tb_usuarios.usuario_departamento="'.$reportDpto.'" AND (tb_tarefas.tarefa_status="Em curso" OR tb_tarefas.tarefa_status="Em revisao") AND tb_usuarios.usuario_id=tb_membrostpc.membroTPC_uid AND tb_tarefas.tarefa_id=tb_membrostpc.membroTPC_tid';
}

$result = mysqli_query($db, $query);

while($row = mysqli_fetch_assoc($result)){
    $nome = $row['usuario_nome'];
    $sobrenome = $row['usuario_sobrenome'];
    $tarefa_nome = $row['tarefa_nome'];
    $tarefa_status = $row['tarefa_status'];
    $fpdf->Cell(50,8,iconv('UTF-8', 'windows-1252', $nome.' '.$sobrenome ),1,0,'L', 1);
    $fpdf->Cell(100,8,  iconv('UTF-8', 'windows-1252', $tarefa_nome),1,0,'L', 1);
    $fpdf->Cell(40,8,  iconv('UTF-8', 'windows-1252', $tarefa_status),1,1,'L', 1);
}

$fpdf->Output('I', 'Lista de Actividades.pdf');

?>