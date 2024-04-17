<?php
    class Login{
        //atributo
        public $conexion;

        //constructor
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        //Metodos
        public function consulta ($email, $clave){
            $con = "SELECT * from usuario WHERE correo='$email' && password=sha1('$clave')";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            if($vec==[]){
                $vec[0] = array("validar"=>"no valida");
            } else {
                $vec[0]['validar']="valida";
            }

            return $vec;
        }
        

    }
?>