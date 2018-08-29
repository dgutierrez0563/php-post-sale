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
                          <li class="breadcrumb-item active"><strong> Inventario</li></strong>
                        </ol>
<!--                         <button class="btn btn-success pull-right" onclick="mostrarForm_inventario(true)">
                          <i class="fa fa-plus-circle"></i>  Agregar Stock</button> -->
                      </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listado_registros">
                      <table id="tb_listado_inventario" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Codigo</th>
                          <th>Producto</th>
                          <th>Stock</th>
                          <th>Estado</th>                          
                          <th>Accion</th>
                        </thead>
                        <tbody>
                          <td style="text-align: center;"></td>
                        </tbody>
                        <tfoot>
                          <th>Codigo</th>
                          <th>Producto</th>
                          <th>Stock</th>
                          <th>Estado</th>                          
                          <th>Accion</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" style="height: 430px;" id="form_registros">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <strong><i class="fa fa-edit"></i> Agregar Stock a Productos</strong>
                        </div>
                        <div class="panel-body">
                          <br>
                          <form id="form_create_update" name="form_create_update" method="POST">                        
                            <!-- <div class="form-horizontal col-lg-6 col-md-6 col-sm-6 col-xs-12"> -->
                              
                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="codigo">Codigo</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" maxlength="20" placeholder="Codigo de articulo" readonly>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="nombre">Nombre de articulo</label>
                                <!-- <input type="hidden" name="id_categoria" id="id_categoria"> -->
                                <input type="text" name="id_articulo" id="id_articulo" style="display: none;">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre de articulo" readonly>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="detalle">Opcion</label>
                                <select name="transaccion" id="transaccion" class="form-control">
                                  <option class="active" value="1">Entradas</option>
                                  <option value="2">Salidas</option>  
                                </select>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="stock">Stock</label>
                                <div class="input-group">
                                  <span class="input-group-addon">U.</span>
                                  <input type="number" class="form-control" name="stock" id="stock" min="0" placeholder="Stock" readonly>
                                </div>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="qty">Cantidad</label>
                                <div class="input-group">
                                  <span class="input-group-addon">U.</span>
                                  <input type="number" class="form-control" name="qty" id="qty" min="1" pattern="^[0-9]+" onpaste="return false;" onDrop="return false;" autocomplete=off placeholder="Cantidad">
                                </div>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="total">Total</label>
                                <div class="input-group">
                                  <span class="input-group-addon">U.</span>
                                  <input type="number" class="form-control" name="total" id="total" min="1" pattern="^[0-9]+" onpaste="return false;" onDrop="return false;" readonly>
                                </div>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <!-- <label for="id_user">ID User</label> -->
                                <input type="text" class="form-control" name="id_user" id="id_user" style="display: none;">
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
<script type="text/javascript" src="scripts/inventario.js"></script>