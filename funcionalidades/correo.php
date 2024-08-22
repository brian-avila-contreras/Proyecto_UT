<?php
$to="bjulian1605@gmail.com";
$subject="prueba de correo";
$message="este es un correo con xampp";
$headers='From: bjavilac@ut.edu.co'."\r\n". 
'Reply-To: bjavilac@ut.edu.co';

if(mail($to,$subject,$message,$headers)){
    echo "el correo enviado a $to fue exitoso";
}else{
    echo "el correo no se pudo enviar";
}
?>