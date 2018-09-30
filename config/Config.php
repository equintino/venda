<?php
class Config {
    private static $data;
    private static $file;
    
    public static function getConfig($section = null){
        if(self::$data != null){
            return self::$data;
        }
        self::setFile();
        $data = self::getData();
        if(!array_key_exists($section, $data)){
            throw new Exception("Sessão não reconhecida: ".$section);
        }
        return $data[$section];
    }
    public static function getData(){
        if(self::$data != null){
            return self::$data;
        }
        self::$data = parse_ini_file(self::getFile(), true);
        return self::$data;
    }
    public static function setFile(){
        if(file_exists("../config/config.ini")){
            self::$file="../config/config.ini";
        }else{
            self::$file="config/config.ini";
        }
    }
    public static function getFile(){
        return self::$file;
    }
}