<?php


class User extends Controller
{
    protected $auth = false;
    public function __construct()
    {

        $this->auth = Auth::User();

        if ($this->auth) {
            return json_encode(['status' => 'pass', 'message' => 'Авторизация']);
        }
        if (!$this->auth) {
            echo "not";
            header('Location: /public/login');
            return json_encode(['status' => 'auth', 'message' => 'Вы не авторизованы для запрашиваемой страницы']);
        }
    }

    public function Index()
    {
        $model=new LinkModel();
        $links = $model->getAll();
        $this->view('../app/Views/auth/index', 'Главная',  $links);

    }

    public function Contacts()
    {
        echo "user contacts";
    }

    public function Home()
    {
        $this->view('../app/Views/auth/home', 'Личный кабинет',);
    }

    public function Logout(){
        setcookie('userID', 1, time() - 3600 * 24 * 30, '/');
        header('Location: /public/guest');
    }

}