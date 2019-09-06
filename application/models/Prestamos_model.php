<?php
/*
*/

class Prestamos_model extends CI_Model
{
	//c100aae01ae5bcad6666cf88de86cb7a
	
	function __construct()
	{
		parent::__construct();
	}
	

	function cantidad_prestamos($idpersona)
	{
		$query = $this->db->query("select count(id_prestamo) as cantidad from prestamo where id_pers =". $idpersona);	
		return $query->result();	
	}
	function getclaseprestamo()
	{
		$query = $this->db->query("select * from claseprestamo order by id_clase asc" );	
		return $query->result();	
	}
	function gettipogarantia()
	{
		$query = $this->db->query("select * from tipogarantia order by id_tipo_gar asc" );	
		return $query->result();	 
	}
	function getestadoprestamo()
	{
		$query = $this->db->query("select * from estadoprestamo order by id_est_pres asc" );	
		return $query->result();	 
	}
	function gettipocambio($fecha)
	{
		$query = $this->db->query("select * from tipocambio where fecha ='". $fecha."'");	
		return $query->result();		
	}
	function prestamo_id($id)
	{	
		$query = $this->db->query("select * from prestamo where id_prestamo =". $id);	
		return $query->result();		
	}
	function seleccionar_prestamos_persona($id)
	{
		$query = $this->db->query("select *from prestamo p
									join tipomoneda m on m.id_moneda = p.idtipomoneda
									join estadoprestamo e on e.id_est_pres = p.idestadoprestamo
									join claseprestamo c on c.id_clase = p.idclaseprestamo
									join tipogarantia g on g.id_tipo_gar = p.id_tipo_garantia 
									where id_pers = ".$id."
									order by id_prestamo asc");	
		return $query->result();		
	}
	function seleccionar_prestamos()
	{
		$query = $this->db->query("select *from prestamo p
									join tipomoneda m on m.id_moneda = p.idtipomoneda
									join estadoprestamo e on e.id_est_pres = p.idestadoprestamo
									join claseprestamo c on c.id_clase = p.idclaseprestamo
									join tipogarantia g on g.id_tipo_gar = p.id_tipo_garantia
									order by id_prestamo asc");	
		return $query->result();		
	}
	function insertar_prestamo($idpersona,$moneda,$clase,$garantia,$usuario,$fechaprestamo,$fechadesembolso,$capitalbs,$capital,$plazo,$tipocambio,$observaciones,$corriente,$penal,$contrato,$cuotas)
	{
		$data = array(
		  'id_pers ' => $idpersona,
		  'idtipomoneda' =>  $moneda,
		  'idestadoprestamo' => 1,
		  'idclaseprestamo' => $clase,
		  'id_tipo_garantia' => $garantia,
		  'id_usuario ' => $usuario,
		  'fechaprestamo' => $fechaprestamo,
		  'fechadesembolso ' => $fechadesembolso,
		  'saldocapitalbs ' => $capitalbs,
		  'saldocapital ' => $capital,
		  'plazoprestamo ' => $plazo,
		  'cambioinicial ' => $tipocambio,
		  'observaciones ' => $observaciones,
		  'interescorriente ' => $corriente,
		  'interespenal ' => $penal ,
		  'editar ' => false,
		  'eliminado ' => false,
		  'conmantenimientovalor' => false,
		  'numerocontrato ' => $contrato,
		  'cerrado ' => false,
		  'nro_cuotas ' => $cuotas
		 );
		$this->db->insert('prestamo',$data);
		return $this->db->insert_id();
	}
	function insert_pagos($prestamo,$nro,$fecha,$estado,$dias,$saldo,$monto_mensual,$cargo,$amortizar,$tipo)
	{
	  $data = array(
	  		'id_prest' => $prestamo,
			  'nro_pago' => $nro,
			  'fecha_pago' => $fecha,
			  'estado_pago' => $estado,
			  'diasinnteres' => $dias,
			  'saldo_capital' => $saldo,
			  'monto_mensual' => $monto_mensual,
			  'cargo_corriente' => $cargo,
			  'monto_amortizar' => $amortizar,
			  'tipo_moneda' => $tipo,
			);
	  $this->db->insert('control_pagos',$data);
		return $this->db->insert_id();

	}

	function insert_tipo_cambio($fecha,$tipocambio)
	{
	  $data = array(
	  		'fecha' => $fecha,
			  'valor' => $tipocambio
			);
	  $this->db->insert('tipocambio',$data);
		return $this->db->insert_id();

	}

	function cerrar_prestamo($idprestamo)
	{
		$data = array(
		   'cerrado ' => true,
		 );
		$this->db->where('id_prestamo',$idprestamo);
		return  $this->db->update('prestamo',$data);
	}
	function modificar_prestamo($idprestamo,$idpersona,$moneda,$clase,$garantia,$usuario,$fechaprestamo,$fechadesembolso,$capitalbs,$capital,$plazo,$tipocambio,$observaciones,$corriente,$penal,$contrato,$cuotas)
	{
		$data = array(
		  'id_pers ' => $idpersona,
		  'idtipomoneda' =>  $moneda,
		  'idestadoprestamo' => 1,
		  'idclaseprestamo' => $clase,
		  'id_tipo_garantia' => $garantia,
		  'id_usuario ' => $usuario,
		  'fechaprestamo' => $fechaprestamo,
		  'fechadesembolso ' => $fechadesembolso,
		  'saldocapitalbs ' => $capitalbs,
		  'saldocapital ' => $capital,
		  'plazoprestamo ' => $plazo,
		  'cambioinicial ' => $tipocambio,
		  'observaciones ' => $observaciones,
		  'interescorriente ' => $corriente,
		  'interespenal ' => $penal ,
		  'editar ' => true,
		  'numerocontrato ' => $contrato,
		  'nro_cuotas ' => $cuotas
		 );
		$this->db->where('id_prestamo',$idprestamo);
		return  $this->db->update('prestamo',$data);
	}
	function eliminar_amortizacion($prestamo)
	{
		$this->db->where('id_presta', $prestamo);
		$this->db->delete('amortizaciones');
	}

	function eliminar_pagos($prestamo)
	{
		$this->db->where('id_prest', $prestamo);
		$this->db->delete('control_pagos');
	}

	function seleccionar_prestamos_reporte($moneda,$estado)
	{
		$cadena = " where 1=1 ";
		if($moneda == 0 && $estado == 0 )
		{
			$query = $this->db->query("select *from prestamoultimaamortizacion
									order by id_prestamo asc");		
		}
		else
		{
			if($moneda>0)
			{
				$cadena= $cadena." and idtipomoneda =".$moneda;
			}
			if($estado>0)
			{
				$cadena= $cadena." and idestadoprestamo =".$estado;
			}
			
			$query = $this->db->query("select *from prestamoultimaamortizacion ".$cadena."
									order by id_prestamo asc");	

		}


		
		return $query->result();		
	}

	function seleccionar_amortizaciones_fechas($fecha1,$fecha2)
	{
		$query = $this->db->query("select *from vistaprestamoamorti where  pagoconfirmado = 3 and fechacalculo between '".$fecha1."' and '".$fecha2."' order by fechacalculo asc");

		return $query->result();	
	}
	
 }