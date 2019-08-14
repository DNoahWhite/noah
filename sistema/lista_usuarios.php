<?php
  include "../conexion.php"
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="css/styleLU.css">
    <?php include "includes/scripts.php" ?>
    <title>Lista de Usuarios</title>
  </head>
  <body>
    <?php
    include "includes/header.php";
     ?>

     <section id="container">

       <h1>Lista de Usuarios</h1>
       <a href="registro_usuario.php" class="btn_new">Crear Usuario</a>

       <table>
         <tr>
           <th>ID</th>
           <th>Nombre</th>
           <th>Correo</th>
           <th>Usuario</th>
           <th>Rol</th>
           <th>Acciones</th>
         </tr>

         <?php

         $query=mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol=r.idrol WHERE estado=1");
         $result=mysqli_num_rows($query);

         if ($result>0) {

            while ($data=mysqli_fetch_array($query)) {

            ?>
         <tr>
           <td><?php echo $data["idusuario"] ?></td>
           <td><?php echo $data["nombre"] ?></td>
           <td><?php echo $data["correo"] ?></td>
           <td><?php echo $data["usuario"] ?></td>
           <td><?php echo $data['rol'] ?></td>
           <td>
             <a href="editar_usuario.php? id=<?php echo $data["idusuario"] ?>" class="link_edit">Editar</a>

            <?php if($data["idusuario"]!= 1){ ?>


             |
             <a href="eliminar_confirmar_usuario.php? id=<?php echo $data["idusuario"] ?>" class="link_delete">Eliminar</a>
           <?php } ?>
           </td>
         </tr>
         <?php
       }
    }


     ?>
       </table>

     </section>

  </body>
</html>
