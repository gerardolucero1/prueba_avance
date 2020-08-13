<?php

$data = json_decode(file_get_contents("php://input"));

$con = mysqli_connect('192.168.64.2', 'admin', 'pass');

if (!$con) {
    echo 'No se pudo conectar al servidor';
}

if (!mysqli_select_db($con, 'avance')) {
    echo 'Error al conectar a la BD';
}

$sql = "INSERT INTO contact(name, email, message, optionSelect) VALUES ('$data->name', '$data->email', '$data->message', '$data->optionSelect')";

if (!mysqli_query($con, $sql)) {
    echo 'Ocurrio un error';
}else{

    $emailToSend = 'yosoyelpapa@gmail.com';
    
    function validarCampo($campo)
    {
        $campo = trim($campo);
        $campo = stripslashes($campo);
        $campo = htmlspecialchars($campo);

        return $campo;
    }

    if (isset($data->email) && !empty($data->email)) {

        $destinoMail = $emailToSend;
        
        $email = validarCampo($data->email);

        $subject = "Assessment realizado";


        // Enviar Email a The Garrison Hotel
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=\"UTF-8\"\r\n";
        $headers .= "From: noreply@example.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        $message1  = "
            <html>
            <head></head>
            <body>
            <font face=\"arial\" size=\"2\">
            <p>Assessment realizado</p>
            <p><b>Nombre:</b><br/>$data->name</p>
            <p><b>Email:</b><br/>$data->email</p>
            <p><b>Mensaje:</b><br/>$data->message</p>
            </font>
            </body>
            </html>
            ";

        // Enviar Email a destino
        mail($destinoMail, $subject, $message1, $headers);

        echo "1";
        
    }else{
        echo "Error al enviar email";
    }

    echo 'datos insertados e email enviado.';
}

