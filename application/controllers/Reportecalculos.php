
<?php

class Reportecalculos extends CI_Controller
{
    	function __construct(){
    		parent::__construct();
    		$this->_is_logued_in();
    		$this->load->helper(array('form', 'url'));
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
            $this->load->view("inicio/cabecera");
            $this->load->view("inicio/menu");
            $this->load->view("inicio/cuerpo");
            $this->load->view("inicio/pie");
        }        
        function calcularpagos2($persona,$fecha,$tipomoneda,$tipocambioini,$montoprestamobs,$montoprestamo,$intcorriente,$plazoprestamo)
        {
            echo $fecha;
        }

        function imprimircalculospagos($prestamo)
        {   
               $tbl_fondoTitulos1 = array('height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '150,203,184', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            
            $tbl_cuerpo = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo1 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            $tbl_cuerpo2 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            $col_color = "255,255,255";
            $tbl_trasparente3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
           
           
          

           $tbl_firmas = array('height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $col_color = "255,255,255";


            $kardex = $this->kardex_model->getprestamosid($prestamo);
            $pagos =  $this->kardex_model->getcontrol_pagos($prestamo);
            $tiporeporte = "KARDEX INDIVIDUAL";
            $id = $this->session->userdata('id_per');
            $this->fpdf = new Pdf2();
            $fecha_hoy = $this->fpdf->fechacompleta();
           $fecha = date('Y-m-j H:i:s');
            $nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
            $hora = date ( 'H:i:s' , $nuevafecha );
            $this->fpdf->fecha = "Fecha:  ".$fecha_hoy ." Hrs:".$hora; 
            $this->fpdf->xheader = 40;
            $this->fpdf->yheader = 8;
            $this->fpdf->cabecera = 1;
            $columnas3 = array();
            $col3 = array();

            
            $sum = 0;
            $sum2 = 0;
            $moneda = $kardex[0]->descripcion;
            

            $this->fpdf->titulo = "EMPRESA DE PRESTAMOS FINANCYATE";
            $this->fpdf->titulo1 = "CONTROL DE PAGOS";
            $this->fpdf->moneda =$moneda;
            
            $this->fpdf->AddPage('P','Letter',null,null);//CREACION DE PAGINA

            if($kardex[0]->idtipomoneda == 1) {$montoprestamobs = $kardex[0]->saldocapitalbs;}else{ $montoprestamobs = $kardex[0]->saldocapital;}

            $col1[] = array_merge(array('text' => utf8_decode('PRESTATARIO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode(nombre_prestatario($kardex[0]->id_pers)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('PLAZO DE PAGO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->nro_cuotas." meses"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('TIPO DE MONEDA:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->descripcion), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('INTERES CORRIENTE (%):'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->interescorriente), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('MONTO DEL PRESTAMO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($montoprestamobs.".-"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;

            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('FECHA DE PRESTAMO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->fechaprestamo), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('ESTADO DEL PRÉSTAMO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->descripcion_est), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;


             $col2[] = array_merge(array('text' => utf8_decode('NRO CUOTA'), 'width' => 11, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('DETALLE'), 'width' => 25, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('DIA.'), 'width' => 17, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('FECHAS'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('DIAS DE INTERES'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('SALDO CAPITAL'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('CAPITAL'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            
            $col2[] = array_merge(array('text' => utf8_decode('CARGO CORRIENTE'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('MONTO A AMORT'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('ESTADO'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            
            
            $columnas2[] = $col2;
             unset($col2);    

             $totalcapital = 0;
               

                $totalcorriente = 0;
                $totalamortizar = 0;

             if(!empty($pagos))
            {
                foreach($pagos as $valor)
                {
                      
                      $totalcapital = $totalcapital +  $valor->monto_mensual;
               

                $totalcorriente = $totalcorriente +$valor->cargo_corriente;
                $totalamortizar = $totalamortizar +$valor->monto_amortizar;


                        if($valor->estado_pago == 't'){$estado = "CANCELADO";}else{$estado = "PENDIENTE";}
                     
                        $col2[] = array_merge(array('text' => utf8_decode( $valor->nro_pago), 'width' => 11, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( "AMORTIZACIÓN ".$valor->nro_pago), 'width' => 25, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( diasemana($valor->fecha_pago)), 'width' => 17, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( $valor->fecha_pago), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( $valor->diasinnteres), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( $valor->saldo_capital), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( $valor->monto_mensual), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( $valor->cargo_corriente), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( $valor->monto_amortizar), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col2[] = array_merge(array('text' => utf8_decode( $estado), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                       
                        $columnas2[] = $col2;
                        unset($col2);                   
                }
            }
             $col2[] = array_merge(array('text' => utf8_decode("TOTALES "), 'width' => 108, 'fillcolor' => $col_color),$tbl_cuerpo);
                $col2[] = array_merge(array('text' => round($montoprestamobs,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo);                
                $col2[] = array_merge(array('text' => round($totalcorriente,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo);
                
                $col2[] = array_merge(array('text' => round($totalamortizar,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo);
                $col2[] = array_merge(array('text' => utf8_decode(''), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo);
                $columnas2[] = $col2;

             $this->fpdf->WriteTable($columnas1);
              $this->fpdf->Ln(2);
            $this->fpdf->WriteTable($columnas2);

            $this->fpdf->Output();

        }
        function calcularpagos($persona,$fecha,$tipomoneda,$tipocambioini,$montoprestamobs,$montoprestamo,$intcorriente,$plazoprestamo)
        {           
           
            $tbl_fondoTitulos1 = array('height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '150,203,184', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            
            $tbl_cuerpo = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo1 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            $tbl_cuerpo2 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            $col_color = "255,255,255";
            $tbl_trasparente3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
           
           
          

           $tbl_firmas = array('height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $col_color = "255,255,255";



            $tiporeporte = "KARDEX INDIVIDUAL";
            $id = $this->session->userdata('id_per');
            $this->fpdf = new Pdf2();
            $fecha_hoy = $this->fpdf->fechacompleta();
            $this->fpdf->fecha = "Fecha:  ".$fecha_hoy;
            $this->fpdf->xheader = 40;
            $this->fpdf->yheader = 8;
            $this->fpdf->cabecera = 1;
            $columnas3 = array();
            $col3 = array();

            
            $sum = 0;
            $sum2 = 0;
            $moneda = "Bolivianos";
            if($tipomoneda == 2)
            {
                $moneda = "Dolar";
                $montoprestamobs = $montoprestamo;
            }

            $this->fpdf->titulo = "EMPRESA DE PRESTAMOS FINANCYATE";
            $this->fpdf->titulo1 = "CÁLCULO DE PAGOS";
            $this->fpdf->moneda =$moneda;
            
            $this->fpdf->AddPage('P','Letter',null,null);//CREACION DE PAGINA

           
           //($fecha,$tipomoneda,$tipocambioini,$montoprestamobs,$montoprestamo,$intcorriente,$plazoprestamo
          
            $col1[] = array_merge(array('text' => utf8_decode('PRESTATARIO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode(nombre_prestatario($persona)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('PLAZO DE PAGO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($plazoprestamo." meses"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('TIPO DE MONEDA:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($moneda), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('INTERES CORRIENTE (%):'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($intcorriente), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('MONTO DEL PRESTAMO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($montoprestamobs.".-"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;

            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('FECHA DE PRESTAMO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($fecha), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('TIPO DE CAMBIO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($tipocambioini), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
           // unset($col1);

           
            $col2[] = array_merge(array('text' => utf8_decode('NRO CUOTA'), 'width' => 11, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('DETALLE'), 'width' => 25, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('DIA.'), 'width' => 17, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('FECHAS'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('DIAS DE INTERES'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('SALDO CAPITAL'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('CAPITAL'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            
            $col2[] = array_merge(array('text' => utf8_decode('CARGO CORRIENTE'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('CARGO PENAL'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('MONTO A AMORT'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            
            $columnas2[] = $col2;
            unset($col2);
             $col2[] = array_merge(array('text' => utf8_decode(0), 'width' => 11, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode('DESEMBOLSO'), 'width' => 25, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode( diasemana($fecha)), 'width' => 17, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode($fecha), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode(0), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode($montoprestamobs), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode(0.00), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode(0.00), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode(0.00), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col2[] = array_merge(array('text' => utf8_decode(0.00), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $columnas2[] = $col2;
            unset($col2);

            $cont = 1; $totalcapital = 0; $totalcorriente = 0; $totalamortizar = 0;
            $capital = ($montoprestamobs / $plazoprestamo); 
            $fechacalculo = $fecha;
            
            while($cont<=$plazoprestamo)
            { 
                $totalcapital = $totalcapital + $capital;
                $nuevafecha = strtotime ( '+30 day' , strtotime ( $fechacalculo ) ) ;
                $nuevafecha2 = date ( 'Y-m-j' , $nuevafecha );  
                $dias = devolver_dias($fechacalculo,$nuevafecha2);
                $fechacalculo = date ( 'Y-m-j' , $nuevafecha );
                
                $cargocorriente = ($montoprestamobs*(($intcorriente*12)/100)*$dias )/360;
                $montoprestamobs = ($montoprestamobs - $capital);   
                $amorizar = ($cargocorriente+$capital);
                $totalcorriente = $totalcorriente + $cargocorriente;
                                $totalamortizar = $totalamortizar + $amorizar;
                //$pagos = $this->prestamos_model->insert_pagos($idprestamo,$cont,$fechacalculo,false,$dias,$montoprestamobs,$capital,$cargocorriente,$amorizar,$tipomoneda);
                
                $col2[] = array_merge(array('text' => utf8_decode($cont), 'width' => 11, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $col2[] = array_merge(array('text' => utf8_decode("AMORTIZACION ".$cont), 'width' => 25, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $col2[] = array_merge(array('text' => utf8_decode( diasemana($fechacalculo)), 'width' => 17, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $col2[] = array_merge(array('text' => utf8_decode($fechacalculo), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $col2[] = array_merge(array('text' => utf8_decode($dias), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $col2[] = array_merge(array('text' => round($montoprestamobs,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $col2[] = array_merge(array('text' => round($capital,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);                
                $col2[] = array_merge(array('text' => round($cargocorriente,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $col2[] = array_merge(array('text' => utf8_decode(0.00), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $col2[] = array_merge(array('text' => round($amorizar,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $columnas2[] = $col2;
                unset($col2);
                $cont = $cont +1 ;
            }

             
                $col2[] = array_merge(array('text' => utf8_decode("TOTALES "), 'width' => 108, 'fillcolor' => $col_color),$tbl_cuerpo);
                $col2[] = array_merge(array('text' => round($totalcapital,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo);                
                $col2[] = array_merge(array('text' => round($totalcorriente,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo);
                $col2[] = array_merge(array('text' => utf8_decode(0.00), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo);
                $col2[] = array_merge(array('text' => round($totalamortizar,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo);
                $columnas2[] = $col2;
                

/*
             if(!empty($amortizacioness))
            {
                foreach($amortizacioness as $valor)
                {
                     
                     
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->ncuota), 'width' => 11, 'fillcolor' => $col_color),$tbl_cuerpo1);
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->nro_recibo), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->descripcion), 'width' => 40, 'fillcolor' => $col_color),$tbl_cuerpo);
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->tipocambio), 'width' => 10, 'fillcolor' => $col_color),$tbl_cuerpo1);
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->fechacalculo), 'width' => 17, 'fillcolor' => $col_color),$tbl_cuerpo1);
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->diasinteres), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->saldocapitalbs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->amortcapitalbs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                        $col3[] = array_merge(array('text' => utf8_decode( $valor->intcorrientecargobs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                       
                        
                        $columnas3[] = $col3;
                        unset($col3);                   
                }
            }*/

           
            
          
            $this->fpdf->WriteTable($columnas1);
              $this->fpdf->Ln(2);
            $this->fpdf->WriteTable($columnas2);
            //$this->fpdf->Ln(2);
           // $this->fpdf->WriteTable($columnas3); 
                

                $this->fpdf->Output();
        }		
}
?>