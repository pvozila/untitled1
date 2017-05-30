<?php
$error = false;
if(isset($_POST['login'])){
	$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
	$password = md5($_POST['password']);
	if(file_exists('users/' . $username . '.xml')){
		$xml = new SimpleXMLElement('users/' . $username . '.xml', 0, true);
		if($password == $xml->password){
			session_start();		
			$_SESSION['username'] = $username;
			header('Location: index.php');
			die;
		}
	}
	$error = true;
}	
?>

<html xmlns="http://www.w3.org/TR/xhtml1/DTD/xhtml11-transitional.dtd">
<head>
	<title> Prijava </title>
</head>
<body>
	<h1> Prijava </h1>
	<form method="post" action="">
		<table>
			<tr><td><label for="username"> Korisnicko ime: </td><td><input type="text" name="username" placeholder="Unesi korisnicko ime..."/></label></td></tr>
			<tr><td><label for="password"> Lozinka: </td><td><input type="password" name="password" placeholder="Unesi lozinku..."/></label></td></tr>
		</table>
		<?php
		if($error){
			echo '<p>Pogresno korisnicko ime i/ili lozinka</p>';
		}
		?>		
		<input type="submit" value="Prijava" name="login"/>
	</form>
	<p> Nisi registriran/a? Registriraj se <a href="register.php"> ovdje</a> odmah! </p>
</body>
</html>