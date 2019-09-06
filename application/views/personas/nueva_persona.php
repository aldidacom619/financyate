<script type="text/javascript" src="<?php echo  base_url() ?>jsd/personas.js"></script>
<div class="row">
	<div class="alert alert-info">
           <H3>NUEVA PERSONA</H3>
        </div>
    <div class="panel panel-default">
	           
                <div class="modal-body">
        
			        <form id="formulariopersona">
			          <div class="row"> 
			            <legend>Datos Personales</legend>
			              <input type="hidden" class="form-control" id="accion" name="accion" required="required">
			              <input type="hidden" class="form-control" id="id_persona" name="id_persona" required="required">
			              <div class="col-lg-4">
			              <div class="form-group"> 
			                <label>C.I.</label>
			                <input class="form-control" id="ci" name="ci" required="required">
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
			                <input class="form-control" id="ap_casada" name="ap_casada" required="required">
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
			                    <input class="form-control" id="correo" name="correo" required="required">
			                </div>
			            </div>
			          </div> 
			        </form> 
			       </div>
			      <div class="modal-footer">
			        <button id="cancelarpersona" type="button" class="btn btn-default" ><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
			        <button id="guardarpersona" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
			      </div>



	</div>
<script type="text/javascript">
    $(document).ready(function(){
       var enlace = "<?php echo  base_url() ?>";
       var accion = "<?php echo  $accion; ?>";
       baseurl(enlace);
       validacionformulariopersona(accion);
      });
</script>
           