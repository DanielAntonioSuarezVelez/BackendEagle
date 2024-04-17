<?php
    class Categoria{
        //atributo
        public $conexion;

        //constructor
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        //Metodos
        public function consulta (){
            $con = "SELECT * from categorias ORDER BY nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }
        
        public function eliminar($id){
            $del = "DELETE from categorias WHERE id_categoria = $id";
            mysqli_query($this->conexion, $del);
            $vec=[];

            $vec['resultado']= "OK";
            $vec['mensaje'] = "La categoria ha sido eliminada";
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO categorias(nombre) VALUES ('$params->nombre')";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado']= "OK";
            $vec['mensaje'] = "La categoria ha sido guardada";
            return $vec;
        }

        public function editar($id,$params){
            $editar = "UPDATE categorias SET nombre= '$params->nombre' WHERE id_categoria = $id";
            mysqli_query($this->conexion, $editar);
            $vec= [];
            $vec['resultado']= "OK";
            $vec['mensaje'] = "La categoria ha sido editada";
            return $vec;

        }   

        public function filtro($valor){
            $filt = "SELECT * FROM categorias WHERE nombre LIKE '%$valor%'";
            //$filt = "SELECT * FROM categorias WHERE nombre LIKE '%" . mysqli_real_escape_string($this->conexion, $valor) . "%'";
            $res =  mysqli_query($this->conexion, $filt);
            $vec=[];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }



    }
?>