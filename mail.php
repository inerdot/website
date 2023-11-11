<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $subject = trim($_POST["subject"]);
        $message = trim($_POST["message"]);

        if ( empty($name) OR empty($subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Completa el formulario e intenta de nuevo.";
            exit;
        }
        $recipient = "inerdot6@gmail.com";
        $subject = "Contacto de $name | INERDOT";

        $email_content = "Nombre: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Asunto: $subject\n\n";
        $email_content .= "Mensaje:\n$message\n";
        $email_headers = "De: $name <$email>";
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);
            echo "Gracias! Su mensaje ha sido enviado. Nos pondremos en contacto en la brevedad.";
        } else {
            http_response_code(500);
            echo "Error! Algo ha salido mal al intentar enviar tu mensaje.";
        }

    } else {
        http_response_code(403);
        echo "Ha ocurrido un error! Por favor intenta de nuevo.";
    }

?>
