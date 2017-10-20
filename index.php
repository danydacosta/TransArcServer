<?php
    //Connexion à la BDD
    include_once('include/connect.php');
    //Library SimpleHTMLDom
    include_once('include/simple_html_dom.php');
    //Fichiers de fonctions
    include_once('include/functions.php');
      
    ClearTable($dbh, 'tbl_lines');
    foreach(FetchTableFromDatabase($dbh, 'tbl_regions') as $region){
        $lineIndex = 0;
        foreach(FetchLinesFromWebsite($region['urlname']) as $line){
            InsertInDatabase($dbh, 'tbl_lines', array('name' => $line, 'numRegion' => $region['id']));
            $lineIndex++;
            foreach(FetchDirectionsFromWebsite($region['urlname'], $line) as $direction){
                //echo $direction.'<br>';
            }
        }
    }