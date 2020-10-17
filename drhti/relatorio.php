<?php 

    require "/fpdf/fpdf.php";

    //A4 width : 219mm
    //default margin : 10mm each side
    //writable horizontal : 219-(10*2) = 199
    
    class myPDF extends FPDF{
        function header(){
            $this->Image('./imagens/logoRed.png',10,6);
            
            //Set font to arial, bold, 14pt
            $this->SetFont('Arial','B',14);
            $this->Cell(190,80,'DESEMPENHO DE COLABORADOR',0,0,'C');
            $this->Ln(60);
            $this->SetFont('Times','B',13);
            
            // SetFillColor(0-255, 0-255, 0-255) formato RGB
            $this->SetFillColor(49,140,231);
            //Rect(Starting point na horizontal, starting point na vertical,width,cell heght,)
            $this->Rect(10, 70, 190, 12, 'F'); 
            //cell(width, height, text, border, en line , [align])
            $this->Cell(190,12,'Formmulário Modelo ',1,1,'C');
            
            
            $this->SetFont('Times','B',10);
            $this->SetFillColor(197,212,240);
            $this->Rect(10, 82, 190, 7, 'F');
            $this->Cell(120 ,7,'Nome do Avaliado: ',1,0,'L');
            $this->Cell(70  ,7,'Data de Avaliação: ',1,1,'L');
            $this->SetFillColor(237,243,252);
            $this->Rect(10, 89, 190, 7, 'F');
            $this->Cell(120 ,7,'Cargo: ',1,0,'L');
            $this->Cell(70  ,7,'Departamento: ',1,1,'L');
            $this->SetFillColor(197,212,240);
            $this->Rect(10, 96, 190, 7, 'F');
            $this->Cell(190 ,7,'Nome do Avaliador: ',1,1,'L');
            $this->SetFillColor(128,191,255);
            $this->Rect(10, 103, 190, 10, 'F');
            $this->Cell(53 ,10,'Assiduidade',1,0,'L');
            $this->Cell(25 ,10,'Insuficiente(1)',1,0,'C');
            $this->Cell(22 ,10,'Suficiente(2)',1,0,'C');
            $this->Cell(22 ,10,'Bom(3)',1,0,'C');
            $this->Cell(25 ,10,'Muito Bom(4)',1,0,'C');
            $this->Cell(41 ,10,'Observações',1,1,'C');
            $this->SetFillColor(197,212,240);
            $this->Rect(10, 113, 190, 7, 'F');
            $this->Cell(53 ,7,'Habilidades Técnicas',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(237,243,252);
            $this->Rect(10, 120, 190, 7, 'F');
            $this->Cell(53 ,7,'Resultado do trabalho',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(197,212,240);
            $this->Rect(10, 127, 190, 7, 'F');
            $this->Cell(53 ,7,'Planejamento',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(128,191,255);
            $this->Rect(10, 134, 190, 10, 'F');
            $this->Cell(53 ,10,'Pontualidade',1,0,'L');
            $this->Cell(22 ,10,'',1,0,'C');
            $this->Cell(16 ,10,'',1,0,'C');
            $this->Cell(22 ,10,'',1,0,'C');
            $this->Cell(16 ,10,'',1,0,'C');
            $this->Cell(20 ,10,'',1,0,'C');
            $this->Cell(41 ,10,'',1,1,'C');
            $this->SetFillColor(197,212,240);
            $this->Rect(10, 144, 190, 7, 'F');
            $this->Cell(53 ,7,'Adaptação com a org.',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(237,243,252);
            $this->Rect(10, 151, 190, 7, 'F');
            $this->Cell(53 ,7,'Capacidade de análise',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(197,212,240);
            $this->Rect(10, 158, 190, 7, 'F');
            $this->Cell(53 ,7,'Comunicação',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(237,243,252);
            $this->Rect(10, 165, 190, 7, 'F');
            $this->Cell(53 ,7,'Trabalho em equipe',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(197,212,240);
            $this->Rect(10, 172, 190, 7, 'F');
            $this->Cell(53 ,7,'Iniciativa',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(237,243,252);
            $this->Rect(10, 179, 190, 7, 'F');
            $this->Cell(53 ,7,'Trabalho em equipe',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->SetFillColor(197,212,240);
            $this->Rect(10, 186, 190, 7, 'F');
            $this->Cell(53 ,7,'Relacionamento interpessoal',1,0,'L');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(22 ,7,'',1,0,'C');
            $this->Cell(16 ,7,'',1,0,'C');
            $this->Cell(20 ,7,'',1,0,'C');
            $this->Cell(41 ,7,'',1,1,'C');
            $this->Cell(129,10,'TOTAL = ',1,0,'R');
            $this->Cell(61 ,10,'',1,1,'C');
        }
        
        function footer(){
            
        }
    }

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->addPage('P','A4',0);
    $pdf->Output();

?>
