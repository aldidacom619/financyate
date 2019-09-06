<?php

class Usuarios extends CI_Controller
    {
    	function __construct(){
    		parent::__construct();
    		$this->load->model('persona_model');
    		$this->load->model('usuarios_model');
    		$this->load->helper(array('form', 'url'));
    		$this->load->library('email');
			$this->load->library('form_validation');
			$this->load->helper('date');
    	}
		
		
		function index($mensaje = "")
		{
				//$dato['consulta'] = $this->horario_model->selec_horario();	
				$dato['title']= "Ingreso de usuarios";	
				$dato['error'] =$mensaje;	
				$this->load->view("usuarios/logued",$dato); 
				
		}
		 
		function loguedd() 
		{	
		
			$username = $this->input->post('username');
			$password = ($this->input->post('pass'));
			echo $username."---". $password;
		
		}	 
	
		function logued() 
		{	
			
			$fecha = date('Y-m-j H:i:s');
  			$nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
  			$fecha = date ( 'Y-m-j' , $nuevafecha );

  			
			if(1==1)
			{	
				$username = $this->input->post('username');
				$password = md5($this->input->post('pass'));
				$login = $this->usuarios_model->loguear($username, $password);
				if($login)
				{
					//echo $login[0]->estado_user;
					
					if( $login[0]->estado_user == 't')
					{
						$data = array(
							'is_logued_in'  => TRUE,
							'id_user' => $login[0]->id_user,
							'estado' => $login[0]->estado_user,
							'user' => $login[0]->username,
							'tipo' => $login[0]->tipo_user, 	
							'nombre' => $login[0]->nombres." ".$login[0]->apellido_paterno." ".$login[0]->apellido_materno,
							'menu' => "menu".$login[0]->tipo_user,				
						); 
						$this->session->set_userdata($data);

						$estado = $this->usuarios_model->actualizarprestamos($fecha);

						redirect("inicio");

					}
					else
					{
							$error ="El usuario ha sido dado de baja del sistema consulte con el administrador del sistema";
							$this->index($error);
					}		
					
				}		
				else 
				{

					
					$this->index('EL NOMBRE O CONTRASEÑA INCORRECTO');
				}
			}
			else
			{	
				$d = $this->usuarios_model->desabilitar();
				$this->index('SU TIEMPO DE PRUEBA A EXPIRADO');
			}
		}
	function salir()
	{
		$this->session->sess_destroy();
		redirect('usuarios');

	}
	function recuperar()
	{
			
			
			
				$datestring = " %Y-%m-%d";
				$time = time();
				$fecha =  mdate($datestring, $time);

				
				$email = $this->input->get('correo');//$this->'alvarod745@gmail.com'; 
				
				if($filas = $this->usuarios_model->email_ver($email))
				{
					$id  = $filas[0]->id_persona;
					$usuario = $filas[0]->username;
					
					$this->load->library("email");

					//configuracion para gmail
					$configGmail = array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.gmail.com',
						'smtp_port' => 465,
						'smtp_user' => 'instecsupot@gmail.com',
						'smtp_pass' => 'superior2017',
						'mailtype' => 'html',
						'charset' => 'utf-8',
						'newline' => "\r\n"
					);     

					//cargamos la configuración para enviar con gmail
					$mensaje = " USUARIO:".$usuario."<br>"."HAZ CLICK AQUI ->  http://127.0.0.1:8080/MINIUTI/index.php/usuarios/recu_contra/".$id;
					$this->email->initialize($configGmail);

					$this->email->from('instecsupot@gmail.com');
					$this->email->to($email);
					$this->email->subject('RECUPERACION DE CONTRASEÑA');
					$this->email->message($mensaje); 
					if ($this->email->send())
					{
						//echo "se envio un correo  a: ".$email;
						
						echo "SE ENVIO UN CORREO A:".$email;
						//$this->index();
					}
					else
					{
						//echo "no se enviooooooooooooooooooooo una mierda jajajaj";
						

						echo "ERROR EN EL ENVIO REVISE SU CONEXION A INTERNET";
						//$this->cambio_clave();
					}
				}
				else
				{
					//echo "<script type=\"text/javascript\">alert(\"LA DIRECCION DE CORREO ELECTRONICO NO SE ENCUENTRA REGISTRADO EN EL SISTEMA\");</script>";  
					echo "LA DIRECCION DE CORREO ELECTRONICO NO SE ENCUENTRA REGISTRADO EN EL SISTEMA";	
				}
				
				//con esto podemos ver el resultado
				//var_dump($this->email->print_debugger());
			
	}
	function recu_contra($id)
	{
			
			
			$dato ['id']= $id;
			

			$dato['error'] ="";

			$dato['title']= "Cambiar Contraseña";	
			$this->load->view("inicio/cabecera2",$dato);
			$this->load->view("usuarios/re_contra",$dato);
			$this->load->view("inicio/pie");
	}
	function _control_clave($clave) 
	{
		
		$user = $this->session->userdata('user');

		return $this->usuarios_model->contro_user($user, $clave);
	}

	function cambiar_contra($id)
	{

		$dato ['id']= $id;
		$nueva =  md5($this->input->post('password'));
		$confimar = md5($this->input->post('repassword'));

			if($nueva == $confimar)
			{
				$dato ['error'] = "";
				$update = $this->usuarios_model->cambiar_clave($id,$nueva);
				$this->load->view("usuarios/logued",$dato);

			}
			else
			{
				$dato['error'] ="Los campos nueva contraseña  y confimar contraseña  no coinciden ...!!";
				$this->load->view("usuarios/logued",$dato);

			}	
		
		
			

	}

	//MODIFICACIONES DE TODO CARAJO JAJAJ
	

}
?>