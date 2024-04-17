<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/tercero.php");

    $control = $_GET['control'];

    $tercero = new Tercero($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $tercero ->consulta();
        break;

        case'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nit":"123", "nombre":"pepito", "telefono":"3124444555", "direccion":"calle 345", "correo":"pep@pepe.com", "descripcion":"edssre", "tipo_tercero":"cliente", "foidciudad":"41" }';
            $params = json_decode($json);
            //print_r($params);
            $vec = $tercero -> insertar($params);

        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $tercero -> eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            //$json = '{"nit":"123", "nombre":"pepito editado", "telefono":"3124444555", "direccion":"calle 345", "correo":"pep@pepe.com", "descripcion":"edssre", "tipo_tercero":"cliente", "foidciudad":"41" }';
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $tercero -> editar($id,$params);

        break;

        case 'filtro':
            //$json = file_get_contents('php://input');
            //$params = json_decode($json);
            $dato = $_GET['dato'];
            $vec = $tercero->filtro($dato);
        break;

        //para pedido
        case 'filtro_cliente':
            //$json = file_get_contents('php://input');
            //$params = json_decode($json);
            $dato = $_GET['dato'];
            $vec = $tercero->filtro_cliente($dato);
        break;

        //para compra
        case 'filtro_proveedor':
            //$json = file_get_contents('php://input');
            //$params = json_decode($json);
            $dato = $_GET['dato'];
            $vec = $tercero->filtro_proveedor($dato);
        break;


        //para pedido
        case 'consultaproveedor':
            $vec = $tercero ->consulta_proveedor();
        break;
        
        // para pedido
        case 'consultacliente':
            $vec = $tercero ->consulta_cliente();
        break;
        
    }

    $datosj = json_encode($vec);
    echo $datosj;
    header('Content-Type: application/json');

?>