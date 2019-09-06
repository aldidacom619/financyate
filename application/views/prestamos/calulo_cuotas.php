<div class="panel panel-default">
	           
                <div class="panel-body">

                

                	<div class="alert alert-warning">
             <strong>OPCIONES DE KARDEX:</strong>
                  <button class="btn btn-prymari" onclick='imprimircalculos()'>IMPRIMIR CALCULOS </button>
			</div> 
                    <div class="dataTable_wrapper">
				    	<table width="100%" class="table table-fit table-striped table-bordered table-hover" id="dataTables-examples">
				        <thead class="thead">
				    			<th>NRO CUOTA</th>
								<th>DETALLE</th>
								<th>DIA</th>
								<th>FECHAS</th>
								
								<th>DIAS DE INTERES</th>
								
								<th>SALDO CAPITAL</th>
								<th>CAPITAL</th>
								<th>CARGO CORRIENTE</th>
								<th>CARGO INTERES PENAL</th>			
								<th>MONTO A AMORT.</th>
						        
				     		</thead>
				     		<tbody><? 
				     			if($tipomoneda == 2)
								{
									$montoprestamobs = $montoprestamo;
								}
				     		?>
				     		<tr>
					     			<td><?= $fecha?></td>
					     			<td>DESEMBOLSO</td>
					     			<td><?= diasemana($fecha)?></td>
					     			<td><?= $fecha?></td>
					     			<td>0</td>					     			
					     			<td><?= $montoprestamobs?></td>
					     			<td>0,00</td>
					     			<td>0,00</td>
					     			<td>0,00</td>
					     			<td>0,00</td>
					     		</tr>
				     		<? $cont = 1; $totalcapital = 0; $totalcorriente = 0; $totalamortizar = 0;


				     		   $capital = ($montoprestamobs / $plazoprestamo);	
				     		   $fechacalculo = $fecha;
				     			?>
				     		<? while($cont<=$plazoprestamo)
				     		{ 
				     			$totalcapital = $totalcapital + $capital;
								$nuevafecha = strtotime ( '+30 day' , strtotime ( $fechacalculo ) ) ;
								
								$nuevafecha2 = date ( 'Y-m-j' , $nuevafecha );	
								
								$dias = devolver_dias($fechacalculo,$nuevafecha2);
								$fechacalculo = date ( 'Y-m-j' , $nuevafecha );

								$cargocorriente = ($montoprestamobs*(($intcorriente*12)/100)*$dias )/360;

								//$cargocorriente = ($montoprestamobs*($intcorriente/100));	
								$montoprestamobs = ($montoprestamobs - $capital);	
								$amorizar = ($cargocorriente+$capital);
								$totalcorriente = $totalcorriente + $cargocorriente;
								$totalamortizar = $totalamortizar + $amorizar;

				     		 ?>	
					     		
					     		<tr>
					     			<td><?= $cont?></td>
					     			<td><?= "AMORTIZACION ".$cont?></td>
					     			<td><?= diasemana($fechacalculo)?></td>
					     			<td><?= $fechacalculo?></td>
					     			<td><?= $dias?></td>
					     			<td><?= round($montoprestamobs,2)?></td>
					     			<td><?= round($capital,2)?></td>
					     			<td><?= round($cargocorriente,2)?></td>
					     			<td>0,00</td>
					     			<td><?= round($amorizar,2)?></td>
					     		</tr>
				     		<? $cont = $cont +1 ;}?>
				    			<tr>
				    				<th colspan="5">TOTALES</th>
				    				<th></th>
				    				<th><?= $totalcapital?></th>
				    				<th><?= $totalcorriente?></th>
				    				<th>0,00 </th>
				    				
				    				<th><?= $totalamortizar?></th>

				    			</tr>

				    
				        	</tbody>
				      </table> 
     				</div>  
    			</div>
		</div>