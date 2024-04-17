<?php
    
    class Pedido{
        //ATRIBUTO
        public $conexion;
        //METODO CONSTRUCTOR
        public function __construct ($conexion){
            $this->conexion = $conexion;
        }

        //METODOS
        public function consulta(){
            $con = "SELECT P.*, t.nombre AS tercero, u.nombre AS usuario FROM pedido p
            INNER JOIN tercero t ON t.id_tercero = p.foidtercero 
            INNER JOIN usuario u ON u.id_usuario = p.foidusuario WHERE P.anulado = 'NO'";
            $res = mysqli_query($this->conexion, $con);

            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;

        }


        public function eliminar($id){
            $del = "DELETE FROM pedido WHERE id_pedido = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El pedido ha sido eliminado";

            return $vec;
        }


        public function insertar($params){
            //echo print_r($params);
            $ins = "INSERT INTO pedido(fecha_pedido, productos, total_pedido, foidtercero, foidusuario, anulado) VALUES ('$params->fecha_pedido','$params->productos', $params->total_pedido, $params->foidtercero,$params->foidusuario, 'NO')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El pedido ha sido agregado";

            return $vec;

        }

        //aun NO
        public function editar($id, $params){
            $editar = "UPDATE pedido SET fecha_pedido = '$params->fecha_pedido', total_pedido = '$params->total_pedido', productos = '$params->productos', foidtercero = '$params->foidtercero', foidusuario = '$params->foidusuario' WHERE id_pedido = $id";
            mysqli_query($this->conexion, $editar);   
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El tercero ha sido editado ";

            return $vec;
        }

      

        public function filtro($valor){
            $filt = "SELECT P.*, t.nombre AS tercero, u.nombre AS usuario FROM pedido p
            INNER JOIN tercero t ON t.id_tercero = p.foidtercero 
            INNER JOIN usuario u ON u.id_usuario = p.foidusuario WHERE  p.productos LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filt);
            $vec = [];

            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;       
            }

            return $vec;

        }

        public function consultap($id){
            $con = "SELECT productos FROM pedido WHERE id_pedido = $id";
            $res = mysqli_query($this->conexion, $con);
            $row = mysqli_fetch_array($res);
            $vec = unserialize($row[0]);

            return $vec;

        }

        public function anular($id){
            $anular = "UPDATE pedido SET anulado ='SI' WHERE id_pedido = $id";
            mysqli_query($this->conexion, $anular);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El pedido ha sido anulado";

            return $vec;
        }


    }




?>
