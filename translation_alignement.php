<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>Find ORF in Contig- BIO-Analysis tools</title>
  </head>

  <body>
	<div class="header">
	<!-- L'entete du site web -->
    <?php include("barre_recherche.php"); ?>
    </div>

	<div class="mega_container">
	</br></br>
		<TABLE>
		<?php
		$ng=0;
		$nc=0;
		$na=0;
		$nt=0;
		$seq_exist=0;

		if ((isset($_POST['seq'])) && ($_POST['seq'] != '')){
		  
		  $seq2=$_POST['seq'];
		  $seq3 = preg_replace("/(\r\n|\n|\r| )/","", $seq2);
		  $seq=strtoupper($seq3);
		  $seq_exist=1;
		  
		  if (preg_match("/^[ACGT]+$/",$seq))
			  {  
				for ($i = 0; $i <= strlen($seq)-1; $i++){
					if ($seq[$i] == 'C'){
						$nc++;
					}		
					if ($seq[$i] == 'G'){
						$ng++;
					}
					if ($seq[$i] == 'A'){
						$na++;
					}		
					if ($seq[$i] == 'T'){
						$nt++;
					}
					$gc=($nc+$ng)/strlen($seq);
					$gc=round($gc,2);
					$t= (4*($nc+$ng) + 2*($na+$nt)-4);
					}
			  }
		} else {
			
			$seq = '';
		}
		?>
		</TABLE>

		<?php

		// Fonction pour convertir sequence nucleotidique du gene en sequence peptidique
		function translate_dna_to_protein($seq) {
	        // $aminoacids is the array of aminoacids
	        $aminoacids=array("F","L","I","M","V","S","P","T","A","Y","*","H","Q","N","K","D","E","C","W","R","G","X");
	        // Standard genetic code
	        $triplets[1]=array("(TTT |TTC )","(TTA |TTG |CT. )","(ATT |ATC |ATA )","(ATG )","(GT. )","(TC. |AGT |AGC )",
	                    "(CC. )","(AC. )","(GC. )","(TAT |TAC )","(TAA |TAG |TGA )","(CAT |CAC )",
	                    "(CAA |CAG )","(AAT |AAC )","(AAA |AAG )","(GAT |GAC )","(GAA |GAG )","(TGT |TGC )",
	                    "(TGG )","(CG. |AGA |AGG )","(GG. )","(\S\S\S )");
	        // place a space after each triplete in the sequence
	        $temp = chunk_split($seq,3,' ');
	        // replace triplets by corresponding aminoacid 
	        $peptide = preg_replace($triplets[1], $aminoacids, $temp);

	        // return peptide sequence
	        return $peptide;
    	}

    	$peptide_sequence_1 = translate_dna_to_protein(substr ($seq, 0, floor(strlen($seq)/3)*3));
    	//echo "Peptide_sequence Frame 1 + :\n".$peptide_sequence_1."\n\n";
    	// Frame 2
    	$peptide_sequence_2= translate_dna_to_protein(substr ($seq, 1, floor((strlen($seq)-1)/3)*3));
    	//echo "Peptide_sequence Frame 2 + :\n".$peptide_sequence_2."\n\n";
    	// Frame 3
		$peptide_sequence_3=translate_dna_to_protein(substr ($seq, 2, floor((strlen($seq)-2)/3)*3));
		//echo "Peptide_sequence Frame 1 + :\n".$peptide_sequence_3."\n\n";
    	

		function RevComp_DNA($seq){
	        $seq= strtoupper($seq);
	        $original=  array("(A)","(T)","(G)","(C)","(Y)","(R)","(W)","(S)","(K)","(M)","(D)","(V)","(H)","(B)");
	        $complement=array("t","a","c","g","r","y","w","s","m","k","h","b","d","v");
	        $seq = preg_replace ($original, $complement, $seq);
	        $seq= strtoupper ($seq);
	        return $seq;
		}

		// Translate the complementary  sequence
		//echo "\t\t\t\t\t\tCDS COORDINATES (3'-5') :\n";
		$rvsequence0= RevComp_DNA($seq);
		//echo $rvsequence0."\n\n";
		$rvsequence = strrev($rvsequence0)."\n\n";
		//echo "complementary sequence :\n".$rvsequence."\n\n";
        //calculate frames 4-6
        // Frame 4
        $peptide_sequence_4 =translate_dna_to_protein(substr ($rvsequence, 0, floor(strlen($rvsequence)/3)*3));
        //echo "Peptide_sequence Frame 1 - :\n".$peptide_sequence_4."\n\n";
        // Frame 5
        $peptide_sequence_5 =translate_DNA_to_protein(substr ($rvsequence, 1,floor((strlen($rvsequence)-1)/3)*3));
        //echo "Peptide_sequence Frame 2 - :\n".$peptide_sequence_5."\n\n";
        // Frame 6
		$peptide_sequence_6 =translate_DNA_to_protein(substr ($rvsequence, 2,floor((strlen($rvsequence)-2)/3)*3));
		//echo "Peptide_sequence Frame 3 - :\n".$peptide_sequence_6."\n\n";

        ?>

        <center>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			Votre s&eacute;quence : <br><textarea name="seq" rows="10" cols="80">ATGTCTAGAATGGGTGATCCATACCGAAATTCCTCGGAAACCCTAAGCAGCCGTGGCGGTGGGGGGAACCGTTGGGACACTGAGCGGTTCGCCTCGGAGCGCGACCGAGTCCGTTTTGCAGCAGACCGAGAAGAGCGAGATTCACGATTTCTCAGAGCTACAGGTGGTGGCGGTCATACACGAGAACGATCTTACGATGACGTTTATGAACGTCGAGGGCCACGAGGATACGAAGAGGAGCGAGAACATTATGACGAACGAGATTATTACGATTCACCCAGACTTCAACGAGAGCGAGAACCAGAACTAGGACGACAAAGATCTACAACTATTACAATGGAAAGAGAGCGAGAGAGGGAAAGAGATGATTCTCCACCTCCTCGAAGAGCTGGTGGCAGACCCGCATTTTTGAGAAGACAGAGCTCCCTGGATACATTTGACCGCAAGCCTTTGGTTAGGTATGAGCGAGAAGCGGAGAGGTTGAGGGATGAATATGGTCCACCTGCCAGACGCCCAGAT</textarea>
			<div align=center>
                <input type=submit value="&nbsp; Show Translation Aligned &nbsp;">
        	</div><p>
			
			<?php
				if ($seq_exist == 1){
					//echo "<br><br>le taux de GC est &eacute;gal &agrave; : $gc";
					//echo "<br><br>la temperature d'hybridation; gal &agrave; : $t";

					$scale="         10        20        30        40        50        60        70        80        90         ";
			        $barr="         |         |         |         |         |         |         |         |         |          ";

			        $peptide_sequence_1_1 = chunk_split($peptide_sequence_1,1,'  ');
			        $peptide_sequence_2_2 = chunk_split($peptide_sequence_2,1,'  ');
			        $peptide_sequence_3_3 = chunk_split($peptide_sequence_3,1,'  ');

			        $peptide_sequence_4_4 = chunk_split($peptide_sequence_4,1,'  ');
			        $peptide_sequence_5_5 = chunk_split($peptide_sequence_5,1,'  ');
			        $peptide_sequence_6_6 = chunk_split($peptide_sequence_6,1,'  ');

			        print "<center><table><tr><td nowrap><pre>\n";
			        // Show translation of of sequence in 5'->3' direction
			        print "<b>Translation of requested code (5'->3')</b>\n\n  $scale\n$barr\n";
			        $i=0;
			        while($i<strlen($seq)){
			                print substr($seq,$i,100)."  ";
			                if ($i<strlen($seq)-$i){print $i+100;}
			                print "\n";
			                print substr($peptide_sequence_1_1,$i,100)."\n";
			                print substr(" ".$peptide_sequence_2_2,$i,100)."\n";
			                print substr("  ".$peptide_sequence_3_3,$i,100)."\n\n";
			               	$i+=100;
			        }
			        // Show translation of complementary sequence
			        // only when requested corresponding frames has been obtained
		           print "<b>Translation of requested code (complementary DNA chain)</b>\n\n  $scale\n$barr\n";
		           $i=0;
		           while($i<strlen($rvsequence)){
		                print substr($rvsequence,$i,100)."  ";
		                if ($i<strlen($seq)-$i){print $i+100;}
		                print "\n";
		                print substr($peptide_sequence_4_4,$i,100)."\n";
		                print substr(" ".$peptide_sequence_5_5,$i,100)."\n";
		                print substr("  ".$peptide_sequence_6_6,$i,100)."\n";
		                $i+=100;
		           }
			}
			?>
		</form>
		</center> 
	</div>
<p><i><a href="main.php">Back to homepage</a></i></p>

	<!-- FOOTER -->
    <footer>
        <?php include("footer.php"); ?>
    </footer>

  </body>
</html>