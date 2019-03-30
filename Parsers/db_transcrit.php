<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Operations sur les fichiers</title>
    </head>
    
    <body>
        
        <?php
            
            // Ouverture du fichier avec le mode r
            $file = fopen('transcripts_sequence_concatene.fasta', 'r');

            // Lecture complete du fichier
            echo '<pre>';

            $seq_trans = "";

            while (!feof($file)) {

                $line = fgets($file, filesize('transcripts_sequence_concatene.fasta'));

                if (preg_match("#^>#", $line)) {

                    // recuperation de l'id du trancrit de gene
                    $regex1 = '#>BC1T_([0-9]{5})|BC1T_([0-9]{6})#i';
                    preg_match_all($regex1, $line, $out);
                    foreach ($out[0] as $sortie)
                        $id_trans = $sortie;     
                        echo $id_trans.'<br>';

                    // recuperation de la description du transcript de gene
                    $regex2 = '#Botrytis(.*)nt\)#i';
                    preg_match_all($regex2, $line, $out);
                    foreach ($out[0] as $sortie)
                        $des_trans = $sortie;
                        echo $des_trans.'<br>';

                    // recuperation de la taille de la sequence du transcrit de gene
                    $regex3 = '#([0-9]{3})\s|([0-9]{4})\s|([0-9]{5})\s|([0-9]{6})\s|([0-9]{7})\s#';
                    preg_match_all($regex3, $line, $out);
                    foreach ($out[0] as $sortie)
                        $length_trans = $sortie;
                        echo $length_trans.'<br>';


                    // recuperation des commentaires sur certains transcript
                    if (preg_match("#Note#i", $line)) {
                        $regex4 = '#Note(.*)#i';
                        preg_match_all($regex4, $line, $out);
                        foreach ($out[0] as $sortie)
                            $commentaire = $sortie;
                            echo $commentaire.'<br>';
                        /*
                        try
                        {
                            // On se connecte à MySQL
                            $bdd = new PDO('mysql:host=localhost;dbname=GENOME;charset=utf8', 'root', '');
                        }
                        catch(Exception $e)
                        {
                            // En cas d'erreur, on affiche un message et on arrête tout
                            die('Erreur : '.$e->getMessage());
                        }  
                        // On ajoute une entrée dans la table proteine
                        //$bdd->exec('INSERT INTO transcrit(id_trans,des_trans,length_trans,seq_trans,commentaire) VALUES("'.$id_trans.'","'.$des_trans.'","'.$length_trans.'","","'.$commentaire.'")');
                        */
                    }else{

                        echo " ".'<br>';
                    }
  

                }else {

                    $seq_trans=$line;
                    echo $seq_trans;

                    /*
                    $bdd->exec('INSERT INTO transcrit(id_trans,des_trans,length_trans,seq_trans,commentaire) VALUES("'.$id_trans.'","'.$des_trans.'","'.$length_trans.'","'.$seq_trans.'","")');
                    */
                }
                
                $seq_trans= "";

                // On ajoute une entrée dans la table proteine
                //$bdd->exec('INSERT INTO transcrit(id_trans,des_trans,length_trans,seq_trans,commentaire) VALUES("'.$id_trans.'","'.$des_trans.'","'.$length_trans.'","","")');

            }

            echo '<pre>';

            /* Fermeture du fichoer */
            fclose($file);
            
        ?>

    </body>
</html>
