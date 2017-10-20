<?php
    //Insert un enregistrement dans une table
    function InsertInDatabase($dbh, $table, $fields){
        $columns = implode(',', array_keys($fields));
        $values = implode(',', array_values($fields));
        $stmt = $dbh->query("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
    }
    
    //Supprime les données d'une table et reset l'auto_increment
    function ClearTable($dbh, $table){
        $stmt = $dbh->query("DELETE FROM {$table}");
        $stmt = $dbh->query("ALTER TABLE {$table} AUTO_INCREMENT = 1");
    }

    //Retourne une array des enregistrements pour une table donnée
    function FetchTableFromDatabase($dbh, $table){
        $stmt = $dbh->query("SELECT * FROM {$table}");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    //Retourne une array des lignes pour une région donnée
    function FetchLinesFromWebsite($region){        
        $doc = new simple_html_dom();
        $doc->load(file_get_contents('http://www.transn.ch/reseau-horaires/'.$region.'.html'));

        $array = array();
        foreach($doc->find('area[class=fancyboxmap]') as $element){
            $line = $element->getAttribute('ad-l');
            end($array) !== $line && $line < 700 ? array_push($array, $line) : null;
        }
        return $array;
    }

    //Retourne une array des directions pour une ligne donnée
    function FetchDirectionsFromWebsite($region, $line){
        $doc = new simple_html_dom();
        $directionIndex = 1;

        $array = array();
        while($directionIndex <= 2){
            $doc->load(file_get_contents('http://www.transn.ch/fr/reseau-horaires/'.$region.'.html?l='.$line.'&d='.$directionIndex));
    
            $element = $doc->find('div[class=titreline]');
            array_push($array, $element[0]->innertext());

            $directionIndex++;
        }

        echo 'Directions for region'.$region.' and line '.$line.':<br>';
        var_dump($array);
        return $array;
    }

    