<?php
    
    class Compra{
        //ATRIBUTO
        public $conexion;
        //METODO CONSTRUCTOR
        public function __construct ($conexion){
            $this->conexion = $conexion;
        }

        //METODOS
        public function consulta(){
            $con = "SELECT c.*, t.nombre AS tercero, u.nombre AS usuario FROM compra c
            INNER JOIN tercero t ON t.id_tercero = c.foidtercero 
            INNER JOIN usuario u ON u.id_usuario = c.foidusuario WHERE c.anulado = 'NO'";
            $res = mysqli_query($this->conexion, $con);

            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;

        }


        public function eliminar($id){
            $del = "DELETE FROM compra WHERE id_compra = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "La compra ha sido eliminada";

            return $vec;
        }


        public function insertar($params){
            $ins = "INSERT INTO compra (fecha_compra, total_compra, productos, foidtercero, foidusuario, anulado) VALUES ('$params->fecha_compra',$params->total_compra,'$params->productos',$params->foidtercero,$params->foidusuario, 'NO')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "La compra ha sido agregada";

            return $vec;

        }


        public function editar($id, $params){
             $editar = "UPDATE compra SET fecha_compra = '$params->fecha_compra', total_compra = $params->total_compra, productos = '$params->productos', foidtercero = $params->foidtercero, foidusuario = $params->foidusuario WHERE id_compra = $id";
            mysqli_query($this->conexion, $editar);   
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "La compra ha sido actualizada ";

            return $vec;
        }

      

        public function filtro($valor){
            $filt = "SELECT c.*, t.nombre AS tercero, u.nombre AS usuario FROM compra c
            INNER JOIN tercero t ON t.id_tercero = c.foidtercero 
            INNER JOIN usuario u ON u.id_usuario = c.foidusuario WHERE  c.productos LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filt);
            $vec = [];
            
            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
                
            }

            return $vec;

        }

        public function consultap($id){
            $con = "SELECT productos FROM compra WHERE id_compra = $id";
            $res = mysqli_query($this->conexion, $con);
            $row = mysqli_fetch_array($res);
            $vec = unserialize($row[0]);

            return $vec;

        }

        public function anular($id){
            $anular = "UPDATE compra SET anulado ='SI' WHERE id_compra = $id";
            mysqli_query($this->conexion, $anular);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "La compra ha sido anulada";

            return $vec;
        }


    }




?>
