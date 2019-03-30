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
			<?php include("header.php"); ?>
		</div>

		<div class="mega_container">

			<!-- MAIN -->
			<div class="main_container">
			
				<?php
					$exist = 0;
					if ((isset($_POST['query_id'])) && ($_POST['query_id'] != '')){
					
						$a = $_POST['query_id'];
						$blast=$_POST['blast'];

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

						if(($blast == 'blastn') || ($blast == 'blastx')){			##Input: Nucleotide
							$seq = $bdd->query("SELECT seq_gene FROM gene WHERE id_gene = '$a'");
						}else if (($blast == 'blastp') || ($blast == 'tblastn')){	##Input: Amino-acids
							$seq = $bdd->query("SELECT seq_prot FROM proteine WHERE id_prot = '$sa'");
						}
						$seq->closeCursor();

						$exist = 1;

						if ($exist != 1) {
							echo "Incorrect gene ID\n";
						}
					}else{
						$blast = '';
						$a = '';
					}
				?>
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
						<p><p style="text-align:center"><b>Select the BLAST type you want to perform.</b></style></p>
						<p><p style="text-align:center"><select name="blast" form="blast">
							<option value="blastp">BLASTp</option>			<!-- Protein against protein -->
							<option value="blastx">BLASTx</option>			<!-- Nucleotide against protein -->
							<option value="blastn">BLASTn</option>			<!-- Nucleotide against nucleotide -->
							<option value="tblastn">tBLASTn</option>		<!-- Protein against nucleotide -->
						</select></style></p>
						<p><p style="text-align:center"><b>Enter here the ID of the sequence to BLAST.</b></style></p>
						<p><p style="text-align:center"><input type="id" name="id" required>			<!-- Be sure this is not empty -->
						<input type="submit" value="Launch BLAST">
						<br><br><br>
						<textarea type="text" name="results" rows="100" cols="100">
						<?php
							if ($exist == 1){
								$outfile = $a.$blast.".bl";
								try{
									$bdd = new PDO('mysql:host=localhost;dbname=GENOME_BOTRYTIS_CINEREA;charset=utf8', 'root', '');
								}
								catch(Exception $e){
									die('Error : '.$e->getMessage());
								}
								if(($blast == 'blastn') || ($blast == 'blastx')){			##Input: Nucleotide
									$seq = $bdd->query("SELECT seq_gene FROM gene WHERE id_gene = '$a'");
								}else if (($blast == 'blastp') || ($blast == 'tblastn')){	##Input: Amino-acids
									$seq = $bdd->query("SELECT seq_prot FROM proteine WHERE id_prot = '$sa'");
								}
								$seq->closeCursor();
								
								##Execute BLAST
								
								if($blast == 'blastp'){
									echo shell_exec('blastp -query $seq -outfmt "7 qseqid sseqid qlen slen length pident evalue" -out $outfile');
								}else if ($blast == 'blastx'){
									echo shell_exec('blastx -query $seq -outfmt "7 qseqid sseqid qlen slen length pident evalue" -out $outfile');
								}else if ($blast == 'blastn'){
									echo shell_exec('blastn -query $seq -outfmt "7 qseqid sseqid qlen slen length pident evalue" -out $outfile');
								}else{		##tblastn
									echo shell_exec('tblastn -query $seq -outfmt "7 qseqid sseqid qlen slen length pident evalue" -out $outfile');
								}
							}
						?>
						</textarea></style></p>
				</form>
			</div>

		</div>

		<!-- FOOTER -->
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
