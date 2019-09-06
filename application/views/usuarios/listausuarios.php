<script type="text/javascript" src="<?php echo  base_url() ?>jsd/user.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>recursos/bower_components/jquery-validation/jquery.validate.js"></script> 
<div class="row">
    <div class="col-lg-12">
    	<div class="alert alert-info">
           <H5>LISTA DE USUARIOS</H5>

        </div>
        <button class="btn btn-primary" onclick='nuevausuario()'>NUEVO</button>
        
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
								<th>Telefono</th>
						        <th>Tipo User</th>
						        <th>Estado</th>
						        <th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($usuarios as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= $fila->ci?></td>
									<td ><?= $fila->nombres?></td>
									<td ><?= $fila->apellido_paterno." ". $fila->apellido_materno?></td>
									<td ><?= $fila->sexo?></td>
									<td ><?= $fila->fecha_nacimiento?></td>
									
						            <td ><?= $fila->telefono?></td>	
						            <td ><?= $fila->descripcion_user?></td>
						            <td ><? if($fila->estado_user== 't'){echo 'ACTIVO';}else{echo 'BAJA';}?></td>
						            
						            
						            <td >
						            	<button class="btn btn-primary" onclick='editarusuario(<?= $fila->id_user?>)'>Editar</button>						            	 
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
        
        
      </div>
      <div class="modal-body">
		  <form id="formulariousuario">
			          <div class="row"> 
			            <legend>Datos Personales</legend>

			            <h4 class="modal-title" id="exampleModalLabel">REGISTRO DE USUARIOS</h4>
			              <input type="hidden" class="form-control" id="accion" name="accion" required="required">
			              <input type="hidden" class="form-control" id="id_persona" name="id_persona" required="required">
			              <div  class="alert alert-danger"  id="validacionusuario" style="display: none;">
                
            </div>
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
			                <label>FECHA DE NACIMIENTO</label>
			                <input class="form-control" id="fechanacimiento" name="fechanacimiento"  required="required">
			              </div> 
			             
			              <div class="form-group">
			                    <label>DIRECCIÓN</label>
			                    <input class="form-control" id="domicilio" name="domicilio" required="required">
			                </div>
			                 <div class="form-group">
			                    <label># TELEFÓNICO</label>
			                    <input class="form-control" id="celular" name="celular" required="required">
			                </div>
			            </div>
			             <div class="col-lg-4">
			                
			               
			                <div class="form-group">
			                    <label>TIPO DE USUARIO</label>
			                    <SELECT NAME="tipouser" id = "tipouser" class="form-control">			                  
			                	</SELECT> 			                    
			                </div>

			                <div class="form-group" id="estadousesr">
			                    <label>ESTADO USUARIO</label>
			                    <SELECT NAME="estadouser" id = "estadouser" class="form-control">			                  
			                	</SELECT> 			                    
			                </div>
			               
			               <div id="usuarioslabel">
				              <div class="form-group">
				                    <label>NOMBRE DE USUARIO</label>
				                    <input class="form-control" id="nombreusuario" name="nombreusuario" required="required">
				                </div>
				                 <div class="form-group">
				                    <label>CONTRASEÑA</label>
				                    <input type="password" class="form-control" id="clave" name="clave" required="required">
				                </div>
				            	</div>
			            	</div> 
			          </div> 
			        </form> 
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick='cerrarmodal()'><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
        <button type="button" class="btn btn-primary" onclick='guardarusuario()'><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
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
           