<?php
namespace App\Http\Component;

class Message_Response {
  /* tipoMensaje:CORRECTO,ERROR,ADVERTENCIA,INFORMACION,CONFIRMACION
  */
  static function mensaje($mensaje,$tipoMensaje="CORRECTO",$estatus=200){
   $data = array();
   $data['estatus'] = $estatus;
   $data['mensaje']=$mensaje;  
   $data['tipoRespuesta']='MENSAJE';  
   $data['tipoMensaje']=$tipoMensaje;
   echo json_encode($data);
   exit();
  } 
  static function mensajeDatosAdicionales($mensaje,$datosAdicionales,$tipoMensaje="CORRECTO",$estatus=200){
   $data = array();
   $data['estatus'] = $estatus;
   $data['mensaje']=$mensaje;  
   $data['tipoRespuesta']='MENSAJE';  
   $data['tipoMensaje']=$tipoMensaje;
   $data["datosAdicionales"]=$datosAdicionales;
   echo json_encode($data);
   exit();
  } 
  
  static function mensajes($mensajes,$tipoMensaje="CORRECTO",$estatus=200){
   $data = array();
   $data['estatus'] = $estatus;
   $data['mensajes']=$mensajes;  
   $data['tipoRespuesta']='MENSAJES';  
   $data['tipoMensaje']=$tipoMensaje;
   echo json_encode($data);
   exit();
  }

    static function mensajesErrores($mensajes,$estatus=200){
        $data = array();
        $data['estatus'] = $estatus;
        $data['mensajes']=$mensajes;
        $data['tipoRespuesta']='MENSAJES';
        $data['tipoMensaje']="ERROR";
        echo json_encode($data);
        exit();
    }

    static function mensajeError($mensaje,$estatus=200){
        $data = array();
        $data['estatus'] = $estatus;
        $data['mensaje']=$mensaje;
        $data['tipoRespuesta']='MENSAJE';
        $data['tipoMensaje']='ERROR';
        echo json_encode($data);
        exit();
    }

    static function datosJSON($draw,$total,$data=array()){
    $json_data = [
          "draw"            => intval($draw),
          "recordsTotal"    => intval( $total ),
          "recordsFiltered" => intval( $total ),
          "data"            => $data,
		  "estatus"          => 200,
		  "tipoRespuesta"          => "DATOS"
          ];
      echo json_encode($json_data);
	  exit();
  }  

  static function redireccion($url,$estatus=200){
   $data = array();
   $data['estatus'] = $estatus;
   $data['url']=$url;  
   $data['tipoRespuesta']='REDIRECCION';
   echo json_encode($data);
   if($estatus==408){
       die();
   }else{
       exit();
   }
  }  
  

}