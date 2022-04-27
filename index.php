<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nota final examen</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="./img/note.ico" rel="icon">
</head>
<body>
	<div class='container'>
		<h1 class='centrar'>FORMULARI D'EXÀMEN</h1>
		<div class='formulari'> 
			<form method="post" action="mostrardatos.php">
				<label for='nif'>Nif</label>
				<input type="text" name="nif" id='nif'><br><br>
				<label for='nombre'>Nom</label>
				<input type="text" name="nombre" id='nombre'><br><br>
				<label for='apellidos'>Gognoms</label>
				<input type="text" name="apellidos" id='apellidos'><br><br>
				<label for='email'>Email</label>
				<input type="email" name="email" id='email'><br><br>
				<label for='nota'>Nota exàmen</label>
				<input type="number" step="000.1" name="nota" id='nota'><br><br>
				<label for='mensaje'>Missatge</label>
				<textarea name='mensaje' id='mensaje' cols='22' rows='5'></textarea><br><br>
				<label></label>
				<input type="submit" name="Enviar" class="enviar">
			</form>
		</div>
	</div>
</body>
</html>
