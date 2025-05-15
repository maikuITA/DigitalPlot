<?php

    require_once (__DIR__ . DIRECTORY_SEPARATOR . "Progetto" . DIRECTORY_SEPARATOR . "autoload.php");
    $plot = null;
    $u = new EUser(username:"c",password: "CAZZETTO", nome:"LUDOV", cognome: "cuci", admin:false , dataNascita: "2004-02-06", luogoNascita: "avezzano", email: "pippo@p", telefono: "423563524131", biografia: "regreregergreg");
    $u->setId(1);
    FPersistantManager::getInstance()->saveInBd($u);
    $u2 = FPersistantManager::getInstance()->retriveObjById(EUser::class, 8);
    echo $u2->__toString();
?>