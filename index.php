<?php
    //Connexion à la BDD
    include_once('include/connect.php');
    //Library SimpleHTMLDom
    include_once('include/simple_html_dom.php');
    //Fichiers de fonctions
    include_once('include/functions.php');
    
    //var_dump($dbh);
    var_dump(FetchRegions($dbh));
    //FetchLines('littoral-val-de-ruz');