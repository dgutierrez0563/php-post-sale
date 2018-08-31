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
                          <li class="breadcrumb-item active"><strong> Articulos</li></strong>
                        </ol>
                        <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarForm_article(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Articulo</button>
                      </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listado_registros">                      
                      <table id="tb_listado_article" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Codigo</th>
                          <th>Nombre</th>
                          <th>Categoria</th>
                          <th>Stock</th>
                          <th>Detalle</th>
                          <th>Imagen</th>
                          <th>Estado</th>
                          <th>Updated</th>
                          <th>Accion</th>
                        </thead>
                        <tbody>                          
                        </tbody>
                        <tfoot>
                          <th>Codigo</th>
                          <th>Nombre</th>
                          <th>Categoria</th>
                          <th>Stock</th>
                          <th>Detalle</th>
                          <th>Imagen</th>
                          <th>Estado</th>
                          <th>Updated</th>
                          <th>Accion</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="form_registros">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <strong><i class="fa fa-edit"></i> Agregar Articulo</strong>
                        </div>
                        <div class="panel-body">
                          
                          <form id="form_create_update" name="form_create_update" method="POST">

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="nombre">Nombre de articulo</label>
                                <input type="text" name="id_articulo" id="id_articulo" style="display: none;">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre de articulo" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="categoria">Categoria</label>
                                <select class="form-control selectpicker" data-live-search="true" name="id_categoria" id="id_categoria" required>                                  
                                </select>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" min="1" pattern="^[0-9]+" onpaste="return false;" onDrop="return false;" autocomplete=off placeholder="Stock">
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="detalle">Detalle</label>
                                <input type="text" class="form-control" name="detalle" id="detalle" maxlength="100" placeholder="Detalle importante" required>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label" for="imagen">Imagen</label>
                                <input class="form-control" type="file" id="imagen" name="imagen"> <!-- Este es para cargar la imagen -->
                                <input type="hidden" name="imagen_actual" id="imagen_actual"> <!-- Este es para cargar la imagen actual y ocultarla por mientras-->
                                <img src="" width="140px" height="120" id="imagen_auxiliar" style="padding-top: 10px;"> <!-- Este es para cargar la imagen como auxiliar y mostrarla cuando llamamos a editar-->
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="codigo">Codigo</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" maxlength="30" placeholder="Codigo de barras" required>
                                <!-- Genermos el codigo de barras -->
                                <button class="btn btn-success btn-sm" type="button" onclick="getBarCode()">
                                  <i class="fa fa-search"></i> Generar Codigo
                                </button>
                                <!-- Enviamos la accion imprimir -->
                                <button class="btn btn-info btn-sm" type="button" onclick="printCode()">
                                  <i class="fa fa-print"></i> Print Code
                                </button>
                                <!-- Aqui se va a tomar el div para a impresion-->
                                <div id="id_print">
                                  <svg id="bar_code"></svg>
                                </div>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="id_user">ID User</label>
                                <input type="text" class="form-control" name="id_user" id="id_user">
                              </div>

                              <br>
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/articulo1.js"></script>