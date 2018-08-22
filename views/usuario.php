

<?php
require 'header.php';
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
                          <li class="breadcrumb-item active"><strong> Usuarios</li></strong>
                        </ol>
                        <button class="btn btn-success pull-right" onclick="mostrarForm(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Usuario</button>
                      </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listado_registros">
                      <br><br>
                      <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Nombre</th>
                          <th>Tipo Documento</th>
                          <th>Numero Documento</th>
                          <th>Direccion</th>
                          <th>Telefono</th>
                          <th>Correo</th>
                          <th>Puesto</th>
                          <th>Role</th>
                          <th>UserName</th>
                          <th>Estado</th>
                          <th>Updated</th>                          
                          <th>Accion</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Nombre</th>
                          <th>Tipo Documento</th>
                          <th>Numero Documento</th>
                          <th>Direccion</th>
                          <th>Telefono</th>
                          <th>Correo</th>
                          <th>Puesto</th>
                          <th>Role</th>
                          <th>UserName</th>
                          <th>Estado</th>
                          <th>Updated</th>                          
                          <th>Accion</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" style="height: 620px;" id="form_registros">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <strong><i class="fa fa-edit"></i> Agregar Usuario</strong>
                        </div>
                        <div class="panel-body">
                          <form id="form_create_update" name="form_create_update" method="POST">

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="nombre">Nombre Completo</label>
                                <input type="text" name="id_usuario" id="id_usuario" style="display: none;">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="70" placeholder="Nombre completo" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="tipo_documento">Tipo de Documento</label>
                                <select class="form-control" name="tipo_documento" id="tipo_documento" placeholder="Tipo de Documento" required>
                                  <option value="1">Cedula Fisica</option>
                                  <option value="2">Cedula Juridica</option>
                                  <option value="3">Pasaporte</option>
                                </select>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="numero_documento">Numero de Documento</label>
                                <input type="text" class="form-control" name="numero_documento" id="numero_documento" maxlength="30" placeholder="Numero de Documento" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="id_puesto">Puesto</label>
                                <select class="form-control selectpicker" data-live-search="true" name="id_puesto" id="id_puesto" required>
                                  
                                </select>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="id_role">Role</label>
                                <select class="form-control selectpicker" data-live-search="true" name="id_role" id="id_role" required>
                                  
                                </select>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Telefono" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="correo">Correo</label>
                                <input type="text" class="form-control" name="correo" id="correo" maxlength="40" placeholder="Correo" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" maxlength="50" placeholder="Direccion" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="nombre_usuario">Nombre Usuario</label>
                                <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" maxlength="40" placeholder="Correo" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="contrasenia">Contrasenia</label>
                                <input type="text" class="form-control" name="contrasenia" id="contrasenia" maxlength="50" placeholder="Direccion" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="id_user">ID User</label>
                                <input type="text" class="form-control" name="id_user" id="id_user">
                              </div>

                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <br>
                                <button class="btn btn-primary" type="submit" id="btn_save"><i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
                              </div>
                            
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
require 'footer.php';
?>
<script type="text/javascript" src="scripts/usuario.js"></script>