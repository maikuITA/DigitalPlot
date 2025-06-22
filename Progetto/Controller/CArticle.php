<?php

class CArticle{

    /**
     * @param ?int $idArticolo
     * @return void
     * @throws Exception
     */
    public static function showArticle(?int $idArticolo):void{
        if($idArticolo === null || $idArticolo <= 0){
            header('Location: https://digitalplot.altervista.org/error');
            exit();
        }
        if(CUser::isLogged()){
            $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticolo);
            if(!isset($article)){
                header('Location: https://digitalplot.altervista.org/error');
                exit();
            }
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if(CUser::isSubbed()){
                VArticle::showArticle(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), $article, $article->getWriter());
            }
            else{
                VArticle::showArticle(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), $article, $article->getWriter());
            }
        }else{
            header('Location: https://digitalplot.altervista.org/auth');
            exit();
        }
        
    }


    /**
     * Method to display the new article page
     * This method checks if the user is logged in and has the privilege to write articles.
     * If the user is authorized, it displays the new article page; otherwise, it redirects to the home page.
     * @return void
     */
    public static function newArticle():void {
        if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if($user->getPrivilege() === WRITER || $user->getPrivilege() === ADMIN){
                VArticle::newArticle(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege());
            }
            else{
                header('Location: https://digitalplot.altervista.org/home');
                exit();
            }
        }else{
            header('Location: https://digitalplot.altervista.org/auth');
            exit();
        }
    }

    public static function dropArticle(EArticle $article): void{
        if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if($user->getPrivilege() > 1){
                $articles = $user->getArticles();
                FPersistentManager::getInstance()->delete($article);
                VProfile::render(user: $user->getUsername(), plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), isLogged:true, privilege: $user->getPrivilege(), articles: $articles);
            }
            else{
                header('Location: https://digitalplot.altervista.org/home');
                exit();
            }
        }else{
            header('Location: https://digitalplot.altervista.org/auth');
            exit();
        }
    }


}