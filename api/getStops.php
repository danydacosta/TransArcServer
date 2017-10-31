<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once('../scripts/connect.php');

    if(isset($_GET['numlinedirection'])){
        $stmt = $dbh->prepare('SELECT tbl_stops.id, tbl_stops.name, tbl_stops.urlpdf 
                               FROM tbl_stops 
                               INNER JOIN tbl_lines_directions ON tbl_stops.numLinesDirections = tbl_lines_directions.id
                               WHERE tbl_lines_directions.id = :numlinedirection');

        $stmt->bindParam(':numlinedirection', $_GET['numlinedirection'], PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetchAll();
    
        echo json_encode($result);
    }