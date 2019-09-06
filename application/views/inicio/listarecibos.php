<script type="text/javascript" src="<?php echo  base_url() ?>jsd/prestamos.js"></script>
<div class="row">
    <div class="col-lg-12">
    	<div class="alert alert-info">
           <center><H3><strong> LISTA DE PRESTAMOS</strong></H3></center>
        </div>
       
        
    	<div class="panel panel-default"> 
	           
                <div class="panel-body">
                    <div class="dataTable_wrapper">
				    	<table width="100%" class="table table-fit table-striped table-bordered table-hover" id="dataTables-example">
				        <thead class="thead">
				    		<th>Nro</th>
								<th>PRESTATARIO</th>
								<th>FECHA DE PAGO</th>
								<th>CONCEPTO</th>
								<th>TIPO DE MONEDA</th>
								<th>MONTO</th>
								<th>CORRELATIVO</th>
								<th>USUARIOS</th>			
								<th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($filas as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= nombre_prestatario($fila->persona)?></td>
									<td ><?= $fila->fecha_pago?></td>
									<td ><?= $fila->concepto_pago?></td>
									<td ><? if ($fila->tipo_moneda == 1){echo "BOLIVIANOS";}else{echo "DOLARES";} ?></td>
									<td ><? if ($fila->tipo_moneda == 1){echo $fila->montobs;}else{echo $fila->monto;} ?></td>
									<td ><?= $fila->correlativo."/".$fila->gestion?></td>

									<td ><?= nombre_usuario($fila->usuario)?></td>
								
						            
						            <td>					            	
						            	 <button class="btn btn-primary" onclick='imprimirrecibo(<?= $fila->id_recibo?>)'>IMPRIMIR</button>
						            	
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
           