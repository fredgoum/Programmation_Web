<!-- 
transcrit.php permet a l'utilisateur d'avoir un resumé d'information sur un transcrit 
de gene contenu dans la Bases de données, juste en ayant spécifier son identifiant.
-->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>Transcrit information - BIO-Analysis tools</title>
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
		
		if ((isset($_POST['id_trans'])) && ($_POST['id_trans'] != '')){
			
			$transcrit_a = $_POST['id_trans'];
			
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
			$transcrit = $bdd ->query("SELECT * FROM transcrit WHERE id_trans = '$transcrit_a'");
			$transcrit->closeCursor();

			$exist = 1;

		}else{
			$transcrit_a = "";
		}
		?>

		</TABLE>	
		<!-- MAIN -->
		<div class="main_container">
			<p><p style="text-align:center"><b>Transcrit information</b></style></p>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:left;">Veuillez entrer votre identifiant de transcrit.</style></p><br>

				<input type = "string" name="id_trans" rows = "1" cols= "50" placeholder="BC1T_00005"/>&nbsp;

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
					$transcrit = $bdd ->query("SELECT * FROM transcrit WHERE id_trans = '$transcrit_a'");
					
					// affichage des infos sur le transcrit du gene
					$i=0;
					while ($data = $transcrit->fetch()){
						$i++;
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">SUMMARY</font></p>';
						echo "\t"."Transcrit indentifiant : ".$transcrit_a.'<br>';
						echo "\t"."Transcrit description  : ".$data['des_trans'].'<br>';
						echo "\t"."Organisme	       : Botrytis Cinerea ".'<br>';
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">GENOMIC CONTEXT</font></p>';
						echo "\t"."Transcrit length   : ".$data['length_trans'].'<br>';
						echo "\t"."Commentaire 	   : ".$data['commentaire'].'<br>';
						echo "\t"."Sequence   	   : ".'<br>';
					}$transcrit->closeCursor();

					if ($data != $transcrit) {  // Si le bon identifiant de transcrit n'est pas fournit alors
						//echo "Identifiant de transcrit incorrect\n";
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
