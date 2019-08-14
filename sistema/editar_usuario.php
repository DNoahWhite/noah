<?php
  include "../conexion.php";

if (!empty($_POST)) {
  $alert='';

	if (empty($_POST['nombre'])||empty($_POST['correo'])||empty($_POST['usuario'])||

			empty($_POST['rol'])) {

		$alert='<p class="msg_error">Todos los campos son obligatorios</p>';

}else {

  $idusuario=$_POST['idUsuario'];
  $nombre=$_POST['nombre'];
  $email=$_POST['correo'];
  $user=$_POST['usuario'];
  $clave=md5($_POST['clave']);
  $rol=$_POST['rol'];


  $query=mysqli_query($conection, "SELECT * FROM usuario
                                    WHERE (usuario='$user' AND idusuario!=$idusuario)
                                    OR (correo='$email' AND idusuario != $idusuario)");

  $result=mysqli_fetch_array($query);//determinara si se repite correo o usuario
  if($result>0){
    $alert='<p class="msg_error">El usuario o correo ya son existentes o ya fueron usadas</p>';
  }else {

    if (empty($_POST['clave'])) {

      $sql_update=mysqli_query($conection, "UPDATE usuario
                                            SET nombre='$nombre',correo='$email',usuario='$user',rol='$rol'
                                            WHERE idusuario=$idusuario");

    }else {

      $sql_update=mysqli_query($conection, "UPDATE usuario
                                            SET nombre='$nombre',correo='$email',usuario='$user',clave='$clave',rol='$rol'
                                            WHERE idusuario=$idusuario");
    }

  /*  $query_insert = mysqli_query($conection, "INSERT INTO usuario(nombre,correo,usuario,clave,rol)
                                              VALUES('$nombre','$email','$user','$clave','$rol')"); */
    if($sql_update){
      $alert='<p class="msg_save">Usuario actualizado correctamente</p>';
    }else{
      $alert='<p class="msg_error">Error al actualizar el usuario</p>';
    }
  }
}
}
//MOSTRAR DATOS


if (empty($_GET['id'])) { //validando que cuando borren el id del url a vacio redirecione
  header('location:lista_usuarios.php');
}

$iduser=$_GET['id'];

$sql=mysqli_query($conection,"SELECT u.idusuario, u.nombre,u.correo, u.usuario, (u.rol) AS idrol, (r.rol) AS rol
                              FROM usuario u
                              INNER JOIN rol r
                              ON u.rol = r.idrol
                              WHERE idusuario=$iduser");
$result_sql=mysqli_num_rows($sql);

if ($result_sql == 0) {
  header('location:lista_usuarios.php');
}else {
  $option = '';
  while ($data = mysqli_fetch_array($sql)) {
    $iduser = $data['idusuario'];
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $usuario = $data['usuario'];
    $idrol = $data['idrol'];
    $rol = $data['rol'];

    if ($idrol == 1) {
      $option='<option value="'.$idrol.'"select>'.$rol.'</option>';
    }elseif ($idrol == 2) {
      $option='<option value="'.$idrol.'"select>'.$rol.'</option>';
    }elseif ($idrol == 4) {
      $option='<option value="'.$idrol.'"select>'.$rol.'</option>';

    }
  }
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/styleRU.css">
	<title>Actulizar Usuario</title>

</head>
<body>
<?php include "includes/header.php"; ?>
	<section id="container">


<div class="form_register">

  <h1>Actulizar Usuario</h1>
  <hr>
  <div class="alert"><?php echo isset($alert)? $alert: ''; ?></div>

  <form action="" method="post">

    <input type="hidden"  name="idUsuario" value="<?php echo $iduser; ?>">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">

		<label for="correo">Correo Electronico</label>
		<input type="email" name="correo" id="correo" placeholder="Correo Electronico" value="<?php echo $correo;?>">

		<label for="usuario">Usuario</label>
		<input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">

		<label for="clave">Contraseña</label>
		<input type="password" name="clave" id="clave" placeholder="Contraseña">

		<label for="rol">Rol</label>

		<?php

			$query_rol = mysqli_query($conection, "SELECT * FROM rol");
			$result_rol=mysqli_num_rows($query_rol);

		 ?>

		<select class="rol" id="rol" name="rol" class="notItemOne">
			<?php
      echo $option;
			if ($result_rol>0) {
				while ($rol = mysqli_fetch_array($query_rol)) {
			 ?>

			 	<option value="<?php echo $rol["idrol"]; ?>"> <?php echo $rol["rol"]; ?></option>

				<?php
			}
		}

				 ?>
		</select>
		<input type="submit" value="Actulizar Usuario" class="btn_save">

	</form>

</div>

	</section>



</body>
</html>
