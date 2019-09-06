<?php
/*
*/

class Usuarios_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getusuarios()
	{
		$query = $this->db->query("select *from usuarios u join  tipousuario t on t.id_tipouser = u.tipo_user where u.id_user not in (1) order by u.id_user asc");	
		return $query->result();
	}

	function seleccionar_usuarios_id($id)
	{
		$query = $this->db->query("select *from usuarios where id_user =".$id);	
		return $query->result();
	}


	function insert_usuario($ci,$nombres,$paterno,$materno,$sexo,$fecha_nac,$direccion,$telefono,$tipousuario,$usuario,$clave)
	{
		$data = array(
			'ci' => $ci,
			'nombres' => $nombres,
			'apellido_paterno' => $paterno,
			'apellido_materno' => $materno,
			'sexo' => $sexo,
			'fecha_nacimiento' => $fecha_nac,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'tipo_user' => $tipousuario,
			'username' => $usuario, 
			'contrasenia' => $clave,
			'estado_user' => true
		 );
		$this->db->insert('usuarios',$data);
		return $this->db->insert_id();
	}

	function modificar_usuario($id,$ci,$nombres,$paterno,$materno,$sexo,$fecha_nac,$direccion,$telefono,$tipousuario,$estado)
	{
		$data = array(
			'ci' => $ci,
			'nombres' => $nombres,
			'apellido_paterno' => $paterno,
			'apellido_materno' => $materno,
			'sexo' => $sexo,
			'fecha_nacimiento' => $fecha_nac,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'tipo_user' => $tipousuario,
			'estado_user' => $estado
		 );
		$this->db->where('id_user',$id);
		return  $this->db->update('usuarios',$data);
	}


	function desabilitar()
	{
		$data = array(
			'estado_user' => false
		 );
		$this->db->where('id_user >',1);
		return  $this->db->update('usuarios',$data);
	}

	function check_ci($ci)
	{
		$query = $this->db->query("select *from usuarios  where ci = '".$ci."'");	
		return $query->result();	
	}



	function loguear($username, $password)
	{

		$this->db->where('username', $username);
		$this->db->where('contrasenia', $password);

		$query = $this->db->get('usuarios');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	function email_ver($correo)
	{
		$this->db->where('correo', $correo);
		$this->db->from('persona');
		$this->db->join('usuarios', 'usuarios.id_persona = persona.id_persona');
		$query = $this->db->get();
		return $query->result();
	}
	function cambiar_clave($id,$password)
	{
		$data = array(
			
			'contrasenia' => $password,
		 );
		$this->db->where('id_persona',$id);
		return  $this->db->update('usuarios',$data);

	}

	function actualizarprestamos($fecha)
	{
		$data = array(
			
			'idestadoprestamo' => 2,
		 );
		$this->db->where('plazoprestamo <',$fecha);
		$this->db->where('idestadoprestamo',1);
		return  $this->db->update('prestamo',$data);
	}

}
?>