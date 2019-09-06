<?php
/*
*/

class Persona_model extends CI_Model
{
	//c100aae01ae5bcad6666cf88de86cb7a
	
	function __construct()
	{
		parent::__construct();
	}
	

	function seleccionar_personas()
	{
		$query = $this->db->query("select *from persona  order by id_persona desc");	
		return $query->result();	
	}
	function persona_id($id)
	{
		$query = $this->db->query("select *from persona  where id_persona = '$id' and  idsituacion = 1");	
		return $query->result();
	} 
	function check_ci($ci)
	{
		$query = $this->db->query("select *from persona  where ci = '".$ci."'");	
		return $query->result();	
	}
	function insert_personas($ci,$nombres,$paterno,$materno,$casada,$sexo,$fecha_nac,$direccion,$telefono,$correo,$ocupacion)
	{
		$data = array(
			'ci' => $ci,
			'nombres' => $nombres,
			'primer_apellido' => $paterno,
			'segundo_apellido' => $materno,
			'apellido_casada' => $casada,
			'sexo' => $sexo,
			'fecha_nacimiento' => $fecha_nac,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'correo' => $correo,
			'ocupacion' => $ocupacion, 
			'idsituacion' => 1,
		 );
		$this->db->insert('persona',$data);
		return $this->db->insert_id();
	}
	function insert_usuario($id_persona,$user,$clave,$tipo)
	{
		$data = array(
			'id_persona' => $id_persona,
			'username' => $user,
			'contrasenia' => $clave,
			'tipo_user' => $tipo,
		 );
		return  $this->db->insert('usuarios',$data);
	}

	function update_personas($id_persona,$ci,$nombres,$paterno,$materno,$casada,$sexo,$fecha_nac,$direccion,$telefono,$correo,$ocupacion)
	{
		$data = array(
			'ci' => $ci,
			'nombres' => $nombres,
			'primer_apellido' => $paterno,
			'segundo_apellido' => $materno,
			'apellido_casada' => $casada,
			'sexo' => $sexo,
			'fecha_nacimiento' => $fecha_nac,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'correo' => $correo,
			'ocupacion' => $ocupacion 
			);
		$this->db->where('id_persona',$id_persona);
		return  $this->db->update('persona',$data);
	}




	function ci_check($ci)
	{
		$this->db->where('ci_per',$ci);
		$query = $this->db->get('persona');
		if($query->num_rows()>0){
			return false;
		}
		else{
			return true;
		}
	}
	function user_check($user)
	{
		$this->db->where('username',$user);
		$query = $this->db->get('user');
		if($query->num_rows()>0){ 
			return false;
		}
		else{
			return true;
		}
	}
	
	
	
}
?>