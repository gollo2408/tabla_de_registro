<?php
	include_once('conexion.php');

	$sentencia_select=$con->prepare('SELECT * FROM clientes ORDER BY id DESC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('SELECT *FROM clientes WHERE Nombres LIKE :campo OR Apellidos LIKE :campo;');
		$select_buscar->execute(array(':campo' =>"%".$buscar_text."%"));
		$resultado=$select_buscar->fetchAll();

	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tabla de Registro</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div class="contenedor">
		<h2>REGISTRO</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="Buscar Nombres o Apellidos" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insert.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Nombres</td>
				<td>Apellidos</td>
				<td>Cédula</td>
				<td>Ciudad</td>
				<td>Correo</td>
				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['Id']; ?></td>
					<td><?php echo $fila['Nombres']; ?></td>
					<td><?php echo $fila['Apellidos']; ?></td>
					<td><?php echo $fila['Cedula']; ?></td>
					<td><?php echo $fila['Ciudad']; ?></td>
					<td><?php echo $fila['Correo']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['Id']; ?>" class="btn__update" >Editar</a></td>
					<td><a href="delete.php?id=<?php echo $fila['Id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>