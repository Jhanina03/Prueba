<?php
$arrayAsociativo = array("nombre" => "Juan", "apellido" => "Perez", "edad" => 30);
print_r($arrayAsociativo);
print_r(gettype($arrayAsociativo));
$mijsonArray = json_encode($arrayAsociativo);
echo "<br>";
echo $mijsonArray;
echo gettype($mijsonArray);
echo "<br>";

$array = array("lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo");
print_r($array);
print_r(gettype($array));
echo "<br>";
$mijson = json_encode($array);
echo $mijson;
echo gettype($mijson);
echo gettype(json_decode($mijson));
echo "<br>";
$objeto = new stdClass();
$objeto->nombre = "Juan";
$objeto->apellido = "Perez";
print_r($objeto);
print_r(gettype($objeto));
echo "<br>";
$mijsonObjeto = json_encode($objeto);
echo $mijsonObjeto;
echo gettype($mijsonObjeto);
echo gettype(json_decode($mijsonObjeto));
$estudiante2 = '[
    {
        "apellido": "Perez",
        "nombre": "Carlos",
        "educacion": [
            {
                "primaria": "La Salle",
                "secundaria": "Bolivar"
            }
        ]
    },
    {
        "apellido": "Conteron",
        "nombre": "Jhanina",
        "educacion": [
            {
                "primaria": "BLSQVD",
                "secundaria": "RBN"
            }
        ]
    }
]';

echo "<br>";
echo $estudiante2; // Imprime el JSON como texto
echo "<br>";
echo "Tipo de dato antes de json_decode: " . gettype($estudiante2);
echo "<br>";

$miphpjason = json_decode($estudiante2, true); // Decodificar JSON a array asociativo

// Verificar si se decodificó correctamente
if ($miphpjason === null) {
    echo "Error al decodificar el JSON.";
} else {
    for ($i = 0; $i < count($miphpjason); $i++) {
        echo "Estudiante " . ($i + 1) . ":<br>";
        echo "Nombre: " . $miphpjason[$i]['nombre'] . "<br>";
        echo "Apellido: " . $miphpjason[$i]['apellido'] . "<br>";
        echo "Educación Primaria: " . $miphpjason[$i]['educacion'][0]['primaria'] . "<br>";
        echo "Educación Secundaria: " . $miphpjason[$i]['educacion'][0]['secundaria'] . "<br>";
        echo "-------------------------<br>";
    }
}