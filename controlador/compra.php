<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/compra.php");

    $control = $_GET['control'];

    $compra = new Compra($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $compra ->consulta();

            $datosj = json_encode($vec);
            echo $datosj;
        break;


        case 'insertar':
           $json = file_get_contents('php://input');
           //$json = '{"fecha_pedido":"2024-4-14","productos":[["1","lapiz",5000,1,5000]],"total_pedido":5000,"foidtercero":17,"foidusuario":2}';

           //var_dump($json);  // Debería mostrar una cadena JSON

           if (is_string($json)) {
            $params = json_decode($json);

                if ($params === null && json_last_error() !== JSON_ERROR_NONE) {
                // Manejar el error de decodificación
                echo "Error en la decodificación del JSON.";
                }
                 } else {
                    echo "El contenido recibido no es una cadena JSON válida.";
                }

            $texto_arreglo = serialize($params->productos);
            $params->productos = $texto_arreglo;
            /* echo "<pre>";
           print_r($params);
           echo "</pre>";*/
            $vec = $compra->insertar($params);

            $datosj = json_encode($vec);
            echo $datosj;
            //header('Content-Type: application/json');
        break;


        case 'anular':
            $id = $_GET['id'];
            $vec = $compra -> anular($id);

            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;


        case 'editar':
            $json = file_get_contents('php://input');
            //$json = '{"fecha_compra":"2024-03-23", "total_compra":"6000", "productos":"productos editado", "foidtercero":"1", "foidusuario":"2"}';
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $compra -> editar($id,$params);

            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');

        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $compra->filtro($dato);

            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;

        case 'productos':
            $id = $_GET['id'];
            $vec = $compra->consultap($id);

            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;

    }


?>