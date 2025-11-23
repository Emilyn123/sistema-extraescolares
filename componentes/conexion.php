<?php 
		function conexion(){
			$servidor="localhost";
			$usuario="root";
			$password="cris18navarro?";
			$bd="extraescolares";

			$conexion=mysqli_connect($servidor,$usuario,$password,$bd);

            if ($conexion) {
                mysqli_set_charset($conexion, "utf8");
            }

			return $conexion;
		}
?>