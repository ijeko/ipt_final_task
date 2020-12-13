<?php


class Guest extends Controller
{
    public function Test()
    {

    }

    public function Index()
    {

        $this->view('../app/Views/index', 'Главная');
    }

    public function Contacts()
    {
        $this->view('../app/Views/contacts', 'Контакты');
    }

    public function About()
    {
        $this->view('../app/Views/about', 'О проекте');
    }

    public function Register()
    {
        $this->view('../app/Views/register', 'Регистрация');
    }

    public function Login()
    {
        $this->view('../app/Views/login', 'Вход для пользователей');

    }

    public function Auth()
    {
        $data = json_decode($_POST['data'], true);
        $validator = new Validator();
        $validate = $validator->checkLogin($data);
        if (!$validate->getMessage()) {
            $db = new DB($validate, UserModel::class);
            $user = $db->verify();
             echo json_encode($db->getMessage());
        }
        else  echo json_encode(['status' => 'failed', 'message' => $validate->getMessage()]);
    }

    public function Adduser()
    {
        $data = json_decode($_POST['data'], true);
        $validator = new Validator();
        $validate = $validator->checkRegister($data);
        if ($validate) {
            $db = new DB($validate, UserModel::class);
            $db->Save();
            $message = $db->getMessage();
        } else {
            $message = $validator->getMessage();
            echo json_encode(['status' => 'failed', 'message' => $message]);
        }
        if ($message == 'pass') {
            echo json_encode(['status' => 'pass', 'message' => 'Пользователь добавлен']);
        }
        if ($message == 'failed') {
            echo json_encode(['status' => 'failed', 'message' => 'Данные не сохранены']);
        }
        if ($message == 'exists') {
            echo json_encode(['status' => 'exists', 'message' => 'Такое имя пользователя или email уже заняты']);
        }
        //else
        //    echo json_encode(['status' => 'failed', 'message' => $message]);

        //  echo json_encode(['status'=> 'failed', 'error' => $this->error]);

    }

    public function Home()
    {
        $this->view('../app/Views/auth/home', 'Личный кабинет');

    }
    public function send()
    {
        $data = json_decode($_POST['data']);
        $sendmail = new SendMail();
        $sendmail->run($data);
    }

}