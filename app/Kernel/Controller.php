<?php


class Controller
{



    protected function model($model)
    {
     //   require_once '../app/Models/' . $model . '.php';
        //return new $model(DB::Connect());
    }

    protected function view($view, $title, $data = [])
    {
        require_once '../app/Views/template.php';
    }
}