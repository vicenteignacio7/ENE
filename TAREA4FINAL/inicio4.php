<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Obtiene datos del formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Consulta segura usando declaraciones preparadas
    $stmt = $conex->prepare("SELECT * FROM usuarios WHERE email = ? AND password = MD5(?)");
    $stmt->bind_param("ss", $email, $password);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificación del resultado de la consulta
    if ($result && $result->num_rows > 0) {
        echo "Inicio de sesión exitoso.";
        header("Location: bodega.html");
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }

    // Cierra la declaración
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siglo XXI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="inicio.css">
    <link rel="img" href="img">
</head>
<body>
<link rel="stylesheet" href="inicio.css">
<div class="background "></div>
<div class="backdrop"></div> 

<div class="page">
  <div class="container">
    <div class="formulario">
      
      <div class="header">
        <div class="logo">
          <div class="logo-area">
          <span class="red">//</span><span class="big">Siglo XXI</span>
          </div>
        </div>
       
        <h3>Iniciar sesión como bodega</h3>
      </div>

      <form method="post" autocomplete="off">
    <div class="input-group">
        <div class="input">
            <i class="fa fa-envelope"></i>
            <input type="text" name="email" placeholder="Correo electrónico">
        </div>
        <div class="input">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" placeholder="Contraseña">
        </div>
        
        
        
        <input type="submit" name="login" value="Iniciar sesión" class="btn btn-login">
        
     
        
        <!-- Aquí está el botón "Iniciar sesión como profesional" -->
        <a href="inicio.php" class="btn btn-registrar btn-profesional">Iniciar sesión como administrador</a>
        <a href="inicio2.php" class="btn btn-registrar btn-profesional">Iniciar sesión como cliente</a>
        <a href="inicio3.php" class="btn btn-registrar btn-profesional">Iniciar sesión como cocinero</a>
        <a href="inicio5.php" class="btn btn-registrar btn-profesional">Iniciar sesión como finanzas</a>
    </div>
</form>

        
    </div>
    <p class="attrib">&copy; Derechos reservados</p>
  </div>
</div>


<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>

    <?php
        include("send.php");
    ?>
</body>
</html>
