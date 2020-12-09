<?php
/**
 * Cierra la sesión 
 */
session_start(); // Reiniciamos las variables de sesión.
session_unset(); // Libera todas las variables de sesión
session_destroy(); // Destruye toda la información registrada de una sesión
$url = '../index.php'; // Preaparamos la variable $url 
// Si se ha cerrado la sesión por inactividad, lo marcamos en la url para mostrar el mensaje adecuado
if(isset($_GET['sesion_expirada'])): $url .= '?sesion_expirada=TRUE';endif;
header("location:$url");
?>
