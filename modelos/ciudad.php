<?php
    class Ciudad{
        //atributo
        public $conexion;

        //constructor
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        //Metodos
        public function consulta_dpto (){
            $con = "SELECT * from dpto ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function consulta_ciudad ($dpto){
            $con = "SELECT * from ciudad WHERE fo_dpto = $dpto ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }
        

        public function consultaciudad(){
            //echo "holaaaa";
            $con_ciudad = "SELECT c.*, d.nombre AS departamento FROM ciudad c
            INNER JOIN dpto d ON c.fo_dpto = d.id_dpto LIMIT 20";
            $res = mysqli_query($this->conexion, $con_ciudad) or die(mysqli_error($this->conexion));

            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }
            return $vec;
        }



    }
?>