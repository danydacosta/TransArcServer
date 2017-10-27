<?php
    include_once('connect.php');
    include_once('functions.php');

    $array = FetchTableFromDatabase($dbh, 'tbl_regions');

    echo json_encode($array);
