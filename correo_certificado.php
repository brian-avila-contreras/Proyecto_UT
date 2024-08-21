<?php
// Iniciar el búfer de salida
ob_start();

// Importar clases de PHPMailer al espacio global
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require('fpdf/fpdf.php');

// Crear una instancia de FPDF y generar el PDF
$pdf = new FPDF();
$pdf->AddPage("landscape", "letter"); // aquí entran dos parámetros (orientación, tamaño)
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(0);
$pdf->SetRightMargin(0);
$pdf->AliasNbPages(); // muestra la página actual y el total de páginas
$pdf->Image('img/certificado.png', 0, 0, 280, 210.59, 'png');
$sbs='Sebastian Polo Molina';
// nombre del usuario al cual se le entrega el certificado
$pdf->SetFont('TIMES', 'BI', 22);
$pdf->SetXY(68, 103);
$pdf->Cell(150, 10, utf8_decode($sbs), 0, 1, 'C', 0);

// nombre del programa por el cual se certifica
$pdf->SetFont('TIMES', 'B', 18);
$pdf->SetXY(70, 131);
$pdf->Cell(150, 5, utf8_decode('La firma de abogados del presidente nayid bukele'), 0, 1, 'C', 0);

// nombre del administrador de la dependencia
$pdf->SetFont('TIMES', 'B', 12);
$pdf->SetXY(29, 158);
$pdf->MultiCell(50, 5, utf8_decode('Brian Julian Avila Contreras'), 0, 'C', 0);

// cargo del administrador de la dependencia
$pdf->SetFont('ARIAL', 'B', 10);
$pdf->SetXY(20, 170);
$pdf->MultiCell(65, 5, utf8_decode('Aspirante a Programador'), 0, 'C', 0);

// firma de la Jefa de Talento Humano
$pdf->SetFont('TIMES', 'B', 12);
$pdf->SetXY(108, 158);
$pdf->MultiCell(50, 5, utf8_decode('Sebastian Polo'), 0, 'C', 0);

// cargo de la Jefa de Talento Humano
$pdf->SetFont('ARIAL', 'B', 10);
$pdf->SetXY(101, 170);
$pdf->MultiCell(65, 5, utf8_decode('Un muy buen abogado.'), 0, 'C', 0);

// Guardar el PDF en una ubicación temporal
$pdfFilePath = $sbs.'_certificado.pdf';
$pdf->Output($pdfFilePath, 'F');

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                        // Desactivar salida de depuración
    $mail->isSMTP();                                            // Enviar usando SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Establecer el servidor SMTP
    $mail->SMTPAuth   = true;                                   // Habilitar autenticación SMTP
    $mail->Username   = 'bjavilac@ut.edu.co';                   // Nombre de usuario SMTP
    $mail->Password   = 'igoyjarmddxicnws';                     // Contraseña SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Habilitar cifrado TLS implícito
    $mail->Port       = 465;                                    // Puerto TCP para conectarse

    // Destinatarios
    $mail->setFrom('bjavilac@ut.edu.co', 'Brian Avila');
    $mail->addAddress('bricont1605@gmail.com', 'Sebastian Polo');     // Añadir un destinatario
    $sb = 'Sebastian Polo ';
    // Adjuntar el PDF generado
    $mail->addAttachment($pdfFilePath);

    // Contenido del correo
    $mail->isHTML(true);                                  // Establecer formato de correo a HTML
    $mail->Subject = 'Certificación inducción Univeridad del Tolima';
    $mail->Body    = 'Hola, ' . $sb . ', adjunto encontrarás tu certificado.';
    $mail->CharSet = 'UTF-8';

    // Enviar el correo
    $mail->send();
    // Eliminar el archivo PDF temporal
    unlink($pdfFilePath);
    // Limpiar el búfer y mostrar mensaje de éxito
    ob_end_clean();
    echo "<script type='text/javascript'>
    alert('Mensaje enviado correctamente');
    window.location.href = 'index.php';
    </script>";
} catch (Exception $e) {
    // Limpiar el búfer y mostrar mensaje de error
    ob_end_clean();
    echo "<script type='text/javascript'>
    alert('El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}');
    window.location.href = 'index.php';
    </script>";
}
?>
