<?php
    include_once('connect.php');

    if(isset($_GET['numregion'])){
        $stmt = $dbh->prepare('SELECT * FROM tbl_lines_directions WHERE numRegion = :numregion');
        $stmt->bindParam(':numregion', $_GET['numregion'], PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetchAll();
    
        echo json_encode($result);
    }