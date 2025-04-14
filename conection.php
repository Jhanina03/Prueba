<?php

class conexion{
//     private const SERVER = 'localhost';
//     private const DB='soa';
//     private const PASS ='';
//     private const USER ='root';
    public function conectar(){
        define('SERVER','localhost:3307');
        define('USER','root');
        define('DB','soa');
        define('PASS','');
        // $SERVER = 'localhost';
        // $DB='soa';
        // $PASS ='';
        // $USER ='root';

        $opc=array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8');
        $Conexion= new PDO("mysql:host=".SERVER.";dbname=".DB, USER, PASS,$opc);
        // $Conexion= new PDO("mysql:host= $SERVER;dbname=$DB", $USER, $PASS);

        return $Conexion;

    }
}