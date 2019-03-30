<!-- #!/bin/bash -->
<!-- DOCTYPE: HTML -->

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="base.css">
		<title>BLAST - BIO-Analysis tools</title>
	</head>

	<body>
		<!-- HEADER -->
		<div class="header">
			<?php include("barre_recherche.php"); ?>
		</div>

		<div class="mega_container">

			<!-- MAIN -->
			<div class="main_container">
			
				<?php
					
					/*
					echo "C'est Moi \n";
					
					echo shell_exec("makeblastdb -in colimin.fasta -dbtype prot -max_file_sz '50GB' -out colimin");
					echo shell_exec("blastp -query coliquery.fasta -db colimin -outfmt '7 qseqid sseqid qlen slen length pident evalue'");
					echo shell_exec('./bash_script.sh');


					exec('sh bash_script.sh', $output, $return_var);
					print_r($output);
					echo "$return_var\n";

					

					$old_path = getcwd();
					chdir('/opt/lampp/htdocs/public_html/Projet_Progweb');
					$output = shell_exec('./bash_script.sh');
					chdir($old_path);


					echo exec("/bin/bash bash_script.sh");


					//echo shell_exec('ls -l ')."\n";
					echo shell_exec("pwd");
					*/
					//echo shell_exec("./Exo_1.pl colimin.fasta");
					echo shell_exec("cd /usr/lib/x86_64-linux-gnu/");
					echo shell_exec("ncbi-blast-2.6.0+/bin/makeblastdb -in colimin.fasta -dbtype prot -max_file_sz '50GB' 2>&1");
					//echo shell_exec("ncbi-blast-2.6.0+/bin/blastp -query /home/alfred/coliquery.fasta -db /home/alfred/colimin -outfmt '7 qseqid sseqid qlen slen length pident evalue' 2>&1");

					



				
				?>
			</div>	
		</div>

		<!-- FOOTER -->
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
