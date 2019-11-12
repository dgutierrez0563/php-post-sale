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
    if ($_SESSION['mantesupplier']==1) {
      
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
                    <li class="breadcrumb-item active"><strong> Proveedor</li></strong>
                  </ol>
                  <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarForm(true)">
                    <i class="fa fa-plus-circle"></i>  Agregar Proveedor
                  </button>
                </div>
              </div>
              <!-- /.box-header -->

            <!-- centro -->
              <div class="panel-body table-responsive" id="listado_registros">
                <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <th>COD</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    <th>Updated</th>                          
                    <th>Accion</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>COD</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    <th>Updated</th>                          
                    <th>Accion</th>
                  </tfoot>
                </table>
              </div>

              <div class="panel-body" id="form_registros">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <strong><i class="fa fa-edit"></i> Agregar Proveedor</strong>
                  </div>
                  <div class="panel-body">
                    <form id="form_create_update" name="form_create_update" method="POST">

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="codproveedor">Codigo de Proveedor</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i><strong>#</strong></i></span>
                          <input type="text" class="form-control" name="codproveedor" id="codproveedor" maxlength="8" pattern="[9-0]{8}" placeholder="Codigo de proveedor" title="Solo se permiten numeros del 0-9" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="nombre">Nombre del Proveedor</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                          <input type="text" class="form-control" name="nombre" id="nombre" maxlength="70" placeholder="Nombre de proveedor" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="tipo_documento">Tipo de Documento</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                          <select class="form-control selectpicker" data-live-search="true" name="tipo_documento" id="tipo_documento" pattern="Cedula Fisica|Cedula Juridica|Pasaporte" placeholder="Tipo de Documento" required>
                            <option value="Cedula Fisica">Cedula Fisica</option>
                            <option value="Cedula Juridica">Cedula Juridica</option>
                            <option value="Pasaporte">Pasaporte</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="numero_documento">Numero de Documento</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                          <input type="text" class="form-control" name="numero_documento" id="numero_documento" maxlength="20" pattern="[9-0]{20}" placeholder="Numero de Documento" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="telefono">Telefono</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                          <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" pattern="[9-0]{20}" placeholder="Telefono" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="correo">Correo</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                          <input type="email" class="form-control" name="correo" id="correo" maxlength="40" placeholder="Correo electronico" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="direccion">Direccion</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-book" aria-hidden="true"></i></span>
                          <input type="text" class="form-control" name="direccion" id="direccion" maxlength="50" placeholder="Direccion" required>
                        </div>
                      </div>

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
                    <strong><i class="fa fa-edit"></i> Editar Datos de Proveedor</strong>
                  </div>
                  <div class="panel-body">
                    <br>
                    <form id="form_edit" name="form_edit" method="POST">
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="codproveedor_edit">Codigo de Proveedor</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i><strong>#</strong></i></span>
                          <input type="text" name="codproveedor_id_edit" id="codproveedor_id_edit" style="display: none;">
                          <input type="text" class="form-control" name="codproveedor_edit" id="codproveedor_edit" maxlength="8" pattern="[9-0]{8}" placeholder="Codigo de proveedor" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="nombre_edit">Nombre del Proveedor</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                          <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" maxlength="70" placeholder="Nombre de proveedor" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="tipo_documento_edit">Tipo de Documento</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                          <select class="form-control selectpicker" data-live-search="true" name="tipo_documento_edit" id="tipo_documento_edit" pattern="Cedula Fisica|Cedula Juridica|Pasaporte" placeholder="Tipo de Documento" required>
                            <option value="Cedula Fisica">Cedula Fisica</option>
                            <option value="Cedula Juridica">Cedula Juridica</option>
                            <option value="Pasaporte">Pasaporte</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="numero_documento_edit">Numero de Documento</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                          <input type="text" class="form-control" name="numero_documento_edit" id="numero_documento_edit" maxlength="20" pattern="[9-0]{20}" placeholder="Numero de Documento" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="telefono_edit">Telefono</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                          <input type="text" class="form-control" name="telefono_edit" id="telefono_edit" maxlength="20" pattern="[9-0]{20}" placeholder="Telefono" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="correo_edit">Correo</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                          <input type="email" class="form-control" name="correo_edit" id="correo_edit" maxlength="40" placeholder="Detalle importante" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="direccion_edit">Direccion</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                          <input type="text" class="form-control" name="direccion_edit" id="direccion_edit" maxlength="50" placeholder="Direccion" required>
                        </div>
                      </div>

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
                    <strong><i class="fa fa-edit"></i> Detalle del Proveedor</strong>
                  </div>
                  <div class="panel-body">
                    
                    <form id="form_detalle_2" name="form_detalle_2">

                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="codproveedor_p">Codigo de Proveedor</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i><strong>#</strong></i></span>
                          <input type="text" name="codproveedor_id_p" id="codproveedor_id_p" style="display: none;">
                          <input type="text" class="form-control" name="codproveedor_p" id="codproveedor_p" readonly>
                        </div>
                      </div>

                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="nombre_p">Nombre de Proveedor</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                          <input type="text" class="form-control" name="nombre_p" id="nombre_p" readonly>
                        </div>
                      </div>

                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="tipo_documento_p">Tipo de Documento</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                          <input type="text" class="form-control" name="tipo_documento_p" id="tipo_documento_p" readonly>
                        </div>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="numero_documento_p">Numero de Documento</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                          <input type="text" class="form-control" name="numero_documento_p" id="numero_documento_p" readonly>
                        </div>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="telefono_p">Telefono</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                          <input type="text" class="form-control" name="telefono_p" id="telefono_p" readonly>
                        </div>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="correo_p">Correo</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                          <input type="text" class="form-control" name="correo_p" id="correo_p" readonly>
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

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="direccion_p">Direccion</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                          <input type="text" class="form-control" name="direccion_p" id="direccion_p" readonly>
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
  <script type="text/javascript" src="scripts/proveedor.js"></script>
<?php  
  }
  ob_end_flush();
?>