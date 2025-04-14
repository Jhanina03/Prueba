<?php
class connection
{
    public function conectar()
    {
        //define: permite definir variables
        //$servername = "localhost";
        define('SERVER', 'localhost:3307');
        define('DB', 'soa');
        define('USER', 'root');
        define('PASSWORD', '');


        //PDO :: ES PORQUE SE ACCEDE A UN METODO DENTRO DEL OBJETO PDO
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try {
            $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DB, USER, PASSWORD, $opc);
            return $conn;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
