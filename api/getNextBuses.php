<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once('../scripts/functions.php');

    //http://localhost/transarcserver/api/getNextBuses.php?originstop=Marin%20Gare&destinationstop=St-Honoré&canton=NE
    if(isset($_GET['originstop']) && isset($_GET['destinationstop']) && isset($_GET['canton'])){
        $origin = GetFullNameStop($_GET['originstop'], $_GET['canton']);
        $destination = GetFullNameStop($_GET['destinationstop'], $_GET['canton']);

        $array_params = array('origin' => $origin, 'destination' => $destination);
        var_dump(GetNextBus($array_params));
    }