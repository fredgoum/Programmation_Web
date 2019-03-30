<!-- 
contig.php permet a l'utilisateur d'avoir un resumé d'information sur un contig 
contenu dans la Bases de données, juste en ayant spécifier son identifiant.
-->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>Contig information - BIO-Analysis tools</title>
  </head>

  <body>
	<div class="header">
	<!-- L'entete du site web -->
    <?php include("barre_recherche.php"); ?>
    </div>

	<div class="mega_container">

		<TABLE>
		<?php
		$exist = 0;
		
		if ((isset($_POST['id_contig'])) && ($_POST['id_contig'] != '')){
			
			$a = $_POST['id_contig'];
			
			try
            {
                // On se connecte à MySQL
                $bdd = new PDO('mysql:host=localhost;dbname=GENOME_BOTRYTIS_CINEREA;charset=utf8', 'root', '');
            }
            catch(Exception $e)
            {
                // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
            }	
			$contig = $bdd->query("SELECT * FROM contig WHERE id_contig = '$a'");
			$contig->closeCursor();

			$exist = 1;

			

		}else{
			$a = "";
		}
		?>

		</TABLE>	
		<!-- MAIN -->
		<div class="main_container">
			<p><p style="text-align:center"><b>Contig information</b></style></p>
			
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:left;">Veuillez entrer votre identifiant de contig.</style></p><br>
				<input type = "string" name="id_contig" rows = "1" cols= "50" placeholder="AAID01000003"/> &nbsp;

				<!-- Bouton pour affichage de resultat -->
				<input type="submit" value="search" />
				<br><br>
				<!-- Resultat
				<p><p style="text-align:center">Output:</style></p>
				<td>
				 -->

				<?php if ($exist ==1){
				echo '<table  align="center" width="50%" border="1" cellpadding="3px" cellspacing="0" bgcolor="">
				<tr><th bgcolor="" height=10 colspan="">Resultat</th></tr>
				<tr><td>';
					try
		            {
		                // On se connecte à MySQL
		                $bdd = new PDO('mysql:host=localhost;dbname=GENOME_BOTRYTIS_CINEREA;charset=utf8', 'root', '');
		            }
		            catch(Exception $e)
		            {
		                // En cas d'erreur, on affiche un message et on arrête tout
		                die('Erreur : '.$e->getMessage());
		            }	
					$contig = $bdd->query("SELECT * FROM contig WHERE id_contig = '$a'");
					
					// affichage des infos sur un contig
					$i=0;
					while ($data = $contig->fetch()){
						$i++;
						//echo "SUMMARY".'<br>'.'<br>';
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">SUMMARY</font></p>';
						echo "\t"."Contig indentifiant : ".$a.'<br>';
						echo "\t"."Contig numero        : ".$data['num_contig'].'<br>';
						echo "\t"."Supercontig  : ".$data['supercontig'].'<br>';
						echo "\t"."Organisme	    : Botrytis Cinerea ".'<br>'.'<br>'; 
						//echo "GENOMIC CONTEXT".'<br>'.'<br>';
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">GENOMIC CONTEXT</font></p>';
						echo "\t"."Localisation    : ".$data['localisation'].'<br>';
						echo "\t"."Contig length 	: ".$data['length'].'<br>';
						//echo "\t"."Sequence   	: ".'<br>'; 
						 
					}$contig->closeCursor();

					if ($data != $contig) {  // Si le bon identifiant de contig n'est pas fournit alors
						//echo "Identifiant de contig incorrect\n";
					}

					
				echo '	
				</tr></td>
  				</table>';
  				}
  					
  				
				?>

				</td>
				<br><br><br>
  				
			</form>
			<p><i><a href="main.php">Back to homepage</a></i></p>
			<br><br>
		</div>
	</div>
	
	<!-- FOOTER -->
    <footer>
        <?php include("footer.php"); ?>
    </footer>

  </body>
</html>
