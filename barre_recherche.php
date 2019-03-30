<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="barre_recherche.css">
        <title>Page protegée par un mot de passe - BIO-Analysis tools</title>
    </head>

 
        <div class="header">
        <!-- L'entete du site web -->
        <?php include("header.php"); ?> 
        </div>

        <body>
			<form id="recherche" method="post">
			 
			<input name="saisie" type="text" placeholder="Mots-Clefs..." required />
			<input class="loupe" type="submit" value="" />
			 
			</form>



		</body>

</html>
