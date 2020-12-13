<?php


class Connect
{
    public static function Mysql()
    {
        $user = 'root';
        $password = 'root';
        $db = 'tinylinks';
        $host = '127.0.0.1:3306';
        $dsn = 'mysql:host=' . $host . ';dbname=' . $db;
        $pdo = new PDO($dsn, $user, $password);
        return $pdo;
    }


}