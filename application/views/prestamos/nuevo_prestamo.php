<script type="text/javascript" src="<?php echo  base_url() ?>jsd/prestamos.js"></script>

<script type="text/javascript" src="<?php echo  base_url() ?>recursos/bower_components/jquery-validation/jquery.validate.js"></script> 
<div class="row">
	<div class="alert alert-info">
           <H3>NUEVO PRESTAMO </H3>
        </div>
        <div class="alert alert-success">
            <strong>PRESTATARIO: <?= nombre_prestatario($id_persona)?></strong>
        </div>
    <div class="panel panel-default">
	           
                <div class="modal-body">
        
			        <form id="formularioprestamo">
			          <div class="row"> 
			            <legend>Datos de Préstamo</legend>
			             <div  class="alert alert-danger"  id="validarprestamo" style="display: none;">
                        				 </div>
			              <input type="hidden" class="form-control" id="accion" name="accion" value="nuevo" required="required">
			              <input type="hidden" class="form-control" id="id_prestamo" name="id_prestamo" required="required">
			              <input type="hidden" class="form-control" id="id_persona" name="id_persona" value="<?= $id_persona?>" required="required">
			              <div class="col-lg-4">
			              
			              <div class="form-group">
			                <label>TIPO DE MONEDA</label>
			                <SELECT NAME="tipomoneda" id = "tipomoneda" class="form-control">
			                  
			                </SELECT> 
			              </div>
			              <div class="form-group"> 
			                <label>FECHA DE PRESTAMO</label>
			                <input class="form-control" id="fecha_prestamo" name="fecha_prestamo" required="required">

			              </div>
			              <div class="form-group">
			                <label>CLASE DE PRESTAMO</label>
			                <SELECT NAME="claseprestamo" id = "claseprestamo" class="form-control">
			                  
			                </SELECT> 
			              </div>
			              <div class="form-group">
			                <label>TIPO DE GARANTIA</label>
			                <SELECT NAME="tipogarantia" id = "tipogarantia" class="form-control">
			                  
			                </SELECT> 
			              </div>
			              
			             	 		              
			            </div>
			            <div class="col-lg-4">
			            	<div class="form-group"> 
				                <label>NRO. CONTRATO</label>
				                <input class="form-control" id="contrato" name="contrato" required="required">
				              </div>
				               <div class="form-group">
			                    <label>TIPO DE CAMBIO INICIAL</label>
			                    <input class="form-control" id="tipocambioini" name="tipocambioini" required="required" >
			                    <input type="hidden" class="form-control" id="tipocambioiniaux" name="tipocambioiniaux">
			                </div>
			            	 	  <div class="form-group"> 
					                <label>MONTO DE PRESTAMO BS</label>
					                <input class="form-control" id="montoprestamobs" name="montoprestamobs" required="required">
					              </div>
					              <div class="form-group"> 
					                <label>MONTO DE PRESTAMO $</label>
					                <input class="form-control" id="montoprestamo" name="montoprestamo" required="required">
					              </div>
					              	
			            </div>
			             <div class="col-lg-4">
			             	 <div class="form-group">
					                <label>FECHA DE DESEMBOLSO</label>
					                <input class="form-control" id="fecdesembolso" name="fecdesembolso" required="required">
					              </div> 
			             	<div class="form-group">
					                <label>INTERES CORRIENTE</label>
					                <input class="form-control" id="intcorriente" name="intcorriente" required="required">
					              </div>  
					              <div class="form-group">
					                <label>INTERES PENAL</label>
					                <input class="form-control" id="intpenal" name="intpenal" required="required">
					              </div> 
			               	<div class="form-group">
					                <label>PLAZO DEL PRESTAMO EN MESES</label>
					                <input class="form-control" id="plazoprestamo" name="plazoprestamo" required="required">
					              </div>  
					            
			               
			                
			            </div>
			          </div>
			          <div class="row">
			          	<div class="col-xs-12">
                            <div class="form-group">
				                    <label>OBSERVACIONES </label>
				                    <textarea class="form-control" id="observacioesprestamo" name="observacioesprestamo" ></textarea>
				                </div>
				            
				        </div>
			          </div> 
			        </form> 
			       </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal" onclick='cerrarmodal()'><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal" onclick='calcularmontos()'><span class="glyphicon glyphicon-remove"></span> Calcular</button>
       				 <button type="button" class="btn btn-primary" id = "guardarprestamo" onclick='guardarprestamo()'><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
			      </div>



	</div>
	<div class="panel panel-default">
		<div id="tablacalculos">
			
		</div>
	</div>
<script type="text/javascript">
    $(document).ready(function(){
       var enlace = "<?php echo  base_url() ?>";
       baseurl(enlace);
       validacionformularioprestamo();
      });
</script>
           