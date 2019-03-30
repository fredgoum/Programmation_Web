<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Operations sur les fichiers</title>
    </head>
    
    <body>
        
        <?php
            
            // Ouverture du fichier avec le mode r
            $file = fopen('genes_sequence_concatene.fasta', 'r');

            // Lecture complete du fichier
            echo '<pre>';

            $seq_gene = "";

            while (!feof($file)) {

                $line = fgets($file, filesize('genes_sequence_concatene.fasta'));

                if (preg_match("#^>#", $line)) {

                    // recuperation de l'id du gene
                    $regex1 = '#>BC1G_([0-9]{5})|BC1G_([0-9]{6})#i';
                    preg_match_all($regex1, $line, $out);
                    foreach ($out[0] as $sortie)
                        $id_gene = $sortie;   
                        echo $id_gene.'<br>';

                    // recuperation de la description du gene
                    $regex2 = '#Botrytis(.*)#i';
                    preg_match_all($regex2, $line, $out);
                    foreach ($out[0] as $sortie)
                        $des_gene = $sortie;
                        echo $des_gene.'<br>';

                    // recuperation de la taille de la sequence du gene
                    $regex3 = '#([0-9]{3})\s|([0-9]{4})\s|([0-9]{5})\s|([0-9]{6})\s|([0-9]{7})\s#';
                    preg_match_all($regex3, $line, $out);
                    foreach ($out[0] as $sortie)
                        $length_gene = $sortie;
                        echo $length_gene.'<br>';
  

                }else {

                    $seq_gene = $line;
                    echo $seq_gene;

                }




                $seq_gene = "";


            }
            echo '<pre>';

            /* Fermeture du fichoer */
            fclose($file);
            
        ?>

    </body>
</html>
