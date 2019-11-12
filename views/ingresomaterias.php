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
    if ($_SESSION['consulcompras']==1) {
      
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
                    <li class="breadcrumb-item active"><strong> Ingreso Materias</li></strong>
                  </ol>
                  <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarForm(true)">
                    <i class="fa fa-plus-circle"></i>  Agregar Ingresos
                  </button>
                </div>
              </div>
              <!-- /.box-header -->

            <!-- centro -->
              <div class="panel-body table-responsive" id="listado_registros">
                <table id="tb_listado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Tipo Comprobante</th>
                    <th>Serie Comprobante</th>
                    <th>Numero Comprobante</th>
                    <th>Total Compra</th>
                    <th>Estado</th>
                    <th>Updated By</th>                          
                    <th>Accion</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Tipo Comprobante</th>
                    <th>Serie Comprobante</th>
                    <th>Numero Comprobante</th>
                    <th>Total Compra</th>
                    <th>Estado</th>
                    <th>Updated By</th>                          
                    <th>Accion</th>
                  </tfoot>
                </table>
              </div>

              <div class="panel-body" id="form_registros">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <strong><i class="fa fa-edit"></i> Agregar Factura-Detalles</strong>
                  </div>
                  <div class="panel-body">
                    <form id="form_create_update" name="form_create_update" method="POST">

                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="codproveedor">Proveedor</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>
                          <input type="text" name="codingreso" id="codingreso" style="display: none;">
                          <input type="text" name="proveedor_aux" id="proveedor_aux" readonly>
                          <select class="form-control selectpicker" data-live-search="true" name="codproveedor" id="codproveedor" required></select>
                        </div>
                      </div>

                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="fechahora">Fecha</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="text" name="fechahora_aux" id="fechahora_aux" readonly>
                          <input type="date" class="form-control" name="fechahora" id="fechahora" placeholder="Fecha Factura" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="tipo_comprobante">Tipo Comprobante</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                          <input type="text" name="tipo_comprobante_aux" id="tipo_comprobante_aux" readonly>
                          <select class="form-control selectpicker" data-live-search="true" name="tipo_comprobante" id="tipo_comprobante" pattern="Boleta|Factura|Ticket" placeholder="Tipo Comprobante" required>
                            <option value="Boleta">Boleta</option>
                            <option value="Factura">Factura</option>
                            <option value="Ticket">Ticket</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label for="seriecomprobante">Serie</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                          <input type="text" name="seriecomprobante_aux" id="seriecomprobante_aux" readonly>
                          <input type="text" class="form-control" name="seriecomprobante" id="seriecomprobante" maxlength="7" placeholder="Serie" required>
                        </div>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="numerocomprobante">Numero Comprobante</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                          <input type="text" name="numerocomprobante_aux" id="numerocomprobante_aux" readonly>
                          <input type="text" class="form-control" name="numerocomprobante" id="numerocomprobante" maxlength="20" placeholder="Numero Comprobante" required>
                        </div>
                      </div>
                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="impuesto">Impueto de Compra</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                          <input type="text" name="impuesto_aux" id="impuesto_aux" readonly>
                          <input type="text" class="form-control" name="impuesto" id="impuesto" maxlength="70" placeholder="Impuesto de Compra" readonly>
                        </div>
                        <br>
                      </div>
                      
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="align-content: right;">
                        <a data-toggle="modal" href="#myModal">
                          <button id="btn_add_atributos" type="button" class="btn btn-primary">
                            <span class="fa fa-plus-circle"> Agregar Articulos</span>
                          </button>
                        </a>
                        <br>
                      </div>
                      
                      <!-- Modal para rellenar los articulos por factura a ingresar. Table rellena detalles -->
                      <div class="col-lg-12 col-md-12 col-sm-12 col-lg-12">
                        <table id="tdetalleingresos" class="table table-primary table-striped table-bordered table-condensed table-hover">
                          <thead style="background-color: #bce8f1;">
                            <th>Accion</th>
                            <th>Articulo</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Subtotal</th>
                          </thead>
                          <tfoot>
                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="border-bottom: double;">
                              <strong><h4 id="total">₡. 0.00</h4><input type="hidden" name="totalcompra" id="totalcompra"></strong>
                            </th>
                          </tfoot>
                          <tbody>

                          </tbody>
                        </table>    
                      </div>

                      <br>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <br>
                        <button class="btn btn-primary" type="submit" id="btn_save"><i class="fa fa-save"></i> Guardar</button>
                        <button id="btn_cancelar" class="btn btn-warning" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-left"></i> Cancelar</button>
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

    <!-- div MODAL -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-LabeLLedby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #bce8f1;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-search"><strong> Seleccione el Articulo</strong></i></h4>
          </div>
          <div class="model-body">
            <table id="tb_listadoarticulosmodal" class="table table-info table-striped table-bordered table-condensed table-hover" style="width: auto;">
              <thead style="background-color: #E5E5E5;">
                <th>Cod.</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Image</th>
                <th>Action</th>
              </thead>
              <tbody>
                
              </tbody>
              <tfoot style="background-color: #E5E5E5;">
                <th>Cod.</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Image</th>
                <th>Action</th>
              </tfoot>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times-circle"> Cerrar</i></button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN div MODAL -->

<?php
  } else {
    require 'noaccess.php';
  }
  require 'footer.php';
?>
  <script type="text/javascript" src="scripts/ingresomaterias.js"></script>
<?php  
  }
  ob_end_flush();
?>