<?php

class CArticle{

    public static function showArticle():void{
        if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retriveObjById(EUser::class, USession::getSessionElement('user'));
            if(CUser::isSubbed()){
                VArticle::showArticle(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), true);
            }
            else{
                VArticle::showArticle(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), false);
            }
        }else{
            header('Location: https://digitalplot.altervista.org/auth');
        }
    }
}