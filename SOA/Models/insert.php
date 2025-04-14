<?php
include_once 'connection.php';
header('Content-Type: application/json');
//include_once: incluye el archivo connection.php, si ya fue incluido no lo vuelve a incluir
//require_once: incluye el archivo connection.php, si ya fue incluido no lo vuelve a incluir, pero si no existe el archivo, genera un error fatal y detiene la ejecución del script
class crudInsert

{
    public static function insertarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono)
    {
        $object = new connection();
        $conn = $object->conectar();



        $sqlInsert = "INSERT INTO `estudiantes` (`cedula`, `nombre`, `apellido`, `direccion`, `telefono`) 
                VALUES (?, ?, ?, ?, ?);";
        //prepare: prepara la consulta para ser ejecutada
        //bindParam: vincula una variable a un parámetro de la consulta preparada
        $stmt = $conn->prepare($sqlInsert);
        $stmt->bindParam(1, $cedula);
        $stmt->bindParam(2, $nombre);
        $stmt->bindParam(3, $apellido);
        $stmt->bindParam(4, $direccion);
        $stmt->bindParam(5, $telefono);

        $stmt->execute();
        // $dataJS = json_encode($stmt);
        $dataJS = json_encode("Se inserto el estudiante");

        // echo json_encode([
        //     "success" => true,
        //     "message" => "Estudiante guardado correctamente"
        // ]);
        
        // print_r("saved correctly");
        print_r($dataJS);

    }
}
