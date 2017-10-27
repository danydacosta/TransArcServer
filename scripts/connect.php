<?php
    try
    {
        $dbh = new PDO('mysql:host=localhost;dbname=transarc', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("SET CHARACTER SET utf8");
    }
    catch (PDOException $e)
    {
        echo('Connection failed: ' . $e->getMessage());
    }