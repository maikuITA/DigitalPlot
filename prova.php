<?php

    require_once (__DIR__ . DIRECTORY_SEPARATOR . "Progetto" . DIRECTORY_SEPARATOR . "autoload.php");


    //$u = new EUser(username:"e",password: "CAZZETTO", nome:"LUDOV", cognome: "cuci", admin:false , dataNascita: "2004-02-06", luogoNascita: "avezzano", email: "pippo@p", telefono: "423563524131", biografia: "regreregergreg");
    //$plot = new EPlotCard(10,0);
    //$u->addPlotCard($plot);
    //FPersistantManager::getInstance()->saveInBd($u);
    $u2 = FPersistantManager::getInstance()->retriveObjById(EUser::class, 9);
    $plot = new EPlotCard(10,$u2);
    $u2->addPlotCard( $plot );
    FPersistantManager::getInstance()->saveInBd( $plot);

    
?>