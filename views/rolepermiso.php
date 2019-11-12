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
    if ($_SESSION['manteroles']==1) {

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
                        <li class="breadcrumb-item active"><strong> Roles</li></strong>
                      </ol>
                      <div class="btn-group pull-right">
                        <button id="btn_agregar" class="btn btn-success pull-left" onclick="mostrarForm(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Role
                        </button>
                      </div>
                      <div class="btn-group pull-right">
                        <button id="btn_agregar_accesos" class="btn btn-primary pull-right" onclick="mostrarFormAccesos(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Accesos
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- /.box-header -->
                  <!-- centro -->
                  <div class="panel-body table-responsive" id="listado_registros">
                    <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <th>COD</th>
                        <th>Nombre Permiso</th>
                        <th>Accion</th>
                      </thead>
                      <tbody>                          
                      </tbody>
                      <tfoot>
                        <th>COD</th>
                        <th>Nombre Permiso</th>
                        <th>Accion</th>
                      </tfoot>
                    </table>
                  </div>


                  <div class="panel-body table-responsive" id="listadopermisorole">
                    <table id="tblistadopermisorole" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <th>COD</th>
                        <th>Nombre Permiso</th>
                        <th>Updated by</th>
                        <th>Updated</th>
                        <th>Accion</th>
                      </thead>
                      <tbody>                          
                      </tbody>
                      <tfoot>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Updated by</th>
                        <th>Updated</th>
                        <th>Accion</th>
                      </tfoot>
                    </table>
                  </div>

		        <div class="panel-body" id="form_detalle">
		          <div class="panel panel-info">
		            <div class="panel-heading">
		              <strong><i class="fa fa-edit"></i> Detalle Permisos por Role</strong>
		            </div>
		            <div class="panel-body">
		              
		              <form id="form_detalle_2" name="form_detalle_2">

		                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
		                    <label for="nombre_p">Codigo de Permiso</label>
		                    <div class="input-group">
		                      <span class="input-group-addon"><i><strong>#</strong></i></span>
		                      <input type="text" name="codcategoria_id_p" id="codcategoria_id_p" style="display: none;">
		                      <input type="text" class="form-control" name="codcategoria_p" id="codcategoria_p" placeholder="Codigo de categoria" readonly>
		                    </div>
		                  </div>

		                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
		                    <label for="nombre_p">Nombre de Permiso</label>
		                    <div class="input-group">
		                      <span class="input-group-addon"><i class="fa fa-archive"></i></span>
		                      <input type="text" class="form-control" name="nombre_p" id="nombre_p" readonly>
		                    </div>
		                  </div>

		                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
		                    <label for="updated_by_p">Creado por</label>
		                    <div class="input-group">
		                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
		                      <input type="text" class="form-control" name="updated_by_p" id="updated_by_p" readonly>
		                    </div>
		                  </div>

		                  <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
		                    <label for="created_at_p">Creado en</label>
		                    <div class="input-group">
		                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                      <input type="text" class="form-control" name="created_at_p" id="created_at_p" readonly>
		                    </div>
		                  </div>

		                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Regresar</button>
		                  </div>
		                <!-- </div> -->
		              </form>
		            </div>
		          </div>                      
		        </div>
		        <!--Fin centro -->

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
  <script type="text/javascript" src="scripts/role_permiso.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<?php  
  }
  ob_end_flush();
?>