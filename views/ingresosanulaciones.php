<?php
  /*
  * Activacion del buffer para sesiones
  */
  ob_start();
  session_start();

  if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    # code...
    header("Location: login.html");

  } else {

    require 'header.php';
    if ($_SESSION['consulcompras']==1) {
      
    ?>
    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">        
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              
              <div class="box-header with-border">
                <div class="form-horizontal">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <strong><a href="dashboard.php"><span class="fa fa-home"> </span> Dashboard</a></strong>
                    </li>
                    <li class="breadcrumb-item active"><strong> Ingreso Anuladoss</li></strong>
                  </ol>
                </div>
              </div>
              <!-- /.box-header -->

            <!-- centro -->
              <div class="panel-body table-responsive" id="listado_registros">
                <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Tipo Comprobante</th>
                    <th>Serie Comprobante</th>
                    <th>Numero Comprobante</th>
                    <th>Total Compra</th>
                    <th>Estado</th>
                    <th>Updated By</th>                          
                    <th>Accion</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Tipo Comprobante</th>
                    <th>Serie Comprobante</th>
                    <th>Numero Comprobante</th>
                    <th>Total Compra</th>
                    <th>Estado</th>
                    <th>Updated By</th>                          
                    <th>Accion</th>
                  </tfoot>
                </table>
              </div>
              
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->



<?php
  } else {
    require 'noaccess.php';
  }
  require 'footer.php';
?>
  <script type="text/javascript" src="scripts/ingresosanulaciones.js"></script>
<?php  
  }
  ob_end_flush();
?>