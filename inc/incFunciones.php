<?php
/*
* Archivo con funciones comunes a toda la aplicación
*
* BitacoraByte
* 20200914
*/

/**
 * Valida si el usuario tiene acceso o no.
 * 
 * Valida si la combinación de usuario/clave pasados en los parámetros tienen acceso a la aplicación.
 * 
 * @param string $usuario. El campo "usuario" a validar.
 * @param string $clave. El campo "clave" del usuario, que se validará.
 * @return boolean. TRUE en caso de que sea correcta la combinación Usuario/Clave y tenga acceso. FALSE en caso contrario.
 * 
 */
function validarAcceso($usuario, $clave) {
  $resultado=FALSE;
  try {
    // Limpiamos los parámetros de entrada
    $usuario=htmlentities(addslashes($usuario));
    $clave=htmlentities(addslashes($clave));
    // Para la prueba, vamos a simular que hemos accedido a la BBDD, con una consulta del estilo
    // SELECT usuario, nombre, clave FROM Usuarios WHERE usuario=$usuario;
    // y hemos recuperado
    $usuarioBD='usu';
    $claveBD='123';
    $nombreBD='Albert E.';
    // Si el usuario no existe, no recuperaría nada y por tanto la comprobación obtendría el mismo resultado que si los datos facilitados no tuvieran acceso.
    // Hacemos la validación
    if ($usuario == $usuarioBD && $clave == $claveBD) {
      // Validación correcta. Iniciar e informar las variables de sessión
      $resultado=TRUE;
      session_start();
      session_regenerate_id(TRUE);
      $_SESSION['usuario']=$usuarioBD;
      $_SESSION['nombre']=$nombreBD;
      $_SESSION['sesionTime']=time();
    }
  } catch (\Throwable $th) {
    throw $th;
  } finally {
    // cerrar la sesion con la bbdd.
    return $resultado;
  }
}

/**
 * Comprueba si ha expirado la sesión
 * 
 * Función que comprueba el periodo de inactividad del usuario, establecido en 600 segundos. Si se supera el tiempo se considera Sesión expirada
 * 
 * @return boolean. TRUE en caso de que el tiempo de inactividad del usuario sea mayor al configurado. En caso contrario FALSE
 */
function sesionExpirada() {
  ((time() - $_SESSION['sesionTime']) > 600) ? $resultado = TRUE : $resultado = FALSE;
  return $resultado;
}
?>
