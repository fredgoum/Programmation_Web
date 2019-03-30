<!-- 
gene.php permet a l'utilisateur d'avoir un resumé d'information sur un gene 
contenu dans la Bases de données, juste en ayant spécifier son identifiant.
-->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>Gene information - BIO-Analysis tools</title>
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
		
		if ((isset($_POST['id_gene'])) && ($_POST['id_gene'] != '')){
			
			$a = $_POST['id_gene'];
			
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
			$gene = $bdd->query("SELECT * FROM gene INNER JOIN gene_summary ON gene.id_gene=gene_summary.locus WHERE gene.id_gene = '$a'");
			$gene->closeCursor();

			$exist = 1;

			if ($exist != 1) {
				echo "Identifiant de gene incorrect\n";
			}

		}else{
			
			$a = "";
		}
		?>

		</TABLE>	
		<!-- MAIN -->
		<div class="main_container">
			<p><p style="text-align:center"><b>Gene information</b></style></p>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:left;">Veuillez entrer votre identifiant de gene.</style></p><br>
				<input type = "string" name="id_gene" rows = "1" cols= "50" placeholder="BC1G_00001"/> &nbsp;

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
					$gene = $bdd->query("SELECT * FROM gene INNER JOIN gene_summary ON gene.id_gene=gene_summary.locus WHERE gene.id_gene = '$a'");
					// SELECT DISTINCT pfam_acc FROM `pfam_domain` WHERE locus='BC1G_00002';
					// affichage de la sequence d'adn du gene
					$i=0;
					while ($data = $gene->fetch()){
						$i++;
						//echo "SUMMARY"."\n";
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">SUMMARY</font></p>';
						echo "\t"."Gene indentifiant : ".$data['id_gene'].'<br>';
						echo "\t"."Gene description  : ".$data['des_gene'].'<br>';
						echo "\t"."Organisme	  : Botrytis Cinerea ".'<br>';
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">GENOMIC CONTEXT</font></p>';
						echo "\t"."Localisation 	: chromosome ".$data['chromosome'].'<br>';
						echo "\t"."Start 		: ".$data['start'].'<br>';
						echo "\t"."Stop 		: ".$data['stop'].'<br>';
						echo "\t"."Gene length 	: ".$data['length_gene'].'<br>';
						echo "\t"."Strand 	  	: ".$data['strand'].'<br>';
						echo "\t"."Exon count 	: ".'<br>';
						echo "\t"."Sequence   	: ".'<br>';
						//echo "\n"."GENERAL PROTEIN INFORMATION".'<br>';
						echo '<p><font style="text-align:center" face="sans-serif" color="#BB0000" size="3">GENERAL PROTEIN INFORMATION</font></p>';
						echo "\t"."Protein name : ".$data['protein_name'].'<br>';
						echo "\t"."Operon 	: ".$data['operon'].'<br>';
					}$gene->closeCursor();

					if ($data != $gene) {  // Si le bon identifiant de gene n'est pas fournit alors
						//echo "Identifiant de gene incorrect\n";
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
