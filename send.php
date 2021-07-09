<?php
    // Este archivo lee el archivo de texto, parsea el contenido y lo envía

    $to = 'lab_retail@outstudio.co';
    // $to = 'juulio@gmail.com';
    // $to      = 'electronicateccr@gmail.com';
    $subject = 'Envío de e-mails de PHP';
    $message = 'Hola php';

    $headers = "Reply-To: The Sender <lab_retail@outstudio.co>\r\n";
    // $headers .= "Return-Path: The Sender <sender@sender.com>\r\n";
    $headers .= "From: Retail App OUT Studio <lab_retail@outstudio.co>\r\n";
    $headers .= "Organization: Organization\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

    $result = mail($to, $subject, $message, $headers);

    if(!$result) {   
        echo "Error";   
    } else {
        echo "Success" . PHP_EOL . PHP_EOL;
    }
?>