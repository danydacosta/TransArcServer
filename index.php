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
    $urlLine = 0;

    //Loop dans les régions ==> 1, 'Littoral & Val-de-Ruz', 'https://m.transn.ch/transports-publics-neuchatelois/reseau-horaires/littoral-val-de-ruz.html
    foreach(FetchTableFromDatabase($dbh, 'tbl_regions') as $region){
        echo '<b>Lignes - directions pour la région '.$region['name'].'</b><br>';
        $directionIndex = 0;
        //Loop dans les lignes - directions ==> 102 - Temple des Valangines - Place Pury - Serrières
        foreach(FetchLinesAndDirectionsFromWebsite($region['url']) as $lineDirections){
            $directionIndex++;
            
            //Il n'est pas vide (premier élément)
            if($previousLine !== ''){
                //Nouvel ligne dans l'itération
                if($previousLine !== substr($lineDirections, 0, 3) || $directionIndex > 2){
                    //On remet l'index à 1
                    $directionIndex = 1;
                }
                
                //Ligne 341 (3, 4) -- A tester...
                if($directionIndex > 2 && $previousLine == 341){
                    $urlLine = 343;
                //Les autres lignes
                } else {
                    $urlLine = substr($lineDirections, 0, 3);
                }
            }
            //On enregistre la ligne courant comme étant la precedante dans la prochaine itération
            $previousLine = substr($lineDirections, 0, 3);
            
            echo '<b>'.$directionIndex.' | '.$lineDirections.'<br></b>';
            //Enregistre les lignes - directions dans la bdd
            InsertInDatabase($dbh, 'tbl_lines_directions', array('name' => $dbh->quote(addslashes($lineDirections)), 'numRegion' => $region['id']));
            $linesDirectionsIndex++;            

            //Apelle la fonction pour les arrêts.
            foreach(FetchStopsFromWebsite($region['url'], $urlLine, $directionIndex) as $stop => $url){
                InsertInDatabase($dbh, 'tbl_stops', array('name' => $dbh->quote(addslashes($stop)), 'urlpdf' => $dbh->quote($url), 'numLinesDirections' => $linesDirectionsIndex));
            }
        }
    }
