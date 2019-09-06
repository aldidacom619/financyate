 <?php 
 function numero_prestamos($idpersona = 0)
 {
 	$fila =& get_instance();	
 	$fila->load->model('prestamos_model');
  if($idpersona == 0)
  {
    $nombre = "";
  }   
  else
  {
    $prestamo = $fila->prestamos_model->cantidad_prestamos($idpersona);
    $cantidad = $prestamo[0]->cantidad;
    
    return $cantidad; 
  } 
 	
 	
 } 

  function nombre_prestatario($idpersona = 0)
 {
  $fila =& get_instance();  
  $fila->load->model('persona_model');
  if($idpersona == 0)
  {
    $nombre = "";
  }   
  else
  {
    $persona = $fila->persona_model->persona_id($idpersona);
    $nombre = $persona[0]->nombres." ".$persona[0]->primer_apellido." ".$persona[0]->segundo_apellido." ".$persona[0]->apellido_casada;  
  } 
  
  return $nombre;
 }

 function nombre_usuario($idpersona = 0)
 {
  $fila =& get_instance();  
  $fila->load->model('usuarios_model');
  if($idpersona == 0)
  {
    $nombre = "";
  }   
  else
  {
    $persona = $fila->usuarios_model->seleccionar_usuarios_id($idpersona);
    $nombre = $persona[0]->nombres." ".$persona[0]->apellido_paterno." ".$persona[0]->apellido_materno;  
  } 
  
  return $nombre;
 }



function devolver_dias($edad,$hoy)
{
   

    $fecha1 = new DateTime($edad);
    $fecha2 = new DateTime($hoy);
    $fecha = $fecha1->diff($fecha2);
    $e = $fecha->format('%a');;
    return $e;
}
function diasemana($fecha)
{
   $arrayDias = array('Domingo', 'Lunes', 'Martes','Miercoles', 'Jueves', 'Viernes', 'Sabado');
     
    $dia=date("w", strtotime($fecha));
    return $arrayDias[$dia];
}
function garantias($idprestamo)
{
    $fila =& get_instance();  
    $fila->load->model('kardex_model');
    if($idprestamo == 0)
    {
      $nombre = "";
    }   
    else
    {
      $garantias = $fila->kardex_model->getgarantias($idprestamo); 

      if($garantias)
      {
        $nombre = $garantias[0]->descripcion_bien." - ".$garantias[0]->descripcion;    
      } 
      else
      {
        $nombre = "SIN GARANTIA";
      }     
    } 
    
    return $nombre;
}
 ?> 






