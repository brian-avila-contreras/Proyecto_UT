
<?php
//Cell(ancho , alto,texto,borde(0/1),salto(0/1),alineacion(L,C,R),rellenar(0/1)
// Cabecera de página
//Numeros de paginas
//SetTextColor(255,255,255);es RGB extraer colores con GIMP
//SetFillColor()
//SetDrawColor()
//Line(derecha-izquierda, arriba-abajo,ancho,arriba-abajo)
//Color line setDrawColor(61,174,233)
//GetX() || GetY() posiciones en cm
//Grosor SetLineWidth(1)
// SetFont(tipo{COURIER, HELVETICA,ARIAL,TIMES,SYMBOL, ZAPDINGBATS}, estilo[normal,B,I ,A], tamaño)
// Cell(ancho , alto,texto,borde(0/1),salto(0/1),alineacion(L,C,R),rellenar(0/1)
//AddPage(orientacion[PORTRAIT, LANDSCAPE], tamño[A3.A4.A5.LETTER,LEGAL],rotacion)
//Image(ruta, poscisionx,pocisiony,alto,ancho,tipo,link)
//SetMargins(10,30,20,20) luego de addpage
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage("landscape", "letter");/* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(0);
$pdf->SetRightMargin(0);
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$pdf->Image('img/certificado.png', 0, 0, 280, 210.59, 'png');



//nombre del usuario al cual se le entrega el certificado
$pdf->SetFont('TIMES', 'BI', 22);
$pdf->SetXY(68, 103);
$pdf->Cell(150, 10, utf8_decode('Brian Julian Avila Contreras'), 0, 1, 'C', 0);

//nombre del programa por el cual se certifica
$pdf->SetFont('TIMES', 'B', 18);
$pdf->SetXY(70, 131);
$pdf->Cell(150, 5, utf8_decode('Licenciatura en lenguas extranjeras con enfasis en ingles'), 0, 1, 'C', 0);

//aqui debe ir el nombre del administrador de la dependenciá
$pdf->SetFont('TIMES', 'B', 12);
$pdf->SetXY(29, 158);
$pdf->MultiCell(50, 5, utf8_decode('maximiliano florentino de las Flores Soverano'), 0, 'C', 0);


//aqui debe ir el Cargo del administrador de la dependenciá
$pdf->SetFont('ARIAL', 'B', 10);
$pdf->SetXY(20, 170);
$pdf->MultiCell(65, 5, utf8_decode('Administrador de la dependencia de Licenciatura en lenguas extrangeras con enfasis en ingles'), 0, 'C', 0);

//aqui debe ir la firma de la Jefa de Talento Humano
$pdf->SetFont('TIMES', 'B', 12);
$pdf->SetXY(108, 158);
$pdf->MultiCell(50, 5, utf8_decode('Yuliet caterine andrade vallejo'), 0, 'C', 0);

//aqui debe ir el cargo de la jefa de talento humano
$pdf->SetFont('ARIAL', 'B', 10);
$pdf->SetXY(101, 170);
$pdf->MultiCell(65, 5, utf8_decode('Jefa de dirección de gestion de talento humano.'), 0, 'C', 0);

$pdf->Output('Prueba2.pdf', 'I');
