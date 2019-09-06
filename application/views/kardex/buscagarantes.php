<div class="panel panel-default">
	           
                <div class="panel-body">
                    <div class="dataTable_wrapper">
				    	 	<table width="100%" class="table table-fit table-striped table-bordered table-hover" id="dataTables-example2">
				        <thead class="thead">
				    		<th>Nro</th>
								<th>C.I.</th>
								<th>Nombres</th>
								
								<th>Sexo</th>
								<th>Nro Préstamos</th>
						        <th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($filas as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= $fila->ci?></td>
									
									<td ><?= $fila->nombres." ".$fila->primer_apellido." ". $fila->segundo_apellido." ". $fila->apellido_casada?></td>
									<td ><?= $fila->sexo?></td>
									<td ><?= "#PRÉSTAMOS ".numero_prestamos($fila->id_persona)?></td>
						            
						            <td ><button class="btn btn-primary" onclick='seleccionargarante(<?= $fila->id_persona?>)'>SELECCIONAR</button>						            	
						          	</td>
				        </tr>
				        <?endforeach?>
				        </tbody>
				      </table> 
     				</div>  
    			</div>
		</div>