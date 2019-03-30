<!-- DOCTYPE: HTML -->

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="base.css">
    <title>G/C percentage computer - BIO-Analysis tools</title>
  </head>

  <body>
    <div class="header">
    <p><i><font color="#FFFFFF">Insert image here</font></i></p>
    </div>

    <div class="mega_container">

        <!-- MENU -->
        <?php include("menu.php"); ?>

        <?php /*CONVERT FUNCTION*/
        $exist = 0;
    
        if ((isset($_POST['sequence'])) && ($_POST['sequence'] != '')){
            // Get the sequence
            $sequence_0 = strtoupper($_POST['sequence']);           
            // Remove unnecessary characters
            $sequence = preg_replace("/(\r\n|\n|\r )/","",$sequence_0); 

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

            $exist = 1;

            // Traduction dans les differents cadres de lecture
            // Traduction dans le sens 5'-3'
            $frame_1=translate_DNA_to_protein(substr ($sequence, 0, floor(strlen($sequence)/3)*3));
            $frame_2=translate_DNA_to_protein(substr ($sequence, 1,floor((strlen($sequence)-1)/3)*3));
            $frame_3=translate_DNA_to_protein(substr ($sequence, 2,floor((strlen($sequence)-2)/3)*3));

            // Sequence complementaire
            function seq_comp_dna($sequence){
                $sequence= strtoupper($sequence);
                $original=  array("(A)","(T)","(G)","(C)","(Y)","(R)","(W)","(S)","(K)","(M)","(D)","(V)","(H)","(B)");
                $complement=array("t","a","c","g","r","y","w","s","m","k","h","b","d","v");
                $sequence = preg_replace ($original, $complement, $sequence);
                $sequence= strtoupper ($sequence);
                return $sequence;
            }
            // Traduction sequence complementaire sens 3'-5'
            $seq_comp_dna = seq_comp_dna($sequence);
            $frame_4=translate_DNA_to_protein(substr ($seq_comp_dna, 0,floor(strlen($seq_comp_dna)/3)*3));
            $frame_5=translate_DNA_to_protein(substr ($seq_comp_dna, 1,floor((strlen($seq_comp_dna)-1)/3)*3));
            $frame_6=translate_DNA_to_protein(substr ($seq_comp_dna, 2,floor((strlen($seq_comp_dna)-2)/3)*3));

            /*
                
                Recheche ORFs

            */
            
        }else{
            $sequence = "";
        } 
        ?>    

        <!-- MAIN -->

        <div class="main_container">
            <p><p style="text-align:center"><b>DNA to Protein</b></style></p>
            <br><br><br>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p><p style="text-align:center">Please input a DNA sequence in the box below.</style></p>
                <textarea type="text" name="sequence" rows="20" cols="133"><?php echo $sequence;?></textarea></br>
                
                <!-- Bouton convertir -->
                <input type="submit" name="compute" value="Convert">
                <br>
                
                <!-- Resultat sequence proteique obtenue -->
                <p><p style="text-align:center">Protein output:</style></p>
                <textarea type="text" readonly name="peptide" rows="20" cols="133"><?php if ($exist ==1){
                    echo "seq_dna : ".$sequence."\n\n";
                    echo "frame 1 : ".$frame_1."\n";
                    echo "frame 2 : ".$frame_2."\n";
                    echo "frame 3 : ".$frame_3."\n\n";

                    echo "seq_comp: ".$seq_comp_dna."\n\n";
                    echo "frame 4 : ".$frame_4."\n";
                    echo "frame 5 : ".$frame_5."\n";
                    echo "frame 6 : ".$frame_6."\n\n";
                } 
                ?>
                </textarea>
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


