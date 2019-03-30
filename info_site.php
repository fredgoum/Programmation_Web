<!-- 
contig.php permet a l'utilisateur d'avoir un resumé d'information sur un contig 
contenu dans la Bases de données, juste en ayant spécifier son identifiant.
-->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>Information Site - BIO-Analysis tools</title>
  </head>

  <body>
	<div class="header">
	<!-- L'entete du site web -->
    <?php include("barre_recherche.php"); ?>	
    </div>

	<div class="mega_container" >

	<h2><a href="gene.php">Genes</a></h2>
		<p>
			permet a l'utilisateur d'avoir un resumé d'information sur un gene contenu dans la Bases de données, juste en ayant spécifier son identifiant.
		<p>

	<h2><a href="transcrit.php">Transcripts</a></h2>
		<p>
			permet a l'utilisateur d'avoir un resumé d'information sur un transcrit de gene contenu dans la Bases de données, juste en ayant spécifier son identifiant.
		</p>

	<h2><a href="protein.php">Proteins</a></h2>
		<p>
			permet a l'utilisateur d'avoir un resumé d'information sur une sequence proteique de gene contenu dans la Bases de données, juste en ayant spécifier son identifiant.
		</p>

	<h2><a href="contig.php">Contigs</a></h2>
		<p>
			permet a l'utilisateur d'avoir un resumé d'information sur un contig contenu dans la Bases de données, juste en ayant spécifier son identifiant.
  		</p>

  	<h2><a href="seq_downloader.php">Sequence downloader</a></h2>
  		<p>
  			permet à un utilisateur d'interroger la base de données genomique de Botritus.</br>
  			Il suffit à l'utilisateur d'entrer un identifiant de gene et à partir de la liste deroulante, choisir s'il 
  			souhaite afficher la sequence d'adn du gene proprement dit ou le transcrit du gene ou la sequence proteine du gene.
  			Le bouton Download permet ensuite à l'utilisateur de télécharger son resultat sous forme de fichier texte.
  		</p>
		
  	<h2><a href="find_ORF.php">ORF Finder</a></h2>
  		<p>
			permet à un utilisateur d'interoger la base de données botrytis sur n'importe quel gene en indiquant l'identifiant de ce dernier. </br>L'utilisateur peut traduire la sequence nucleptidique du gene en sequence peptique (dans le cadre ouvert de lecture 1), et ensuite choisir d'afficher les regions codantes du gene (ORFs)
		</p>

  	<h2><a href="domains_pfam.php">Pfam domains</a></h2>
		<p>
			permet de faire une collection de famille de proteine pour un profil Pfam donné. </br>L'utilisateur entre un profil de pfam et selectionne tous les genes contenant des domains pfam dans la base de données de Botrytis cinerea (ici GENOME BOTRYTIS CINEREA).</br>
			e.g : PF02727.8 renvoie tous les genes contenant le domaine PF02727.8</br>
			==> collection de famille de proteines.
		</p>


	</div>

	<!-- FOOTER -->
    <footer>
        <?php include("footer.php"); ?>
    </footer>

  </body>
</html>
