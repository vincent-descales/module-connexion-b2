<?php
abstract class Database {

    private const DB_HOST = 'localhost';  // Would probably be `localhost` or `127.0.0.1`
    private const DB_CHARSET = 'utf-8';
    private const DB_NAME = 'moduleconnexion';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = 'password';
    protected $connexion;


    public function __construct()
    {
        $this->getConnectionDb();  
    }

    protected function getConnectionDb()
    {   
        $this->connexion = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD);
    }
}
