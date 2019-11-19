<?php

class DB {

    const HOST = 'localhost';
    const USER = 'sank1917';
    const PASS = 'Immortal1917';
    const DB   = 'test';
    
    public static function connect() {
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db   = self::DB;
        
        $connect = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
        return $connect; 
    }

}