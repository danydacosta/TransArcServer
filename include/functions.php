<?php
    //Insert un enregistrement dans une table
    function InsertInDatabase($dbh, $table, $fields){
        $columns = implode(',', array_keys($fields));
        $values = implode(',', array_values($fields));
        $stmt = $dbh->query("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
    }
    
    function ClearTable($dbh, $table){
        $stmt = $dbh->query("DELETE FROM {$table}");
        $stmt = $dbh->query("ALTER TABLE {$table} AUTO_INCREMENT = 1");
    }

    //Retourne une array des regions
    function FetchRegionsFromDatabase($dbh){
        $stmt = $dbh->query('SELECT * FROM tbl_regions');
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

    