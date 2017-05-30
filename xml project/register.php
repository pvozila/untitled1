<?php
$errors = array();
if(isset($_POST['Register'])){
	$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
	$email = $_POST['email'];
	$password = $_POST['password'];
	$c_password = $_POST['c_password'];
	if(file_exists('users/' . $username . '.xml')){
		$errors[] = 'Korisnicko ime vec postoji.';
	}
	if($username == ''){
		$errors[] = 'Korisnicko ime je prazno.';
	}
	if($email == ''){
		$errors[] = 'E-mail je prazan.';
	}
	if($password == '' || $c_password == ''){
		$errors[] = 'Lozinke su prazne.';
	}
	
	if($password != $c_password){
		$errors[] = 'Lozinke se ne podudaraju.';
	}
	if(count($errors) == 0){
		$xml  = new SimpleXMLElement('<user></user>');
		$xml->addChild('password', md5(($password)));
		$xml->addChild('email', $email);
		$xml->asXml('users/' . $username . '.xml');
		header('Location: login.php');
	}
}
?>


<html xmlns="http://www.w3.org/TR/xhtml1/DTD/xhtml11-transitional.dtd">
<head>
	<title> Registracija </title>
</head>
<body>
	<h1> Registracija </h1>
	<form method="post" action="">
		<?php
		if(count($errors) > 0){
			echo '<ul>';
			foreach($errors as $e){
				echo '<li>' . $e . '</li>';
			}
			echo '</ul>';
		}
		
		?>
		<table>
			<tr><td><label for="username"> Korisnicko ime: </td><td><input type="text" name="username" placeholder="Unesi korisnicko ime..."/></label></td></tr>
			<tr><td><label for="email"> E-mail adresa: </td><td><input type="text" name="email" placeholder="Unesi e-mail..."/></label></td></tr>
			<tr><td><label for="password"> Lozinka: </td><td><input type="password" name="password" placeholder="Unesi lozinku..."/></label></td></tr>
			<tr><td><label for="c_password"> Potvrda lozinke: </td><td><input type="password" name="c_password" placeholder="Potvrdi lozinku..."/></label></td></tr>
		</table>
		</br>
		<input type="submit" value="Registriraj se" name="Register"/>
	</form>
	<p> Registriran/a si? Prijavi se <a href="login.php"> ovdje</a>!</p>
</body>
</html>