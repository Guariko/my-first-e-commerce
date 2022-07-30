<?php

require "$mailerPath/PHPMailer.php";
require "$mailerPath/SMTP.php";
require "$mailerPath/Exception.php";
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$userName = "";
$userEmail = "";
$userSubject = null;

$displayMessageSent = "";

if (isset($_SESSION["displayMessageSent"])) {
    $displayMessageSent = $_SESSION["displayMessageSent"];
}

if (isset($_SESSION["contactUserSubject"])) {
    $userSubject = $_SESSION["contactUserSubject"];
}

if (isset($_SESSION["contactUserEmail"])) {
    $userEmail = $_SESSION["contactUserEmail"];
}

if (isset($_SESSION["contactUserName"])) {
    $userName = $_SESSION["contactUserName"];
}

$errorMessageName = "";
$errorMessageEmail = "";
$errorMessageSubject = "";

$displayNameError = "";
$displayEmailError = "";
$displaySubjectError = "";

if (isset($_SESSION["errorMessageName"])) {
    $displayNameError = "active";
    $errorMessageName = $_SESSION["errorMessageName"];
}

if (isset($_SESSION["errorMessageEmail"])) {
    $displayEmailError = "active";
    $errorMessageEmail = $_SESSION["errorMessageEmail"];
}

if (isset($_SESSION["errorMessageSubject"])) {
    $displaySubjectError = "active";
    $errorMessageSubject = $_SESSION["errorMessageSubject"];
}

$minNameLength = 2;
$minSubjectLength = 10;

$maxNameLength = 250;
$maxSubjectLength = 3000;

if (isset($_SESSION["userLogged"])) {
    $userName = $_SESSION["userData"]["name"];
    $userEmail = $_SESSION["userData"]["email"];
}

if (isset($_POST["send__question"])) {

    $error = false;
    $displayNameError = "";
    $displayEmailError = "";
    $displaySubjectError = "";

    $name = $_POST["name"];
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $userMessage = $_POST["subject"];

    if (!$email) {
        $error = true;
        $displayEmailError = "active";
        $errorMessageEmail = "Por favor, insira um email válido";
        $_SESSION["errorMessageEmail"] = $errorMessageEmail;
        unset($_SESSION["contactUserEmail"]);
    }

    if (strlen($name) < $minNameLength) {
        $error = true;
        $displayNameError = "active";
        $errorMessageName = "O nome tem que ter pelo menos 2 characters";
        $_SESSION["errorMessageName"] = $errorMessageName;
        unset($_SESSION["contactUserName"]);
    }

    if (strlen($name) > $maxNameLength) {
        $error = true;
        $displayNameError = "active";
        $errorMessageName = "O nome não pode ter mais de 250 characters";
        $_SESSION["errorMessageName"] = $errorMessageName;
        unset($_SESSION["contactUserName"]);
    }

    if (strlen($userMessage) < $minSubjectLength) {
        $error = true;
        $displaySubjectError = "active";
        $errorMessageSubject = "A sua dúvida tem que ter pelo menos 10 characters";
        $_SESSION["errorMessageSubject"] = $errorMessageSubject;
        unset($_SESSION["contactUserSubject"]);
    }

    if (strlen($userMessage) > $maxSubjectLength) {
        $error = true;
        $displaySubjectError = "active";
        $errorMessageSubject = "A sua dúvida não pode ter mais de 3000 characters";
        $_SESSION["errorMessageSubject"] = $errorMessageSubject;
        unset($_SESSION["contactUserSubject"]);
    }

    if ($displayNameError !== "active") {
        unset($_SESSION["errorMessageName"]);
        $_SESSION["contactUserName"] = $name;
    }

    if ($email) {
        unset($_SESSION["errorMessageEmail"]);
        $_SESSION["contactUserEmail"] = $email;
    }

    if ($displaySubjectError !== "active") {
        unset($_SESSION["errorMessageSubject"]);
        $_SESSION["contactUserSubject"] = $userMessage;
    }

    if (!$error) {

        unset($_SESSION["contactUserName"]);
        unset($_SESSION["contactUserSubject"]);
        unset($_SESSION["contactUserEmail"]);

        $messageBody = "
                        <h1> $name  </h1>
                        <p> $email </p>
                        <h2> $userMessage </h2>
                        ";

        //Create instance of PHPMailer
        $mail = new PHPMailer();
        //Set mailer to use smtp
        $mail->isSMTP();
        //Define smtp host
        $mail->Host = "smtp.gmail.com";
        //Enable smtp authentication
        $mail->SMTPAuth = true;
        //Set smtp encryption type (ssl/tls)
        $mail->SMTPSecure = "tls";
        //Port to connect smtp
        $mail->Port = "587";
        $mail->CharSet = "UTF-8";
        //Set gmail username
        $mail->Username = "imreadyagora@gmail.com";
        //Set gmail password
        $mail->Password = "atsxcvejovordhol";
        //Email subject
        $mail->Subject = "Dúvida do site";
        //Set sender email
        $mail->setFrom('creatingsomething2021@gmail.com');
        //Enable HTML
        $mail->isHTML(true);
        //Attachment
        $mail->addAttachment('');
        //Email body
        $mail->Body = $messageBody;
        //Add recipient
        $mail->addAddress('creatingsomething2021@gmail.com');
        //Finally send email
        if ($mail->send()) {
            $_SESSION["displayMessageSent"] = "active";
            header("location: $homePath#contact");
        } else {
            echo "Message could not be sent. Mailer Error: ";
        }
        //Closing smtp connection
        $mail->smtpClose();
    } else {
        header("location: $homePath#contact");
    }
}
