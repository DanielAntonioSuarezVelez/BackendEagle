<?php
    
    class Dashboard{
        //ATRIBUTO
        public $conexion;
        //METODO CONSTRUCTOR
        public function __construct ($conexion){
            $this->conexion = $conexion;
        }

        //METODOS
        public function consultapedido(){
            $con = "SELECT COUNT(*) AS conteo FROM pedido";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }
            return $vec;
        }

        
        public function consultacompra(){
            $con = "SELECT COUNT(*) AS conteo FROM compra";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }
            return $vec;
        }


        public function consultaproducto(){
            $con = "SELECT COUNT(*)	AS conteo FROM producto";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }
            return $vec;
        }


        public function consultacliente(){
            $con = "SELECT COUNT(*)	AS conteo FROM tercero WHERE tipo_tercero='Cliente'";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }
            return $vec;
        }
      

  


    }




?>
