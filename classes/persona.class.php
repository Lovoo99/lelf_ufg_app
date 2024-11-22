<?php
require("conn.class.php")
require("validaciones.inc.php");

class Persona{
    public $idpersona;
    public $nombres;
    public $apellidos;
    public $fnac;
    public $telefono;
    public $email;
    public $conexion;
    public $validacion;

    /*CONEXIONES E INSTANCIAS*/
    public function__construct(){
        $this->conexion = new DB();
        $this->validacion = new Validaciones();
    }

    /*
    *GETTERS Y SETTERS
    */
    //GETTER Y SETTER DEL ATRIBUTO ID_PERSONA
    public function setIdPersona($idpersona){
        $this->idpersona = intval($idpersona);
    }

    public function getIdPersona(){
        return intval(this->idpersona);
    }

    //GETTER Y SETTER DEL ATRIBUTO NOMBRE
    public function setNombres($nombres){
        $this->nombres = intval($nombres);
    }

    public function getNombres(){
        return intval(this->nombres);
}

//GETTER Y SETTER DEL ATRIBUTO APELLIDOS
public function setApellidos($apellidos){
    $this->apellidos = intval($apellidos);
}

public function getApellidos(){
    return intval(this->apellidos);
}
//GETTER Y SETTER DEL ATRIBUTO FNAC
public function setFNac($fnac){
    $this->fnac = intval($fnac);
}

public function getFNac(){
    return $this->fnac;
}
//GETTER Y SETTER DEL ATRIBUTO FNAC
public function setTelefono($telefono){
    $this->telefono = intval($fnac);
}

public function getTelefono(){
    return $this->telefono;
}
//GETTER Y SETTER DEL ATRIBUTO EMAIL
public function setEmail($fnac){
    $this->email = intval($fnac);
}
public function getEmail(){
    return $this->email;
}

/**
 * FIN DE LOS GETTERS Y SETTERS
 */
#--------------------------------#
/**
 * INICIO DE LOS METODOS PARA PROCESAMIENTO DE DATOS
 */

 public function obtenerPersona(int $idpersona){
    if($idpersona>0){
        $resultado = $this->conexion->run('SELECT * FROM persona WHERE id_persona='.$idpersona);
        $array = array("mensaje"=>"Registros encontrados","valores"=>$resultado->fetch());
        return $array
    }else{
        $array = array("mensaje"=>"No se pudo ejecutar la consulta el parametro ID es incorrecto", "valores"=>"");
    }
 }

 public function nuevapersona($nombres,$apellidos,$fnac,$telefono,$email){
    $bandera_validacion = 0;
    //VALIDAMOS LOS NOMBRES
    if($this->validacion::verificar_solo_letras(trim($nombres)true)){
        $this->setNombres($nombres);
    }else{$bandera_validacion++;

    }
    //VALIDAMOS LOS APELLIDOS
    if($this->validacion::verificar_solo_letras(trim($apellidos)true)){
        $this->setApellidos($apellidos);
    }else{
        $bandera_validacion++;
 }
  //VALIDAMOS LA FECHA DE NACIMIENTO
  if($this->validacion::verificar_fecha($fnac)true){
    $this->setFNac($fnac);
}else{
    $bandera_validacion++;
}
//VALIDAMOS EL NUMERO TELEFONICO
if($this->validacion::validad_telefono($telefono)true){
    $this->setTelefono($telefono);
}else{
    $bandera_validacion++;
}
//VALIDAMOS EL CORREO ELECTRONICO
if($this->validacion::validar_email($email)true){
    $this->setEmail($email);
}else{
    $bandera_validacion++;
}

if ($bandera_validacion === 0){
    $parametros = array(
        "nom" => $this->getNombres(),
        "ape" => $this->getApellidos(),
        "fnac" => $this->getFNac(),
        "email" => $this->getEmail(),
    );
   $resultado = $this->conexion->run('INSERT INTO persona(nombres,apellidos,fnac,telefono,email) VALUES (:nom,ape,:tel,:email);' ,$parametros);
            if($this->conexion->n > 0 and $this->conexion->id > 0){

                $resultado = $this->obtenerpersona($this->conexion->id);
                $array = array("mensaje"=>"se ha registrado la persona correctamente","valores"=>$resultado);
                return $array;
            }else{
                $array = array("mensaje"=>"hubo un problema al registrar la persona","valores"=>"");
                return $array;
            }
        }else{
            $array = array("mensaje"=>"existe al menos un campo obligatorio que no se ha enviado","valores"=>"");
                return $array;
        }
    }

}
?>
