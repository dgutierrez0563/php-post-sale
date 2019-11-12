<?php
  /*
  * Activacion del buffer para sesiones
  */
  // ob_start();
  // session_start();

  if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    # code...
    header("Location: login.html");

  } else {

    //require 'header.php';

    ?>
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
                        <li class="breadcrumb-item active"><strong> Welcome</li></strong>
                      </ol>
                    </div>                    
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <p style="font-size:15px">
                        <i class="icon fa fa-building"></i> Something's wrong!<strong><?php //echo date('d-m-Y');//echo $_SESSION['NombreCompleto'];?></strong> You cant't access here.
                      </p>
                    </div>
                    <img class="center-block" src="../public/img/privacidad.jpg" class="img-responsive">
                    <br>
                    <br>
                  </div>
                  <!-- /.box-header -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
<?php
  //require 'footer.php';
?>
<?php  
  }
  //ob_end_flush();
?>