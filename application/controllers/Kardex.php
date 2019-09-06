<?php

class Kardex extends CI_Controller
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
	
	function verprestamo($idprestamo) 
	{
			$menu = $this->session->userdata('menu');
			$dato['kardex'] = $this->kardex_model->getprestamosid($idprestamo);
			$dato['amortizacioness'] = $this->kardex_model->amortizaciones($idprestamo);
			$dato['garantes'] = $this->kardex_model->getgarantespres($idprestamo);
			$this->load->view("inicio/cabecera");
			$this->load->view("inicio/$menu");
			$this->load->view("kardex/verdatosprestamo",$dato);
			$this->load->view("inicio/pie");
	}
	function datosgarantes()
	{
		$idga = $this->input->get('idga');
		$dato['filas'] = $this->kardex_model->getgarantes($idga);
		$this->load->view("kardex/modagarate",$dato);
	}
	function eliminargarantes()
	{
		$ga = $this->input->get('ga');
		$pre = $this->input->get('pre');
		$delete = $this->kardex_model->deletegarantes($pre,$ga);
		echo "1";
	}
	function buscarpersona()
	{
		$ci = $this->input->get('cis');

		$dato['filas'] = $this->kardex_model->getbuscargarantes($ci);
		$this->load->view("kardex/buscagarantes",$dato);
	}
	function selectgarates()
	{
		$id = $this->input->get('garante');

		$datos =$this->kardex_model->getgarantes($id);
	 	$json = json_encode($datos); 
     	echo $json;
	}
	function guardargarantes()
	{
		$ga = $this->input->get('ga');
		$pre = $this->input->get('pre');
		
		$garante = $this->kardex_model->insert_garante($ga,$pre); 	
		echo $ga;
	}
	function tipogarantia()
	{
		$filas = $this->kardex_model->gettipogarantia();
		$option = "<option VALUE='-1'>Seleccionar opcion</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->id_tipo_gar."'>".$fila->descripcion_gar."</option>";		
		}
		echo $option;	
	}
	function tipobien()
	{
		$filas = $this->kardex_model->gettipobien();
		$option = "<option VALUE='-1'>Seleccionar opcion</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->id_bien."'>".$fila->descripcion_bien."</option>";		
		}
		echo $option;	
	}

	function getgarantia()
	{
		$id = $this->input->get('pre');
		$datos =$this->kardex_model->getgarantiaspres($id);
	 	if($datos)
	 	{
	 		$json = json_encode($datos); 
     		echo $json;		
	 	}
	 	else
	 	{
	 		echo 1;	
	 	}
	}
	function eliminargarantia()
	{
		$ga = $this->input->get('ga');
		$delete = $this->kardex_model->deletegarantia($ga);
		echo "1";
	}
	function guardargarantia()
	{
		if($this->input->get('acciongar') == 'nuevo')
		{
			$garante = $this->kardex_model->insert_garantia($this->input->get('id_prestamogar'),$this->input->get('biengar'),$this->input->get('descripciongar'),$this->input->get('observaciongar'),$this->input->get('tipo_g'));
			echo $garante;
		}
		else
		{	
			$actualizar = $this->kardex_model->modificar_garantia($this->input->get('id_garantia'),$this->input->get('biengar'),$this->input->get('descripciongar'),$this->input->get('observaciongar'),$this->input->get('tipo_g'));
				
		}
	}

	function controlpagosk()
	{
		$prestamo = $this->input->get('idpres');
		//$prestamo = 8;
		$dato['filas'] = $this->kardex_model->getcontrol_pagos($prestamo);
		$this->load->view("kardex/listacontrol_pagos",$dato);
	}
	function amortizacion()
	{
		$prestamo = $this->input->get('idpres');
		//$prestamo = 8;
		$datos =$this->kardex_model->getamortizacionkardex($prestamo);
	 	$json = json_encode($datos); 
     	echo $json;
		
		//$this->load->view("kardex/amortizacion",$dato);	
	}
	function getamortizaciones()
	{
		$prestamo = $this->input->get('idpres');
		$cuota = $this->input->get('cuota');
		
		$datos =$this->kardex_model->getamortizacioncuotas($prestamo,$cuota);
	 	$json = json_encode($datos); 
     	echo $json;
	}
	function amortizacionpagos()
	{
		$pago = $this->input->get('pag');
		//$prestamo = 8;
		$datos =$this->kardex_model->getpagoskardex($pago);
	 	$json = json_encode($datos); 
     	echo $json;
	}
	function guardaramortizacion()
	{
		$usuario = $this->session->userdata('id_user');
		$nro_cuotaanterior= $this->input->get('nro_cuotaanterior') +1 ;
		$accionamort= $this->input->get('accionamort');
		$id_prestamoamort= $this->input->get('id_prestamoamort');
		$amortizacionid= $this->input->get('amortizacionid');
		$moneda= $this->input->get('moneda');
		$deuda_anterior= $this->input->get('deuda_anterior');
		$fecha_anterior= $this->input->get('fecha_anterior');
		$capital_anterior= $this->input->get('capital_anterior');
		$corriete_anterior= $this->input->get('corriete_anterior');
		$penal_anterior= $this->input->get('penal_anterior');
		$deuda_anterior2= $this->input->get('deuda_anterior2');
		$cuota_anterior = $this->input->get('cuota_anterior');
		$intcorriente = $this->input->get('intcorriente');
		$intpenal = $this->input->get('intpenal');
		$plazo = $this->input->get('plazo');
		$fecha_calculo = $this->input->get('fecha_calculo');		
		$tipo_cambio = $this->input->get('tipo_cambio');	
		$tipocambioiniaux = $this->input->get('tipocambioiniaux');	
		$dias_interes = $this->input->get('dias_interes');
		
		$descripcionnamortizacion = $this->input->get('descripcionnamortizacion');
		$montobs = $this->input->get('montobs');
		$monto = $this->input->get('monto');
		$cargo_interes_penaltxt = $this->input->get('cargo_interes_penaltxt');		
		$cargo_interes_corrientetxt = $this->input->get('cargo_interes_corrientetxt');		
		$cargo_cuota_mestxt = $this->input->get('cargo_cuota_mestxt');		
		$cargo_total_cuotatxt = $this->input->get('cargo_total_cuotatxt');		
		$abono_interes_penaltxt = $this->input->get('abono_interes_penaltxt');		
		$abono_interes_corrientetxt = $this->input->get('abono_interes_corrientetxt');		
		$abono_cuota_mestxt = $this->input->get('abono_cuota_mestxt');		
		$abono_total_cuotatxt = $this->input->get('abono_total_cuotatxt');
		$saldo_interes_penaltxt = $this->input->get('saldo_interes_penaltxt');		
		$saldo_interes_corrientetxt = $this->input->get('saldo_interes_corrientetxt');
		$saldo_cuota_mestxt = $this->input->get('saldo_cuota_mestxt');
		$saldo_total_cuotatxt = $this->input->get('saldo_total_cuotatxt');
		$deposito = $this->input->get('deposito');
		$comprobante = $this->input->get('comprobante');
		$penalizar = $this->input->get('penalizar');
		$corriente = $this->input->get('corriente');
		$plazoprestamoamor = $this->input->get('plazopago');

		if($saldo_total_cuotatxt == 0)
		{
			$cerrar = $this->kardex_model->cerrarprestamo($id_prestamoamort,5);
		}

		if($tipocambioiniaux == 2)
		{
			$tipcamb = $this->prestamos_model->insert_tipo_cambio($fecha_calculo,$tipo_cambio);
		}	
		if($accionamort == 'nuevo')
		{
			
			if($moneda == 1)
			{
				$insert = $this->kardex_model->insertar_amortizacion($id_prestamoamort,$usuario,1,$nro_cuotaanterior,$fecha_calculo,$comprobante,$tipo_cambio,$dias_interes,$descripcionnamortizacion,($abono_cuota_mestxt / $tipo_cambio),$abono_cuota_mestxt,($saldo_cuota_mestxt/ $tipo_cambio),$saldo_cuota_mestxt,($cargo_interes_corrientetxt / $tipo_cambio),$cargo_interes_corrientetxt,($abono_interes_corrientetxt / $tipo_cambio),$abono_interes_corrientetxt,($saldo_interes_corrientetxt / $tipo_cambio),$saldo_interes_corrientetxt,($cargo_interes_penaltxt / $tipo_cambio),$cargo_interes_penaltxt,($abono_interes_penaltxt/ $tipo_cambio),$abono_interes_penaltxt,($saldo_interes_penaltxt / $tipo_cambio),$saldo_interes_penaltxt,($saldo_total_cuotatxt / $tipo_cambio),$saldo_total_cuotatxt,$monto,$montobs,true,$moneda,($cargo_cuota_mestxt / $tipo_cambio),$cargo_cuota_mestxt,$intcorriente,$intpenal,$plazo,$penalizar,$deposito,$corriente,$plazoprestamoamor);	
			}
			else
			{
				$insert = $this->kardex_model->insertar_amortizacion($id_prestamoamort,$usuario,1,$nro_cuotaanterior,$fecha_calculo,$comprobante,$tipo_cambio,$dias_interes,$descripcionnamortizacion,$abono_cuota_mestxt,($abono_cuota_mestxt * $tipo_cambio),$saldo_cuota_mestxt,($saldo_cuota_mestxt * $tipo_cambio),$cargo_interes_corrientetxt,($cargo_interes_corrientetxt * $tipo_cambio),$abono_interes_corrientetxt,($abono_interes_corrientetxt * $tipo_cambio),$saldo_interes_corrientetxt,($saldo_interes_corrientetxt * $tipo_cambio),$cargo_interes_penaltxt,($cargo_interes_penaltxt * $tipo_cambio),$abono_interes_penaltxt,($abono_interes_penaltxt * $tipo_cambio),$saldo_interes_penaltxt,($saldo_interes_penaltxt * $tipo_cambio),$saldo_total_cuotatxt,($saldo_total_cuotatxt * $tipo_cambio),$monto,$montobs,true,$moneda,$cargo_cuota_mestxt,($cargo_cuota_mestxt * $tipo_cambio),$intcorriente,$intpenal,$plazo,$penalizar,$deposito,$corriente,$plazoprestamoamor);
			}
			$cerrar  = $this->prestamos_model->cerrar_prestamo($id_prestamoamort);
			$actualizar_pagos = $this->kardex_model->act_pagos($id_prestamoamort,$fecha_calculo);
		}
		else
		{
			if($moneda == 1)
			{
				$insert = $this->kardex_model->editar_amortizacion($amortizacionid,$id_prestamoamort,$usuario,1,$nro_cuotaanterior,$fecha_calculo,$comprobante,$tipo_cambio,$dias_interes,$descripcionnamortizacion,($abono_cuota_mestxt / $tipo_cambio),$abono_cuota_mestxt,($saldo_cuota_mestxt/ $tipo_cambio),$saldo_cuota_mestxt,($cargo_interes_corrientetxt / $tipo_cambio),$cargo_interes_corrientetxt,($abono_interes_corrientetxt / $tipo_cambio),$abono_interes_corrientetxt,($saldo_interes_corrientetxt / $tipo_cambio),$saldo_interes_corrientetxt,($cargo_interes_penaltxt / $tipo_cambio),$cargo_interes_penaltxt,($abono_interes_penaltxt/ $tipo_cambio),$abono_interes_penaltxt,($saldo_interes_penaltxt / $tipo_cambio),$saldo_interes_penaltxt,($saldo_total_cuotatxt / $tipo_cambio),$saldo_total_cuotatxt,$monto,$montobs,true,$moneda,($cargo_cuota_mestxt / $tipo_cambio),$cargo_cuota_mestxt,$intcorriente,$intpenal,$plazo,$penalizar,$deposito,$corriente,$plazoprestamoamor);	
			}
			else
			{
				$insert = $this->kardex_model->editar_amortizacion($amortizacionid,$id_prestamoamort,$usuario,1,$nro_cuotaanterior,$fecha_calculo,$comprobante,$tipo_cambio,$dias_interes,$descripcionnamortizacion,$abono_cuota_mestxt,($abono_cuota_mestxt * $tipo_cambio),$saldo_cuota_mestxt,($saldo_cuota_mestxt * $tipo_cambio),$cargo_interes_corrientetxt,($cargo_interes_corrientetxt * $tipo_cambio),$abono_interes_corrientetxt,($abono_interes_corrientetxt * $tipo_cambio),$saldo_interes_corrientetxt,($saldo_interes_corrientetxt * $tipo_cambio),$cargo_interes_penaltxt,($cargo_interes_penaltxt * $tipo_cambio),$abono_interes_penaltxt,($abono_interes_penaltxt * $tipo_cambio),$saldo_interes_penaltxt,($saldo_interes_penaltxt * $tipo_cambio),$saldo_total_cuotatxt,($saldo_total_cuotatxt * $tipo_cambio),$monto,$montobs,true,$moneda,$cargo_cuota_mestxt,($cargo_cuota_mestxt * $tipo_cambio),$intcorriente,$intpenal,$plazo,$penalizar,$deposito,$corriente,$plazoprestamoamor);
			}
		}


		
		
	}
	function nuevo_recibo()
	{
		
			$fecha = date('Y-m-j H:i:s');
  			$nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
  			$gestion = date ( 'Y' , $nuevafecha );
  			$usuario = $this->session->userdata('id_user');
			$amortizacion = $this->input->get('am');
			$prestamo= $this->input->get('pre');
			$pago = $this->input->get('pa');
			$persona = $this->input->get('persona');
			$re = $this->kardex_model->numero_recibo($gestion);
			if($re)
			{
				$correlativo = $re[0]->recibo + 1;
			}
			else
			{
				$correlativo = 1;
			}
			
			$rec = $correlativo."/".$gestion;
					
			$amorti = $this->kardex_model->getamortizacionrecibo($amortizacion);
			$idrecibo = $this->kardex_model->insert_recibo($prestamo,$amortizacion,$pago,$amorti[0]->tipocambio,$amorti[0]->cuotatotalbs,$amorti[0]->cuotatotal,$amorti[0]->fechacalculo,$amorti[0]->descripcion,$amorti[0]->tipo_moneda,$gestion,$correlativo,$usuario,$persona);	
			$actualizar = $this->kardex_model->cambiarestadoamortizacion($amortizacion,$rec,$idrecibo);
			

			echo $idrecibo;
	}
	function confirmarpago()
	{
		$amortizacion = $this->input->get('am');

		$usuario = $this->session->userdata('id_user');

		$fecha = date('Y-m-j H:i:s');
  			$nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
  			$fecha = date ( 'Y-m-j H:i:s' , $nuevafecha );

		$actualizar = $this->kardex_model->aceptarpago($amortizacion,$usuario, $fecha);
		echo $amortizacion;
	}
	

}
?>