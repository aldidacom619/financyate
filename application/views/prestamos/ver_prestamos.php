<script type="text/javascript" src="<?php echo  base_url() ?>jsd/prestamos.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>jsd/personas.js"></script>
<div class="row">
    <div class="col-lg-12">
    	<div class="alert alert-info">
           <center><H3><strong> LISTA DE PRESTAMOS PERSONA</strong></H3></center>
        </div>                 
         
         <button class="btn btn-primary" onclick='nuevoprestamos(<?= $persona?>)'>Nuevo Prestamo</button>
         
         <BR>

          <div class="alert alert-success">
            <strong>PRESTATARIO: <?= nombre_prestatario($persona)?></strong>
        </div>
    	<div class="panel panel-default"> 
	           
                <div class="panel-body">
                    <div class="dataTable_wrapper">
				    	<table width="100%" class="table table-fit table-striped table-bordered table-hover" id="dataTables-example">
				        <thead class="thead">
				    		<th>Nro</th>
								<th>PERSONA</th>
								<th>FECHA PRESTAMO</th>
								<th>TIPO MONEDA</th>
								<th>MONTO BS</th>
								<th>MONTO $</th>
								<th>TIPO_CAMBIO</th>			
								<th>INT. CORRIENTE</th>
								<th>INT. PENAL</th>
						        <th>NRO. CUOTAS</th>
						        <th>PLAZO PAGO</th>
						        <th>ESTADO</th>
						        <th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($prestamos as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= nombre_prestatario($fila->id_pers)?></td>
									<td ><?= $fila->fechaprestamo?></td>
									<td ><?= $fila->descripcion?></td>
									
									<td ><?= $fila->saldocapitalbs?></td>
									<td ><?= $fila->saldocapital?></td>
									<td ><?= $fila->cambioinicial?></td>
									<td ><?= $fila->interescorriente?></td>
						            <td ><?= $fila->interespenal?></td>
						            <td ><?= $fila->nro_cuotas?></td>
						            <td ><?= $fila->plazoprestamo?></td>
						            <td ><?= $fila->descripcion_est?></td>
						            
						            <td>					            	
						            	 <button class="btn btn-success" onclick='verkardex(<?= $fila->id_prestamo?>)'>KARDEX</button>
						            	<?if($fila->cerrado == 'f'){?>
						            	  <button class="btn btn-primary" onclick='modificarpresta(<?= $fila->id_prestamo?>)'>EDITAR</button>
						            	 <?}?>
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

<script type="text/javascript">
    $(document).ready(function(){
      var enlace = "<?php echo  base_url() ?>";
      baseurl(enlace);
      
      });
</script>
           