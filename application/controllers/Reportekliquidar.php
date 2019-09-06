
<?php

class Reportekliquidar extends CI_Controller
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
        function liquidarprestamo($idprestamo,$tipocambio,$fecha,$auxcambio,$pe,$co)
        {           
            $kardex = $this->kardex_model->getprestamosid($idprestamo);
            $amortizacioness = $this->kardex_model->getamortizacionkardex($idprestamo);
            $tbl_fondoTitulos1 = array('height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '150,203,184', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
             $tbl_cuerpo = array('height' => '7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo1 = array('height' => '7', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo2 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $col_color = "255,255,255";
            $tbl_trasparente1 = array('height' => '7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente2 = array('height' => '7', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente3 = array('height' => '7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente4 = array('height' => '7', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente5 = array('height' => '7', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente6 = array('height' => '7', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente7 = array('height' => '7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_firmas = array('height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $col_color = "255,255,255";
            $tiporeporte = "KARDEX INDIVIDUAL";
            $id = $this->session->userdata('id_per');
            $this->fpdf = new Pdf2();
            $fecha_hoy = $this->fpdf->fechacompleta();
             $fecha2 = date('Y-m-j H:i:s');
            $nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha2 ) ) ;
            $hora = date ( 'H:i:s' , $nuevafecha );
            $this->fpdf->fecha = "Fecha:  ".$fecha_hoy ." Hrs:".$hora; 
            $this->fpdf->xheader = 40;
            $this->fpdf->yheader = 8;
            $this->fpdf->cabecera = 1;
            $columnas3 = array();
            $col3 = array();
            $sum = 0;
            $sum2 = 0;
            $this->fpdf->titulo = "EMPRESA DE PRESTAMOS FINANCYATE";
            $this->fpdf->titulo1 = "LIQUIDACIÓN DE PRÉSTAMO";
            $this->fpdf->moneda = $kardex[0]->descripcion;
            $this->fpdf->AddPage('P','Letter',null,null);//CREACION DE PAGINA
            $col4[] = array_merge(array('text' => utf8_decode('DATOS DEL PRESTATARIO'), 'width' => 50, 'fillcolor' => $col_color),$tbl_trasparente3);
            $columnas4[] = $col4;
            $col5[] = array_merge(array('text' => utf8_decode('NOMBRE:'), 'width' => 32, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col5[] = array_merge(array('text' => utf8_decode(nombre_prestatario($kardex[0]->id_pers)), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col5[] = array_merge(array('text' => utf8_decode('C.I.:'), 'width' => 30, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col5[] = array_merge(array('text' => utf8_decode($kardex[0]->ci), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col5[] = array_merge(array('text' => utf8_decode('NRO DE TELÉFONO:'), 'width' => 35, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col5[] = array_merge(array('text' => utf8_decode($kardex[0]->telefono), 'width' => 30, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas5[] = $col5;
            $col6[] = array_merge(array('text' => utf8_decode('DATOS DEL PRÉSTAMO'), 'width' => 50, 'fillcolor' => $col_color),$tbl_trasparente3);
            $columnas6[] = $col6;
            $col1[] = array_merge(array('text' => utf8_decode('MONTO DE PRESTAMO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            if($kardex[0]->idtipomoneda == 1)
            {$col1[] = array_merge(array('text' => utf8_decode($kardex[0]->saldocapitalbs), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);}else
            {$col1[] = array_merge(array('text' => utf8_decode($kardex[0]->saldocapital), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente4);}
            $col1[] = array_merge(array('text' => utf8_decode('FECHA PRÉSTAMO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->fechaprestamo), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
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
            $col1[] = array_merge(array('text' => utf8_decode('CLASE DE PRÉSTAMO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->descripcion_clas), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('INTERES PENAL (%):'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->interespenal), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('SALDO TOTAL:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente3);
            if($kardex[0]->idtipomoneda == 1)
            {$col1[] = array_merge(array('text' => utf8_decode($amortizacioness[0]->totaldeudabs), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);}else
            {$col1[] = array_merge(array('text' => utf8_decode($amortizacioness[0]->totaldeuda), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente4);}
            $columnas1[] = $col1;
            $col2[] = array_merge(array('text' => utf8_decode('DATOS DE LA LIQUIDACIÓN'), 'width' => 50, 'fillcolor' => $col_color),$tbl_trasparente3);
            $columnas2[] = $col2;
            $col3[] = array_merge(array('text' => utf8_decode('Fecha ultimo pago:'), 'width' => 30, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($amortizacioness[0]->fechacalculo), 'width' => 18, 'fillcolor' => $col_color),$tbl_trasparente2);
            $col3[] = array_merge(array('text' => utf8_decode('Tipo de Cambio:'), 'width' => 30, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($amortizacioness[0]->tipocambio), 'width' => 18, 'fillcolor' => $col_color),$tbl_trasparente2);
            $col3[] = array_merge(array('text' => utf8_decode('Fecha de Liquidación:'), 'width' => 40, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($fecha), 'width' => 18, 'fillcolor' => $col_color),$tbl_trasparente2);
            $col3[] = array_merge(array('text' => utf8_decode('Tipo de Cambio:'), 'width' => 27, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($tipocambio), 'width' => 14, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
            unset($col3);
            $col3[] = array_merge(array('text' => utf8_decode(''), 'width' => 195, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
            unset($col3);
            $col3[] = array_merge(array('text' => utf8_decode(''), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente5);
            $col3[] = array_merge(array('text' => utf8_decode('Días de Interes'), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente5);
            $col3[] = array_merge(array('text' => utf8_decode('Intereses pendientes Pago'), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente5);
            $col3[] = array_merge(array('text' => utf8_decode('Cálculo a la fecha'), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente5);
            $col3[] = array_merge(array('text' => utf8_decode('Total Liquidacion'), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente5);
            $columnas3[] = $col3;
            unset($col3);
             /*
                CALCULOS DE LA LIQUIDACION
             */
            $dias = devolver_dias($amortizacioness[0]->fechacalculo,$fecha);
            if($kardex[0]->idtipomoneda == 1){
                $anteriorpenal = $amortizacioness[0]->intpenalsaldobs;
                $anteriorcorriente = $amortizacioness[0]->intcorrientesaldobs;
                $saldocapital= $amortizacioness[0]->saldocapitalbs;
                $saldototal= $amortizacioness[0]->totaldeudabs;
            }
            else
            {
                $anteriorpenal = $amortizacioness[0]->intpenalsaldo;
                $anteriorcorriente = $amortizacioness[0]->intcorrientesaldo;
                $saldocapital= $amortizacioness[0]->saldocapital;
                $saldototal= $amortizacioness[0]->totaldeuda;
            }
            $intcorriente = $kardex[0]->interescorriente;
            $intpenal = $kardex[0]->interespenal;
            $cargopenal = 0;
            $cargocorriente = 0;
            if($dias>30)
            { 
                if($pe==1){

                   $plazopago = $amortizacioness[0]->plazoprestamoamor;
                   if($fecha > $plazopago)
                   {
                        $diasp = devolver_dias($plazopago,$fecha);
                   } 
                   else
                   {
                        $diasp = devolver_dias($fecha,$fecha);
                   }

                   $cargopenal = round((($saldocapital*(($intpenal*12)/100)*($diasp))/360),2);}
                }
            
                if($co==1)
                {
                    $cargocorriente = round((($saldocapital*(($intcorriente*12)/100)*($dias))/360),2);
                }
                
            $total_penal = $anteriorpenal + $cargopenal;
            $total_corriente = $anteriorcorriente + $cargocorriente;
            $totalintereses = round(($cargopenal + $cargocorriente),2);
            $totalliquidacion = round(($total_penal+ $total_corriente+$saldocapital),2);
            $col3[] = array_merge(array('text' => utf8_decode('Interes Penal:'), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($dias), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode($anteriorpenal), 'width' => 29, 'fillcolor' => $col_color),$tbl_trasparente7);
            $col3[] = array_merge(array('text' => utf8_decode('+'), 'width' => 15, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode($cargopenal), 'width' => 24, 'fillcolor' => $col_color),$tbl_trasparente7);
            $col3[] = array_merge(array('text' => utf8_decode('='), 'width' => 15, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode($total_penal), 'width' => 24, 'fillcolor' => $col_color),$tbl_trasparente7);
            $columnas3[] = $col3;
            unset($col3);
            $col3[] = array_merge(array('text' => utf8_decode('Interes Corriente:'), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($dias), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode($anteriorcorriente), 'width' => 29, 'fillcolor' => $col_color),$tbl_trasparente7);
            $col3[] = array_merge(array('text' => utf8_decode('+'), 'width' => 15, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode($cargocorriente), 'width' => 24, 'fillcolor' => $col_color),$tbl_trasparente7);
            $col3[] = array_merge(array('text' => utf8_decode('='), 'width' => 15, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode($total_corriente), 'width' => 24, 'fillcolor' => $col_color),$tbl_trasparente7);
            $columnas3[] = $col3;
            unset($col3);
            $col3[] = array_merge(array('text' => utf8_decode('Saldo Deudor:'), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode(''), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode($saldocapital), 'width' => 29, 'fillcolor' => $col_color),$tbl_trasparente7);
            $col3[] = array_merge(array('text' => utf8_decode('+'), 'width' => 15, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode('0.00'), 'width' => 24, 'fillcolor' => $col_color),$tbl_trasparente7);
            $col3[] = array_merge(array('text' => utf8_decode('='), 'width' => 15, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col3[] = array_merge(array('text' => utf8_decode($saldocapital), 'width' => 24, 'fillcolor' => $col_color),$tbl_trasparente7);
            $columnas3[] = $col3;
            $col7[] = array_merge(array('text' => utf8_decode('TOTAL:'), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col7[] = array_merge(array('text' => utf8_decode(''), 'width' => 39, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col7[] = array_merge(array('text' => utf8_decode($saldototal), 'width' => 29, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col7[] = array_merge(array('text' => utf8_decode('+'), 'width' => 15, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col7[] = array_merge(array('text' => utf8_decode($totalintereses), 'width' => 24, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col7[] = array_merge(array('text' => utf8_decode('='), 'width' => 15, 'fillcolor' => $col_color),$tbl_trasparente6);
            $col7[] = array_merge(array('text' => utf8_decode($totalliquidacion), 'width' => 24, 'fillcolor' => $col_color),$tbl_trasparente1);
            $columnas7[] = $col7;
            unset($col7);
            $x = $this->fpdf->GetY();
            $y = $this->fpdf->GetY();
            $this->fpdf->Line(20, 51, 200, 51);
            $this->fpdf->Line(20, 71, 200, 71);
            $this->fpdf->Line(20, 116, 200, 116);
            $this->fpdf->Line(20, 163, 200, 163);
            $this->fpdf->WriteTable($columnas4); 
            $this->fpdf->Ln(3);
            $this->fpdf->WriteTable($columnas5); 
            $this->fpdf->Ln(3);
            $this->fpdf->WriteTable($columnas6); 
            $this->fpdf->Ln(5);
            $this->fpdf->WriteTable($columnas1); 
            $this->fpdf->Ln(5);
            $this->fpdf->WriteTable($columnas2);
            $this->fpdf->Ln(5);
            $this->fpdf->WriteTable($columnas3); 
            $this->fpdf->Ln(2);
            $this->fpdf->WriteTable($columnas7); 
            $this->fpdf->Output();
        }		
}
?>