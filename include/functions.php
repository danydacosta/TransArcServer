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

    //Retourne une array de lignes-directions pour une région donnée
    function FetchLinesAndDirectionsFromWebsite($region){
        $doc = new simple_html_dom();
        $doc->load(file_get_contents($region));

        $array = array();
        foreach($doc->find('select[id=ls] option') as $element){   
            if($element->innertext !== 'Choisissez votre ligne'){
                array_push($array, $element->innertext);
            };
        }
        return $array;
    }

    