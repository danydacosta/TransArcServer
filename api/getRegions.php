<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once('../scripts/connect.php');
    include_once('../scripts/functions.php');

    $array = FetchTableFromDatabase($dbh, 'tbl_regions');

    echo json_encode($array);
