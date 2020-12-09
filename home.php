<?php
  session_start();
  require_once('inc/incFunciones.php'); // Requerido para la función sesionExpirada()
  // Control de acceso
  if (!isset($_SESSION['usuario'])): header('Location:index.php');                // Si la variable no existe mandamos al formulario de acceso
  elseif (sesionExpirada()): header('location:php/cerrarSesion.php?sesion_expirada=TRUE');  // Si existe y la sesión ha expirado, cerramos la sesión y marcamos la variable que lo indica para que la página de inicio muestre el mensaje correcto
  else: $_SESSION['loggedin_time']=time();                                        // Si existe y el elseif no se ha cumplido (es decir, sesión NO expirada) actualizamos la marca de tiempo del último acceso del usuario
  endif;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Logging en PHP</title>
<meta charset="utf-8" />
<meta name="description" content="Ejemplo en PHP. Formulario de acceso">
<link rel="stylesheet" href="css/estilobb.css" />
<link rel="shortcut icon" href="imagenes/logo.png"/>
</head>
<body class="is-preload">
    <div id="wrapper">
        <div id="main">
            <div class="inner">
                <header id="header">
                    <h1>Home</h1>
                </header>
                <p>Hola: <b><?php echo $_SESSION['nombre'] ?></b></p>
                <section>
                  <fieldset>
                    <legend>Depuraci&oacute;n de variables</legend>
                  <?php
                    echo '<p>Sesión: <b>'. session_id() . '</b></p>'; 
                    echo '<p>Usuario: <b>'.$_SESSION['usuario'].'</b></p>';
                    echo '<p>Nombre: <b>'.$_SESSION['nombre'].'</b></p>';
                    echo '<p>Time: <b>' . $_SESSION['loggedin_time'].'</b></p>';
                  ?>
                  </fieldset>
                  <a href="php/cerrarSesion.php">Cerrar sesi&oacute;n</a>
                </section>
                <footer>Logging en PHP | V:1.0 | <a href="https://bitacorabyte.wordpress.com">BitacoraByte</a></footer>
            </div>
        </div>
    </div>
</body>
</html>