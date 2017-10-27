<?php
    //Connexion à la BDD
    include_once('scripts/connect.php');
    //Library SimpleHTMLDom
    include_once('lib/simple_html_dom.php');
    //Fichiers de fonctions
    include_once('scripts/functions.php');
    
    //On vide les tables en attendant les nouvelles données
    ClearTable($dbh, 'tbl_lines_directions');
    ClearTable($dbh, 'tbl_stops');

    $previousLine = '';
    $linesDirectionsIndex = 0;
    $urlLine = 0;

    //Loop dans les régions
    foreach(FetchTableFromDatabase($dbh, 'tbl_regions') as $region){
        $directionIndex = 0;
        //Loop dans les lignes - directions
        foreach(FetchLinesAndDirectionsFromWebsite($region['url']) as $lineDirections){
            $directionIndex++;
            
            //Il n'est pas vide (premier élément)
            if($previousLine !== ''){
                //Nouvel ligne dans l'itération
                if($previousLine !== substr($lineDirections, 0, 3) || $directionIndex > 2){
                    //On remet l'index à 1
                    $directionIndex = 1;
                }
                
                //Exception: Ligne 341 (3, 4) => ligne 343
                if($lineDirections == '341 - Jardin Klaus - Verger' || $lineDirections == '341 - Verger - Place du Marché/Jardin Klaus'){
                    $urlLine = 343;
                //Les autres lignes
                }
            }

            //Enregistre la ligne courante
            $urlLine = substr($lineDirections, 0, 3);

            //On enregistre la ligne courant comme étant la precedante dans la prochaine itération
            $previousLine = substr($lineDirections, 0, 3);
            
            //Enregistre les lignes - directions dans la bdd
            InsertInDatabase($dbh, 'tbl_lines_directions', array('name' => $dbh->quote(addslashes($lineDirections)), 'numRegion' => $region['id']));
            $linesDirectionsIndex++;

            //Apelle la fonction pour les arrêts.
            foreach(FetchStopsFromWebsite($region['url'], $urlLine, $directionIndex) as $stop => $url){
                //Enregistre l'arrêt ainsi que l'url du PDF correspondant dans la bdd
                InsertInDatabase($dbh, 'tbl_stops', array('name' => $dbh->quote(addslashes($stop)), 'urlpdf' => $dbh->quote($url), 'numLinesDirections' => $linesDirectionsIndex));
            }
        }
    }

    echo '<h1>Terminé</h1>';
