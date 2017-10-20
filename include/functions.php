<?php
    //Retourne une array des regions
    function FetchRegions($dbh){
        $stmt = $dbh->query('SELECT * FROM tbl_regions');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function FetchLines($region){        
        $doc = new simple_html_dom();
        $doc->load(file_get_contents('http://www.transn.ch/reseau-horaires/',$region));

        $array = array();
        foreach($doc->find('area[class=fancyboxmap]') as $element){
            $line = $element->getAttribute('ad-l');
            if(end($array) !== $line){
                array_push($array, $line);
            }
        }
        return $array;
    }