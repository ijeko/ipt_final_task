<?php


class Auth
{
//

    public static function User()
    {
        $data = ['id', $_COOKIE['userID']];
//        $data = ['id', '1'];
        $empty_model =new UserModel();
        $model = DB::getModel($empty_model, $data);
        return $model;
    }

}