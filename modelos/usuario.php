<?php
    
    class Usuario{
        //ATRIBUTO
        public $conexion;
        //METODO CONSTRUCTOR
        public function __construct ($conexion){
            $this->conexion = $conexion;
        }

        //METODOS
        public function consulta(){
            //echo"holaaaaaaaaaaaaaaaaaaaaaa";
            $con = "SELECT u.*, r.nombre_rol AS rol FROM usuario u
            INNER JOIN rol r ON r.id_rol = u.foidrol";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;

        }


        public function eliminar($id){
            $del = "DELETE FROM usuario WHERE id_usuario = $id";
            mysqli_query($this->conexion, $del);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El usuario ha sido eliminado";

            return $vec;
        }


        public function insertar($params){
            $ins = "INSERT INTO usuario(nombre, cedula, telefono, direccion, correo, password, foidrol) VALUES ('$params->nombre', '$params->cedula', '$params->telefono', '$params->direccion', '$params->correo', sha1('$params->password'), $params->foidrol)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El usuario ha sido agregado";

            return $vec;

        }


        public function editar($id, $params){
             $editar = "UPDATE usuario SET nombre = '$params->nombre', cedula = '$params->cedula', telefono = '$params->telefono', direccion = '$params->direccion', correo = '$params->correo', password = sha1('$params->password'), foidrol = $params->foidrol   WHERE id_usuario = $id";
            mysqli_query($this->conexion, $editar);   
            $vec = [];
            $vec['resultado'] ="OK";
            $vec["mensaje"] = "El tercero ha sido editado ";

            return $vec;
        }

      

        public function filtro($valor){
            $filtro = "SELECT u.*, r.nombre_rol AS rol FROM usuario u
            INNER JOIN rol r ON r.id_rol = u.foidrol WHERE  u.nombre LIKE '%$valor%'";
            $res = mysqli_query($this->conexion, $filtro);
            $vec = [];

            while ($row = mysqli_fetch_array($res)) {
                $vec[] = $row;
                
            }

            return $vec;

        }


        public function consulta_rol(){
            $con = "SELECT * FROM rol";
            $res = mysqli_query($this->conexion, $con) or die(mysqli_error($this->conexion));

            $vec = [];
            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }
            return $vec;
        }


    }




?>
