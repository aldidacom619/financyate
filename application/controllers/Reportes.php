<?php

class Reportes extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->_is_logued_in();
		$this->load->model('persona_model');
		$this->load->model('prestamos_model');
		$this->load->model('kardex_model');
		$this->load->helper('prestamo_helper');
		$this->load->library('pdf2');
    		$this->load->library('form_validation');
			$this->load->helper('download');
			$this->load->helper('date'); 
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
			$this->load->view("inicio/cabecera");
			$this->load->view("inicio/$menu");
			$this->load->view("inicio/reportes");
			$this->load->view("inicio/pie");
	}

	function imprimirprestamos($moneda=0,$estado =0)
	{
			$tiporeporte = "";
			
			
			$dato = $this->prestamos_model->seleccionar_prestamos_reporte($moneda,$estado);
				$tiporeporte = "TODOS LOS PRESTAMOS";
			

			$id = $this->session->userdata('id_per');
			$this->fpdf = new Pdf2();
			$fecha_hoy = $this->fpdf->fechacompleta();
	       $fecha = date('Y-m-j H:i:s');
  			$nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
  			$hora = date ( 'H:i:s' , $nuevafecha );
	        $this->fpdf->fecha = "Fecha:  ".$fecha_hoy ." Hrs:".$hora; 
	        $this->fpdf->xheader = 40;
	        $this->fpdf->yheader = 8;
	        $this->fpdf->cabecera = 3;
			
			$sum = 0;
			$sum2 = 0;
			$encabezados = array('Nro','Prestatario', 'Fecha de Prestamo', 'Tipo Moneda','Tipo de Cambio','Int Corriente','Int penal','Nro Cuotas','Plazo Prestamo','Clase Prestamo','Tipo de Garantia','Estado', 'Monto de Préstamo','Deuda Pendiente');
	        $w = array(8,50,15,20,15,15,15,15,15,20,20,15,15,15);
	        foreach ($encabezados as $val){
	            $encabezados_[] = iconv('UTF-8', 'windows-1252', $val);
	        }
	        $this->fpdf->setEncabezadoG($encabezados_);
	        $this->fpdf->setWidthsG($w);
	       $this->fpdf->titulo = "EMPRESA DE PRESTAMOS FINANCYATE";
            $this->fpdf->titulo1 = $tiporeporte ;$this->fpdf->moneda = $moneda;
	        
	        $this->fpdf->AddPage('L','Letter',null,null);
	        $num = 1;
	        $this->fpdf->SetFont('Arial', '', 7);
	        $this->fpdf->SetFillColor(0);
	        $this->fpdf->SetTextColor(0);


	      if(!empty($dato))
	        {
	            foreach($dato as $valor)
	            {
	            	 if($valor->idtipomoneda == 1) {$montoprestamobs = $valor->saldocapitalbs; $totaldeudabs = $valor->totaldeudabs; }else{ $montoprestamobs = $valor->saldocapital;  $totaldeudabs = $valor->totaldeuda;}
	            	
	                 $s = array(
	                    $num,
	                    iconv('UTF-8', 'windows-1252',nombre_prestatario($valor->id_pers)),
	                    iconv('UTF-8', 'windows-1252', $valor->fechaprestamo),
	                    iconv('UTF-8', 'windows-1252', $valor->descripcion),
	                    iconv('UTF-8', 'windows-1252', $valor->cambioinicial),
	                    iconv('UTF-8', 'windows-1252', $valor->interescorriente),
	                    iconv('UTF-8', 'windows-1252', $valor->interespenal),
	                    
	                    iconv('UTF-8', 'windows-1252', $valor->nro_cuotas), 
	                    iconv('UTF-8', 'windows-1252', $valor->plazoprestamo),
	                    
	                    iconv('UTF-8', 'windows-1252', $valor->descripcion_clas),
	                    iconv('UTF-8', 'windows-1252', $valor->descripcion_gar),
	                    iconv('UTF-8', 'windows-1252', $valor->descripcion_est),
	                    iconv('UTF-8', 'windows-1252', $montoprestamobs),
	                    iconv('UTF-8', 'windows-1252', $totaldeudabs),
	                    
	                    
	                    
	                );
	                $this->fpdf->Row($s, true, '', 6);
	                $num++;
	            }
	        }
	        	

				$this->fpdf->Output();
	}

	function reporteamortizaciones($fecha1, $fecha2)
	{
		$tiporeporte = "";
			
			
			$dato = $this->prestamos_model->seleccionar_amortizaciones_fechas($fecha1,$fecha2);
				$tiporeporte = "REPORTE DE RECUPERACIÓN DE PRESTAMOS";
			

			$id = $this->session->userdata('id_per');
			$this->fpdf = new Pdf2();
			$fecha_hoy = $this->fpdf->fechacompleta();
			$fecha = date('Y-m-j H:i:s');
  			$nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
  			$hora = date ( 'H:i:s' , $nuevafecha );
	        $this->fpdf->fecha = "Fecha:  ".$fecha_hoy ." Hrs:".$hora; 
	        $this->fpdf->xheader = 40;
	        $this->fpdf->yheader = 8;
	        $this->fpdf->cabecera = 3;
			
			$sum = 0;
			$sum2 = 0;
			$encabezados = array('Nro','Nro. Credito','Prestatario', 'Fecha de Prestamo', 'Tipo Moneda','Int Corriente','Int penal','Nro Cuotas','Plazo Prestamo','Estado', 'Monto de Préstamo','Deuda Pendiente', 'Fecha de Pago', 'Cuota', 'Usuario' );
	        $w = array(8,10,50,15,20,10,10,12,15,18,15,15,15,15,30);
	        foreach ($encabezados as $val){
	            $encabezados_[] = iconv('UTF-8', 'windows-1252', $val);
	        }
	        $this->fpdf->setEncabezadoG($encabezados_);
	        $this->fpdf->setWidthsG($w);
	       $this->fpdf->titulo = "EMPRESA DE PRESTAMOS FINANCYATE";
            $this->fpdf->titulo1 = $tiporeporte ;

            $this->fpdf->moneda = "";
	        
	        $this->fpdf->AddPage('L','Letter',null,null);
	        $num = 1;
	        $this->fpdf->SetFont('Arial', '', 7);
	        $this->fpdf->SetFillColor(0);
	        $this->fpdf->SetTextColor(0);

	        $totarecuperado = 0;
	      if(!empty($dato))
	        {
	            foreach($dato as $valor)
	            {
	            	 if($valor->idtipomoneda == 1) {$montoprestamobs = $valor->saldocapitalbs; $totaldeudabs = $valor->totaldeudabs; 
	            	 	$cuota = $valor->cuotatotalbs;}
	            	 	else{ 
	            	 		$montoprestamobs = $valor->saldocapital;  $totaldeudabs = $valor->totaldeuda;$cuota = $valor->cuotatotal;}
	            		$totarecuperado = $totarecuperado + $cuota;
	                 $s = array(
	                    $num,
	                    iconv('UTF-8', 'windows-1252', $valor->id_prestamo),
	                    iconv('UTF-8', 'windows-1252',nombre_prestatario($valor->id_pers)),
	                    
	                    iconv('UTF-8', 'windows-1252', $valor->fechaprestamo),
	                    iconv('UTF-8', 'windows-1252', $valor->descripcion),
	                    
	                    iconv('UTF-8', 'windows-1252', $valor->interescorriente),
	                    iconv('UTF-8', 'windows-1252', $valor->interespenal),
	                    
	                    iconv('UTF-8', 'windows-1252', $valor->nro_cuotas), 
	                    iconv('UTF-8', 'windows-1252', $valor->plazoprestamo),
	                    
	                    
	                    
	                    iconv('UTF-8', 'windows-1252', $valor->descripcion_est),
	                    iconv('UTF-8', 'windows-1252', $montoprestamobs),
	                    iconv('UTF-8', 'windows-1252', $totaldeudabs),
	                     iconv('UTF-8', 'windows-1252', $valor->fechacalculo),
	                    iconv('UTF-8', 'windows-1252', $cuota),
	                    iconv('UTF-8', 'windows-1252', nombre_usuario($valor->idusuarioconfirmacion)),
	                    
	                    
	                    
	                );
	                $this->fpdf->Row($s, true, '', 6);
	                $num++;
	            }

	             $s = array(
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    '-----',
	                    iconv('UTF-8', 'windows-1252', $totarecuperado),'TOTALES', );
	             $this->fpdf->Row($s, true, '', 6);
	        }
	        	

				$this->fpdf->Output();
	}
	
		
	

}
?>