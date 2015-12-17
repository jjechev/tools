<?php

if (($_POST)) {

    $status_message = "";

    $email_to = "rax@abv.bg";
    $email_subject = "Запитване от сайта";

    foreach ($_POST as $value) {
        if ($value == "")
            $status_message = "Моля попълнете всички полета!<br />";
    }

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $_POST['email'])) {

        $status_message .= 'Невалиден email адрес!<br />';
    }
    $email_message = "Запитване\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    foreach ($_POST as $key => $value) {

        $email_message .= "{$key}: " . clean_string($value) . "\n";
    }
// create email headers

    $headers = 'From: ' . $email_from . "\r\n" .
            'Reply-To: ' . $email_from . "\r\n" .
            'Content-type: text/plain; charset=UTF-8' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    if (!$status_message) {
        @mail($email_to, $email_subject, $email_message, $headers);
        $status_message = "Съобщениято е изпратено!";
        unset($_POST);
    }
}

