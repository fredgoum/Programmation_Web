<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Operations sur les fichiers</title>
    </head>
    
    <body>
        
        <?php
            
            // Ouverture du fichier avec le mode r
            $file = fopen('proteines_sequence_concatene.fasta', 'r');

            // Lecture complete du fichier
            echo '<pre>';

            $seq_prot = "";

            while (!feof($file)) {

                $line = fgets($file, filesize('proteines_sequence_concatene.fasta'));

                if (preg_match("#^>#", $line)) {

                    // recuperation de l'id de la proteine
                    $regex1 = '#>BC1T_([0-9]{5})|BC1T_([0-9]{6})#i';
                    preg_match_all($regex1, $line, $out);
                    foreach ($out[0] as $sortie)
                        $id_prot = $sortie;     
                        echo $id_prot.'<br>';

                    // recuperation de l'id du gene codant pour la proteine
                    $regex2 = '#BC1G_([0-9]{5})|BC1G_([0-9]{6})#i';
                    preg_match_all($regex2, $line, $out);
                    foreach ($out[0] as $sortie)
                        $id_gene = $sortie;     
                        echo $id_gene.'<br>';

                    // recuperation de la description de la proteine
                    $regex3 = '#Botrytis(.*)aa\)#i';
                    preg_match_all($regex3, $line, $out);
                    foreach ($out[0] as $sortie)
                        $des_prot = $sortie;
                        echo $des_prot.'<br>';

                    // recuperation de la taille de la sequence proteique
                    $regex4 = '#([0-9]{2})\s|([0-9]{3})\s|([0-9]{4})\s|([0-9]{5})\s|([0-9]{6})\s#';
                    preg_match_all($regex4, $line, $out);
                    foreach ($out[0] as $sortie)
                        $length_prot = $sortie;
                        echo $length_prot.'<br>';



                }else {

                    $seq_prot=$line;
                    echo $seq_prot;

                }

                
                $seq_prot.= "";

            }


            echo '<pre>';
            /* Fermeture du fichier */
            fclose($file);
            
        ?>

    </body>
</html>
