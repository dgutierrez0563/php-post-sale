
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
    if ($_SESSION['manteaccess']==1) {

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
                        <li class="breadcrumb-item active"><strong> Accesos</li></strong>
                      </ol>
<!--                       <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarForm(true)">
                      <i class="fa fa-plus-circle"></i>  Agregar Accesos</button> -->
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <!-- centro -->
                  <div class="panel-body table-responsive" id="listado_registros">
                    <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <th>No.</th>
                        <th>Tipo de Role</th>
                        <th>Tipo de Permiso</th>
                        <th style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">Action</th>
                      </thead>
                      <tbody>                          
                      </tbody>
                      <tfoot>
                        <th>No.</th>
                        <th>Tipo de Role</th>
                        <th>Tipo de Permiso</th>
                        <th style="margin:0 auto;margin-left:auto;margin-right:auto;text-align:center;">Action</th>
                      </tfoot>
                    </table>
                  </div>

                  <div class="panel-body" id="form_asignacion_accesos">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Asignacion de Accesos</strong>
                      </div>
                      <div class="panel-body">                        
                        <form id="form_create_accesos" name="form_create_accesos" method="POST">

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="id_role_asignacion">Role</label>
                              <select class="form-control selectpicker" data-live-search="true" name="id_role_asignacion" id="id_role_asignacion" required>
                              </select>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="panel panel-danger">
                                <div class="panel-heading">
                                  <strong><i class="fa fa-edit"></i> Listado de Accesos</strong>
                                </div>
                                <div class="panel-body">
                                  <ul style="list-style: none;columns: 3;" name="permisos" id="permisos">
                                    
                                  </ul>
                                </div>
                            </div>

                            <br>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <br>
                              <button class="btn btn-primary" type="submit" id="btn_save"><i class="fa fa-save"></i> Guardar</button>
                              <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
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
  <script type="text/javascript" src="scripts/acceso.js"></script>
<?php  
  }
  ob_end_flush();
?>