<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/usuario.php");

    $control = $_GET['control'];

    $usuario = new Usuario($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $usuario ->consulta();
        break;

        case'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Juan","cedula":"1088343945","telefono":"20902233","direccion":"mzb","correo":"jks@gmail.com","password":"123","foidrol":"1"}';
            $params = json_decode($json);
            //print_r($params);
            $vec = $usuario -> insertar($params);

        break;

        case 'eliminar':
            $id = $_GET['id'];
            $vec = $usuario -> eliminar($id);
        break;

        case 'editar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"Juan editado","cedula":"1088343945","telefono":"20902233","direccion":"mzbyyuu","correo":"jks@gmail.com","password":"123","foidrol":"1"}';
            $params = json_decode($json);
            $id = $_GET['id'];
            $vec = $usuario -> editar($id,$params);

        break;

        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $usuario->filtro($dato);
        break;

        case 'consultarol':
            $vec = $usuario ->consulta_rol();
        break;
    }

    $datosj = json_encode($vec);
    echo $datosj;
    header('Content-Type: application/json');

?>