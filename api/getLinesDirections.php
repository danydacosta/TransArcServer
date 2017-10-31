<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once('../scripts/connect.php');

    if(isset($_GET['numregion'])){
        $stmt = $dbh->prepare('SELECT tbl_lines_directions.id, tbl_lines_directions.name, tbl_lines_directions.numRegion
                               FROM tbl_lines_directions
                               INNER JOIN tbl_regions ON tbl_lines_directions.numRegion = tbl_regions.id
                               WHERE tbl_regions.id = :numregion');

        $stmt->bindParam(':numregion', $_GET['numregion'], PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetchAll();
    
        echo json_encode($result);
    }