<!DOCTYPE html>
<html lang="es" class="body-full-height">
<head>
  <title><?= $title ?></title>
   <link rel="stylesheet" href="<?php echo  base_url() ?>recursos/bower_components/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo  base_url() ?>recursos/bower_components/bootstrap/dist/css/datepicker.css">
   <link rel="stylesheet" href="<?php echo  base_url() ?>recursos/bower_components/metisMenu/dist/metisMenu.min.css">
   <link rel="stylesheet" href="<?php echo  base_url() ?>recursos/css/estilos.css">
  
    
</head>
<body>       
<div class=" login-container" >
    <div class="login-box">
      <div><h1>EMPRESA DE PRESTAMOS</h1><br><p>"FINANCYATE"
      </p></div>
      <div class="login-body panel-info">
             <div class="panel-heading">
               <div class="panel-title text-center">
                    INGRESO AL SISTEMA
               </div>
             </div>
       <div class="panel-body">
         <div class="form-group">
          <?= form_open('Usuarios/logued')?>
         <fieldset>
             <div style="margin-bottom: 25px" class="input-group">
               <span class="input-group-addon">
                 <i class="glyphicon glyphicon-user"></i>
               </span>
               <input  name="username" class="form-control" id="exampleInputEmail1" placeholder="Usuario">
             </div>
             <div style="margin-bottom: 25px" class="input-group">
               <span class="input-group-addon">
                 <i class="glyphicon glyphicon-lock"></i>
               </span>
               <input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
             </div>
             <div class="form-group">
               <?php echo form_submit(array('type'=>'submit','value'=>'Ingresar','class'=>'btn btn-info'))?> 
             </div>
          </fieldset>
          <? if ($error != "")
       {?>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true"><?= $error?> &times;</span></button>
       <?}
      
      ?>
      <?php echo form_close();?>

        </div>    
       </div>
     </div>
    </div>
  </div>

<footer>
 
</footer>
</body>
   
   
</html>
