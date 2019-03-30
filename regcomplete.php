<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="forms.css">
		<title>Registration complete</title>
	</head>


	<body>
		<div class="bg2"></div>
		<?php
			echo "Your account has been registered and activated. Please write down your username and your password.<br><br>";
			echo "Your username is: ".$_POST["username"]."<br>Your password is: the one you have entered.";
		?>
	</body>
</html>
