<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="forms.css">
	<title>Login</title>
  </head>

  <body>
	<div class="bg1"></div>

	<div class="bg-text">
		<div class="form-popup" id="login">
			<form action="/login.php" class="form-container">
				<h1>Login</h1>

				<label for="uname"><b>Username</b></label>
				<input type="text" name="uname" required>
				<br><br>
				<label for="psw"><b>Password</b></label>
				<input type="password" name="psw" required>
				<br><br>
				<button type="submit" class="btn">Login</button>
			</form>
			<p>Don't have an account yet?</p>
			<form action="signup.php" class="form-container">
				<button type="submit" class="btn">Sign-up</button>
			</form>
		</div>
	</div>
  </body>
</html>
