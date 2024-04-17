<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/ciudad.php");

    $control = $_GET['control'];

    $ciudad = new Ciudad($conexion);

    switch ($control) {
        case 'dpto':
            $vec = $ciudad->consulta_dpto();
        break;

        case 'ciudad':
            $id = $_GET['dpto'];
            $vec = $ciudad->consulta_ciudad($id);
        break;

        case 'consultaciudad':
            $vec = $ciudad ->consultaciudad();
        break;


    }


    $datosj = json_encode($vec);
    echo $datosj;
   // header('Content-Type: application/json');

?>