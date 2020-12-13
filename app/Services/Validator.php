<?php

class Validator
{
    protected $error;
    protected $validated;

    public function checkRegister($data = [])
    {
        $username = filter_var(trim($data['username']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
        $password = $data['password'];
        if (strlen($username) <= '2' && $username != '') {
            $this->error = "Длина логина не менее трех символов";
//            echo json_encode(['status'=> 'failed', 'error' => $this->error]);
            return false;
        }

        if ($username == '') {
            $this->error = "Поле логин обязательно для заполнения";
//            echo json_encode(['status'=> 'failed', 'error' => $this->error]);
            return false;
        }
        if ($email == '') {
            $this->error = "Поле email обязательно для заполнения";
//            echo json_encode(['status'=> 'failed', 'error' => $this->error]);
            return false;

        }
        if (strlen($password) <= 3 && $password != '') {
            $this->error = "Пароль не менее четырех символов";
//            echo json_encode(['status'=> 'failed', 'error' => $this->error]);
            return false;
        }

        if ($password == '') {
            $this->error = "Поле пароль обязательно для заполнения";
//            echo json_encode(['status'=> 'failed', 'error' => $this->error]);
            return false;
        }

        $this->validated = ['username' => $username, 'email' => $email, 'password' => $password];
        $this->error = '';
        return $this;
    }

    public function checkLogin($data = [])
    {
        $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
        $password = $data['password'];
        if (!$email or !$password) {
            $this->error = "Все поля обязательны к заполнению";
            return $this;
        } else {
            $this->validated = ['email' => $email, 'password' => $password];
            return $this;

        }

    }

    public function checkLinks($data = [])
    {
        $fullurl = filter_var(trim($data['fullurl']), FILTER_SANITIZE_URL);
        $shorturl = filter_var(trim($data['shorturl']), FILTER_SANITIZE_URL);
        $user_id = $data['user_id'];
        if (!$fullurl or !$shorturl) {
            $this->error = "Заполните оба поля";
            return $this;
        } else {
            $this->validated = ['fullurl' => $fullurl, 'shorturl' => $shorturl, 'user_id' => $user_id];
            return $this;

        }
    }

    public function getMessage()
    {
        return $this->error;

    }

    public function getValidated()
    {
        return $this->validated;
    }

}