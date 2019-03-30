<!-- 
password.php restreint l'acces au site web (qui n'est pas public) à certaines personnes.
seuls nos collaborateurs biologistes ont acces au site grace au mot de passe qu'on les a fournit. 
si le mot de passe est correct, on affiche la page d'acceuil
sinon on affiche un message d'erreur.
-->

<!-- DOCTYPE: HTML -->
<?php
    if (isset($_POST['mot_de_passe']) AND $_POST['mot_de_passe'] ==  "aa") 
    {
?>
	<html lang="en">
	  <head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="base.css">
		<title>BIO-Analysis tools</title>
	  </head>

	  <body>

		<!-- HEADER -->
		<div class="header">
			<p><i><font color="#FFFFFF">Insert image here</font></i></p>
		</div>

		<div class="mega_container">

			<!-- MENU -->
		    <?php include("menu.php"); ?>

			<!-- MAIN -->
			<div class="main_container">
				<p><p style="text-align:center"><b>Welcome to BIO-Analysis tools!</b></style></p>
				<br><br><br>
				<p><p style="text-align:center">Select a tool in the menu on the left side of the page to begin.</style></p>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div>

		</div>

		<!-- FOOTER -->
	    <footer>
	        <?php include("footer.php"); ?>
	    </footer>

	  </body>

	</html>

<?php
    }
    else // Sinon, on affiche un message d'erreur
    {
        echo '<p>Mot de passe incorrect</p>';
    }
?>

