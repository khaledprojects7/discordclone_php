<?php

try{
    $db = new PDO("mysql:host=bvnjezp1zbqgentz1qpy-mysql.services.clever-cloud.com;dbname=bvnjezp1zbqgentz1qpy;","u1ntbjeslurlseig","GptO9be7GfCJM2PcEcbv");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e)
{
    die("Error : Database connection failed");
}