     <div class="panel-body">
              <font size="2">
              </div>
              <div class="row">
                    <div class="col-xs-3">
                       <p class="text-right"><strong>C.I.:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->ci?></p>
                    </div>
                    <div class="col-xs-3">
                       <p class="text-right"><strong>NOMBRES:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->nombres?></p>
                    </div>
               </div>
              <div class="row">
                    <div class="col-xs-3">
                       <p class="text-right"><strong>PRIMER APELLIDO:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->primer_apellido?></p>
                    </div><div class="col-xs-3">
                       <p class="text-right"><strong>SEGUNDO APELLIDO:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->segundo_apellido?></p>
                    </div>
                </div>
              <div class="row">     
                  <div class="col-xs-3">
                       <p class="text-right"><strong>APELLIDO CASADA:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->apellido_casada?></p>
                    </div><div class="col-xs-3">
                       <p class="text-right"><strong>SEXO:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->sexo?></p>
                    </div>
               </div>
              <div class="row">
                    <div class="col-xs-3">
                       <p class="text-right"><strong>FECHA DE NACIMIENTO:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->fecha_nacimiento?></p>
                    </div><div class="col-xs-3">
                       <p class="text-right"><strong>CORREO:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->correo?></p>
                    </div>
                </div>
              <div class="row">     
                    <div class="col-xs-3">
                       <p class="text-right"><strong>DIRECCIÓN:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->direccion?></p>
                    </div><div class="col-xs-3">
                       <p class="text-right"><strong>TELEFONO:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->telefono?></p>
                    </div>
               </div>
              <div class="row">      
                    <div class="col-xs-3">
                       <p class="text-right"><strong>OCUPACION:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= $filas[0]->ocupacion?></p>
                    </div>
                  
                  <div class="col-xs-3">
                       <p class="text-right"><strong>NRO PRÉSTAMOS:</strong></p>
                    </div> 
                    <div class="col-xs-3">
                       <p class="text-left" id="spPrestatario"><?= numero_prestamos($filas[0]->id_persona)?></p>
                    </div>
              </div>
            </font>
    </div>