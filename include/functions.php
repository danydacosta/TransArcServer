<?php
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