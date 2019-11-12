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
    if ($_SESSION['mantecategorties']==1) {
      
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
                    <li class="breadcrumb-item active"><strong> Categorias</li></strong>
                  </ol>
                  <button id="btn_agregar" class="btn btn-success pull-right" onclick="mostrarFormCategoriaRegistro(true)">
                    <i class="fa fa-plus-circle"></i>  Agregar Categoria</button>
                </div>
              </div>

              <!-- centro -->
              <div class="panel-body table-responsive" id="listado_registros_categoria">
                <table id="tb_listado_categoria" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <th>COD</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Estado</th>
                    <th>Updated</th>                          
                    <th>Accion</th>
                  </thead>
                  <tbody>
                    <td class="center-block"></td>
                  </tbody>
                  <tfoot>
                    <th>COD</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Estado</th>
                    <th>Updated</th>
                    <th>Accion</th>
                  </tfoot>
                </table>
              </div>

              <div class="panel-body" id="form_registros_categoria">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <strong><i class="fa fa-edit"></i> Agregar nueva categoria</strong>
                  </div>
                  <div class="panel-body">
                    <br>
                    <form id="form_create_categoria" name="form_create_categoria" method="POST">                        
                      <!-- <div class="form-horizontal col-lg-6 col-md-6 col-sm-6 col-xs-12">                       -->
                      
                      <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label for="codcategoria">Codigo de Categoria</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i><strong>#</strong></i></span>
                          <!-- <input type="text" name="codcategoria_id" id="codcategoria_id" style="display: none;"> -->
                          <input type="text" class="form-control" name="codcategoria" id="codcategoria" maxlength="8" pattern="{9-0}" placeholder="Codigo de categoria" title="Solo se permiten numeros del 0-9" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label for="nombre">Nombre de Categoria</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-building"></i></span>
                          <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre de categoria" required>
                        </div>
                      </div>

                      <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <label for="detalle">Detalle</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                          <input type="text" class="form-control" name="detalle" id="detalle" maxlength="100" placeholder="Detalle importante" required>
                        </div>
                      </div>

  <!--                     <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" name="id_user" id="id_user">
                      </div> -->

                      <br>
                      <br>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" type="submit" id="btn_save_categoria"><i class="fa fa-save"></i> Guardar</button>
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
                    <strong><i class="fa fa-edit"></i> Editar Datos de Categoria</strong>
                  </div>
                  <div class="panel-body">
                    <br>
                    <form id="form_edit" name="form_edit" method="POST">
                        
                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="codcategoria_edit">Codigo de Categoria</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i><strong>#</strong></i></span>
                            <input type="text" name="codcategoria_id_edit" id="codcategoria_id_edit" style="display: none;">
                            <input type="text" class="form-control" name="codcategoria_edit" id="codcategoria_edit" maxlength="8" pattern="[9-0]" placeholder="Codigo de categoria" required>
                          </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                          <label for="nombre_edit">Nombre de Categoria</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-building"></i></span>
                            <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" maxlength="50" placeholder="Nombre de categoria" required>
                          </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                          <label for="detalle_edit">Detalle</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                            <input type="text" class="form-control" name="detalle_edit" id="detalle_edit" maxlength="100" placeholder="Detalle importante" required>
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
                    <strong><i class="fa fa-edit"></i> Detalle de Categoria</strong>
                  </div>
                  <div class="panel-body">
                    
                    <form id="form_detalle_2" name="form_detalle_2">

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label for="nombre_p">Codigo de Categoria</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i><strong>#</strong></i></span>
                            <input type="text" name="codcategoria_id_p" id="codcategoria_id_p" style="display: none;">
                            <input type="text" class="form-control" name="codcategoria_p" id="codcategoria_p" placeholder="Codigo de categoria" readonly>
                          </div>
                        </div>

                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label for="nombre_p">Nombre de Categoria</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                            <input type="text" class="form-control" name="nombre_p" id="nombre_p" readonly>
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

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="detalle_p">Detalles de Categoria</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                            <input type="text" class="form-control" name="detalle_p" id="detalle_p" readonly>
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
  <script type="text/javascript" src="scripts/categoria.js"></script>
<?php  
  }
  ob_end_flush();
?>