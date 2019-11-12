
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
                        <li class="breadcrumb-item active"><strong> Nivel 2 Sub-Menu</li></strong>
                      </ol>
                      <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarForm(true)">
                        <i class="fa fa-plus-circle"></i>  Agregar Nivel 2</button>
                    </div>
                  </div>

                  <!-- /.box-header -->
                  <!-- centro -->
                  <div class="panel-body table-responsive" id="listado_registros">
                    <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <th>No.</th>
                        <th>Nombre SubMenu</th>
                        <th>Articulo</th>
                        <th>Detalle 1</th>
                        <th>Detalle 2</th>
                        <th>Accion</th>
                      </thead>
                      <tbody>                          
                      </tbody>
                      <tfoot>
                        <th>No.</th>
                        <th>Nombre SubMenu</th>
                        <th>Articulo</th>
                        <th>Detalle 1</th>
                        <th>Detalle 2</th>
                        <th>Accion</th>
                      </tfoot>
                    </table>
                  </div>


                  <div class="panel-body" id="form_registros">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Agregar Nivel 2 Sub-Menu</strong>
                      </div>
                      <div class="panel-body">
                        
                        <form id="form_create_update" name="form_create_update" method="POST">

                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label for="codsubmenu">SubMenu</label>
                              <div class="input-group">
                                <span class="input-group-addon"><i></i></span>
                                <input type="text" name="idsubsubmenu" id="idsubsubmenu" style="display: none;">
                                <select class="form-control selectpicker" data-live-search="true" name="codsubmenu" id="codsubmenu" required>
                                </select>
                              </div>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label for="codarticulo">Nombre Articulo</label>
                              <div class="input-group">
                                <span class="input-group-addon"><i></i></span>
                                <select class="form-control selectpicker" data-live-search="true" name="codarticulo" id="codarticulo" required>
                                </select>
                              </div>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label for="detalle1">Detalle 1</label>
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input type="text" class="form-control" name="detalle1" id="detalle1" maxlength="50" placeholder="Nombre de Puesto" required>
                              </div>
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label for="detalle2">Detalle 2</label>
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input type="text" class="form-control" name="detalle2" id="detalle2" maxlength="50" placeholder="Nombre de Puesto" required>
                              </div>
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

                  <div class="panel-body table-responsive" id="listado_registrosaux">
                    <table id="tb_listadoaux" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <th>No.</th>
                        <th>Nombre SubMenu</th>
                        <th>Articulo</th>
                        <th>Detalle 1</th>
                        <th>Detalle 2</th>
                        <th>Accion</th>
                      </thead>
                      <tbody>                          
                      </tbody>
                      <tfoot>
                        <th>No.</th>
                        <th>Nombre SubMenu</th>
                        <th>Articulo</th>
                        <th>Detalle 1</th>
                        <th>Detalle 2</th>
                        <th>Accion</th>
                      </tfoot>
                    </table>
                  </div>


                  <div class="panel-body" id="form_registros_edit">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Editar Nivel 2 Sub-Menu</strong>
                      </div>
                      <div class="panel-body">
                        
                        <form id="form_edit" name="form_edit" method="POST">

                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label for="codsubmenu_edit">Codigo Nivel 2 Sub-Menu</label>
                              <div class="input-group">
                                <span class="input-group-addon"><i></i></span>
                                <input type="text" name="idsubsubmenu_edit_id" id="idsubsubmenu_edit_id" style="display: none;">
                                <select class="form-control selectpicker" data-live-search="true" name="codsubmenu_edit" id="codsubmenu_edit" required>
                                </select>
                              </div>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label for="codarticulo_edit">Nombre Articulo</label>
                              <div class="input-group">
                                <span class="input-group-addon"><i></i></span>
                                <select class="form-control selectpicker" data-live-search="true" name="codarticulo_edit" id="codarticulo_edit" required>
                                </select>
                              </div>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label for="detalle1_edit">Detalle 1 Boton</label>
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input type="text" class="form-control" name="detalle1_edit" id="detalle1_edit" maxlength="50" placeholder="Detalle 1 Boton" required>
                              </div>
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label for="detalle2_edit">Detalle 2 Boton</label>
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input type="text" class="form-control" name="detalle2_edit" id="detalle2_edit" maxlength="50" placeholder="Detalle 2 Boton" required>
                              </div>
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
  <script type="text/javascript" src="scripts/subsubmenu.js"></script>
<?php  
  }
  ob_end_flush();
?>