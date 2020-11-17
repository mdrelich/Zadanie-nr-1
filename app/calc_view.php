<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator Kredytowy</title>
</head>
<body>
<center>
Kalkulator Kredytowy
</br>
Wpisz wszystkie potrzebne parametry żeby obliczyć swój kredyt
<form action="<?php print(_APP_URL);?>/app/calc.php" method="br">
	<label for="id_x">Kwota </label>
	<input id="id_x" type="text" name="x" value="<?php if (isset($x)) print($x); ?>" /><br />
	<label for="id_y">Na ile kredyt(w latach) </label>
	<input id="id_y" type="text" name="y" value="<?php if (isset($y)) print($y); ?>" /><br />
    <label for="id_z">Oprocentowanie("prosze podać procenty (5%=5)) </label>
    <input id="id_z" type="text" name="z" value="<?php if (isset($z)) print($z); ?>" /><br />
    <input type="submit" value="Oblicz" />
</form>

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #93f600; width:300px;">
<?php echo 'Miesięczna rata kredytu: '.$result." zł"; ?>
</div>
<?php } ?>
</center>
</body>
</html>