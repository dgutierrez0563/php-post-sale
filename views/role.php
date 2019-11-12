
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
                        <button id="btn_agregar" class="btn btn-success " onclick="mostrarForm(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Role
                        </button>
                        <button id="btn_agregar_accesos" class="btn btn-primary " onclick="mostrarFormAccesos(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Accesos
                        </button>
                      </div>
<!--                       <div class="btn-group pull-right">
                        <button id="btn_agregar_accesos" class="btn btn-primary pull-right" onclick="mostrarFormAccesos(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Accesos
                        </button>
                      </div> -->
                    </div>
                  </div>

                  <!-- /.box-header -->
                  <!-- centro -->
                  <div class="panel-body table-responsive" id="listado_registros">
                    <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <th>Cod.</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Updated by</th>
                        <th>Updated</th>
                        <th>Accion</th>
                      </thead>
                      <tbody>                          
                      </tbody>
                      <tfoot>
                        <th>Cod.</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Updated by</th>
                        <th>Updated</th>
                        <th>Accion</th>
                      </tfoot>
                    </table>
                  </div>
                  <div class="panel-body" id="form_registros">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Agregar Role</strong>
                      </div>
                      <div class="panel-body">
                        
                        <form id="form_create_update" name="form_create_update" method="POST">

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="codrole">Codigo Role</label>
                            <input type="text" name="id_role" id="id_role" style="display: none;">
                            <input type="text" class="form-control" name="codrole" id="codrole" maxlength="5" placeholder="Codigo rol" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="nombre">Nombre del Role</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre del rol" required>
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


                  <div class="panel-body" id="form_detalle">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Detalle del Role</strong>
                      </div>
                      <div class="panel-body">
                        
                        <form id="form_detalle_2" name="form_detalle_2">

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="codrole_p">Codigo de Role</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i><strong>#</strong></i></span>
                              <input type="text" name="codrole_id_p" id="codrole_id_p" style="display: none;">
                              <input type="text" class="form-control" name="codrole_p" id="codrole_p" readonly>
                            </div>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="nombre_p">Nombre de Role</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                              <input type="text" class="form-control" name="nombre_p" id="nombre_p" readonly>
                            </div>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="estado_p">Estado</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                              <input type="text" class="form-control" name="estado_p" id="estado_p" readonly>
                            </div>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="updated_by_p">Actualizado por</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="text" class="form-control" name="updated_by_p" id="updated_by_p" readonly>
                            </div>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="created_at_p">Creado en</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                              <input type="text" class="form-control" name="created_at_p" id="created_at_p" readonly>
                            </div>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="updated_at_p">Actualizado en</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                              <input type="text" class="form-control" name="updated_at_p" id="updated_at_p" readonly>
                            </div>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
                          </div>
                          <!-- </div> -->
                        </form>
                      </div>
                    </div>                      
                  </div>
                  <!--Fin centro -->

                  <div class="panel-body" id="form_asignacion_accesos">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Asignacion de Accesos</strong>
                      </div>
                      <div class="panel-body">
                        
                        <form id="form_create_update_accesos" name="form_create_update_accesos" method="POST">

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="id_role_asignacion">Role</label>
                              <select class="form-control selectpicker" data-live-search="true" name="id_role_asignacion" id="id_role_asignacion" required>
                              </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="id_permiso">Permisos</label>
                              <select class="form-control selectpicker" data-live-search="true" name="id_permiso" id="id_permiso" required>
                              </select>
                              <br>
                              <button class="btn btn-primary btn-sm" type="submit" id="btn_save_accesos">
                                <i class="fa fa-plus" style="font-size: 12px;"></i>  Agregar Atributo
                              </button>
                            </div>
                            <br>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <br>
                              <button class="btn btn-primary" type="submit" id="btn_save_accesos"><i class="fa fa-save"></i> Guardar</button>
                              <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
                            </div>
                          <!-- </div> -->
                        </form>
                      </div>
                    </div>                      
                  </div>
                  <!--Fin centro -->


                  <div class="panel-body" id="form_listado_role_acceso" style="display: none;">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <strong><i class="fa fa-edit"></i> Listado de Accesos del Role</strong>
                      </div>
                      <div class="panel-body">
                        
                        <form id="form_view_listado_role_acceso" name="form_view_listado_role_acceso" method="POST">

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="id_role_seleccionado">Role</label>
                              <select class="form-control selectpicker" data-live-search="true" name="id_role_seleccionado" id="id_role_seleccionado" required>
                              </select>
                            </div>

                            <br>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <br>
                              <button class="btn btn-success" type="submit" id="btn_search_role_acceso"><i class="fa fa-search"></i> Search</button>
                              <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
                            </div>
                          <!-- </div> -->
                        </form>
                      </div>
                    </div>                      
                  </div>
                  <!--Fin centro -->

                  <div class="panel-body table-responsive" id="listado_roles_permisos">
                    <table id="tblistadopermisorole" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <th>No.</th>
                        <th>Cod Permiso</th>
                        <th>Nombre Permiso</th>
                        <th>Updated</th>
                        <th>Accion</th>
                      </thead>
                      <tbody>                          
                      </tbody>
                      <tfoot>
                        <th>No.</th>
                        <th>Cod Permiso</th>
                        <th>Nombre Permiso</th>
                        <th>Updated</th>
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
  <script type="text/javascript" src="scripts/role.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<?php  
  }
  ob_end_flush();
?>