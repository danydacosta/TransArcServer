<?php
    //Insert un enregistrement dans une table
    function InsertInDatabase($dbh, $table, $fields){
        $columns = implode(',', array_keys($fields));
        $values = implode(',', array_values($fields));

        $stmt = $dbh->query("DELETE FROM {$table}");
        $stmt = $dbh->query("ALTER TABLE {$table} AUTO_INCREMENT = 1");
        $stmt = $dbh->query("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
    }

    //Retourne une array des regions
    function FetchRegions($dbh){
        $stmt = $dbh->query('SELECT * FROM tbl_regions');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function FetchLines($region){        
        $doc = new simple_html_dom();
        $doc->load(file_get_contents('http://www.transn.ch/reseau-horaires/',$region['urlname']));

        $array = array();
        foreach($doc->find('area[class=fancyboxmap]') as $element){
            $line = $element->getAttribute('ad-l');
            if(end($array) !== $line){
                array_push($array, $line);
            }
        }
        return $array;
    }

    