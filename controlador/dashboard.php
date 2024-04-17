<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/dashboard.php");

    $control = $_GET['control'];

    $dashboard = new Dashboard($conexion);

    switch ($control) {
        case 'consultapedido':    
            $vec = $dashboard ->consultapedido();
        break;

        case 'consultacompra':    
            $vec = $dashboard ->consultacompra();
        break;

        case 'consultaproducto':    
            $vec = $dashboard ->consultaproducto();
        break;

        case 'consultacliente':    
            $vec = $dashboard ->consultacliente();
        break;

    }


    $datosj = json_encode($vec);
    echo $datosj;
    header('Content-Type: application/json');

?>