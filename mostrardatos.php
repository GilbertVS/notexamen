<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nota final examen</title>
	<link href="./img/note.ico" rel="icon">
	<link rel="stylesheet" type="text/css" href="css/estilos.css?v=1.0">
</head>
<?php
	// caracters especials per php
	header('Content-Type: text/html; charset=UTF-8');
	// rebre dades dels camps d'entrada del formulari
	$nif = trim($_REQUEST['nif']) ?? null;
	$dni = substr($nif, 0, 8);
	if (is_numeric($dni)) $letraN = $dni%23;
	$letra = substr($nif, 8, 1);
	$letters = "TRWAGMYFPDXBNJZSQVHLCKET";
	if (is_numeric($dni)) $letter = substr($letters, $letraN, 1);
	//print($letra."  ==  ".$letter);
	$nombre = trim($_REQUEST['nombre']) ?? null;
	$apellidos =  trim($_REQUEST['apellidos']) ?? null;
	$email = trim($_REQUEST['email']) ?? null;
	$nota = trim($_REQUEST['nota']) ?? '';
	$mensaje = $_REQUEST['mensaje'] ?? null;
	// variable string dels erros en els camps del formulari no vàlids o buits
	$errors= null;
	// variables string del text de la nota d'exàmen final
	$notaFinal = null;
	// assignació nota final
	if (is_numeric($nota) && $nota>=0 && $nota<5) $notaFinal = 'Suspens';
	else if (is_numeric($nota) && $nota>=0 && $nota<7) $notaFinal = 'Aprovat';
	else if (is_numeric($nota) && $nota>=0 && $nota<9) $notaFinal = 'Notable';
	else if (is_numeric($nota) && $nota>=0 && $nota<=10) $notaFinal = 'Excel·lent';
	// validació dels camps amb try catch
	try{
		if (!$nif = filter_input(INPUT_POST, 'nif')) {
			$errors .= "El camp nif és obligatori.</br><style>.dni {border: 2px solid red;}</style>";
		}
		else if (!is_numeric($dni)){
			$errors .= "El camp nif no té els digits correctes.</br><style>.dni {border: 2px solid red;}</style>";
		}
		else if ($letra != $letter) {
			$errors .= "El camp nif és erroni.</br><style>.dni {border: 2px solid red;}</style>";
		}

		if (!$nombre = filter_input(INPUT_POST, 'nombre')) {
			$errors .= "El camp nom és obligatori.</br><style>.nom {border: 2px solid red;}</style>";
		}
		if (!$apellidos = filter_input(INPUT_POST, 'apellidos')) {
			$errors .= "El camp cognom és obligatori.</br><style>.cognom {border: 2px solid red;}</style>";
		}
		if ($nota == '') {
			$errors .= "El camp nota d'exàmen és obligatoria.</br><style>.nota {border: 2px solid red;}</style>";
		}	
		if (empty($notaFinal) && is_numeric($nota)) {
			$errors .= "El camp nota d'exàmen no és un nombre del seu rang.</br><style>.nota {border: 2px solid red;}</style>";
		}
		if ($nota != 0 AND (!$nota = filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_FLOAT))  AND !empty($notaFinal)) {
			$errors .= "El camp nota d'exàmen no pot ser un caracter.</br><style>.nota {border: 2px solid red;}</style>";
			$notaFinal = null;
		}
		if (empty($email)) {
			$errors .= "El camp email és obligatori.</br><style>.email {border: 2px solid red;}</style>";
		}
		if (!empty($email) AND (!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))) {
			$errors .= "El camp email és incorrecte.</br><style>.email {border: 2px solid red;}</style>";
		}
		if (!$mensaje = filter_input(INPUT_POST, 'mensaje')) {
			$errors .= "El camp missatge és obligatori.</br><style>.msg {border-color:red;}</style>";
		}
		if (!empty($errors)) { 
			throw new Exception($errors); 
		}
	}catch(Exception $e) {
		$errors = $e->getMessage();
	}
?>
<body>
	<div class='container'>
		<h1 class='centrar'>MOSTRAR NOTA D'EXÀMEN</h1>
		<div class='card'> 
			<input type="text" class ="dni" placeholder="nif" disabled value='<?php if (!empty($nif)) echo trim($nif) ?>'><br><br>
			<input type="text" class = "nom" placeholder="nom" disabled value='<?php if (!empty($nombre)) echo " ".trim($nombre) ?>'>
			<input type="text" class = "cognom" placeholder="cognoms" disabled value='<?php if (!empty($apellidos)) echo " ".trim($apellidos) ?>'><br><br>
			<input type="text" class = "nota" placeholder="qualificació" disabled value='<?php if(!empty($notaFinal)) echo " ".trim($notaFinal)." amb ".$nota ?>'>
			<div class="box">
				<!--aqui iran las cajitas <aside></aside>-->
				<?php
					if (is_numeric($nota)) {
						$nota2 = floor($nota);
						for ($i=1; $i<=$nota2; $i++) {
							if ($i<5) $aside = "<aside class='rojo'></aside>";
							else if ($i<7) $aside = "<aside class='amarillo'></aside>";
							else if ($i<9) $aside = "<aside class='verde'></aside>";
							else if ($i<=10) $aside = "<aside class='azul'></aside>";
							if (!empty($notaFinal)) echo $aside;
						}
					}
				?> 
				<!-- final dels aside -->
			</div>
			<br><br>
			<input type="text" class = "email" placeholder="email" disabled value='<?php if (!empty($email)) echo " ".trim($email) ?>'><br><br>
			<textarea  class = "msg" cols='22' rows='5' disabled><?php if (!empty($mensaje)) echo " $mensaje" ?></textarea>
			<p class = "errores"><?php if (!empty($errors)) echo $errors; ?></p>
		</div>
	</div>
</body>
</html>
