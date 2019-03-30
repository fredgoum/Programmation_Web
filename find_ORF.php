<!-- 
Find_ORF permet à un utilisateur d'interoger la base de données botrytis sur n'importe quel gene
en indiquant l'identifiant de ce dernier.  L'utilisateur peut traduire la sequence nucleptidique 
du gene en sequence peptique (dans le cadre ouvert de lecture 1), et ensuite choisir d'afficher 
les regions codantes du gene (ORFs)
-->

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
			$gene = $bdd->query("SELECT seq_gene FROM gene WHERE id_gene = '$a'");
			$gene->closeCursor();
			
			$exist = 1;

		}else{
			$a = "";
		}
		?>
		</TABLE>	

		<!-- MAIN -->
		<div class="main_container">
			<p><p style="text-align:center"><b>Find ORF in gene sequence</b></style></p>
			<br>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:center">Veuillez entrer votre identifiant de gene.</style></p>
				<!-- champ identifiant du contig -->
				<input type = "string" name="id_gene" rows = "1" cols= "20" placeholder="BC1G_00002"/><br>
				<!-- Bouton pour affichage de resultat -->
				<input type="submit" value="submit"/><br>
				<!-- Resultat -->
				<!--<font face="sans-serif" color="#BB0000" size="3" >ORFs Search</font>-->
				<center>
				<h3><a href=""></a><font style="text-align:center" face="sans-serif" size="4">ORFs Search</font></h3>
				<td>
				<textarea type="text" name="seq_gene" rows="30" cols="130"><?php if ($exist ==1){
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
					$gene = $bdd->query("SELECT seq_gene FROM gene WHERE id_gene = '$a'");
					
					// Affichage de la sequence du contig
					$i=0;
					while ($data = $gene->fetch()){
						$i++;
						$sequence =  $data['seq_gene'];

						//echo "Sequence d'adn :\n\n".$sequence."\n\n";

						// Fonction pour convertir sequence nucleotidique du gene en sequence peptidique
						function translate_dna_to_protein($sequence) {
		                // $aminoacids is the array of aminoacids
		                $aminoacids=array("F","L","I","M","V","S","P","T","A","Y","*","H","Q","N","K","D","E","C","W","R","G","X");
		                // Standard genetic code
		                $triplets[1]=array("(TTT |TTC )","(TTA |TTG |CT. )","(ATT |ATC |ATA )","(ATG )","(GT. )","(TC. |AGT |AGC )",
		                            "(CC. )","(AC. )","(GC. )","(TAT |TAC )","(TAA |TAG |TGA )","(CAT |CAC )",
		                            "(CAA |CAG )","(AAT |AAC )","(AAA |AAG )","(GAT |GAC )","(GAA |GAG )","(TGT |TGC )",
		                            "(TGG )","(CG. |AGA |AGG )","(GG. )","(\S\S\S )");
		                // place a space after each triplete in the sequence
		                $temp = chunk_split($sequence,3,' ');
		                // replace triplets by corresponding aminoacid 
		                $peptide = preg_replace($triplets[1], $aminoacids, $temp);

		                // return peptide sequence
		                return $peptide;
		            	}

		            	// Fonction recherche ORF
						function find_ORF($peptide_sequence){
			                $peptide_sequence=strtolower($peptide_sequence); # renvoie la sequence en minuscules
          
			                $oligo=preg_split('/\*/',$peptide_sequence); # on split la la sequence à chaque codon stop
			                
			                foreach ($oligo as $m => $val){

			                	//if (strlen($val)>=10){
				           			if (preg_match_all('/m(.*)/', $oligo[$m], $out)){ // si on rencontre un met-stop alors on renvoie la sequence
					                    foreach ($out[0] as $sortie) {
					                        $of = $sortie;   
					                        if (strlen($of)>=10)  
					                        	echo $of."\n";
					                    }
					                }
					            //}
			                }
			        		return $peptide_sequence;
						}

						function RevComp_DNA($seq){
					        $seq= strtoupper($seq);
					        $original=  array("(A)","(T)","(G)","(C)","(Y)","(R)","(W)","(S)","(K)","(M)","(D)","(V)","(H)","(B)");
					        $complement=array("t","a","c","g","r","y","w","s","m","k","h","b","d","v");
					        $seq = preg_replace ($original, $complement, $seq);
					        $seq= strtoupper ($seq);
					        return $seq;
						}

		            	// Translate in  5-3 direction
		            	echo "\t\t\t\t\t\tCDS COORDINATES (5'-3'):\n";
		            	// Calculate frames 1-3
		            	// Frame 1
		            	$peptide_sequence_1 = translate_dna_to_protein(substr ($sequence, 0, floor(strlen($sequence)/3)*3));
		            	//echo "Peptide_sequence Frame 1 + :\n".$peptide_sequence_1."\n\n";
		            	// Frame 2
		            	$peptide_sequence_2= translate_dna_to_protein(substr ($sequence, 1, floor((strlen($sequence)-1)/3)*3));
		            	//echo "Peptide_sequence Frame 2 + :\n".$peptide_sequence_2."\n\n";
		            	// Frame 3
                		$peptide_sequence_3=translate_dna_to_protein(substr ($sequence, 2, floor((strlen($sequence)-2)/3)*3));
                		//echo "Peptide_sequence Frame 1 + :\n".$peptide_sequence_3."\n\n";
		            	
                		//echo "ORFs found :\n\n";
						echo "ORFs FOUND FOR FRAME 1 :\n"; $orf1 = find_ORF($peptide_sequence_1); echo "\n\n";
						echo "ORFs FOUND FOR FRAME 2 :\n"; $orf2 = find_ORF($peptide_sequence_2); echo "\n\n";
						echo "ORFs FOUND FOR FRAME 3 :\n"; $orf3 = find_ORF($peptide_sequence_3); echo "\n";


						// Translate the complementary  sequence
						echo "\t\t\t\t\t\tCDS COORDINATES (3'-5') :\n";
						$rvsequence0= RevComp_DNA($sequence);
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

			            echo "ORFs FOUND FOR FRAME 1 :\n"; $orf4 = find_ORF($peptide_sequence_4); echo "\n\n";
			            echo "ORFs FOUND FOR FRAME 2 :\n"; $orf5 = find_ORF($peptide_sequence_5); echo "\n\n";
			            echo "ORFs FOUND FOR FRAME 3 :\n"; $orf6 = find_ORF($peptide_sequence_6); echo "\n\n";

					}$gene->closeCursor();
					
				} 
				?>


					

			  </textarea>
			  </center>
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
