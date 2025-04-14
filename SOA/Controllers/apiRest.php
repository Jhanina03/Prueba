<?php
include_once '../Models/select.php';
include_once '../Models/insert.php';
include_once '../Models/delete.php';
include_once '../Models/update.php';
header('Content-Type: application/json; charset=utf-8');
$opc = $_SERVER['REQUEST_METHOD'];

//print_r($opc);

switch ($opc) {
    case 'GET':

        //$object = new crudSelect();
        //$object->selectEstudiante();
        crudSelect::selectEstudiante();
        break;
    case 'POST':

        // $object = new crudInsert();
        // $object->insertarEstudiante();
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        crudInsert::insertarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono);

        // $datos = json_decode(file_get_contents('php://input'));

        // crudInsert::insertarEstudiante($datos->cedula, $datos->nombre, $datos->apellido, $datos->direccion, $datos->telefono);
        break;
    case 'DELETE':
        $cedula = $_GET['cedula']??null;
        crudDelete::deleteEstudiante($cedula);
        break;
        case 'PUT':
            $inputData = file_get_contents('php://input');
            $data = json_decode($inputData, true);
    
            $cedula = $data['cedula'];
            $nombre = $data['nombre'];
            $apellido = $data['apellido'];
            $direccion = $data['direccion'];
            $telefono = $data['telefono'];
    
            crudUpdate::actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono);
            break;
    default:
        echo "Error: Method not allowed";
        break;
}
