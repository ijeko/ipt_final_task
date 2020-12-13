<?php

class UserModel extends Model
{
    protected $table = 'users';
    protected $id;
    protected $username;
    protected $email;
    protected $password;

    public function __construct($data = [])
    {
        $this->setData($data);
    }


    public function setData($userdata)
    {
        $this->id = $userdata['id'];
        $this->username = $userdata['username'];
        $this->email = $userdata['email'];
        $this->password = $userdata['password'];
    }

    public function getData()
    {
        return ['id'=> $this->id, 'username' => $this->username, 'email' => $this->email, 'password' => $this->password];
    }
    public function id()
    {
        return $this->id;

    }
    public function username()
    {
        return $this->username;

    }
    public function email()
    {
        return $this->email;

    }
    public function getLinks()
    {
        $data = ['user_id', Auth::User()->id()];
//        $data = ['id', '1'];
        $empty_model =new LinkModel();
        $model = DB::getModel($empty_model, $data);
        var_dump($model);
        return $model;
    }



}