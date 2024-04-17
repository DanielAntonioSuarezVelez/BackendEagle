<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/producto.php");

    $control = $_GET['control'];

    $producto = new Producto($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $producto ->consulta();
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;

        case 'restarp':
            $id = $_GET['id'];
            $cant = $_GET['cant'];
            $vec = $producto ->restar_productos($id, $cant);
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;

        case 'sumarp':
            $id = $_GET['id'];
            $cant = $_GET['cant'];
            $vec = $producto ->sumar_productos($id, $cant);
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;

        case'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Lapiz", "fecha_creacion":"2024-02-21", "valor_unitario":"3000", "valor_compra":"3000", "cantidad":"40", "foidcategoria":"1", "foidmarca":"1", "foidusuario":"2" }';
            $params = json_decode($json);
            //print_r($params);""
            $vec = $producto -> insertar($params);
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $producto -> eliminar($id);
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Lapiz modif", "fecha_creacion":"2024-02-21", "valor_unitario":"3000", "valor_compra":"3000", "cantidad":"40", "foidcategoria":"1", "foidmarca":"1", "foidusuario":"2" }';
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $producto -> editar($id,$params);
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $producto->filtro($dato);
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;
    }


?>