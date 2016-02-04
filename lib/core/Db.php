<?php

namespace Lib\Core;

class Db
{
    public $connect;

    private function __construct()
    {

    }

    private function connect()
    {
        $this->connect = new \PDO('mysql:host='. getenv('DB_HOST') .
            ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    }

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
            $instance->connect();
        }

        return $instance;
    }

}