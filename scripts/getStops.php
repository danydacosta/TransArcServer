<?php
    include_once('connect.php');

    if(isset($_GET['numlinedirection'])){
        $stmt = $dbh->prepare('SELECT * FROM tbl_stops WHERE numLinesDirections = :numlinedirection');
        $stmt->bindParam(':numlinedirection', $_GET['numlinedirection'], PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetchAll();
    
        echo json_encode($result);
    }