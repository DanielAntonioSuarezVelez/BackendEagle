<?php
    
    class Tercero{
        //ATRIBUTO
        public $conexion;
        //METODO CONSTRUCTOR
        public function __construct ($conexion){
            $this->conexion = $conexion;
        }

        //METODOS
        public function consulta(){
            //echo"holaaaaaaaaaaaaaaaaaaaaaa";
            $con = "SELECT t.*, c.nombre AS ciudad, dp.nombre AS dpto FROM tercero t
            INNER JOIN ciudad c ON t.foidciudad = c.id_ciudad
            INNER JOIN dpto dp ON c.fo_dpto = dp.id_dpto";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;

        }


        public function eliminar($id){
            $del = "DELETE FROM tercero WHERE id_tercero = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El tercero ha sido eliminado";

            return $vec;
        }


        public function insertar($params){
            $ins = "INSERT INTO tercero(nit, nombre, telefono, direccion, correo, descripcion, tipo_tercero, foidciudad, fodpto) VALUES ('$params->nit', '$params->nombre', '$params->telefono', '$params->direccion', '$params->correo',  '$params->descripcion', '$params->tipo_tercero', $params->foidciudad , $params->fodpto)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El tercero ha sido agregado";

            return $vec;

        }


        public function editar($id, $params){
            $editar = "UPDATE tercero SET nit = '$params->nit', nombre = '$params->nombre', telefono = '$params->telefono', direccion = '$params->direccion', correo = '$params->correo', descripcion = '$params->descripcion', tipo_tercero = '$params->tipo_tercero', foidciudad = $params->foidciudad, fodpto = $params->fodpto WHERE id_tercero = $id";
            mysqli_query($this->conexion, $editar);   
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El tercero ha sido editado ";

            return $vec;
        }

      

        public function filtro($valor){
            $filtro = "SELECT t.*, c.nombre AS ciudad FROM tercero t
            INNER JOIN ciudad c ON t.foidciudad = c.id_ciudad WHERE  t.nit LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }

            return $vec;
        }

        //para pedido
        public function filtro_cliente($valor){
            $filtro = "SELECT t.*, c.nombre AS ciudad FROM tercero t
            INNER JOIN ciudad c ON t.foidciudad = c.id_ciudad WHERE t.tipo_tercero = 'Cliente' AND  t.nit LIKE $valor";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            
            return $vec;
        }

        //para compra
        public function filtro_proveedor($valor){
            $filtro = "SELECT t.*, c.nombre AS ciudad FROM tercero t
            INNER JOIN ciudad c ON t.foidciudad = c.id_ciudad WHERE t.tipo_tercero = 'Proveedor' AND  t.nit LIKE $valor";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
            }
            
            return $vec;
        }




        public function consulta_proveedor(){
            $con = "SELECT t.*, c.nombre AS ciudad FROM tercero t
            INNER JOIN ciudad c ON t.foidciudad = c.id_ciudad WHERE t.tipo_tercero = 'Proveedor'";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }
            return $vec;
        }


        public function consulta_cliente(){
            $con = "SELECT t.*, c.nombre AS ciudad FROM tercero t
            INNER JOIN ciudad c ON t.foidciudad = c.id_ciudad WHERE t.tipo_tercero = 'Cliente'";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }
            return $vec;
        }



    }


?>
