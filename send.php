<?php
    // $to      = 'lab_retail@outstudio.co';
    $to      = 'electronicateccr@gmail.com';
    $subject = 'Envío de e-mails de PHP';
    $message = 'Hola Luis. Este e-mail se envió desde mi compu, localhost Ubuntu con PHP :)';

    $result = mail($to, $subject, $message);

    if(!$result) {   
        echo "Error";   
    } else {
        echo "Success";
    }
?>