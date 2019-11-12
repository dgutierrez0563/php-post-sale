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
    if ($_SESSION['mantarticles']==1) {

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
                      <th>COD</th>
                      <th>Nombre</th>
                      <th>Categoria</th>
                      <th>Precio</th>
                      <th>Imagen</th>
                      <th>Estado</th>
                      <th>Action</th>
                    </thead>
                    <tbody>                          
                    </tbody>
                    <tfoot>
                      <th>COD</th>
                      <th>Nombre</th>
                      <th>Categoria</th>
                      <th>Precio</th>
                      <th>Imagen</th>
                      <th>Estado</th>
                      <th>Action</th>
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
                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="codarticulo">Codigo de articulo</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i><strong>#</strong></i></span>
                            <input type="text" name="cod_id_articulo" id="cod_id_articulo" style="display: none;">
                            <input type="text" class="form-control" name="codarticulo" id="codarticulo" maxlength="50" placeholder="Codigo de articulo" required>
                          </div>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="nombre">Nombre de articulo</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre de articulo" required>
                          </div>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="precio">Precio</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="number" class="form-control" name="precio" id="precio" maxlength="15" placeholder="Precio Preventa" required>
                          </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="codigo">Codigo Barras</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input type="text" class="form-control" name="codigo" id="codigo" maxlength="30" placeholder="Codigo de barras" required>
                          </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="categoria">Categoria</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                            <select class="form-control selectpicker" data-live-search="true" name="id_categoria" id="id_categoria" required></select>
                          </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label" for="imagen">Imagen</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-photo"></i></span>
                            <input class="form-control" type="file" id="imagen" name="imagen"> <!-- Este es para cargar la imagen -->
                            <input type="hidden" name="imagen_actual" id="imagen_actual"> <!-- Este es para cargar la imagen actual y ocultarla por mientras-->
                          </div>
                          <img src="" width="70px" height="70px" id="imagen_auxiliar" style="padding-top: 10px;"> <!-- Este es para cargar la imagen como auxiliar y mostrarla cuando llamamos a editar-->
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="detalle">Detalle</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                            <input type="text" class="form-control" name="detalle" id="detalle" maxlength="100" placeholder="Detalle importante" required>
                          </div>
                        </div>
                        <hr>

  <!--                         <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="">Codigo de Barras</label> -->
                          <!-- Genermos el codigo de barras -->
  <!--                           <div>
                            <button class="btn btn-success btn-sm" type="button" onclick="getBarCode()">
                              <i class="fa fa-search"></i> Generar Codigo
                            </button> -->
                            <!-- Enviamos la accion imprimir -->
  <!--                             <button class="btn btn-info btn-sm" type="button" onclick="printCode()">
                              <i class="fa fa-print"></i> Print Code
                            </button> -->
                            <!-- Aqui se va a tomar el div para a impresion-->
  <!--                             <div id="id_print">
                              <svg id="bar_code"></svg>
                            </div>
                          </div>
                        </div> -->
                        

  <!--                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="id_user">ID User</label>
                          <input type="text" class="form-control" name="id_user" id="id_user">
                        </div> -->

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

                <div class="panel-body" id="form_detalle">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <strong><i class="fa fa-edit"></i> Detalle del Articulo</strong>
                    </div>
                    <div class="panel-body">
                      
                      <form id="form_detalle_articulo" name="form_detalle_articulo">
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="codigoarticulo_p">Codigo de articulo</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i><strong>#</strong></i></span>
                            <input type="text" name="cod_id_articulo_p" id="cod_id_articulo_p" style="display: none;">
                            <input type="text" class="form-control" name="codigoarticulo_p" id="codigoarticulo_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="nombre_p">Nombre de articulo</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                            <input type="text" class="form-control" name="nombre_p" id="nombre_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="categoria_p">Categoria</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                            <input type="text" class="form-control" name="categoria_p" id="categoria_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="precio_p">Precio</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control" name="precio_p" id="precio_p" maxlength="15" readonly>
                          </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="codigo_p">Codigo Barras</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input type="text" class="form-control" name="codigo_p" id="codigo_p" readonly>
                          </div>
                        </div>
                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="estado_p">Estado</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-exclamation-triangle"></i></span>
                            <input type="text" class="form-control" name="estado_p" id="estado_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="updated_by_p">Actualizado por</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="updated_by_p" id="updated_by_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="created_at_p">Creado en</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" name="created_at_p" id="created_at_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="updated_at_p">Actualizado en</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" name="updated_at_p" id="updated_at_p" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="detalle_p">Detalle</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                            <input type="text" class="form-control" name="detalle_p" id="detalle_p" readonly>
                          </div>
                        </div>

  <!--                         <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                          <label for="codigo_p">Codigo</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input type="text" class="form-control" name="codigo_p" id="codigo_p" readonly>
                          </div>
                          <div id="id_print_p">
                            <svg id="bar_code_p"></svg>
                          </div>
                        </div> -->
                        
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label class="control-label" for="imagen_auxiliar_p">Imagen</label><br>
  <!--                           <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-photo"></i></span>
                            <input type="hidden" name="imagen_actual_p" id="imagen_actual_p" readonly>
                          </div> -->
                          <img width="70px" height="70px" id="imagen_auxiliar_p">
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Regresar</button>
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
  } else {
    require 'noaccess.php';
  }

  require 'footer.php';
?>
  <script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
  <script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
  <script type="text/javascript" src="scripts/articulo_v2.js"></script>
<?php 
  }
  ob_end_flush();
?>