
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
    //if ($_SESSION['manteaccess']==1) {

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
                        <li class="breadcrumb-item active"><strong> Nivel 1 Menu</li></strong>
                      </ol>
                      <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarForm(true)">
                        <i class="fa fa-plus-circle"></i>  Agregar Nivel</button>
                    </div>
                  </div>

                  <!-- /.box-header -->
                  <!-- centro -->
                  <div class="panel-body table-responsive" id="listado_registros">
                    <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <th>Cod SubMenu</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Accion</th>
                      </thead>
                      <tbody>                          
                      </tbody>
                      <tfoot>
                        <th>Cod SubMenu</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Accion</th>
                      </tfoot>
                    </table>
                  </div>
                  <div class="panel-body" id="form_registros">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Agregar Nivel 1 Sub-Menu</strong>
                      </div>
                      <div class="panel-body">
                        
                        <form id="form_create_update" name="form_create_update" method="POST">

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="codsubmenu">Codigo Nivel 1 Menu</label>
                              <input type="text" name="codsubmenu_id" id="codsubmenu_id" style="display: none;">
                              <input type="text" class="form-control" name="codsubmenu" id="codsubmenu" maxlength="50" placeholder="Codigo Sub-Menu 1" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="nombre">Nombre Nivel 1 Menu</label>
                              <input type="text" name="id_permiso" id="id_permiso" style="display: none;">
                              <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre del Sub-Menu 1" required>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <button class="btn btn-primary" type="submit" id="btn_save"><i class="fa fa-save"></i> Guardar</button>
                              <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
                            </div>
                          <!-- </div> -->
                        </form>
                      </div>
                    </div>                      
                  </div>
                  <!--Fin centro -->

                  <div class="panel-body" id="form_registros_edit">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Editar Nivel 1 Sub-Menu</strong>
                      </div>
                      <div class="panel-body">
                        
                        <form id="form_edit" name="form_edit" method="POST">

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="codsubmenu_edit">Codigo Nivel 1 Sub-Menu</label>
                              <input type="text" name="codsubmenu_id_edit" id="codsubmenu_id_edit" style="display: none;">
                              <input type="text" class="form-control" name="codsubmenu_edit" id="codsubmenu_edit" maxlength="50" placeholder="Codigo Nivel 1 Sub-Menu" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="nombre_edit">Nombre Nivel 1 Sub-Menu</label>
                              <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" maxlength="50" placeholder="Nombre Nivel 1 Sub-Menu" required>
                            </div>
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <button class="btn btn-primary" type="submit" id="btn_edit"><i class="fa fa-save"></i> Guardar</button>
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
  // } else {
  //   require 'noaccess.php';
  // }
  require 'footer.php';
?>
  <script type="text/javascript" src="scripts/submenu.js"></script>
<?php  
  }
  ob_end_flush();
?>