
<?php

class Recibo extends CI_Controller
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
            $menu = $this->session->userdata('menu');
            $dato['filas'] = $this->kardex_model->getrecibos();
            $this->load->view("inicio/cabecera");
            $this->load->view("inicio/$menu");
            $this->load->view("inicio/listarecibos",$dato);
            $this->load->view("inicio/pie");
        }     
        function imprimir_recibo($idrecibo)
        {         
            $kardex = $this->kardex_model->getreciboid($idrecibo);
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
            $tbl_trasparente6 = array('height' => '7', 'align' => 'C', 'font_name' => 'Times', 'font_size' => '15', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente7 = array('height' => '7', 'align' => 'C', 'font_name' => 'Times', 'font_size' => '13', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_firmas = array('height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $col_color = "255,255,255";
            $tiporeporte = "KARDEX INDIVIDUAL";
            $id = $this->session->userdata('id_per');
            $this->fpdf = new Pdf2();
            $fecha_hoy = $this->fpdf->fechacompleta();
            $fechas = date('Y-m-j H:i:s');
            $nuevafecha = strtotime ( '-4 hour' , strtotime ( $fechas ) ) ;
            $hora = date ( 'H:i:s' , $nuevafecha );
            $this->fpdf->fecha = "Fecha:  ".$fecha_hoy ." Hrs:".$hora;
            $this->fpdf->xheader = 40;
            $this->fpdf->yheader = 8;
            $this->fpdf->cabecera = 2;
            $columnas3 = array();
            $col3 = array();
            $sum = 0;
            $sum2 = 0;
            $this->fpdf->titulo = "EMPRESA DE PRESTAMOS FINANCYATE";
            $this->fpdf->titulo1 = "RECIBO DE PAGOS (Original)";
            $this->fpdf->moneda = "";
            $this->fpdf->AddPage('P','Letter',null,null);//CREACION DE PAGINA
           

            $col1[] = array_merge(array('text' => utf8_decode('NUMERO DE RECIBO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->correlativo."/".$kardex[0]->gestion), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2); 
            $col1[] = array_merge(array('text' => utf8_decode('FECHA DE PAGO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->fecha_pago), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas1[] = $col1;
            unset($col1); 

              $col1[] = array_merge(array('text' => utf8_decode('NOMBRE PRESTATARIO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode(nombre_prestatario($kardex[0]->persona)), 'width' => 120, 'fillcolor' => $col_color),$tbl_trasparente2);
             $columnas1[] = $col1;
            unset($col1); 

              $col1[] = array_merge(array('text' => utf8_decode('MONTO DE PAGO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            if($kardex[0]->tipo_moneda == 1)
            {$moneda = "Bolivianos";  $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->montobs.".-"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);}else
            {$moneda = "Dolares"; $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->monto.".-"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);}

            $col1[] = array_merge(array('text' => utf8_decode('NRO DE AMORTIZACION:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->nropago." AMORTIZACION"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas1[] = $col1;
            unset($col1);
            $col1[] = array_merge(array('text' => utf8_decode('TIPO DE MONEDA:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($moneda), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
             $col1[] = array_merge(array('text' => utf8_decode('TIPO DE CAMBIO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->tipocambio), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas1[] = $col1;
             unset($col1); 

              $col1[] = array_merge(array('text' => utf8_decode('POR CONCEPTO DE :'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($kardex[0]->concepto_pago), 'width' => 120, 'fillcolor' => $col_color),$tbl_trasparente2);
             $columnas1[] = $col1;
             

            $col2[] = array_merge(array('text' => utf8_decode('RECIBI CONFORME:'.nombre_usuario($kardex[0]->usuario)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente5);
            
             $col2[] = array_merge(array('text' => utf8_decode('ENTREGUE CONFORME:'.nombre_prestatario($kardex[0]->persona)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente5);
            
            $columnas2[] = $col2;
            


            $col3[] = array_merge(array('text' => utf8_decode('EMPRESA DE PRESTAMOS FINANCYATE'), 'width' => 192, 'fillcolor' => $col_color),$tbl_trasparente6);
             $columnas3[] = $col3;
             unset($col3); 
             $col3[] = array_merge(array('text' => utf8_decode('RECIBO DE PAGOS (Copia)'), 'width' => 192, 'fillcolor' => $col_color),$tbl_trasparente6);
              $columnas3[] = $col3;
             unset($col3); 
             $col3[] = array_merge(array('text' => utf8_decode('FECHA ACTUAL:'.$fecha_hoy." Hrs:".$hora ), 'width' => 192, 'fillcolor' => $col_color),$tbl_trasparente7);
             $columnas3[] = $col3;
             unset($col3); 



              $col3[] = array_merge(array('text' => utf8_decode('NUMERO DE RECIBO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->correlativo."/".$kardex[0]->gestion), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2); 
            $col3[] = array_merge(array('text' => utf8_decode('FECHA DE PAGO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->fecha_pago), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
            unset($col3); 

            $col3[] = array_merge(array('text' => utf8_decode('NOMBRE PRESTATARIO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode(nombre_prestatario($kardex[0]->persona)), 'width' => 120, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
            unset($col3); 

            $col3[] = array_merge(array('text' => utf8_decode('MONTO DE PAGO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            if($kardex[0]->tipo_moneda == 1)
            {$moneda = "Bolivianos";  $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->montobs.".-"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);}else
            {$moneda = "Dolares"; $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->monto.".-"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);}

            $col3[] = array_merge(array('text' => utf8_decode('NRO DE AMORTIZACION:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->nropago." AMORTIZACION"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
            unset($col3);
            $col3[] = array_merge(array('text' => utf8_decode('TIPO DE MONEDA:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($moneda), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
             $col3[] = array_merge(array('text' => utf8_decode('TIPO DE CAMBIO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->tipocambio), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
             unset($col3); 

             $col3[] = array_merge(array('text' => utf8_decode('POR CONCEPTO DE :'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->concepto_pago), 'width' => 120, 'fillcolor' => $col_color),$tbl_trasparente2);
             $columnas3[] = $col3;
             

            $col4[] = array_merge(array('text' => utf8_decode('RECIBI CONFORME:'.nombre_usuario($kardex[0]->usuario)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente5);
            
             $col4[] = array_merge(array('text' => utf8_decode('ENTREGUE CONFORME:'.nombre_prestatario($kardex[0]->persona)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente5);
            
            $columnas4[] = $col4;



            
      $this->fpdf->Line(20, 120, 200, 120);
             $this->fpdf->WriteTable($columnas1); 
             $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas2);

             $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas3);
      $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas4);

            
            $this->fpdf->Output();

        }   
      
}
?>