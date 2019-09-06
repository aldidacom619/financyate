<script type="text/javascript" src="<?php echo  base_url() ?>jsd/personas.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>recursos/bower_components/jquery-validation/jquery.validate.js"></script> 
<div class="row">
    <div class="col-lg-12">
    	<div class="alert alert-info">
           <H5>LISTA DE PRESTATARIOS & GARANTES</H5>
        </div>
        <button class="btn btn-primary" onclick='nuevapersona()'>NUEVO</button>
        
    	<div class="panel panel-default">
	           
                <div class="panel-body">
                    <div class="dataTable_wrapper">
				    	<table width="100%" class="table table-fit table-striped table-bordered table-hover" id="dataTables-example">
				        <thead class="thead">
				    		<th>Nro</th>
								<th>C.I.</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Sexo</th>
								<th>Fecha Nacimiento</th>			
								<th>Dirección</th>
						        <th>Teléfono</th>
						        <th>Nro Préstamos</th>
						        <th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($personas as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= $fila->ci?></td>
									<td ><?= $fila->nombres?></td>
									<td ><?= $fila->primer_apellido." ". $fila->segundo_apellido." ". $fila->apellido_casada?></td>
									<td ><?= $fila->sexo?></td>
									<td ><?= $fila->fecha_nacimiento?></td>
									<td ><?= $fila->direccion?></td>
						            <td ><?= $fila->telefono?></td>
						            <td ><?= "#PRÉSTAMOS ".numero_prestamos($fila->id_persona)?></td>
						            
						            <td ><button class="btn btn-primary" onclick='editarpersona(<?= $fila->id_persona?>)'>Editar</button>
						            	 <button class="btn btn-success" onclick='verprestamos(<?= $fila->id_persona?>)'>Ver Prestamo</button>
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
<div class="modal fade" id="personamodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">REGISTRO DE PRESTATARIOS</h4>
      </div>
      <div class="modal-body">
		  <form id="formulariopersona">
			          <div class="row"> 
			            <legend>Datos Personales</legend>
			            <div  class="alert alert-danger"  id="validarpersona" style="display: none;">
                
           				 </div>
			              <input type="hidden" class="form-control" id="accion" name="accion" required="required">
			              <input type="hidden" class="form-control" id="id_persona" name="id_persona" required="required">
			              <input type="hidden" class="form-control" id="id_prestamo" name="id_prestamo" required="required">
			              <div class="col-lg-4">
			              <div class="form-group"> 
			                <label>C.I.</label>
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
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick='cerrarmodal()'><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
        <button type="button" class="btn btn-primary" onclick='guardarpersona()'><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      var enlace = "<?php echo  base_url() ?>";
      baseurl(enlace);
       validacionformulariopersona();
      });
</script>
           