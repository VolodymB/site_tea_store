<?php
class Db{
    // запис констант
    const USER='root';
    const PASS='root';
    const HOST='localhost';
    const DB='tea_store';

    // функція для підключення до бд
    public static function connect(){
        // звернення в середині класу до самого себе(батьківських властивостей) через self
        $hosting=self::HOST;
        $db=self::DB;
        $charset='utf8';
        $user=self::USER;
        $password=self::PASS;
        $dsn="mysql:host=$hosting;dbname=$db;charset=$charset";
    $option=[
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES=>false,
        ];
        $connect=new PDO($dsn,$user,$password,$option);
        return $connect;
    }





}
?>