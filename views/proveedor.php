
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
                              <strong><a href="#"><span class="fa fa-home"> </span> Dashboard</a></strong>
                          </li>
                          <li class="breadcrumb-item active"><strong> Proveedor</li></strong>
                        </ol>
                        <button class="btn btn-success pull-right" onclick="mostrarForm(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar</button>
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
                          <th>Estado</th>
                          <th>Updated</th>                          
                          <th>Accion</th>
                        </thead>
                        <tbody>
                          <td class="center-block"></td>
                        </tbody>
                        <tfoot>
                          <th>Nombre</th>
                          <th>Tipo Documento</th>
                          <th>Numero Documento</th>
                          <th>Direccion</th>
                          <th>Telefono</th>
                          <th>Correo</th>
                          <th>Estado</th>
                          <th>Updated</th>                          
                          <th>Accion</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="form_registros">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <strong><i class="fa fa-edit"></i> Agregar Articulo</strong>
                        </div>
                        <div class="panel-body">
                          <br>
                          <form id="form_create_update" name="form_create_update" method="POST">                        
                            <div class="form-horizontal col-lg-6 col-md-6 col-sm-6 col-xs-12">

                              <div class="form-group">
                                <label for="codigo">Codigo</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" maxlength="20" placeholder="Codigo de articulo" required>
                              </div>

                              <div class="form-group">
                                <label for="nombre">Nombre de articulo</label>
                                <!-- <input type="hidden" name="id_categoria" id="id_categoria"> -->
                                <input type="text" name="id_articulo" id="id_articulo" style="display: none;">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre de departamento" required>
                              </div>

                              <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <!-- <input type="hidden" name="id_categoria" id="id_categoria"> -->
                                <input type="text" name="id_categoria" id="id_categoria" style="display: none;">
                                <input type="text" class="form-control" name="categoria" id="categoria" maxlength="50" placeholder="Nombre de departamento" required>
                              </div>

                              <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="text" class="form-control" name="stock" id="stock" maxlength="50" placeholder="Nombre de departamento" required>
                              </div>

                              <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <input type="text" class="form-control" name="detalle" id="detalle" maxlength="100" placeholder="Detalle importante" required>
                              </div>

                              <div class="form-group">
                                <label for="id_user">ID User</label>
                                <input type="text" class="form-control" name="id_user" id="id_user">
                              </div>

                              <br>
                              <br>
                              <div class="form-group">
                                <button class="btn btn-primary" type="submit" id="btn_save"><i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
                              </div>
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
<script type="text/javascript" src="scripts/articulo.js"></script>