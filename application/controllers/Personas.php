<?php

class Personas extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->_is_logued_in();
		$this->load->helper(array('form', 'url'));
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
			$this->load->view("inicio/cabecera");
			$this->load->view("inicio/$menu");
			$this->load->view("inicio/cuerpo");
			$this->load->view("inicio/pie");
	}
	function lista_persona()
	{ 
		$menu = $this->session->userdata('menu');
		$dato['personas'] = $this->persona_model->seleccionar_personas();
		$this->load->view("inicio/cabecera");
		$this->load->view("inicio/$menu");
		$this->load->view("personas/lista_personas",$dato);
		$this->load->view("inicio/pie");
	}
	function nuevo()
	{
		$menu = $this->session->userdata('menu');
		$dato['accion'] = "nuevo";
		$this->load->view("inicio/cabecera"); 
		$this->load->view("inicio/$menu");
		$this->load->view("personas/nueva_persona",$dato);
		$this->load->view("inicio/pie");
	}
	function guardarpersona()
	{
		//echo "SE REALIZO EL REGISTRO CORRECTAMENTE";
		if($this->input->get('accion')=='nuevo')  
			{
				$id_persona = $this->persona_model->insert_personas($this->input->get('ci'),strtoupper($this->input->get('nombres')),strtoupper($this->input->get('ap_paterno')),strtoupper($this->input->get('ap_materno')),$this->input->get('ap_casada'),$this->input->get('sexo'),$this->input->get('fechanacimientodoc'),$this->input->get('domicilio'),$this->input->get('celular'),$this->input->get('correo'),$this->input->get('ocupacion')); 
				if($this->input->get('id_prestamo')>0)
				{	
					$garante = $this->kardex_model->insert_garante($id_persona,$this->input->get('id_prestamo')); 					
				}
				echo "SE REALIZO EL REGISTRO CORRECTAMENTE";
			}
			else
			{
				$id_persona = $this->input->get('id_persona');
				$update_persona = $this->persona_model->update_personas($id_persona,$this->input->get('ci'),strtoupper($this->input->get('nombres')),strtoupper($this->input->get('ap_paterno')),strtoupper($this->input->get('ap_materno')),$this->input->get('ap_casada'),$this->input->get('sexo'),$this->input->get('fechanacimientodoc'),$this->input->get('domicilio'),$this->input->get('celular'),$this->input->get('correo'),$this->input->get('ocupacion'));
				
			

				echo "SE REALIZO LA MODIFICACION CORRECTAMENTE";
			}
	}
	function datopersona()
	{
			$id = $this->input->get('idp');
			$datos =$this->persona_model->persona_id($id);
		 	$json = json_encode($datos); 
         	echo $json;
	}

	function verificarci()
	{
		$ci = $this->input->get('ci');
		if($this->persona_model->check_ci($ci))
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}
	
		
	

}
?>