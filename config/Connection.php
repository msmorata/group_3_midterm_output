<?php

class Connection{
    private static $pdo = null;

    private static $host = "localhost";
    private static $dbname = "db_inventory_sales";
    private static $username = "postgres";
    private static $password = "admin";
    private static $port = "5432";

    public static function get(){
        if (self::$pdo === null) {

            try{
                $dsn = "pgsql:host=".self::$host.";port=".self::$port.";dbname=".self::$dbname;
                self::$pdo = new PDO($dsn, self::$username, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
                );
            } catch(PDOException $e){
                echo "Database connection failed: ".$e->getMessage();
                exit;
            }
            
        }
        return self::$pdo;
    }
}