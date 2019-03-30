<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="forms.css">
	<title>Sign-up</title>
  </head>


  <body>
	<div class="bg2"></div>

	<?php
		##CREATE USERNAME
		$username = '';						##INIT
		if ((isset($_POST['name'])) && ((isset($_POST['surname'])) && ($_POST['name'] != '')) && ($_POST['surname'] != '')){
			##Pre-treat: all in lowercase
			$name = strtolower($name);
			$surname = strtolower($surname);
			##Build the parts for the username
			$len_surname = strlen($surname);			##Get length of surname
			if ($len_name <= 5){
				$temp2 = $surname;				##Take all the surname
			}else{
				$temp2 = substr($surname,0,6);			##Return the 6 first letters
			}
			$temp1 = substr($name,0,1);				##take the first letter of name
			$temp3 = '_a';						##By default
			$username = $temp1.$temp2.$temp3;			##Username has been built
		}else{
			$name = ''; $surname = ''; $email = '';
		}

		##MANAGE FORM DISPLAY
		if ((isset($_POST['psw'])) && (isset($_POST['pswrepeat']))){
			if (($_POST['psw'] !== $_POST['pswrepeat'])){			##Passwords are not identical or password empty
				include("signup.php");					##Display again this form
			}else if ((isset($_POST['name'])) && (isset($_POST['surname'])) && (isset($_POST['email'])) && (isset($_POST['psw']))){
				include("regcomplete.php");				##Registration is complete
			}
		}else{
			$psw = ''; $pswrepeat = '';
		}
	?>
	<div class="bg-text">
		<div class="form-popup" id="signup">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-container" method="post">
				<h1>Sign-up</h1>

				<label for="email">E-mail</label>
				<input type="text" name="email" required>
				<br><br>
				<label for="name">Name</label>
				<input type="text" name="name" required>
				<br><br>
				<label for="surname">Surname</label>
				<input type="text" name="surname" required>
				<br><br>
				<label for="psw">Password</label>
				<input type="password" name="psw" required>
				<br><br>
				<label for="pswrepeat">Retype password</label>
				<input type="password" name="pswrepeat" required>
				<br><br>
				<button type="submit" class="btn">Sign-up</button>
				<br><br><br>
				<p><i><font size="2">All fields are required.</font></i></p>
			</form>
		</div>
	</div>
  </body>
</html>
