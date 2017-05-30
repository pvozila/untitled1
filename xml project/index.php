<?php
session_start();
if(!file_exists('users/' . $_SESSION['username'] . '.xml')){
	header('Location: login.php');
}

?>

<html xmlns="http://www.w3.org/TR/xhtml1/DTD/xhtml11-transitional.dtd">
<head>
	<title> Korisnicka stranica </title>
</head>
<body>
	<h1> Korisnicka stranica </h1>
	<h2> Dobrodosao/la, <?php echo $_SESSION['username']?></h2>
	<h3> Registrirani korisnici i njihove e-mail adrese. </h3>
	<table>
		<tr>
			<th>Korisnicko ime</th>
			<th>E-mail</th>
		</tr>
		<?php
		$files = glob('users/*.xml');
		foreach($files as $file){
			$xml = new SimpleXMLElement($file, 0, true);
			echo '
			<tr>
				<td>' . basename($file, '.xml') . '</td>
				<td>' . $xml->email . '</td>';
		}
		
		?>
	</table>
	<hr/>
	
	<a href="logout.php"> Odjava </a>
</body>
</html>