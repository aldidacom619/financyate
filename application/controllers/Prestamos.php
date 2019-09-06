<?php

class Prestamos extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->_is_logued_in();
		$this->load->helper(array('form', 'url','date'));
		$this->load->model('persona_model');
		$this->load->model('prestamos_model');
		$this->load->model('kardex_model');
		$this->load->helper('prestamo_helper');
	}
	function _is_logued_in()
	{
		$is_logued_in = $this->session->userdata('is_logued_in'); 
		if($is_logued_in != TRUE)
		{
			//echo $is_logued_in;
			redirect('usuarios');
		}	
	}
	function index() 
	{
		$menu = $this->session->userdata('menu');
			$dato['prestamos'] = $this->prestamos_model->seleccionar_prestamos();
			$this->load->view("inicio/cabecera");
			$this->load->view("inicio/$menu");
			$this->load->view("prestamos/lista_prestamos",$dato);
			$this->load->view("inicio/pie");
	}
	function verprestamos($idpersona)
	{
		$menu = $this->session->userdata('menu');
		$dato['accion'] = "nuevo";
		$dato['persona'] = $idpersona;
		$dato['prestamos'] = $this->prestamos_model->seleccionar_prestamos_persona($idpersona);
		$dato['id_persona'] = $idpersona;
		$this->load->view("inicio/cabecera"); 
		$this->load->view("inicio/$menu");
		$this->load->view("prestamos/ver_prestamos",$dato);
		$this->load->view("inicio/pie");
	}
	function nuevoprestamo($idpersona)
	{
		$menu = $this->session->userdata('menu');
		$dato['accion'] = "nuevo";
		$dato['id_persona'] = $idpersona;
		$this->load->view("inicio/cabecera"); 
		$this->load->view("inicio/$menu");
		$this->load->view("prestamos/nuevo_prestamo",$dato);
		$this->load->view("inicio/pie");
	}

	function modificarprestamo($idprestamo)
	{
		$menu = $this->session->userdata('menu');
		$dato['accion'] = "nuevo";
		$dato['prestamo'] = $idprestamo;
		$this->load->view("inicio/cabecera"); 
		$this->load->view("inicio/$menu");
		$this->load->view("prestamos/modificarprestamo",$dato);
		$this->load->view("inicio/pie");
	}
	function datoprestamo() 
	{
		$id = $this->input->get('idp');
		$datos =$this->prestamos_model->prestamo_id($id);
	 	$json = json_encode($datos); 
     	echo $json;
	}

	function claseprestamo()
	{
		$filas = $this->prestamos_model->getclaseprestamo();
		$option = "<option VALUE='-1'>Seleccionar opcion</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->id_clase."'>".$fila->descripcion_clas."</option>";		
		}
		echo $option;	
	}
	function tipogarantia()
	{
		$filas = $this->prestamos_model->gettipogarantia();
		$option = "<option VALUE='-1'>Seleccionar opcion</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->id_tipo_gar."'>".$fila->descripcion_gar."</option>";		
		}
		echo $option;	
	}
	function estado_prestamo()
	{
		$filas = $this->prestamos_model->getestadoprestamo();
		$option = "<option VALUE='-1'>Seleccionar opcion</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->id_est_pres."'>".$fila->descripcion_est."</option>";		
		}
		echo $option;	
	}
	function tipocambiomoneda()
	{
		$fecha = $this->input->get('fec');
		$filas = $this->prestamos_model->gettipocambio($fecha);
		if($filas)
		{
			echo $filas[0]->valor;
		}else{ echo 1;}	
		
	}
	function calcularprestamo()
	{
		$dato['fecha'] = $this->input->get('fecha_prestamo');
		$dato['tipomoneda'] = $this->input->get('tipomoneda');
		$dato['tipocambioini'] = $this->input->get('tipocambioini');
		$dato['montoprestamobs'] = $this->input->get('montoprestamobs');
		$dato['montoprestamo'] = $this->input->get('montoprestamo');
		$dato['intcorriente'] = $this->input->get('intcorriente');
		$dato['plazoprestamo'] = $this->input->get('plazoprestamo');
		$this->load->view("prestamos/calulo_cuotas",$dato);

	}
	function guardarprestamo()
	{

		$accion = $this->input->get('accion');
		$id_prestamo = $this->input->get('id_prestamo');
		$fechaprestamo = $this->input->get('fecha_prestamo');
		$moneda = $this->input->get('tipomoneda');
		$tipocambio = $this->input->get('tipocambioini');
		$tipocambioiniaux = $this->input->get('tipocambioiniaux');
		
		$capitalbs = $this->input->get('montoprestamobs');
		$capital = $this->input->get('montoprestamo'); 
		$corriente = $this->input->get('intcorriente');
		$penal = $this->input->get('intcorriente');

		$idpersona = $this->input->get('id_persona');
		$clase = $this->input->get('claseprestamo');
		$garantia = $this->input->get('tipogarantia');
		$usuario = $this->session->userdata('id_user');
		$fechadesembolso = $this->input->get('fecdesembolso');
		
		 
		$observaciones = $this->input->get('observacioesprestamo');
		$contrato = $this->input->get('contrato');
		$cuotas = $this->input->get('plazoprestamo');
		$nuevafecha = strtotime ( '+'.$cuotas.' month' , strtotime ( $fechaprestamo ));
		$plazo = date ( 'Y-m-j' , $nuevafecha );

		$cargo_cuota_mes = $capitalbs / $cuotas;

		if($tipocambioiniaux == 2)
		{
			$tipcamb = $this->prestamos_model->insert_tipo_cambio($fechaprestamo,$tipocambio);
		}	
		if($accion == 'nuevo')
		{
			$id_prestamo = $this->prestamos_model->insertar_prestamo($idpersona,$moneda,$clase,$garantia,$usuario,$fechaprestamo,$fechadesembolso,$capitalbs,$capital,$plazo,$tipocambio,$observaciones,$corriente,$penal,$contrato,$cuotas);
		}
		else
		{
			$modificar = $this->prestamos_model->modificar_prestamo($id_prestamo,$idpersona,$moneda,$clase,$garantia,$usuario,$fechaprestamo,$fechadesembolso,$capitalbs,$capital,$plazo,$tipocambio,$observaciones,$corriente,$penal,$contrato,$cuotas);
			$amort = $this->prestamos_model->eliminar_amortizacion($id_prestamo);
			$pagos = $this->prestamos_model->eliminar_pagos($id_prestamo);
		}	


		$this->insercarcularmontos($id_prestamo,$fechaprestamo,$moneda,$capitalbs,$capital,$corriente,$cuotas);
		$insert = $this->kardex_model->insertar_amortizacion($id_prestamo,$usuario,0,0,$fechaprestamo,0,$tipocambio,0,'REGISTRO PRESTAMO',0,0,$capital,$capitalbs,0,0,0,0,0,0,0,0,0,0,0,0,$capital,$capitalbs,0,0,true,$moneda,($cargo_cuota_mes / $tipocambio),$cargo_cuota_mes,$corriente,$penal,$cuotas,false,1,false,$plazo,1);
		echo "SE REALIZO ELL REGISTRO CORRECTAMENTE";
	}

	function sumar_meses()
	{
		$mes = 4;
		$fechacalculo = '2018-07-21';
		$nuevafecha = strtotime ( '+'.$mes.' month' , strtotime ( $fechacalculo ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

		//echo $nuevafecha;
		$usuario = $this->session->userdata('id_user');
		echo $usuario;
	}
	function insercarcularmontos($idprestamo,$fecha,$tipomoneda,$montoprestamobs,$montoprestamo,$intcorriente,$plazoprestamo)
	{
		if($tipomoneda == 2)
		{
			$montoprestamobs = $montoprestamo;
		}

		$pagos = $this->prestamos_model->insert_pagos($idprestamo,0,$fecha,true,0,$montoprestamobs,0,0,0,$tipomoneda);
		$cont = 1; 
		$capital = ($montoprestamobs / $plazoprestamo);	
		$fechacalculo = $fecha;
		
 		while($cont<=$plazoprestamo)
 		{ 
 			
			$nuevafecha = strtotime ( '+30 day' , strtotime ( $fechacalculo ) ) ;
			$nuevafecha2 = date ( 'Y-m-j' , $nuevafecha );	
			$dias = devolver_dias($fechacalculo,$nuevafecha2);
			$fechacalculo = date ( 'Y-m-j' , $nuevafecha );
			
			$cargocorriente = ($montoprestamobs*(($intcorriente*12)/100)*$dias )/360;
			$montoprestamobs = ($montoprestamobs - $capital);	
			$amorizar = ($cargocorriente+$capital);
			
			$pagos = $this->prestamos_model->insert_pagos($idprestamo,$cont,$fechacalculo,false,$dias,$montoprestamobs,$capital,$cargocorriente,$amorizar,$tipomoneda);
			

     		$cont = $cont +1 ;
 		}
				    		
	}

	function calculodiasinteres()
	{
		$fecha1 = $this->input->get('fec');
		$fecha2 = $this->input->get('fec2');
		$dias = devolver_dias($fecha1,$fecha2);
		echo $dias;
	}
}
?>