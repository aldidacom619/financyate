<?php

class Inicio extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->_is_logued_in();

		
		$this->load->model('reportes_model');
		$this->load->helper('prestamo_helper');
		$this->load->helper(array('form', 'url'));
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
			$fecha = date('Y-m-j H:i:s');
  			$nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
  			$fecha = date ( 'Y-m-j' , $nuevafecha );
  			
			$menu = $this->session->userdata('menu');
			//echo $menu;
			$dato['pagospedientes'] = $this->reportes_model->pagospendietes();
			$dato['prestamomora'] = $this->reportes_model->prestamosenmora();
			$dato['cuotasdiarias'] = $this->reportes_model->cuotasdiarias($fecha);

			
			$this->load->view("inicio/cabecera");
			$this->load->view("inicio/$menu");
			$this->load->view("inicio/cuerpo",$dato);
			$this->load->view("inicio/pie");
	}
	
		
	

}
?>