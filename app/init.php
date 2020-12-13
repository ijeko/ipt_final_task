<?php
require "Kernel/App.php";
require "Kernel/Controller.php";
require "Kernel/Model.php";
require "Services/DB.php";
require "Services/Validator.php";
require "Models/UserModel.php";
require "Models/LinkModel.php";
require "Services/Auth.php";
require "Services/Connect.php";
require "Services/phpmailer/PHPMailer.php";
require "Services/phpmailer/SMTP.php";
require "Services/phpmailer/Exception.php";
require_once "Controllers/Links.php";
require "Interfaces/Mailer.php";
require "Services/SendMail.php";
require "Services/PhpMailService.php";
require "Services/MailService.php";

$app = new App();