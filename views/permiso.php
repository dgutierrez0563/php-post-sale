
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
                          <li class="breadcrumb-item active"><strong> Permisos</li></strong>
                        </ol>
                        <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarForm(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Accesos</button>
                      </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listado_registros">
                      <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Nombre</th>
                          <th>Detalle</th>
                          <th>Estado</th>
                          <th>Updated by</th>
                          <th>Updated</th>
                          <th>Accion</th>
                        </thead>
                        <tbody>                          
                        </tbody>
                        <tfoot>
                          <th>Nombre</th>
                          <th>Detalle</th>
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
                          <strong><i class="fa fa-edit"></i> Agregar Accesos</strong>
                        </div>
                        <div class="panel-body">
                          
                          <form id="form_create_update" name="form_create_update" method="POST">

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="nombre">Nombre Acceso</label>
                                <input type="text" name="id_permiso" id="id_permiso" style="display: none;">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre del acceso" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="detalle">Detalle</label>
                                <!-- <textarea type="text" class="form-control" name="detalle" id="detalle" rows="1"></textarea> -->
                                <input type="text" class="form-control" name="detalle" id="detalle" placeholder="Detalle del acceso">
                              </div>
                              
                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="id_user">ID User</label>
                                <input type="text" class="form-control" name="id_user" id="id_user">
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
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
require 'footer.php';
?>
<script type="text/javascript" src="scripts/permiso.js"></script>