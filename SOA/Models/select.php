<?php
include_once 'connection.php';

class crudSelect
{
    public static function  selectEstudiante()
    {
        $object = new connection();
        $conn = $object->conectar();
        $SqlSelect = "SELECT * FROM estudiantes";
        $result = $conn->prepare($SqlSelect);
        $result->execute();
        //fetchAll: devuelve un array con todos los resultados de la consulta
        //PDO::FETCH_ASSOC: devuelve un array asociativo, donde los nombres de las columnas son las claves del array
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        //print_r: imprime cosas propias del lenguaje de programación, como arrays, objetos, etc.
        //echo: imprime cadenas de texto, números, etc.
        //print_r($data);
        $data = json_encode($data);
        print_r($data);
    }
}
