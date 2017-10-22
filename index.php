<?php
    //Connexion à la BDD
    include_once('include/connect.php');
    //Library SimpleHTMLDom
    include_once('include/simple_html_dom.php');
    //Fichiers de fonctions
    include_once('include/functions.php');
      
    ClearTable($dbh, 'tbl_lines_directions');
    ClearTable($dbh, 'tbl_stops');

    $previousLine = '';
    $linesDirectionsIndex = 0;
    //Régions
    foreach(FetchTableFromDatabase($dbh, 'tbl_regions') as $region){
        echo '<b>Lignes - directions pour la région '.$region['name'].'</b><br>';
        $directionIndex = 0;
        foreach(FetchLinesAndDirectionsFromWebsite($region['url']) as $lineDirections){
            $directionIndex++;
            
            //Il n'est pas vide (premier élément)
            if($previousLine !== ''){
                //Nouvel ligne dans l'itération
                if($previousLine !== substr($lineDirections, 0, 3) || $directionIndex > 2){
                    //On remet l'index à 1
                    $directionIndex = 1;
                } 
            }
            //On enregistre la ligne courant comme étant la precedante dans la prochaine itération
            $previousLine = substr($lineDirections, 0, 3);
            
            //Enregistre dans la bdd
            echo '<b>'.$directionIndex.' | '.$lineDirections.'<br></b>';
            InsertInDatabase($dbh, 'tbl_lines_directions', array('name' => $dbh->quote(addslashes($lineDirections)), 'numRegion' => $region['id']));
            $linesDirectionsIndex++;

            //Apelle la fonction pour les arrêts.
            foreach(FetchStopsFromWebsite($region['url'], substr($lineDirections, 0, 3), $directionIndex) as $stop => $url){
                InsertInDatabase($dbh, 'tbl_stops', array('name' => $dbh->quote(addslashes($stop)), 'urlpdf' => $dbh->quote($url), 'numLinesDirections' => $linesDirectionsIndex));
            }
        }
    }
