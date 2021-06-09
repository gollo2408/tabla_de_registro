<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$nombres=$_POST['Nombres'];
		$apellidos=$_POST['Apellidos'];
		$cedula=$_POST['Cedula'];
		$ciudad=$_POST['Ciudad'];
		$correo=$_POST['Correo'];

		if(!empty($nombres) && !empty($apellidos) && !empty($cedula) && !empty($ciudad) && !empty($correo) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO clientes(Nombres,Apellidos,Cedula,Ciudad,Correo) VALUES(:Nombres,:Apellidos,:Cedula,:Ciudad,:Correo)');
				$consulta_insert->execute(array(
					':Nombres' =>$nombres,
					':Apellidos' =>$apellidos,
					':Cedula' =>$cedula,
					':Ciudad' =>$ciudad,
					':Correo' =>$correo
				));
				header('Location: index.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD EN PHP CON MYSQL</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="Nombres" placeholder="Nombres" class="input__text">
				<input type="text" name="Apellidos" placeholder="Apellidos" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="Cedula" placeholder="Cédula" class="input__text">
				<input type="text" name="Ciudad" placeholder="Ciudad" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="Correo" placeholder="Correo electrónico" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>