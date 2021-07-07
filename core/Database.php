<?php
class Database 
{
    private static $instancePDO = null;

    public static function getPdo(){

        if(self::$instancePDO === null){
            self::$instancePDO = new PDO('mysql:host=localhost;dbname=garages','garage' ,'garage', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_PERSISTENT
            ]);
        }

        return self::$instancePDO;

    }

    /*
    public static function getPdo(){

            $PDO = new PDO('mysql:host=localhost;dbname=garages','garage' ,'garage', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_PERSISTENT
            ]);

        return $PDO;
    }*/
}




