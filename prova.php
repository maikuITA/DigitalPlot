<?php

    require_once 'Progetto/autoload.php';
    use Foundation\FDatabase;
    use Entity\EUser;

    $u = new EUser("mario", "pippo", "mario", "pippo", false ,"01-03-2004", "roma", "pippo@p", "09990", "pippo");
   
    $db = FDatabase::getInstance();
    $em = $db->getEntityManager();
    $em->persist($u);
    $em->flush();
?>