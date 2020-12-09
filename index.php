<?php
session_start(); // Iniciar las variables de sesión
$mensaje=NULL; // Variable para almacenar el mensaje que se muestra al usuario en el formulario de acceso si fuese necesario.
require_once('inc/incFunciones.php'); // Para la función validarAcceso()
if(isset($_SESSION['usuario'])): header('location:home.php');   // Si la variable está definida y no es NULL, el usuario ya está validado por tanto mandamos a la home.php
elseif (isset($_GET['sesion_expirada'])): $mensaje='Sesi&oacute;n expirada. Debe acceder de nuevo.'; //En caso contrario, revisamos si venimos de cerrar la sesión por inactividad
endif;
// Si $_POST>0 indica que viene con información, por tanto se está recargando la página por pulsar el botón "Acceder", así que tenemos que validar al usuario
if(count($_POST)>0):(validarAcceso($_POST['usuario'],$_POST['clave'])) ? header('location:home.php'): $mensaje='Datos de acceso no válidos';
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
            <div class="loggin">
                <header id="header">
                    <h1>Formulario de acceso</h1>
                </header>
                <form name="form_acceso" action="" method="POST">
                    <?php if($mensaje<>NULL) { ?> <div class="mensaje"><?php echo $mensaje; ?></div> <?php } ?>
                    <input type="text" name="usuario" placeholder="Usuario" autocomplete="off" required><br>
                    <input type="password" name="clave" placeholder="Clave" autocomplete="off" required><br>
                    <input type="submit" value="Acceder">
                </form>
            </div>
            <footer>Logging en PHP | V:1.0 | <a href="https://bitacorabyte.wordpress.com">BitacoraByte</a></footer>
        </div>
    </div>
</body>
</html>