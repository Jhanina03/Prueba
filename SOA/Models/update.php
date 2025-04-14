<?php
include_once 'connection.php';

class crudUpdate
{
    public static function actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono)
    {
            $object = new connection();
            $conn = $object->conectar();
            
            $sqlUpdate = "UPDATE estudiantes SET nombre = ?, apellido = ?, direccion = ?, telefono = ? WHERE cedula = ?";
            $stmt = $conn->prepare($sqlUpdate);
            //El prepare prepara la consulta para ser ejecutada
            //bindParam: vincula una variable preparada con un parámetro, es decir evita las inyecciones de sql.
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $direccion);
            $stmt->bindParam(4, $telefono);
            $stmt->bindParam(5, $cedula);
            //execute: Ejecuta la consulta y da resultado de true o false
            // if ($stmt->execute()) {
            //     $data = array("success" => true, "message" => "Estudiante actualizado correctamente");
            // } else {
            //     $data = array("success" => false, "message" => "Error al actualizar el estudiante");
            // }
            $stmt->execute();
            $datajs = json_encode("Se actualizó estudiante");
        print_r($datajs);
        //O la otra solucion es mandarle un datajs = jsonencode("Se actualizó estudiante") e imprimir la data print_r($data)
    }
}
?>
