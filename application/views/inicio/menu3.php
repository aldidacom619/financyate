  <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background: orange">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" "<?php echo site_url('inicio');?>"><STRONG> EMPRESA DE PRESTAMOS FINANCYATE </STRONG></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-leght">
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><STRONG>ADMINISTRACION</STRONG>
                        <i class="glyphicon glyphicon-cog"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                       <li>
                             <a href="<?php echo site_url('inicio');?>" ><i class="glyphicon glyphicon-user"></i>Inicio</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo site_url('usuarios/salir');?>" ><i class="glyphicon glyphicon-remove"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><STRONG>PRESTAMO</STRONG>
                        <i class="fa fa-money"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                             <a href="<?php echo site_url('prestamos');?>" ><i class="fa-tasks"></i>Lista de Prestamos</a>
                        </li>
                       <li>
                             <a href="<?php echo site_url('personas/lista_persona');?>" ><i class="fa fa-user fa-fw"></i>Prestatarios & Garantes</a>
                        </li>
                       
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                   <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><STRONG>CONTROL DE RECIBOS</STRONG>
                        <i class="glyphicon glyphicon-check"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                             <a href="<?php echo site_url('recibo');?>" ><i class="fa-tasks"></i>Lista de Recibos emitidos</a>
                        </li>
                       
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><STRONG>REPORTES</STRONG>
                        <i class="fa fa-file-text-o"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                             <a href="<?php echo site_url('reportes');?>" ><i class="fa-tasks"></i>Generaros de Reportes</a>
                        </li>
                       
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>

            <!-- /.navbar-top-links -->

    
            <!-- /.navbar-static-side -->
        </nav>
<div class="container" style="width: 100%; background-color: #ffff;">

 
        

           
        <!-- Page Content -->
      