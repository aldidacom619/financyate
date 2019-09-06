<?php
/*
*/

class Reportes_model extends CI_Model
{
	//c100aae01ae5bcad6666cf88de86cb7a
	
	function __construct()
	{
		parent::__construct();
	}
	
	function pagospendietes()
	{
		$query = $this->db->query("select *from prestamoultimaamortizacion where pagoconfirmado = 2 order by fechacalculo desc");	
		return $query->result();	
	}
	function prestamosenmora()
	{
			$query = $this->db->query("select *from prestamoultimaamortizacion where idestadoprestamo = 2 order by plazoprestamo desc");	
		return $query->result();	
	}
	function cuotasdiarias($fecha)
	{

		$query = $this->db->query("select *from (select *from (select DISTINCT ON (id_prest) id_prest, fecha_pago from (select *from control_pagos where estado_pago = false and fecha_pago <= '".$fecha."'  order by fecha_pago desc)t1)t2 join (select id_prest as id_ptm, sum (monto_amortizar)as monto_amortizar, count(id_prest)as ncuotas from control_pagos where estado_pago = false and fecha_pago <=  '".$fecha."' group by id_prest)t3 on t3.id_ptm = t2.id_prest)t4 join prestamoultimaamortizacion p on p.id_prestamo = t4.id_prest");	
		return $query->result();	

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