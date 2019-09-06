<?php

class User extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->_is_logued_in();
		$this->load->helper(array('form', 'url'));
		$this->load->model('persona_model');
		$this->load->model('usuarios_model');
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
			$dato['usuarios'] = $this->usuarios_model->getusuarios();		
			$this->load->view("inicio/cabecera");
			$this->load->view("inicio/$menu");
			$this->load->view("usuarios/listausuarios",$dato);
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

	
	
	function guardaruser()
	{
		//echo "SE REALIZO EL REGISTRO CORRECTAMENTE";
		if($this->input->get('accion')=='nuevo')  
			{
				//insert_usuario($ci,$nombres,$paterno,$materno,$sexo,$fecha_nac,$direccion,$telefono,$tipousuario,$usuario,$clave)

				$id_persona = $this->usuarios_model->insert_usuario($this->input->get('ci'),strtoupper($this->input->get('nombres')),strtoupper($this->input->get('ap_paterno')),strtoupper($this->input->get('ap_materno')),$this->input->get('sexo'),$this->input->get('fechanacimiento'),$this->input->get('domicilio'),$this->input->get('celular'),$this->input->get('tipouser'),$this->input->get('nombreusuario'),md5($this->input->get('clave'))); 
				
				echo "SE REALIZO EL REGISTRO CORRECTAMENTE";
			}
			else
			{
				$id_persona = $this->input->get('id_persona');
				
				$update_persona = $this->usuarios_model->modificar_usuario($id_persona,$this->input->get('ci'),strtoupper($this->input->get('nombres')),strtoupper($this->input->get('ap_paterno')),strtoupper($this->input->get('ap_materno')),$this->input->get('sexo'),$this->input->get('fechanacimiento'),$this->input->get('domicilio'),$this->input->get('celular'),$this->input->get('tipouser'),$this->input->get('estadouser'));
	
				echo "SE REALIZO LA MODIFICACION CORRECTAMENTE";
			}
	}
	function datosusuario()
	{
			$id = $this->input->get('idp');
			$datos =$this->usuarios_model->seleccionar_usuarios_id($id);
		 	$json = json_encode($datos); 
         	echo $json;
	}

	function verificarci()
	{
		$ci = $this->input->get('ci');
		if($this->usuarios_model->check_ci($ci))
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