<script type="text/javascript" src="<?php echo  base_url() ?>jsd/personas.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>jsd/kardex.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>recursos/bower_components/jquery-validation/jquery.validate.js"></script> 

<div class="row">
    
	<div class="col-lg-12"> 
      	<div class="alert alert-info">
           <center><H3><strong> KARDEX DE PRESTAMO</strong></H3></center>
        </div>
          <div class="panel-body">
              <font size="2">
              <div class="row">
                    <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>PRESTATARIO:</strong></p>
                      </div>
                      <div class="col-xs-8">
                        <p class="text-left" id="spPrestatario"><?= nombre_prestatario($kardex[0]->id_pers)?></p>
                      </div>
                  </div>
                  <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>OCUPACION:</strong></p> 
                      </div>
                      <div class="col-xs-8">
                        <p class="text-left" id="spRegional"><?= $kardex[0]->ocupacion?></p>
                      </div>
                  </div>   
                  <div class="col-xs-3">
                      <div class="col-xs-5">
                          <p class="text-right"><strong>NRO. CREDITO:</strong></p>
                      </div>
                      <div class="col-xs-7">
                        <p class="text-left" id="spClasePrestamo"><?= $kardex[0]->id_prestamo?></p>
                      </div>                     
                  </div>   
                  <div class="col-xs-2">
                      <div class="col-xs-8">
                          <p class="text-right"><strong>INTERES CORRIENTE(%):</strong></p>
                      </div>
                      <div class="col-xs-4">
                        <p class="text-left" id="spIntCorriente"><?= $kardex[0]->interescorriente?></p>
                      </div>
                  </div>    
              </div>
              <div class="row">
                       <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>C.I.:</strong></p>
                      </div>
                      <div class="col-xs-8">
                        <p class="text-left" id="spCi"><?= $kardex[0]->ci?></p>
                      </div>
                      
                  </div> 
                  <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>CORREO:</strong></p>
                      </div>
                      <div class="col-xs-8">
                        <p class="text-left" id="spSector"><?= $kardex[0]->correo?></p>
                      </div>
                  </div>   
                  <div class="col-xs-3">
                      <div class="col-xs-5">
                          <p class="text-right"><strong>TIPO DE MONEDA:</strong></p>
                      </div>
                      <div class="col-xs-7">
                        <p class="text-left" id="spDescripCuenta"><?= $kardex[0]->descripcion?></p>
                      </div>
                  </div>   
                  <div class="col-xs-2">
                      <div class="col-xs-8">
                          <p class="text-right"><strong>INTERES PENAL(%):</strong></p>
                      </div>
                      <div class="col-xs-4">
                        <p class="text-left" id="spIntPenal"><?= $kardex[0]->interespenal?></p>
                      </div>
                  </div>   
              </div>
              <div class="row">
                 <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>TELEFONO:</strong></p>
                      </div>
                      <div class="col-xs-8">
                        <p class="text-left" id="spMatricula"><?= $kardex[0]->telefono?></p>
                      </div>
                  </div>   
                  <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>SEXO:</strong></p>
                      </div>
                      <div class="col-xs-8">
                        <p class="text-left" id="spInstitucion"><?= $kardex[0]->sexo?></p>
                      </div>
                  </div>   
                  <div class="col-xs-3">
                      <div class="col-xs-5">
                          <p class="text-right"><strong>FECHA PRÉSTAMO:</strong></p>
                      </div>
                      <div class="col-xs-7">
                        <p class="text-left" id="spFechaPrestamo"><?= $kardex[0]->fechaprestamo?></p>
                      </div>
                  </div>   
                  <div class="col-xs-2">
                      <div class="col-xs-8">
                          <p class="text-right"><strong>PLAZO (MESES):</strong></p>
                      </div>
                      <div class="col-xs-4">
                        <p class="text-left" id="spPlazo"><?= $kardex[0]->nro_cuotas?></p>
                      </div>
                  </div>   
              </div>
              <div class="row">
                  <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>DIRECCION:</strong></p>
                      </div>
                      <div class="col-xs-8">
                        <p class="text-left" id="spLegal"><?= $kardex[0]->direccion?></p>
                      </div>
                  </div>     
                  <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"> <button type="button" class="btn btn-primary btn-xs"  onclick='garantiakardex(<?= $kardex[0]->id_prestamo?>)'>GARANTIA</button></p>
                      </div>
                      <div class="col-xs-8">
                        <p class="text-left" id=""><?= garantias($kardex[0]->id_prestamo)?> </p>
                      </div>
                  </div>   
                  <div class="col-xs-3">
                      <div class="col-xs-5">
                          <p class="text-right"><strong>MONTO CRÉDITO:</strong></p>
                      </div>
                      <div class="col-xs-7">
                        <p class="text-left" id="spMontoCredito"><? if($kardex[0]->idtipomoneda == 1) {echo $kardex[0]->saldocapitalbs;}else{ echo $kardex[0]->saldocapital;}?></p>
                      </div>
                  </div>   
                  <div class="col-xs-2">
                      <div class="col-xs-8">
                          <p class="text-right"><strong>FECHA CULMINACION:</strong></p>
                      </div>
                      <div class="col-xs-4">
                        <p class="text-left" id="spFechaSaldo"><?= $kardex[0]->plazoprestamo?></p>
                      </div>
                  </div>   
              </div>
              <div class="row">
                  
                  <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>FECHA DE NACIMIENTO:</strong></p>
                      </div>
                      <div class="col-xs-8">
                          <p class="text-left" id="spFechaCierre"><?= $kardex[0]->fecha_nacimiento?></p>
                      </div>
                  </div>   
                  <div class="col-xs-3">
                      <div class="col-xs-4">
                          <p class="text-right"><strong>CLASE DE PRESTAMO</strong></p>
                      </div>
                      <div class="col-xs-8">
                          <p class="text-left" id="spCambioCierre"><?= $kardex[0]->descripcion_clas?></p>
                      </div>
                  </div>   
                  <div class="col-xs-3">
                      <div class="col-xs-5">
                          <p class="text-right"><strong>ESTADO PRESTAMO:</strong></p>
                      </div>
                      <div class="col-xs-7">
                        <p class="text-left" id="spSaldoCapital"><?= $kardex[0]->descripcion_est?></p>
                      </div>
                  </div>   
                  <div class="col-xs-2">
                      <div class="col-xs-8">
                          <p class="text-right"><strong>TIPO GARANTIA:</strong></p>
                      </div>
                      <div class="col-xs-4">
                        <p class="text-left" id="spFechaSaldo"><?= $kardex[0]->descripcion_gar?></p>
                      </div>
                  </div>   
              </div>
              </font>
          </div>
           
          <? if ($kardex[0]->cerrado ==  't'){?> 
           <div  class="alert alert-danger" >EL PRESTAMO TIENE MAS DE UNA AMORTIZACIÓN, POR SEGURIDAD SE ENCUENTRA CERRADO, NO SE PUEDE REALIZAR NINGUNA EDICIÓ DE INFORMACIÓN
           </div>
         <? }?> 
          <div class="alert alert-warning">
              <button class="btn btn-prymari" onclick='agregargarantes(<?= $kardex[0]->id_prestamo?>)'>AGREGAR</button><strong> GARANTES:
              <? foreach($garantes as $gar):?>
              	<button class="btn btn-primary" onclick='vergarante(<?= $kardex[0]->id_prestamo?>,<?= $gar->id_person?>)'><?= nombre_prestatario($gar->id_person)." "?></button>
              <?endforeach?>	
            
              </strong>
          </div> 
          <div class="alert alert-warning">
             <strong>OPCIONES DE KARDEX:</strong>
                  <button class="btn btn-prymari" onclick='controlpagoskardex(<?= $kardex[0]->id_prestamo?>)'>CONTROL DE PAGOS </button>
                  <button class="btn btn-prymari" onclick='amortizarpago(<?= $kardex[0]->id_prestamo?>)'>NUEVA AMORTIZACIÓN </button>
                  <button class="btn btn-prymari" onclick='liquidar(<?= $kardex[0]->id_prestamo?>)'>LIQUIDACION </button>
                  <button class="btn btn-prymari" onclick='imprimirkardex(<?= $kardex[0]->id_prestamo?>)'>IMPRIMIR KARDEX </button>

                  
          </div> 
		      <div class="panel panel-default">
	          <div class="alert alert-success"> 
              <center><strong>AMORTIZACIONES</strong></center>
            </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
				    	<table width="100%" class="table table-fit table-striped table-bordered table-hover" id="dataTables-examples">
				        <thead class="thead">
				    			<th colspan="6"></th>
								<th colspan="2">CAPITAL</th>
								<th colspan="3">INT CORRIENTE</th>
								<th colspan="3">INT PENAL</th>
								<th colspan="2"></th>
								
								<th></th>
						 </thead>
				     	

				        <thead class="thead" >
				    			<th  class="info">#CUOTA</th>
                  <th  class="info">RECIBO</th>
								<th  class="info">DETALLE</th>
								<th  class="info">T.C.</th>
								<th  class="info">FECHAS</th>
								
								<th  class="info">D.I.</th>
								
								<th  class="info">S.C.</th>
								<th  class="info">AMORT.</th>

								<th  class="info">CIC</th>
								<th  class="info">AIC</th>			
								<th  class="info">SIC</th>			
								<th  class="info">CIP</th>
								<th  class="info">AIP</th>
								<th  class="info">SIP</th>

								<th  class="info">TOTAL DEUDA</th>
								<th  class="info">PAGO</th>			
								<th  class="info">OPC.</th>
						        
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($amortizacioness as $fila):?>
				        	<tr>
				          			<td ><?= $fila->ncuota?></td>
                        <td ><?= $fila->nro_recibo?></td>
									      <td ><?= $fila->descripcion?></td>
      									<td ><?= $fila->tipocambio?></td>
      									<td class="warning"><?= $fila->fechacalculo?></td>									
      									<td ><?= $fila->diasinteres?></td>
                        <? if($fila->tipo_moneda == 1){?>
                            <td ><?= $fila->saldocapitalbs?></td>
          									<td ><?= $fila->amortcapitalbs?></td>
          									<td ><?= $fila->intcorrientecargobs?></td>
    						            <td ><?= $fila->intcorrienteabonobs?></td>
    						            <td ><?= $fila->intcorrientesaldobs?></td>
    						            <td ><?= $fila->intpenalcargobs?></td>
    						            <td ><?= $fila->intpenalabonobs?></td>
    						            <td ><?= $fila->intpenalsaldobs?></td>
    						            <td ><?= $fila->totaldeudabs?></td>
    						            <td class="warning"><?= $fila->cuotatotalbs?></td>
                        <?}else{?>
						                <td ><?= $fila->saldocapital?></td>
                            <td ><?= $fila->amortcapital?></td>
                            <td ><?= $fila->intcorrientecargo?></td>
                            <td ><?= $fila->intcorrienteabono?></td>
                            <td ><?= $fila->intcorrientesaldo?></td>
                            <td ><?= $fila->intpenalcargo?></td>
                            <td ><?= $fila->intpenalabono?></td>
                            <td ><?= $fila->intpenalsaldo?></td>
                            <td ><?= $fila->totaldeuda?></td>
                            <td class="warning"><?= $fila->cuotatotal?></td>
                        <?}?>
                        <td> <? if($fila->con_recibo == 2){?>
						            	 <button class="btn btn-success" onclick='editaramortizarpago(<?= $fila->id_amort?>,<?= $fila->id_presta?>,<?= $fila->ncuota?>)'><span class="fa fa-edit"></span> EDITAR</button> <button class="btn btn-primary" onclick='crear_recibo(<?= $fila->id_amort?>,<?= $fila->id_presta?>,<?= $fila->ncuota?>,<?= $kardex[0]->id_pers?>)'><span class="fa fa-print"></span> RECIBO</button>
                           <?}
                            if($fila->pagoconfirmado == 2)
                            {?>
                                <button class="btn btn-danger" onclick='confirmarpago(<?= $fila->id_amort?>)'><span class="glyphicon glyphicon-ok"></span> COFIRMAR PAGO</button>
                            <?}  
                           ?>

						          	</td>
				        </tr>
				        <?endforeach?>
				        </tbody>
				      </table> 
     				</div>  
    			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="vergarantemodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Datos de Garante</h3>
      </div>
      <div class="modal-body">
            <input type="hidden" name="idpers" id="idpers">
            <input type="hidden" name="idpres" id="idpres">
            <div id= "datosgarate">            
            </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick='eliminargarante()'>ELIMINAR GARANTE</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="garantiamodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Datos de Garantia</h3>
      </div>
      <div class="modal-body">
           <form id="formulariogarantia">
                 <input type="hidden" class="form-control" id="acciongar" name="acciongar" required="required">
                 <input type="hidden" class="form-control" id="id_garantia" name="id_garantia" required="required">
                 <input type="hidden" class="form-control" id="id_prestamogar" name="id_prestamogar" required="required">
                   
                
                    
                <div class="row"> 
                   
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>TIPO GARANTIA</label>
                      <SELECT NAME="tipo_g" id = "tipo_g" class="form-control">
                        
                      </SELECT> 
                    </div>
                    <div class="form-group">
                      <label>TIPO BIEN</label>
                      <SELECT NAME="biengar" id = "biengar" class="form-control">
                        
                      </SELECT> 
                    </div>
                     <div class="form-group">
                      <label>DESCRIPCION</label>
                      <input class="form-control" id="descripciongar" name="descripciongar"">
                    </div>  
                    <div class="form-group">
                      <label>OBSERVACION</label>
                      <textarea  class="form-control" id="observaciongar" name="observaciongar" required="required"></textarea>
                    </div> 
                   
                    
                  </div>
                 
                </div> 
              </form>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="elimgaran" onclick='eliminargarantia()'>ELIMINAR GARANTIA</button>
        <button type="button" class="btn btn-primary" onclick='guardargarantia()'>GUARDAR</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="personamodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">AGREGAR GARANTES</h4>
      </div>
      <div class="modal-body"><legend>Datos Personales</legend>
            <div  class="alert alert-danger"  id="validarpersona" style="display: none;">
                
                   </div>
           <div class="row"> 
                  

                    <div class="col-lg-4">
                    <div class="form-group"> 
                      <label>C.I. BUSCAR</label>
                      <input class="form-control" id="cib" name="cib" required="required">
                      <small id="emailHelp" class="form-text text-muted">EJEMPLO 0000000 PT -  0000000 LP</small>
                    </div>
                     </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="listagarantes"></div>
                    </div>
                </div>
            <form id="formulariopersona">
                 <input type="hidden" class="form-control" id="accion" name="accion" required="required">
                 <input type="hidden" class="form-control" id="id_persona" name="id_persona" required="required">
                 <input type="hidden" class="form-control" id="id_prestamo" name="id_prestamo" required="required">
                   
                
                    
                <div class="row"> 
                    <div class="col-lg-4">
                      <div class="form-group"> 
                      <label>C.I. COMPLETO</label>
                      <input class="form-control" id="ci" name="ci" required="required">
                      <small id="emailHelp" class="form-text text-muted">EJEMPLO 0000000 PT -  0000000 LP</small>
                    </div>
                    <div class="form-group">
                      <label>NOMBRES</label>
                      <input class="form-control" id="nombres" name="nombres" required="required">
                    </div>  
                    <div class="form-group">
                      <label>PRIMER APELLIDO</label>
                      <input class="form-control" id="ap_paterno" name="ap_paterno" required="required">
                    </div>
                    <div class="form-group">
                      <label>SEGUNDO APELLIDO</label>
                      <input class="form-control" id="ap_materno" name="ap_materno" required="required">
                    </div>  
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>SEXO</label>
                      <SELECT NAME="sexo" id = "sexo" class="form-control">
                        
                      </SELECT> 
                    </div>
                     <div class="form-group">
                      <label>APELLIDO CASADA</label>
                      <input class="form-control" id="ap_casada" name="ap_casada"">
                    </div>  
                    <div class="form-group">
                      <label>FECHA DE NACIMIENTO</label>
                      <input class="form-control" id="fechanacimientodoc" name="fechanacimientodoc" required="required">
                    </div> 
                   
                    <div class="form-group">
                          <label>DIRECCIÓN</label>
                          <input class="form-control" id="domicilio" name="domicilio" required="required">
                      </div>
                  </div>
                   <div class="col-lg-4">
                      
                      <div class="form-group">
                          <label># TELEFÓNICO</label>
                          <input class="form-control" id="celular" name="celular" required="required">
                      </div>
                      <div class="form-group">
                          <label>OCUPACIÓN</label>
                          <input class="form-control" id="ocupacion" name="ocupacion" required="required">
                      </div>
                      <div class="form-group">
                          <label>CORREO</label>
                       
                          <input type="text" class="form-control" id="correo" name="correo" >
                      </div>
                        
                  </div>
                </div> 
              </form> 
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick='cerrarmodal()'><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
        <button type="button" class="btn btn-info"  onclick='cancelarsel()'> Cancelar Seleccion</button>
        <button type="button" class="btn btn-primary" onclick='guardargarante()'><span class="glyphicon glyphicon-floppy-disk"></span> Seleccionar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="controlpagosmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="titulo1"></h3>
      </div>
      <div class="modal-body">
            <input type="hidden" name="idpresk" id="idpresk">
            <div id= "controlpagos">            
            </div>       
            <div id= "controlamortizacion">    
                 <div class="modal-body">
        
              <form id="formularioamortizacion">
                
                  <legend>Datos de Préstamo</legend>
                    <input type="hidden" class="form-control" id="accionamort" name="accionamort" required="required">
                    <input type="hidden" class="form-control" id="id_prestamoamort" name="id_prestamoamort" required="required">
                    <input type="hidden" class="form-control" id="moneda" name="moneda" required="required">
                    <input type="hidden"  class="form-control" id="deuda_anterior" name="deuda_anterior">
                    <input type="hidden"  class="form-control" id="nro_cuotaanterior" name="nro_cuotaanterior"> 
                    <input type="hidden"  class="form-control" id="amortizacionid" name="amortizacionid"> 
                    <input type="hidden"  class="form-control" id="plazopago" name="plazopago"> 

                    
                      <div  class="alert alert-danger"  id="validarprestamo" style="display: none;">
                
                   </div>


                <div class="row">     
                    <div class="col-lg-2">
                      <div class="form-group"> 
                        <label>FECHA DE ANTERIOR</label>
                        <input class="form-control" id="fecha_anterior" name="fecha_anterior"   readonly="true" >
                      </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group"> 
                        <label>SALDO <BR>CAPITAL</label>
                        <input class="form-control" id="capital_anterior" name="capital_anterior"  readonly="true" >
                      </div>
                </div>
                   <div class="col-lg-2">
                     <div class="form-group">
                          <label>INTERES <BR>CORRIENTE</label>
                          <input class="form-control" id="corriete_anterior" name="corriete_anterior" readonly="true">
                   </div> 
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group">
                          <label>INTERES <BR> PENAL</label>
                          <input class="form-control" id="penal_anterior" name="penal_anterior" required="required"  readonly="true">
                   </div> 
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group">
                          <label>TOTAL <BR>DEUDA</label>
                          <input class="form-control" id="deuda_anterior2" name="deuda_anterior2" required="required"  readonly="true"> 
                   </div> 
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group">
                          <label><BR>CUOTA</label>
                          <input class="form-control" id="cuota_anterior" name="cuota_anterior" required="required"  readonly="true">
                     </div> 
                  </div>
                </div>
                <div class="row">     
                    <div class="col-lg-3">
                      <div class="form-group"> 
                        <label>INTERES CORRIETE</label>
                        <input class="form-control" id="intcorriente" name="intcorriente"  readonly="true" >
                      </div>
                  </div>
                  <div class="col-lg-3">
                      <div class="form-group"> 
                        <label>INTERES PENAL</label>
                        <input class="form-control" id="intpenal" name="intpenal" readonly="true" >
                      </div>
                  </div>
                  <div class="col-lg-3">
                      <div class="form-group"> 
                        <label>PLAZO PRESTAMO</label>
                        <input class="form-control" id="plazo" name="plazo" readonly="true" >
                      </div>
                  </div>
                  <div class="col-lg-3">
                      <div class="form-group"> 
                        <label>DEPOSITO</label>
                        
                        <SELECT NAME="deposito" id = "deposito" class="form-control">
                        
                      </SELECT> 
                      </div>
                  </div>
                 
                </div>
                <div class="row">
                    <div class="col-xs-2">
                          <div class="form-group"> 
                            <label>FECHA DE CÁLCULO</label>
                            <input class="form-control" id="fecha_calculo" name="fecha_calculo">

                          </div>
                    </div>
                    <div class="col-xs-2">
                           <div class="form-group"> 
                            <label>TIPO DE CAMBIO</label>
                            <input class="form-control" id="tipo_cambio" name="tipo_cambio"  readonly="true">
                            <input type="hidden" class="form-control" id="tipocambioiniaux" name="tipocambioiniaux">
                          </div>
                    </div>
                    <div class="col-xs-2">
                           <div class="form-group"> 
                            <label>DIAS DE INTERES</label>
                            <input class="form-control" id="dias_interes" name="dias_interes"  readonly="true">
                          </div>
                    </div>
                     <div class="col-xs-2">
                           <div class="form-group"> 
                            <label>NRO DE COMPROBANTE</label>
                            <input class="form-control" id="comprobante" name="comprobante"  readonly="true" >
                          </div>
                    </div>
                    <div class="col-xs-2">
                         <div class="form-group" id="penalchek"> 
                             <label>OPCION</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  id="penalizar" name="penalizar"  value="true" >PENALIZAR
                                                </label>
                                            </div>
                          </div>
                    </div>
                     <div class="col-xs-2">
                         <div class="form-group" id="corrichek"> 
                             <label>OPCION</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  id="corriente" name="corriente"  value="true" >CORRIENTE
                                                </label>
                                            </div>
                          </div>
                    </div>
                    
                </div>

                <div id="liquidark">
                  <div class="row">
                      <div class="col-xs-6">
                            <div class="form-group"> 
                              <label>DESCRIPCIÓN</label>
                              <input class="form-control" id="descripcionnamortizacion" name="descripcionnamortizacion">
                            </div>
                      </div>
                      <div class="col-xs-3">
                             <div class="form-group"> 
                              <label>MONTO BS</label>
                              <input class="form-control" id="montobs" name="montobs" >
                            </div>
                      </div>
                      <div class="col-xs-3">
                             <div class="form-group"> 
                              <label>MONTO $</label>
                              <input class="form-control" id="monto" name="monto">
                            </div>
                      </div>
                      <div class="col-xs-3">
                        
                      </div>
                  </div>
                 </div>
                <legend>Datos de Cálculo</legend>
                <div class="row">
                    <div class="col-xs-2">
                      <div class="form-group">
                          <label>INT PENAL ANT</label>                         
                          <input type="text" class="form-control" id="cargo_interes_penal_anteriortxt" name="cargo_interes_penal_anteriortxt" required="required"readonly="true">
                        </div>
                    </div>
                    <div class="col-xs-2">
                      <div class="form-group">
                          <label>CAR.INT PENAL</label>                         
                          <input type="text" class="form-control" id="cargo_interes_penaltxt" name="cargo_interes_penaltxt" required="required"readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-4">
                         <div class="form-group">
                          <label>ABONO INTERES PENAL</label>
                         
                          <input type="text" class="form-control" id="abono_interes_penaltxt" name="abono_interes_penaltxt" required="required" readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                          <label>SALDO INTERES PENAL</label>
                         
                          <input type="text" class="form-control" id="saldo_interes_penaltxt" name="saldo_interes_penaltxt" required="required" readonly="true">
                        </div> 
                    </div>
                </div>
                 <div class="row">
                    <div class="col-xs-2">
                        <div class="form-group">
                          <label>INT COR ANT</label>
                         
                          <input type="text" class="form-control" id="cargo_interes_corriente_anteriortxt" name="cargo_interes_corriente_anteriortxt" required="required" readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                          <label>CAR.INT COR</label>
                         
                          <input type="text" class="form-control" id="cargo_interes_corrientetxt" name="cargo_interes_corrientetxt" required="required" readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-4">
                         <div class="form-group">
                          <label>ABONO INTERES CORRIENTE</label>
                         
                          <input type="text" class="form-control" id="abono_interes_corrientetxt" name="abono_interes_corrientetxt" required="required" readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                          <label>SALDO INTERES CORRIENTE</label>
                         
                          <input type="text" class="form-control" id="saldo_interes_corrientetxt" name="saldo_interes_corrientetxt" required="required" readonly="true">
                        </div> 
                    </div>
                </div>
                  <div class="row">
                    <div class="col-xs-4">
                         <div class="form-group">
                          <label>CARGO CAPITAL</label>
                         
                          <input type="text" class="form-control" id="cargo_cuota_mestxt" name="cargo_cuota_mestxt" required="required" readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-4">
                         <div class="form-group">
                          <label>ABONO CUOTA MES</label>
                         
                          <input type="text" class="form-control" id="abono_cuota_mestxt" name="abono_cuota_mestxt" required="required" readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                          <label>SALDO CAPITAL</label>
                         
                          <input type="text" class="form-control" id="saldo_cuota_mestxt" name="saldo_cuota_mestxt" required="required" readonly="true">
                        </div> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                         <div class="form-group">
                          <label>TOTAL CUOTA MES</label>
                         
                          <input type="text"  class="form-control" id="cargo_total_cuotatxt" name="cargo_total_cuotatxt" required="required" readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-4">
                         <div class="form-group">
                          <label>ABONO CUOTA MES</label>
                         
                          <input type="text" class="form-control" id="abono_total_cuotatxt" name="abono_total_cuotatxt" required="required" readonly="true">
                        </div> 
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                          <div class="alert alert-danger">
                            
                          <label>TOTAL DEUDA</label> 
                          
                         
                          <input type="text" class="form-control" id="saldo_total_cuotatxt" name="saldo_total_cuotatxt" required="required" readonly="true">
                        </div> 
                    </div>
                </div>

              </form> 
             </div>        
            </div>       
      </div>
       <div class="modal-footer" id="botonespagos">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick='imprimircalculos(<?= $kardex[0]->id_prestamo?>)'>IMPRIMIR</button>
      </div> 
      <div class="modal-footer" id="botonesamort">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick='guardaramortizacion()'>GUARDAR AMORTIZACION</button>
      </div>

       <div class="modal-footer" id="botonesliquidar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick='liquidarprestamo()'>LIQUIDAR</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
      var enlace = "<?php echo  base_url() ?>";
      baseurl(enlace);
      validacionformulariopersona();
      activado();
      });
</script>