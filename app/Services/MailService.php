<?php


class MailService implements Mailer
{

    public function send($data)
    {

        $to = 'johny@example.com, sally@example.com'; // обратите внимание на запятую

        $subject = 'Новосе сообщение с сайта';

        $message = '
<html>
<head>
  <title>Новое сообщения с сайта</title>
</head>
<body>
  <p>Отправитель: ' . $data->name . '</p>
  <br>
  <p>' . $data->text . '</p>  
</body>
</html>';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

//        $headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
//        $headers[] = 'From: Birthday Reminder <birthday@example.com>';
//        $headers[] = 'Cc: birthdayarchive@example.com';
//        $headers[] = 'Bcc: birthdaycheck@example.com';

        $headers = ['To' => 'e.sobaka@gmail.com', 'From' => $data->email, 'Cc' => '', 'Bcc'=>''];

// Отправляем
        mail($to, $subject, $message, implode("\r\n", $headers));

    }
}