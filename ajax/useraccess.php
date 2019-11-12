<?php  
	if (strlen(session_id() < 1)) 
		session_start();
	
	require_once "../models/UserAccess.php";

	$useraccess = new UserAccess();

	switch ($_GET["action"]) {

		case 'verify':

			$username = $_POST['username'];
			$passwd = $_POST['passwd'];

			$passwd_decritp = hash("SHA256", $passwd);
			$response = $useraccess->verify($username,$passwd_decritp);
			$fetch = $response->fetch_object();

			if (isset($fetch)) {
				//Declarar variables de session
				$_SESSION['coduser'] = $fetch->CodUsuario;
				$_SESSION['fullname'] = $fetch->NombreCompleto;
				$_SESSION['username'] = $fetch->NombreUsuario;
				$_SESSION['email'] = $fetch->Correo;
				$_SESSION['rolename'] = $fetch->Nombre;
				
				//Obtener lista de permisos por role en el usuario
				$accesslist = $useraccess->accesslist($fetch->CodUsuario);

				//Write array para almacenar los permisos
				$data = array();
				//Recorrer el object y almacenar en el array los data
				while ($item = $accesslist->fetch_object()) {
					# code...
					array_push($data, $item->CodPermiso);
				}
				//Se determina el acceso del usuario
				in_array(1, $data)?$_SESSION['consulcompras']=1 : $_SESSION['consulcompras']=0;
				in_array(2, $data)?$_SESSION['consulventas']=1 : $_SESSION['consulventas']=0;
				in_array(3, $data)?$_SESSION['mantarticles']=1 : $_SESSION['mantarticles']=0;
				in_array(4, $data)?$_SESSION['mantecategorties']=1 : $_SESSION['mantecategorties']=0;
				in_array(5, $data)?$_SESSION['mantedepartament']=1 : $_SESSION['mantedepartament']=0;
				in_array(6, $data)?$_SESSION['manteinvoice']=1 : $_SESSION['manteinvoice']=0;
				in_array(7, $data)?$_SESSION['mantepasswrd']=1 : $_SESSION['mantepasswrd']=0;
				in_array(8, $data)?$_SESSION['manteaccess']=1 : $_SESSION['manteaccess']=0;
				in_array(9, $data)?$_SESSION['mantesupplier']=1 : $_SESSION['mantesupplier']=0;
				in_array(10, $data)?$_SESSION['mantepuestos']=1 : $_SESSION['mantepuestos']=0;
				in_array(11, $data)?$_SESSION['manteroles']=1 : $_SESSION['manteroles']=0;
				in_array(12, $data)?$_SESSION['manteusers']=1 : $_SESSION['manteusers']=0;
				in_array(13, $data)?$_SESSION['moduleventas']=1 : $_SESSION['moduleventas']=0;
				/*in_array(14, $data)?$_SESSION['consulcompras']=1 : $_SESSION['consulcompras']=0;
				in_array(15, $data)?$_SESSION['consulcompras']=1 : $_SESSION['consulcompras']=0;
				in_array(16, $data)?$_SESSION['consulcompras']=1 : $_SESSION['consulcompras']=0;
				in_array(17, $data)?$_SESSION['consulcompras']=1 : $_SESSION['consulcompras']=0;
				in_array(18, $data)?$_SESSION['consulcompras']=1 : $_SESSION['consulcompras']=0;*/
			}
			
			echo json_encode($fetch);
	 		break;

		case 'destroysession':
			//Liampiar variables de sesión   
	        session_unset();
	        //Destruir sesión
	        session_destroy();
	        //Redireccionar login
	        header("Location: ../index.php");

			break;
		default:			
			break;
	}
?>