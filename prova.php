<?php

    require_once 'Progetto/autoload.php';


    $u = new EUser("paperino", "pippo", "mario", "pippo", false ,"2004-03-25", "roma", "pippo@p", "09990", "pippo");

    $db = FDatabase::getInstance();
    $em = $db->getEntityManager();
    $em->persist($u);
    $em->flush();
?>