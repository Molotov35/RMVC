<?php  
	
	require_once "config/app.php";
	require_once "autoload.php";
	require_once "app/views/inc/session_start.php";
	
	if (isset($_GET['views'])) {
		$url=explode("/", $_GET['views']);
	} else {
		$url=["HOME"];
	}

 ?>

 <!DOCTYPE html>
 <html lang="es" data-bs-theme="light">
 <head>
 	<?php require_once "app/views/inc/head.php"; ?>
 </head>
 <body>

 	<?php 

 		use app\controllers\viewsController;
 		use app\controllers\loginController;
 		$insLogin = new loginController();

 		$viewsController = new viewsController();
 		$view = $viewsController->getControllerViews($url[0]);

 		if ($view=="LOGIN" || $view=="404" || $view=="403") {
 			require_once "app/views/content/".$view."-view.php";
 		} else {
 			/**
 			 * CERRAR SESIÒN
 			 // */
 				// echo '<pre>'; print_r($_SESSION); echo '</pre>';
 			if (!isset($_SESSION['User']) || empty($_SESSION['User'])) {
	 			$insLogin->sessionClose();
 				exit();
 			}


 			require_once "app/views/inc/navbar.php";
 			require_once $view;
 		}

 	 	require_once "app/views/inc/script.php";

 	 ?>
 </body>
 </html>

