<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title> </title>
  </head>

  <body>

	<div class="mega_container">

		<TABLE>
		<?php
		
			try
            {
                // On se connecte à MySQL
                $bdd = new PDO('mysql:host=localhost;dbname=GENOME;charset=utf8', 'root', '');
            }
            catch(Exception $e)
            {
                // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
            }	
			$gene = $bdd->query("SELECT seq_gene FROM gene WHERE id_gene = 'BC1G_00001'");

			$i=0;
			while ($data = $gene->fetch()){
				$i++;
						
				echo $data['seq_gene'];
						 
			}$gene->closeCursor();

		?>

		</TABLE>	
	</div>
	
  </body>
</html>
