<?php
/*
*/

class Kardex_model extends CI_Model
{
	//c100aae01ae5bcad6666cf88de86cb7a
	
	function __construct()
	{
		parent::__construct();
	}
	function getprestamosid($id_prestamo)
	{
		$query = $this->db->query("select *from prestamo p
									join persona pe on pe.id_persona = p.id_pers
									join tipogarantia g on g.id_tipo_gar = p.id_tipo_garantia
									join usuarios u on u.id_user = p.id_usuario
									join claseprestamo c on c.id_clase = p.idclaseprestamo
									join estadoprestamo e on e.id_est_pres = p.idestadoprestamo
									join tipomoneda m on m.id_moneda = p.idtipomoneda
									where p.id_prestamo =".$id_prestamo);	
		return $query->result();		
	}

	function amortizaciones($id_prestamo)
	{
		$query = $this->db->query("select *from amortizaciones where id_presta =".$id_prestamo."order by ncuota asc ");	
		return $query->result();		
	}
	function getgarantespres($id_prestamo)
	{
		$query = $this->db->query("select *from garante where estado_gar = true and id_prest =".$id_prestamo);	
		return $query->result();		
	}
	function getgarantias($id_prestamo)
	{
		$query = $this->db->query("select *from garantia g
									join bienes b on b.id_bien = g.idbien
									where estado_garantia = true and id_prest =".$id_prestamo);	
		return $query->result();			
	}
	function getgarantes($id)
	{
		$query = $this->db->query("select *from persona  where id_persona = '$id' and  idsituacion = 1");	
		return $query->result();
	}
	function getbuscargarantes($ci)
	{
		$query = $this->db->query("select *from persona  where ci ilike '%".$ci."%' and  idsituacion = 1");	
		return $query->result();	
	}
	function deletegarantes($pre,$ga)
	{
		$data = array(
			  'estado_gar'=> false
		);
		$this->db->where('id_prest',$pre);
		$this->db->where('id_person',$ga);
		return  $this->db->update('garante',$data);
	}
	function deletegarantia($id_garantia)
	{
		$data = array(
			  'estado_garantia'=> false
		);
		$this->db->where('id_garantia',$id_garantia);		
		return  $this->db->update('garantia',$data);
	}
	function insert_garantia($id_prestamo,$id_bien,$descripcion,$observacion,$tipo)
	{
		$data = array(
		  'id_prest ' => $id_prestamo,
		  'idbien' =>  $id_bien,
		  'estado_garantia' => true,
		  'descripcion' => $descripcion,
		  'observaciones' => $observacion,
		  'idtipogarantia' => $tipo
		 );
		$this->db->insert('garantia',$data);
		return $this->db->insert_id();	
	}
	function modificar_garantia($id_garantia,$id_bien,$descripcion,$observacion,$tipo)
	{
		$data = array(
		  'idbien' =>  $id_bien,
		  'descripcion' => $descripcion,
		  'observaciones' => $observacion,
		  'idtipogarantia' => $tipo
		 );
		$this->db->where('id_garantia',$id_garantia);		
		return  $this->db->update('garantia',$data);
	}
	function insert_garante($id_persona,$id_prestamo )
	{
		$data = array(
		  'id_prest ' => $id_prestamo,
		  'id_person' =>  $id_persona,
		  'estado_gar' => true
		 );
		$this->db->insert('garante',$data);
		return $this->db->insert_id();
	}

	function gettipogarantia()
	{
		$query = $this->db->query("select * from tipogarantia order by id_tipo_gar asc" );	
		return $query->result();	
	}
	function gettipobien()
	{
		$query = $this->db->query("select * from bienes order by id_bien asc" );	
		return $query->result();	
	}
	function getgarantiaspres($id_prestamo)
	{
		$query = $this->db->query("select *from garantia where estado_garantia = true and id_prest =".$id_prestamo);	
		return $query->result();	
	}
	function getcontrol_pagos($id_prestamo)
	{
		$query = $this->db->query("select *from control_pagos where id_prest =".$id_prestamo."order by nro_pago asc");	
		return $query->result();
	}
	function getcontrol_pagos_id($pago)
	{
		$query = $this->db->query("select *from control_pagos where id_pagos =".$pago);	
		return $query->result();

	}
	function getcontrol_pagos_idanterior($prestamo,$anterior)
	{
		$query = $this->db->query("select *from control_pagos where id_prest =".$prestamo." and nro_pago = ".$anterior);	
		return $query->result();
	}
	function getamortizacionkardex($prestamo)
	{
		$query = $this->db->query("select *from amortizaciones where id_presta =".$prestamo."order by id_amort desc limit 1  ");	
		return $query->result();	
	}
	function getamortizacioncuotas($prestamo,$cuota)
	{
		$query = $this->db->query("select *from amortizaciones where id_presta =".$prestamo."and ncuota=".$cuota);	
		return $query->result();	
	}
	function getamortizacionrecibo($amortizacion)
	{
		$query = $this->db->query("select *from amortizaciones where id_amort =".$amortizacion);	
		return $query->result();	
	}
	function getpagoskardex($pagos)
	{
		$query = $this->db->query("select *from control_pagos where id_pagos =".$pagos);	
		return $query->result();
	}

	function insertar_amortizacion($id_presta,$id_usuario,$nro_recibo,$ncuota,$fechacalculo,$comprobante,$tipocambio,$diasinteres,$descripcion,$amortcapital,$amortcapitalbs,$saldocapital,$saldocapitalbs,$intcorrientecargo,$intcorrientecargobs,$intcorrienteabono,$intcorrienteabonobs,$intcorrientesaldo,$intcorrientesaldobs,$intepenalcargo,$intpenalcargob,$intpenalabono,$intpenalabonobs,$intpenalsaldo,$intpenalsaldobs,$totaldeuda,$totaldeudabs,$cuotatotal,$cuotatotalbs,$escritura,$tipo_moneda,$a_cuota_mes,$a_cuota_mesbs,$interes_corriente,$interes_penal,$plazo,$penalizado,$deposito,$corriente,$plazoprestamoamor,$recibo=2)
	{
		$data = array(
		   'id_presta' => $id_presta,
		  'id_usuario' => $id_usuario,
		  
		  'ncuota' => $ncuota,
		  'fechacalculo' => $fechacalculo,
		  
		  'comprobante' => $comprobante,
		  'tipocambio' => $tipocambio,
		  'diasinteres' => $diasinteres,
		  'descripcion' => $descripcion,
		  'amortcapital' => $amortcapital,
		  'amortcapitalbs' => $amortcapitalbs,
		  'saldocapital' => $saldocapital,
		  'saldocapitalbs' => $saldocapitalbs,
		  'intcorrientecargo' => $intcorrientecargo,
		  'intcorrientecargobs' => $intcorrientecargobs,
		  'intcorrienteabono' => $intcorrienteabono,
		  'intcorrienteabonobs' => $intcorrienteabonobs,
		  'intcorrientesaldo' => $intcorrientesaldo,
		  'intcorrientesaldobs' => $intcorrientesaldobs,
		  'intpenalcargo' => $intepenalcargo,
		  'intpenalcargobs' => $intpenalcargob,
		  'intpenalabono' => $intpenalabono,
		  'intpenalabonobs' => $intpenalabonobs,
		  'intpenalsaldo' => $intpenalsaldo,
		  'intpenalsaldobs' => $intpenalsaldobs,
		  'totaldeuda' => $totaldeuda,
		  'totaldeudabs' => $totaldeudabs,
		  'cuotatotal' => $cuotatotal,
		  'cuotatotalbs' => $cuotatotalbs,
		  
		  'escritura' => $escritura,
		  'tipo_moneda' => $tipo_moneda,
		  'a_cuota_mes' => $a_cuota_mes,
		  'a_cuota_mesbs' => $a_cuota_mesbs,
		  'interes_corriente' => $interes_corriente,
		  'interes_penal' => $interes_penal,
		  'plazo' => $plazo,
		  'penalizado' => $penalizado,
		  'penalizarcorriente' => $corriente,
		  'con_recibo' => $recibo,	
		  'deposito' => $deposito,
		  'plazoprestamoamor' =>$plazoprestamoamor
		 );
		$this->db->insert('amortizaciones',$data);
		return $this->db->insert_id();
	}
	function editar_amortizacion($amortizacionid,$id_presta,$id_usuario,$nro_recibo,$ncuota,$fechacalculo,$comprobante,$tipocambio,$diasinteres,$descripcion,$amortcapital,$amortcapitalbs,$saldocapital,$saldocapitalbs,$intcorrientecargo,$intcorrientecargobs,$intcorrienteabono,$intcorrienteabonobs,$intcorrientesaldo,$intcorrientesaldobs,$intepenalcargo,$intpenalcargob,$intpenalabono,$intpenalabonobs,$intpenalsaldo,$intpenalsaldobs,$totaldeuda,$totaldeudabs,$cuotatotal,$cuotatotalbs,$escritura,$tipo_moneda,$a_cuota_mes,$a_cuota_mesbs,$interes_corriente,$interes_penal,$plazo,$penalizado,$deposito,$corriente,$plazoprestamoamor,$recibo=2)
	{
		$data = array(
		  
		  'id_usuario' => $id_usuario,
		  
		  'ncuota' => $ncuota,
		  'fechacalculo' => $fechacalculo,
		  
		  'comprobante' => $comprobante,
		  'tipocambio' => $tipocambio,
		  'diasinteres' => $diasinteres,
		  'descripcion' => $descripcion,
		  'amortcapital' => $amortcapital,
		  'amortcapitalbs' => $amortcapitalbs,
		  'saldocapital' => $saldocapital,
		  'saldocapitalbs' => $saldocapitalbs,
		  'intcorrientecargo' => $intcorrientecargo,
		  'intcorrientecargobs' => $intcorrientecargobs,
		  'intcorrienteabono' => $intcorrienteabono,
		  'intcorrienteabonobs' => $intcorrienteabonobs,
		  'intcorrientesaldo' => $intcorrientesaldo,
		  'intcorrientesaldobs' => $intcorrientesaldobs,
		  'intpenalcargo' => $intepenalcargo,
		  'intpenalcargobs' => $intpenalcargob,
		  'intpenalabono' => $intpenalabono,
		  'intpenalabonobs' => $intpenalabonobs,
		  'intpenalsaldo' => $intpenalsaldo,
		  'intpenalsaldobs' => $intpenalsaldobs,
		  'totaldeuda' => $totaldeuda,
		  'totaldeudabs' => $totaldeudabs,
		  'cuotatotal' => $cuotatotal,
		  'cuotatotalbs' => $cuotatotalbs,
		  
		  'escritura' => $escritura,
		  'tipo_moneda' => $tipo_moneda,
		  'a_cuota_mes' => $a_cuota_mes,
		  'a_cuota_mesbs' => $a_cuota_mesbs,
		  'interes_corriente' => $interes_corriente,
		  'interes_penal' => $interes_penal,
		  'plazo' => $plazo,
		  'penalizado' => $penalizado,
		  'penalizarcorriente' => $corriente,	
		  'deposito' => $deposito
		  	  
		 );
		$this->db->where('id_amort',$amortizacionid);		
		return  $this->db->update('amortizaciones',$data);
	}

	function seleccionar_prestamos()
	{
		$query = $this->db->query("select *from prestamo p
									join tipomoneda m on m.id_moneda = p.idtipomoneda
									order by id_prestamo asc");	
		return $query->result();		
	}

	function act_pagos($id_prestamoamort,$fecha_calculo)
	{
		$data = array(
		  'estado_pago' =>  true		  
		 );
		$this->db->where('id_prest',$id_prestamoamort);		
		$this->db->where('fecha_pago <=',$fecha_calculo);		
		return  $this->db->update('control_pagos',$data);
	}

	function insert_recibo($idprestamo,$idamortizacion,$nropago,$tipocambio,$montobs,$monto,$fecha_pago,$concepto_pago,$moneda,$gestion,$correlativo,$usuario,$persona)
	{
		$data = array(
		  'idprestamo' => $idprestamo,
		  'idamortizacion' => $idamortizacion,
		  'nropago' => $nropago,
		  'tipocambio' => $tipocambio,
		  'montobs' => $montobs,
		  'monto' => $monto,
		  'fecha_pago' => $fecha_pago,
		  'concepto_pago' => $concepto_pago,
		  'gestion' => $gestion,
		  'correlativo' => $correlativo,
		  'tipo_moneda' =>$moneda,
		  'usuario' =>$usuario,
		  'persona' =>$persona,
		 );
		$this->db->insert('recibos',$data);
		return $this->db->insert_id();	
	}

	function numero_recibo($gesstion)
	{
		$query = $this->db->query("select max(correlativo)as recibo from recibos where gestion =".$gesstion);	
		return $query->result();		
	}
	function getreciboid($idrecibo)
	{
		$query = $this->db->query("select * from recibos where id_recibo =".$idrecibo);	
		return $query->result();		
	}
	function cambiarestadoamortizacion($amortizacion,$recibo,$idrecibo)
	{
		$data = array(
		  'idrecibo' =>  $idrecibo,
		  'nro_recibo' =>  $recibo,
		  'con_recibo' =>  3,
		  'pagoconfirmado' => 2		  
		 );
		$this->db->where('id_amort',$amortizacion);		
		return  $this->db->update('amortizaciones',$data);
	}
	function aceptarpago($amortizacion,$usuario,$fecha)
	{
		$data = array(
		  'pagoconfirmado' => 3	,
		  'idusuarioconfirmacion' => $usuario,
		  'fecha_confirmacion' => $fecha
		 );
		$this->db->where('id_amort',$amortizacion);		
		return  $this->db->update('amortizaciones',$data);
	}


	function cerrarprestamo($prestamo,$estado)
	{
		$data = array(
		  'idestadoprestamo' =>  $estado,
		  	  
		 );
		$this->db->where('id_prestamo',$prestamo);		
		return  $this->db->update('prestamo',$data);
	}
	function getrecibos()
	{
		$query = $this->db->query("select * from recibos order by id_recibo desc");	
		return $query->result();	
	}

 }


