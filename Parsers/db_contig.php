<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Operations sur les fichiers</title>
    </head>
    
    <body>
        
        <?php
            
            // Ouverture du fichier avec le mode r
            $file = fopen('contigs_concatene.fasta', 'r');

            // Lecture complete du fichier
            echo '<pre>';

            $seq_contig = "";

            while (!feof($file)) {

                $line = fgets($file, filesize('contigs_concatene.fasta'));

                if (preg_match("#^>#", $line)) {

                    // recuperation de l'id du contig
                    $regex1 = '#>AAID([0-9]{8})|AAID([0-9]{9})#i';
                    preg_match_all($regex1, $line, $out);
                    foreach ($out[0] as $sortie)
                        $id_contig = $sortie;
                        echo $id_contig.'<br>';       

                    // recuperation du numero de contig
                    $regex2 = '#CONTIG_([0-9]{1})|CONTIG_([0-9]{2})#i';
                    preg_match_all($regex2, $line, $out);
                    foreach ($out[0] as $sortie)
                        $num_contig = $sortie;   
                        echo $num_contig.'<br>';          

                    // recuperation du numero du supercontig
                    $regex3 = '#\t\t([0-9]{1})\s|\t\t([0-9]{2})\s|\t\t([0-9]{3})\s#';
                    preg_match_all($regex3, $line, $out);
                    foreach ($out[0] as $sortie)
                        $des_contig = $sortie;
                        echo $des_contig.'<br>';

                    // recuperation de la localisation de la sequence dans le genome
                    $regex4 = '#\[(.*)\]#i';
                    preg_match_all($regex4, $line, $out);
                    foreach ($out[0] as $sortie)
                        $localisation = $sortie;
                        echo $localisation.'<br>';

                    // recuperation de la taille de la sequence
                    $regex5 = '#\s([0-9]{3})\s|\s([0-9]{4})\s|\s([0-9]{5})\s|\s([0-9]{6})\s|\s([0-9]{7})\s#';
                    preg_match_all($regex5, $line, $out);
                    foreach ($out[0] as $sortie)
                        $length_contig = $sortie;
                        echo $length_contig.'<br>';

                }else {

                    $seq_contig = $line;
                    echo $seq_contig;
                }

                $seq_contig = "";
                

            }

            echo '<pre>';

            /* Fermeture du fichoer */
            fclose($file);
            
        ?>

    </body>
</html>
