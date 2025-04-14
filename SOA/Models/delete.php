<?php
include_once 'connection.php';
//include_once: incluye el archivo connection.php, si ya fue incluido no lo vuelve a incluir
//require_once: incluye el archivo connection.php, si ya fue incluido no lo vuelve a incluir, pero si no existe el archivo, genera un error fatal y detiene la ejecución del script
class crudDelete
{
    public static function deleteEstudiante($cedula)
    {
        $object = new connection();
        $conn = $object->conectar();

        $sqlDelete = "DELETE FROM `estudiantes` WHERE `cedula`=?;";
        //prepare: prepara la consulta para ser ejecutada
        //bindParam: vincula una variable a un parámetro de la consulta preparada
        $stmt = $conn->prepare($sqlDelete);
        $stmt->bindParam(1, $cedula);

        $stmt->execute();
        // $dataJS = json_encode($stmt);
        // print_r("deleted correctly");
        // print_r($dataJS);
        echo json_encode(["status" => "success", "message" => "Estudiante eliminado correctamente"]);

    }
}