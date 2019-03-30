<!-- 
protein.php permet a l'utilisateur d'avoir un resumé d'information sur une sequence proteique 
de gene contenu dans la Bases de données, juste en ayant spécifier son identifiant.
-->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>Protein information - BIO-Analysis tools</title>
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
		
		if ((isset($_POST['id_prot'])) && ($_POST['id_prot'] != '')){
			
			$protein_a = $_POST['id_prot'];
			
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
			$proteine = $bdd->query("SELECT * FROM proteine WHERE id_prot = '$protein_a'");
			$proteine->closeCursor();

			$exist = 1;

		}else{
			$protein_a = "";
		}
		?>

		</TABLE>	
		<!-- MAIN -->
		<div class="main_container">
			<p><p style="text-align:center"><b>Protein information</b></style></p>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:left;">Veuillez entrer votre identifiant de proteine.</style></p><br>

				<input type = "string" name="id_prot" rows = "1" cols= "50" placeholder="BC1T_00005"/>&nbsp;

				<!-- Bouton pour affichage de resultat -->
				<input type="submit" value="search" />
				<br><br>

				<?php if ($exist ==1){
				echo '<table  align="center" width="50%" border="1" cellpadding="3px" cellspacing="0" bgcolor="">
				<tr><th bgcolor="" colspan="">Resultat</th></tr>
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
					$proteine = $bdd->query("SELECT * FROM proteine WHERE id_prot = '$protein_a'");
					
					// affichage des infos sur le transcrit du gene
					// Affichage de la sequence proteique du gene
					$i=0;
					while ($data = $proteine->fetch()){
						$i++;
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">SUMMARY</font></p>';
						echo "\t"."Protein indentifiant : ".$protein_a.'<br>';
						echo "\t"."Gene indentifiant    : ".$data['id_gene'].'<br>';
						echo "\t"."Protein description  : ".$data['des_prot'].'<br>';
						echo "\t"."Organisme	     : Botrytis Cinerea ".'<br>'; 
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">GENOMIC CONTEXT</font></p>';
						echo "\t"."Protein length   : ".$data['length_prot'].'<br>';
						echo "\t"."Sequence   	 : ".'<br>'; 
					}$proteine->closeCursor();

					if ($data != $proteine) {  // Si le bon identifiant de proteine n'est pas fournit alors
						//echo "Identifiant de proteine incorrect\n";
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
