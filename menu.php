<!-- DOCTYPE: HTML -->

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="">
		<title>Menu - BIO-Analysis tools</title>
	</head>

	<body>
		<!-- MENU -->
		<div class="topnav">
			<a href="main.php">BIO-Analysis Tools</a>
			<div class="dropdown">
				<button class="dropbtn">Genome information</button>
				<div class="dropdown-content">
					<a href="gene.php">Genes</a>
					<a href="transcrit.php">Transcripts</a>
					<a href="protein.php">Proteins</a>
					<a href="contig.php">Contigs</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Sequence trad</button>
				<div class="dropdown-content">
					<a href="translation_alignement.php">Show translation aligned</a>
					<a href="find_ORF.php">ORF finder</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Analysis data</button>
				<div class="dropdown-content">
					<a href="seq_downloader.php">Sequence downloader</a>
					<a href="blast.php">BLAST tool</a>
					<a href="domains_pfam.php">Pfam domains</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">Ressources</button>
				<div class="dropdown-content">   
					<a href="https://www.ncbi.nlm.nih.gov/">NCBI</a>
					<a href="https://www.ncbi.nlm.nih.gov/orffinder/">ORFs Finder</a>
					<a href="https://blast.ncbi.nlm.nih.gov/Blast.cgi">BLAST Tool</a>
				</div>
			</div>
			<a href="login.php">Log in</a>
			<a href="signup.php">Signup</a>
			<a href="info_site.php">Aide</a></br>
			<div class="connect_text">You are not authentified yet.</div>
		</div>
	</body>
</html>