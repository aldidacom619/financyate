<script type="text/javascript" src="<?php echo  base_url() ?>jsd/reporte.js"></script>
<div class="row">
	<div class="alert alert-info">
           <H3>PANEL DE GENERACIÓN DE REPORTES</H3>
        </div>
    <div class="panel panel-default">
	           
                <div class="modal-body">
        
			       
			          <div class="row"> 
			          	 <form id="formularioreportes">
			            <legend>Reporte de Prestamos</legend>
			           
			              <div class="col-lg-3">
			              	 <div class="form-group">
			                <label>TIPO DE MONEDA</label>
			                <SELECT NAME="tipomoneda" id = "tipomoneda" class="form-control">
			                  
			                </SELECT> 
			              </div>
			             
			            	</div>
			            <div class="col-lg-3">
			              <div class="form-group">
			                <label>ESTADO PRESTAMO</label>
			                <SELECT NAME="estadoprestamo" id = "estadoprestamo" class="form-control">
			                  
			                </SELECT> 
			              </div>
			               
			            </div>

			           	             
			              </form> 
			              
			             <div class="col-lg-3">
			             	<div class="form-group"> 
			                	<br>
			                  <button class="btn btn-primary" onclick='primerreporte()'><span class="fa fa-print"></span> Imprimir Reporte</button>
			               </div>
			                
			            </div>
			          </div> 


			           <div class="row"> 
			          	 <form id="formularioreportes">
			            <legend>Reporte de Amortizaciones</legend>
			           
			              <div class="col-lg-3">
			              	 <div class="form-group">
			                <label>FECHA INICIO</label>
			                <input type="text"  NAME="fecha1" id = "fecha1" class="form-control">
			                  
			                
			              </div>
			             
			            	</div>
			            <div class="col-lg-3">
			              <div class="form-group">
			                <label>FECHA FIN</label>
			                <input type="text"  NAME="fecha2" id = "fecha2" class="form-control">
			                  
			                
			              </div>
			               
			            </div>

			           	             
			              </form> 
			              
			             <div class="col-lg-3">
			             	<div class="form-group"> 
			                	<br>
			                  <button class="btn btn-primary" onclick='primerreporteamortizacion()'><span class="fa fa-print"></span> Imprimir Reporte</button>
			               </div>
			                
			            </div>
			          </div> 


			         
			       </div>
			     



	</div>
<script type="text/javascript">
    $(document).ready(function(){
       var enlace = "<?php echo  base_url() ?>";
       baseurl(enlace);
       validacionformularioreporte();
      });
</script>
           