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
    if ($_SESSION['mantepuestos']==1) {

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
                    <li class="breadcrumb-item active"><strong> Puesto</li></strong>
                  </ol>
                  <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarFormRegistro(true)">
                    <i class="fa fa-plus-circle"></i>  Agregar Puesto</button>
                </div>
              </div>

              <!-- centro -->
              <div class="panel-body table-responsive" id="listado_registros">
                <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <th>COD</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Estado</th>                       
                    <th>Accion</th>
                  </thead>
                  <tbody>
                    <td class="center-block"></td>
                  </tbody>
                  <tfoot>
                    <th>COD</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Estado</th>                       
                    <th>Accion</th>
                  </tfoot>
                </table>
              </div>

              <div class="panel-body" id="form_registros">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <strong><i class="fa fa-edit"></i> Agregar nuevo puesto</strong>
                  </div>
                  <div class="panel-body">
                    <br>
                    <form id="form_create" name="form_create" method="POST">                        

                      <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label for="codpuesto">Codigo de Puesto</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i><strong>#</strong></i></span>
                          <input type="text" name="codpuesto_id" id="codpuesto_id" style="display: none;">
                          <input type="text" class="form-control" name="codpuesto" id="codpuesto" maxlength="8" pattern="{9-0}" placeholder="Codigo de Puesto" title="Solo se permiten numeros del 0-9" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label for="nombre">Nombre de Puesto</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-building"></i></span>
                          <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre de Puesto" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label for="coddepartamento">Departamento</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-building"></i></span>
                          <select class="form-control selectpicker" data-live-search="true" name="coddepartamento" id="coddepartamento" required>
                          </select>
                        </div>
                      </div>

                      <br>
                      <br>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit" id="btn_save"><i class="fa fa-save"></i> Guardar</button>
                        <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
                      </div>
                    </form>
                  </div>
                </div>                      
              </div>
              <!--Fin centro -->

              <div class="panel-body" id="form_registros_edit">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <strong><i class="fa fa-edit"></i> Editar Datos de Puesto</strong>
                  </div>
                  <div class="panel-body">
                    <br>
                    <form id="form_edit" name="form_edit" method="POST">
                        
                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="codpuesto_edit">Codigo de Puesto</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i><strong>#</strong></i></span>
                            <input type="text" name="codpuesto_id_edit" id="codpuesto_id_edit" style="display: none;">
                            <input type="text" class="form-control" name="codpuesto_edit" id="codpuesto_edit" maxlength="8" pattern="[9-0]" placeholder="Codigo de categoria" required>
                          </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="nombre_edit">Nombre de Puesto</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                            <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" maxlength="50" placeholder="Nombre de Puesto" required>
                          </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="coddepartamento_edit">Departamento</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-building"></i></span>
                            <select class="form-control selectpicker" data-live-search="true" name="coddepartamento_edit" id="coddepartamento_edit" required>
                            </select>
                          </div>
                        </div>

                        <br>
                        <br>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btn_edit"><i class="fa fa-save"></i> Guardar</button>
                          <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
                        </div>
                    </form>
                  </div>
                </div>                      
              </div>
              <!--Fin centro -->

              <div class="panel-body" id="form_detalle">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <strong><i class="fa fa-edit"></i> Detalle de Puesto</strong>
                  </div>
                  <div class="panel-body">
                    
                    <form id="form_detalle_2" name="form_detalle_2">

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label for="codpuesto_p">Codigo de Puesto</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i><strong>#</strong></i></span>
                            <input type="text" name="codpuesto_id_p" id="codpuesto_id_p" style="display: none;">
                            <input type="text" class="form-control" name="codpuesto_p" id="codpuesto_p" placeholder="Codigo de categoria" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label for="nombre_p">Nombre de Puesto</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                            <input type="text" class="form-control" name="nombre_p" id="nombre_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label for="departamento_p">Departamento</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                            <input type="text" class="form-control" name="departamento_p" id="departamento_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label for="estado_p">Estado</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-exclamation-triangle"></i></span>
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
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" name="created_at_p" id="created_at_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label for="updated_at_p">Actualizado en</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" name="updated_at_p" id="updated_at_p" readonly>
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
  <script type="text/javascript" src="scripts/puesto_v2.js"></script>
<?php  
  }
  ob_end_flush();
?>