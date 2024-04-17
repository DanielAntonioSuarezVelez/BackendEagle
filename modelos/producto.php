<?php
    class Producto{
        //atributo
        public $conexion;

        //constructor
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        //Metodos
        public function consulta (){
            $con = "SELECT p.*, c.nombre AS categoria, mr.nombre AS marca, us.nombre AS usuario FROM producto p
                    INNER JOIN categorias c ON p.foidcategoria = c.id_categoria
                    INNER JOIN marca mr ON p.foidmarca = mr.id_marca
                    INNER JOIN usuario us ON p.foidusuario = us.id_usuario
                    ORDER BY p.id_producto";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }
        
        public function eliminar($id){
            $del = "DELETE from producto WHERE id_producto = $id";
            mysqli_query($this->conexion, $del);
            $vec=[];

            $vec['resultado']= "OK";
            $vec['mensaje'] = "El producto ha sido eliminada";
            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO producto (nombre, fecha_creacion, valor_unitario, valor_compra, cantidad, foidcategoria, foidmarca, foidusuario) 
            VALUES ('$params->nombre','$params->fecha_creacion',$params->valor_unitario,$params->valor_compra,$params->cantidad, $params->foidcategoria,$params->foidmarca,$params->foidusuario)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado']= "OK";
            $vec['mensaje'] = "La producto ha sido guardado";
            return $vec;
        }

        public function editar($id,$params){
            $editar = "UPDATE producto SET nombre = '$params->nombre', fecha_creacion = '$params->fecha_creacion', valor_unitario = $params->valor_unitario, valor_compra =$params->valor_compra,
            cantidad = $params->cantidad, foidcategoria=$params->foidcategoria, foidmarca='$params->foidmarca', foidusuario= $params->foidusuario
            WHERE id_producto = $id";
            mysqli_query($this->conexion, $editar);
            $vec= [];
            $vec['resultado']= "OK";
            $vec['mensaje'] = "El producto ha sido editado";
            return $vec;

        }   

        public function filtro($valor){
            $filtro = "SELECT p.*, c.nombre AS categoria, mr.nombre AS marca, us.nombre AS usuario FROM producto p
            INNER JOIN categorias c ON p.foidcategoria = c.id_categoria
            INNER JOIN marca mr ON p.foidmarca = mr.id_marca
            INNER JOIN usuario us ON p.foidusuario = us.id_usuario WHERE p.nombre LIKE'%$valor%' OR US.nombre LIKE '%$valor%'";
            $res =  mysqli_query($this->conexion, $filtro);
            $vec=[];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function restar_productos($id, $cant){
            $cant = "UPDATE producto SET cantidad=(cantidad - $cant) WHERE id_producto = $id; ";
            mysqli_query($this->conexion, $cant);
            $vec= [];
            $vec['resultado']= "OK";
            $vec['mensaje'] = "El producto ha sido editado, se restaron productos";
            return $vec;
        }

        
        public function sumar_productos($id, $cant){
            $cant = "UPDATE producto SET cantidad=(cantidad + $cant) WHERE id_producto = $id; ";
            mysqli_query($this->conexion, $cant);
            $vec= [];
            $vec['resultado']= "OK";
            $vec['mensaje'] = "El producto ha sido editado, se sumaron productos";
            return $vec;
        }





    }
?>