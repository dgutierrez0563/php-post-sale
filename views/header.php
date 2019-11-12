<?php 
  if (strlen(session_id()) < 1) {
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="IPOST Facturas Digitales">
    <meta name="description" content="Facturacion Electronica Sencilla">

    <title>IPOST | dgutierrez</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<!--     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v4.7.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  </head>
  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-shopping-cart"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>IPOST</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../public/img/user-default.png" class="user-image" alt="Image">
                  <span class="hidden-xs"><?php echo $_SESSION['username']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../public/img/user-default.png" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $_SESSION['fullname']; ?>
                      <small><?php echo $_SESSION['email']; ?></small>
                      <small><?php echo $_SESSION['rolename']; ?></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">                    
                    <div class="pull-right">
                      <a href="../ajax/useraccess.php?action=destroysession" class="btn btn-warning btn-flat">Logon</a>
                    </div>
                    <div class="pull-left">
                      <a href="#" class="btn btn-info btn-flat">Profile</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li>
              <a href="./dashboard.php">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-home"></i>
                <span>Panel Almacen</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php 
                  if ($_SESSION['mantarticles']==1 && $_SESSION['mantecategorties']==1 && $_SESSION['mantesupplier']==1) {
                    echo '<li><a href="./articulo_v2.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                          <li><a href="./categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                          <li><a href="./proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>';
                  }                  
                ?>
                <?php 
                  if ($_SESSION['mantarticles']==1 && $_SESSION['mantecategorties']==1 && $_SESSION['mantesupplier']==0) {
                    echo '<li><a href="./articulo_v2.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                          <li><a href="./categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>';
                  }                  
                ?>
                <?php 
                  if ($_SESSION['mantarticles']==1 && $_SESSION['mantecategorties']==0 && $_SESSION['mantesupplier']==1) {
                    echo '<li><a href="./articulo_v2.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                          <li><a href="./proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>';
                  }                  
                ?>
                <?php 
                  if ($_SESSION['mantarticles']==0 && $_SESSION['mantecategorties']==1 && $_SESSION['mantesupplier']==1) {
                    echo '<li><a href="./categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                          <li><a href="./proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>';
                  }                  
                ?>
                <li><a href="./inventario.php"><i class="fa fa-circle-o"></i> Stock</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Panel Administrativo</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="./departamento.php"><i class="fa fa-circle-o"></i> Departamentos</a></li>
                <li><a href="./cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="./puesto_v2.php"><i class="fa fa-circle-o"></i> Puestos</a></li>
                <li><a href="./usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Panel Niveles Menu</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="./submenu.php"><i class="fa fa-circle-o"></i> Nivel 1 Menu</a></li>
                <li><a href="./subsubmenu.php"><i class="fa fa-circle-o"></i> Nivel 2 Sub-Menu</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> N/A</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Panel Compra-Ingresos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ingresomaterias.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="ingresosanulaciones.php"><i class="fa fa-circle-o"></i> Anulaciones</a></li>
                <li><a href="proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Modulo Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventas.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
              </ul>
            </li>
            <?php 
              if ($_SESSION['manteaccess']==1 && $_SESSION['manteroles']==1 && $_SESSION['manteusers']==1) {
                echo '
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-lock"></i> <span>Modulo Seguridad</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="acceso.php"><i class="fa fa-circle-o"></i> Asignacion de Accesos</a></li>
                      <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                      <li><a href="role.php"><i class="fa fa-circle-o"></i> Roles</a></li>
                      <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                    </ul>
                  </li>';
              } ?> 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
              </ul>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
<?php  
 //}
?>