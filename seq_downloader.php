<!DOCTYPE html>
<!-- 
seq_dowloader permet à un utilisateur d'interroger la base de données genomique de Botritus.
Il suffit à l'utilisateur d'entrer un identifiant de gene et à partir de la liste deroulante, choisir s'il 
souhaite afficher la sequence d'adn du gene proprement dit ou le transcrit du gene ou la sequence proteine du gene.
Le bouton Download permet ensuite à l'utilisateur de télécharger son resultat sous forme de fichier texte.
-->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>Sequence Downloader - BIO-Analysis tools</title>
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
		$gene = "";
		
		if ((isset($_POST['id_gene'])) && ($_POST['id_gene'] != '')){
			
			$a = $_POST['id_gene'];
			$transcrit_a = preg_replace('/BC1G_*/','BC1T_',$a);
			$unit=$_POST['unit'];
			
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
            if ($unit == 'sequence_dna'){
				$gene = $bdd->query("SELECT * FROM gene WHERE id_gene = '$a'");
				$gene->closeCursor();
			}
			if ($unit == 'translate_to_rna'){
				$transcrit = $bdd ->query("SELECT * FROM transcrit WHERE id_trans = '$transcrit_a'");
				$transcrit->closeCursor();
			}
			if ($unit == 'translate_to_protein'){
				$proteine = $bdd->query("SELECT * FROM proteine WHERE id_gene = '$a'");
				$proteine->closeCursor();
			}
			$exist = 1;

		}else{
			$a = "";
			$transcrit_a = "";
			$unit = 'sequence_dna';
		}
		?>
		</TABLE>	

		<!-- MAIN -->
		<div class="main_container">
			<p><p style="text-align:center"><b>Saquence-Downloader</b></style></p>
			<br>

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:center;">Veuillez entrer votre identifiant de sequence.</style></p>
				<input type = "string" name="id_gene" rows = "1" cols= "50" placeholder="BC1G_00001"/></br></br>
				<!-- listes deroulantes pour permettre a l'utilisateur de choisoir l'info qu'il veut afficher -->
				<td>
				    <select name="unit">
						<option value="sequence_dna"<?php if ($unit == 'sequence_dna'){echo "selected";}?>>sequence_dna </option>
						<option value="translate_to_rna"<?php if ($unit == 'translate_to_rna'){echo "selected";}?>>translate_to_rna</option>
						<option value="translate_to_protein"<?php if ($unit == 'translate_to_protein'){echo "selected";}?>>translate_to_protein</option>
					</select>
				</td>

				<!-- Bouton pour affichage de resultat -->
				<input type="submit" value="submit" />
				<br>
				<!-- Resultat -->
				<p><p style="text-align:left;">Resultat:</style></p>
				<td>
				<!-- La zone de texte -->
				<textarea id="my-textarea" type="text" name="fichier" rows="20" cols="100"><?php if ($exist ==1){
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
					$gene = $bdd->query("SELECT * FROM gene WHERE id_gene = '$a'");
					$transcrit = $bdd ->query("SELECT * FROM transcrit WHERE id_trans = '$transcrit_a'");
					$proteine = $bdd->query("SELECT * FROM proteine WHERE id_gene = '$a'");
					
					// Affichage de la sequence d'adn du gene
					if ($unit == 'sequence_dna'){
						$i=0;
						while ($data = $gene->fetch()){
							$i++;
							echo "> ".$data['id_gene']."\n";
							echo $data['seq_gene']."\n\n";
						}$gene->closeCursor();
						

					}

					// Affichage de la sequence transcrite du gene
					if ($unit == 'translate_to_rna'){
						$i=0;
						while ($data = $transcrit->fetch()){
							$i++;
							$t = '/T/'; $u = 'U';
							echo "> ".$data['id_trans']."\n";
							echo preg_replace($t,$u,$data['seq_trans'])."\n\n";
						}$transcrit->closeCursor();

					}
					
					// Affichage de la sequence proteique du gene
					if ($unit == 'translate_to_protein'){
						$i=0;
						while ($data = $proteine->fetch()){
							$i++;
							echo "> ".$data['id_prot']."\n";
							echo $data['seq_prot']."\n\n";
						}$proteine->closeCursor();

					}
				} 
				?>	
				</textarea>

				<!-- 
				télécharger le contenu du textarea sous forme de fichie.txt avec utilisation de 
				javascript. on specifie ici dans la balise textearea ci dessus que id="my-textarea"
				-->
				<script type="text/javascript">
					function download(){
					    var text = document.getElementById("my-textarea").value;
					    text = text.replace(/\n/g, "\r\n"); // To retain the Line breaks.
					    var blob = new Blob([text], { type: "text/plain"});
					    var anchor = document.createElement("a");
					    anchor.download = "my-filename.txt";
					    anchor.href = window.URL.createObjectURL(blob);
					    anchor.target ="_blank";
					    anchor.style.display = "none"; // just to be safe!
					    document.body.appendChild(anchor);
					    anchor.click();
					    document.body.removeChild(anchor);
					}
				</script>

				<!-- buton Download-->
				<button type="button" onclick="download()">Download</button>
	
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
