
              
                <!-- /.row -->
           <script type="text/javascript" src="<?php echo  base_url() ?>jsd/prestamos.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>jsd/personas.js"></script>

  <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">EMPRESA DE PRESTAMOS FINANCYATE</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
<div class="row">
    <div class="col-lg-12">
    	<div class="alert alert-info">
           <center><H3><strong> PAGOS PENDIENTES POR COBRAR</strong></H3></center>
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
								<th>MONTO PRESTAMO</th>
								<th>PLAZO DE PAGO</th>
								<th>TIPO_CAMBIO</th>			
								
						        <th>CUOTA</th>
						        <th>FECHA DE PAGO</th>
						        <th>ESTADO PRESTAMO</th>
						        <th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($pagospedientes as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= nombre_prestatario($fila->id_pers)?></td>
									<td ><?= $fila->fechaprestamo?></td>
									<td ><?= $fila->descripcion?></td>
									
									<td ><?  if($fila->id_moneda == 1){echo $fila->saldocapitalbs;}else {$fila->saldocapital;} ?></td>
									<td ><?= $fila->plazoprestamo?></td>
									<td ><?= $fila->cambioinicial?></td>
							
						            <td ><?  if($fila->id_moneda == 1){echo $fila->cuotatotalbs;}else {$fila->cuotatotal;} ?></td>
						            <td ><?= $fila->fechacalculo?></td>
						            <td ><?= $fila->descripcion_est?></td>						            
						            <td>					            	
						            	 <button class="btn btn-danger" onclick='verkardex(<?= $fila->id_prestamo?>)'>VERIFICAR</button>
						            	
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

<div class="row">
    <div class="col-lg-12">
    	<div class="alert alert-danger">
           <center><H3><strong> PRESTAMOS EN MORA</strong></H3></center>
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
								<th>MONTO PRESTAMO</th>
								<th>PLAZO DE PAGO</th>
								<th>TIPO_CAMBIO</th>			
								 <th>ULTIMA FECHA</th>
						        <th>ULTIMA CUOTA</th>
						        <th>DEUDA TOTAL</th>
						        <th>ESTADO PRESTAMO</th>
						        <th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($prestamomora as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= nombre_prestatario($fila->id_pers)?></td>
									<td ><?= $fila->fechaprestamo?></td>
									<td ><?= $fila->descripcion?></td>
									
									<td ><?  if($fila->id_moneda == 1){echo $fila->saldocapitalbs;}else {$fila->saldocapital;} ?></td>
									<td class="danger"><?= $fila->plazoprestamo?></td>
									<td ><?= $fila->cambioinicial?></td>
									<td ><?= $fila->fechacalculo?></td>
						            <td ><?  if($fila->id_moneda == 1){echo $fila->cuotatotalbs;}else {$fila->cuotatotal;} ?></td>
						            <td  class="danger" ><?  if($fila->id_moneda == 1){echo $fila->totaldeudabs;}else {$fila->totaldeuda;} ?></td>
						            <td ><?= $fila->descripcion_est?></td>						            
						            <td>					            	
						            	 <button class="btn btn-danger" onclick='verkardex(<?= $fila->id_prestamo?>)'>VERIFICAR</button>
						            	
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


<div class="row">
    <div class="col-lg-12">
    	<div class="alert alert-success">
           <center><H3><strong>CONTROL DE PAGOS POR CUOTAS</strong></H3></center>
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
								<th>MONTO PRESTAMO</th>
								 <th>ULTIMA FECHA AMORTIZACION</th>
								
								<th>ULTIMA CUOTA</th>			
								 <th>DEUDA TOTAL</th>
						        <th>FECHA DE PAGO</th>
						        <th>NUM CUOTAS PENDIENTES</th>
						        <th>TOTAL MONTO A PAGAR</th>
						       
						        <th>ESTADO PRESTAMO</th>
						        <th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($cuotasdiarias as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= nombre_prestatario($fila->id_pers)?></td>
									<td ><?= $fila->fechaprestamo?></td>
									<td ><?= $fila->descripcion?></td>
									
									<td ><?  if($fila->id_moneda == 1){echo $fila->saldocapitalbs;}else {$fila->saldocapital;} ?></td>
									<td ><?= $fila->fechacalculo?></td>
									 <td ><?  if($fila->id_moneda == 1){echo $fila->cuotatotalbs;}else {$fila->cuotatotal;} ?></td>
						            <td   ><?  if($fila->id_moneda == 1){echo $fila->totaldeudabs;}else {$fila->totaldeuda;} ?></td>
									<td class="danger"><?= $fila->fecha_pago?></td>
									<td class="danger"><?= $fila->ncuotas?></td>
									<td class="danger"><?= $fila->monto_amortizar?></td>
									
									
						           
						            
						            <td ><?= $fila->descripcion_est?></td>						            
						            <td>					            	
						            	 <button class="btn btn-danger" onclick='verkardex(<?= $fila->id_prestamo?>)'>VERIFICAR</button>
						            	
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
           