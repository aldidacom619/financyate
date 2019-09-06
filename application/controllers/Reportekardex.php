
<?php

class Reportekardex extends CI_Controller
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
        
        function kardexprestamo($idprestamo)
        {
           
            $kardex = $this->kardex_model->getprestamosid($idprestamo);
            $amortizacioness = $this->kardex_model->amortizaciones($idprestamo);
            $garantes = $this->kardex_model->getgarantespres($idprestamo);    

            $tbl_fondoTitulos1 = array('height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '150,203,184', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            
            $tbl_cuerpo = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo1 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            $tbl_cuerpo2 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            $col_color = "255,255,255";

            $tbl_trasparente = array('height' => '10', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            
            $tbl_trasparente2 = array('height' => '10', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');

            $tbl_trasparente3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');

            $tbl_trasparente4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');

            

          

           $tbl_firmas = array('height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $col_color = "255,255,255";



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
           
            $this->fpdf->titulo = "EMPRESA DE PRESTAMOS FINANCYATE";
            $this->fpdf->titulo1 = "KARDEX INDIVIDUAL";
            $this->fpdf->moneda = $kardex[0]->descripcion;
            
            $this->fpdf->AddPage('L','Letter',null,null);//CREACION DE PAGINA

           
           
            $col1[] = array_merge(array('text' => utf8_decode('PRESTATARIO:'), 'width' => 32, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode(nombre_prestatario($kardex[0]->id_pers)), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('OCUPACION:'), 'width' => 30, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->ocupacion), 'width' => 35, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('NRO DE PRÉSTAMO:'), 'width' => 31, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->id_prestamo), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('INTERES CORRIENTE (%):'), 'width' => 40, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->interescorriente), 'width' => 18, 'fillcolor' => $col_color),$tbl_trasparente4);

            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('C.I.:'), 'width' => 32, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->ci), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('CORREO:'), 'width' =>30, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->correo), 'width' => 35, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('TIPO DE MONEDA:'), 'width' => 31, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->descripcion), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('INTERES PENAL (%):'), 'width' => 40, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->interespenal), 'width' => 18, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('TELÉFONO:'), 'width' => 32, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->telefono), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('SEXO:'), 'width' => 30, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->sexo), 'width' => 35, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('FECHA PRÉSTAMO:'), 'width' => 31, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->fechaprestamo), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('PLAZO DE PAGO:'), 'width' => 40, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->nro_cuotas." meses"), 'width' => 18, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('DIRECCIÓN:'), 'width' => 32, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->direccion), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('ESTADO PRÉSTAMO:'), 'width' => 30, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->descripcion_est), 'width' => 35, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('MONTO DE PRESTAMO:'), 'width' => 31, 'fillcolor' => $col_color),$tbl_trasparente3);
            
            
            if($kardex[0]->idtipomoneda == 1)
            {$col1[] = array_merge(array('text' => utf8_decode($kardex[0]->saldocapitalbs), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente4);}else
            {$col1[] = array_merge(array('text' => utf8_decode($kardex[0]->saldocapital), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente4);}
            

            $col1[] = array_merge(array('text' => utf8_decode('FECHA DE CULMINACION:'), 'width' => 40, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->plazoprestamo), 'width' => 18, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;

            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('FECHA DE NACIMIENTO:'), 'width' => 32, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->fecha_nacimiento), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('CLASE DE PRÉSTAMO:'), 'width' => 30, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->descripcion_clas), 'width' => 35, 'fillcolor' => $col_color),$tbl_trasparente4);
            $col1[] = array_merge(array('text' => utf8_decode('TIPO DE GARANTIA:'), 'width' => 31, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->descripcion_gar), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente4);
            
            $columnas1[] = $col1;
             unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('GARANTIA:'), 'width' => 32, 'fillcolor' => $col_color),$tbl_trasparente3);
            $col1[] = array_merge(array('text' => utf8_decode( garantias($kardex[0]->id_prestamo)), 'width' => 226, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('GARANTES:'), 'width' => 32, 'fillcolor' => $col_color),$tbl_trasparente3);
            $gaaux = "";
            foreach($garantes as $gar){
                    $gaaux = $gaaux."-- ".nombre_prestatario($gar->id_person); 
            }
            $col1[] = array_merge(array('text' => utf8_decode($gaaux), 'width' => 226, 'fillcolor' => $col_color),$tbl_trasparente4);
            $columnas1[] = $col1;





            $col2[] = array_merge(array('text' => utf8_decode('DATOSS AMORTIZACIÓN'), 'width' => 108, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('CAPITAL'), 'width' => 30, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('INTERES CORRIENTE'), 'width' => 45, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('INTERES PENAL'), 'width' => 45, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode(''), 'width' => 30, 'fillcolor' => $col_color),$tbl_cuerpo1);

            $columnas2[] = $col2;
             unset($col2);
            $col2[] = array_merge(array('text' => utf8_decode('CUOTA'), 'width' => 11, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('RECIBO'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('DETALLE'), 'width' => 40, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('T.C.'), 'width' => 10, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('FECHA'), 'width' => 17, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('Días Interes'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('SALDO CAP.'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('Abon. Capital'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('Car. Int. Corriente'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('Abon. Int. Corriente'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('Saldo Int. Corriente'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('Car. Int. Penal'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('Abon. Int. Penal'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('Saldo Int. Penal'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('TOTAL DEUDA'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col2[] = array_merge(array('text' => utf8_decode('ABONO'), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo1);

            $columnas2[] = $col2;

            //FRANJA

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
                        if($valor->tipo_moneda == 1)
                        {
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->saldocapitalbs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->amortcapitalbs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intcorrientecargobs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intcorrienteabonobs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intcorrientesaldobs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intpenalcargobs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intpenalabonobs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intpenalsaldobs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->totaldeudabs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->cuotatotalbs), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);    
                        }
                        else
                        {
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->saldocapital), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->amortcapital), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intcorrientecargo), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intcorrienteabono), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intcorrientesaldo), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intpenalcargo), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intpenalabono), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->intpenalsaldo), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->totaldeuda), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);
                            $col3[] = array_merge(array('text' => utf8_decode( $valor->cuotatotal), 'width' => 15, 'fillcolor' => $col_color),$tbl_cuerpo3);       
                        }
                        
                        
                        $columnas3[] = $col3;
                        unset($col3);                   
                }
            }

           
            
            
            $this->fpdf->WriteTable($columnas1); 
            $this->fpdf->Ln(2);
            $this->fpdf->WriteTable($columnas2);
            //$this->fpdf->Ln(2);
            $this->fpdf->WriteTable($columnas3); 
                

                $this->fpdf->Output();
        }
		
       
		
		
}
?>