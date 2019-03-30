<!-- 
domains_pfam permet de faire une collection de famille de proteine pour un profil Pfam donné.
L'utilisateur entre un profil de pfam et selectionne tous les genes contenant des domains 
pfam dans la base de données de Botrytis cinerea (ici GENOME_BOTRYTIS_CINEREA).
e.g : PF02727.8 renvoie tous les genes contenant le domaine PF02727.8
		==> collection de famille de proteines.
-->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>PFAM Dommains - BIO-Analysis tools</title>
  </head>

  <body>
	<div class="header">
	<!-- L'entete du site web -->
    <?php include("barre_recherche.php"); ?>

	<div class="mega_container">

		<TABLE>
		<?php
		$exist = 0;
		
		if ((isset($_POST['pfam_acc'])) && ($_POST['pfam_acc'] != '')){
			
			$a = $_POST['pfam_acc'];
			
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
			$pfam_acc = $bdd->query("SELECT DISTINCT locus, pfam_acc, pfam_name, pfam_start, pfam_stop, length FROM pfam_domain WHERE pfam_acc = '$a'");
			$pfam_acc->closeCursor();

			$exist = 1;

		}else{
			$a = "";
		}
		?>
		</TABLE>	

		<!-- MAIN -->
		<div class="main_container">
			<p><p style="text-align:center"><b>Matched PFAM Domains</b></style></p>
			<br>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:center">Veuillez entrer votre pfam profile.</style></p>
				<input type = "string" name="pfam_acc" rows = "1" cols= "50" placeholder="PF00657.17"/></br></br>
				<!-- Bouton pour affichage de resultat -->
				<input type="submit" value="submit" />

				<div align="center" class="s">
				    <h2><a href=""></a> Pfam Profile Search</h2>
				</div><?php if ($exist ==1){
				echo '<table align="center" width="80%" border="1" cellpadding="2" cellspacing="0"  bgcolor="">';

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
					$pfam_acc = $bdd->query("SELECT DISTINCT locus, pfam_acc, pfam_name, pfam_start, pfam_stop, length FROM pfam_domain WHERE pfam_acc = '$a'");
					
					// Affichage de la sequence d'adn du gene
					echo'<tr><th bgcolor="" height=10 colspan="">locus</th><th height=10 colspan="">pfam_acc</th><th height=10 colspan="">pfam_name</th><th height=10 colspan="">pfam_start</th><th height=10 colspan="">pfam_stop</th><th height=10 colspan="">length</th></tr>';
					$i=0;
					while ($data = $pfam_acc->fetch()){
						$i++;
						//echo $data['chromosome']."\t";
						//echo $data['protein_name']."\n";

						echo'<tr>';
						echo'<td align="center" class="table_text" onclick="changeText(this)">'; echo $data['locus']; echo'</td>'; 
						echo'<td align="center" class="table_text" onclick="this.innerHTML=1">'; echo $data['pfam_acc']; echo'</td>'; 
						echo'<td align="center" class="table_text">'; echo $data['pfam_name']; echo'</td>'; 
						echo'<td align="center" class="table_text">'; echo $data['pfam_start']; echo'</td>'; 
						echo'<td align="center" class="table_text">'; echo $data['pfam_stop']; echo'</td>'; 
						echo'<td align="center" class="table_text">'; echo $data['length']; echo'</td>'; 
						echo'</tr>';
						//echo $data['pfam_score']."\t";
						//echo $data['Evalue']."\n";
						//echo $data['pfam_description']."\t";

						

					}$pfam_acc->closeCursor();
					
					if ($data != $pfam_acc) {  // Si le bon identifiant de pfam n'est pas fournit alors
						//echo "Identifiant de contig incorrect\n";
					}
				echo '	
				
  				</table>';
  				}

				?>	
				</textarea>
				</td>




				<script>
					function changeText(id) {
						//var a = "<?php echo $data['locus']; ?>";
						//document.write (a);
						//document.write(id);
						//console.log(document.getElementById(id).value); // javascript
					  	id.innerHTML = 1;
					}
				</script>





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
