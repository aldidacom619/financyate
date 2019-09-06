<div class="panel panel-default">
	           
                <div class="panel-body">
                    <div class="dataTable_wrapper">
				    	<table width="100%" class="table table-fit table-striped table-bordered table-hover" id="dataTables-examples">
				        <thead class="thead">
				    			<th>NRO CUOTA</th>
								
								<th>DIA INTERES</th>
								<th>FECHAS</th>
								<th>SALDO CAPITAL</th>
								<th>MENSUAL</th>
								<th>CARGO CORRIENTE</th>
								<th>MONTO A AMORT.</th>
								
						        
				     		</thead>
				     			<tbody>
				     		<?php $aux = 0; $totalcapital = 0; $totalcorriente = 0; $totalamortizar = 0;$totalmensual = 0?>
				    		<? foreach($filas as $fila):?>
				        	<?php 
									if($fila->estado_pago == 'f')
									{ 
										if($aux == 0)
										{?> 
											<tr class="danger">
									
									<?php
										 $aux = 1;
										}else{
										?> 
											<tr class="success">
									
										<?php 
											 $aux = 2;
									}
					        		}else{
					        			?> <tr class="info">
									<?php
					        		}?>		
				        	
				        			<? $totalcapital = $totalcapital + $fila->saldo_capital;
				        				$totalcorriente = $totalcorriente + $fila->cargo_corriente;
				        				$totalamortizar = $totalamortizar + $fila->monto_amortizar;
				        				$totalmensual = $totalmensual +$fila->monto_mensual;
				        			?>
				          			<td ><?= $fila->nro_pago?></td>
									<td ><?= $fila->diasinnteres?></td>
									<td ><?= $fila->fecha_pago?></td>
									<td ><?= round($fila->saldo_capital,2)?></td>
									<td ><?= round($fila->monto_mensual,2)?></td>
									<td ><?= round($fila->cargo_corriente,2)?></td>
									<td ><?= round($fila->monto_amortizar,2)?></td>
								<!--	<td >
									<?php 
									if($fila->estado_pago == 'f' && $aux == 1)
									{?>
				        				<button class="btn btn-primary" onclick='amortizarpago(<?= $fila->id_prest?>,<?= $fila->id_pagos?>)'>AMORTIZAR</button>		
					        		<?php
					        		}
					        		?>	
						            
						            </td>-->
				        	</tr>
				        <?endforeach?>
				        <tr>
				    				<th colspan="3">TOTALES</th>
				    				
				    				<th></th>
				    				<th><?= $totalmensual?></th>

				    				<th><?= $totalcorriente?></th>
				    				
				    				
				    				<th><?= $totalamortizar?></th>

				    			</tr>
				        </tbody>
				      </table> 
     				</div>  
    			</div>
		</div> 