<?php  

	if($_GET['module'] == 'categoria'){
		include "models/categoria/categoria.php";
	}
	elseif ($_GET['module'] == 'dashboard') {
		include "models/dashboard.php";
	}
	else{
		include "../models/dashboard.php";
	}
?>