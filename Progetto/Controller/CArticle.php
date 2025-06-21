<?php

class CArticle{

    public static function showArticle(?int $idArticolo):void{
        if($idArticolo === null || $idArticolo <= 0){
            header('Location: https://digitalplot.altervista.org/error');
            exit();
        }
        if(CUser::isLogged()){
            $article = FPersistentManager::getInstance()->retriveObjById(EArticle::class, $idArticolo);
            if(!isset($article)){
                header('Location: https://digitalplot.altervista.org/error');
                exit();
            }
            $user = FPersistentManager::getInstance()->retriveObjById(EUser::class, USession::getSessionElement('user'));
            if(CUser::isSubbed()){
                VArticle::showArticle(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), true, $article, $article->getWriter());
            }
            else{
                VArticle::showArticle(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), false, $article, $article->getWriter());
            }
        }else{
            header('Location: https://digitalplot.altervista.org/auth');
            exit();
        }
    }
}