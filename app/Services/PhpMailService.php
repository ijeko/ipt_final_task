<?php

class PhpMailService implements Mailer
{

    public function send($data)
    {

        $name = $data->name;
        $email = $data->email;
        $text = $data->text;
        $file = $data->file;

        $title = "Сообщение с сайта";
        $body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Почта:</b> $email<br><br>
<b>Сообщение:</b><br>$text
";


        $mail = new phpmailer\PHPMailer();
        try {
            $mail->isSMTP();
            $mail->CharSet = "UTF-8";
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = function ($str, $level) {
                $GLOBALS['status'][] = $str;
            };

            $mail->Host = 'smtp.gmail.com'; // SMTP сервера вашей почты
            $mail->Username = 'e.sobaka@gmail.com'; // Логин на почте
            $mail->Password = 'password'; // Пароль на почте
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($email, $name); // Адрес самой почты и имя отправителя

            // Адрес получателя
            $mail->addAddress('e.sobaka@gmail.com');

            // Прикрипление файлов к письму
            if (!empty($file['name'][0])) {
                for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
                    $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
                    $filename = $file['name'][$ct];
                    if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
                        $mail->addAttachment($uploadfile, $filename);
                        $rfile[] = "Файл $filename прикреплён";
                    } else {
                        $rfile[] = "Не удалось прикрепить файл $filename";
                    }
                }
            }
// Отправка сообщения
            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body = $body;

// Проверяем отравленность сообщения
            if ($mail->send()) {
                $result = "success";
            } else {
                $result = "error";
            }
            throw new \phpmailer\Exception();

        }

         catch (\phpmailer\Exception $e) {
            $result = "error";
            $status = "Сообщение не было отправлено по причине: {$mail->ErrorInfo}";
        }

// Отображение результата
        echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);
    }
}