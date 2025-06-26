<?php

class CArticle{

    /**
     * @param ?int $idArticolo
     * @return void
     * @throws Exception
     */
    public static function showArticle(?int $idArticolo):void{
        if($idArticolo === null || $idArticolo <= 0){
            header('Location: https://digitalplot.altervista.org/error/404');
            exit();
        }
        if(CUser::isLogged()){
            $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticolo);
            if(!isset($article)){
                header('Location: https://digitalplot.altervista.org/error/404');
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
                VArticle::newArticle(isLogged: true, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege());
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

    /**
     * allow you to drop an article from the profile view
     * @param $idArticle
     * @return void
     */
    public static function dropArticle(int $idArticle): void{
        if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if($user->getPrivilege() > 1){
                $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticle);
                if($article->getWriter()->getId() === $user->getId() || $user->getPrivilege() === ADMIN ){
                    $drop_result = FPersistentManager::getInstance()->delete($article);
                    if ($drop_result){
                        ULogSys::toLog("Articolo eliminato");
                        ULogSys::toLog("");
                        VConfirm::render("L'articolo " . $article->getTitle() . " è stato eliminato correttamente", plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), isLogged:true, privilege: $user->getPrivilege());
                        exit();
                    }
                    header('Location: https://digitalplot.altervista.org/error/1');
                    exit();
                }else{
                    header('Location: https://digitalplot.altervista.org/error/1');
                    exit(); 
                }
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


    public static function saveArticle(){
        if(UServer::getRequestMethod() === 'POST'){
            if(CUser::isLogged()){
                if(CUser::isSubbed()){
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                if ($user->getPrivilege() > 1){
                        $title = UHTTPMethods::post('title');
                        $description = UHTTPMethods::post('description');
                        $tipo = UHTTPMethods::post('category');
                        $genre = UHTTPMethods::post('genre');
                        $date = date('Y-m-d');
                        $content = UHTTPMethods::files('articleFile');
                        if(UHTTPMethods::post('contenuto') !== "" ){
                            $content = trim(UHTTPMethods::post('contenuto'));

                        }else{
                            $content = self::checkFile($content);
                        }
                        $article = new EArticle($title,$description,$content,PENDING,$genre, $tipo, $date, $user);
                        $user->addArticle($article);
                        FPersistentManager::getInstance()->saveInDb($article);
                        FPersistentManager::getInstance()->saveInDb($user);
                        ULogSys::toLog('Nuovo articolo salvato');
                        ULogSys::toLog("");
                        $confirmMessage = "Articolo salvato correttamente!";
                        VConfirm::render($confirmMessage, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), true);
                        exit;
                }else{
                        header('Location: https://digitalplot.altervista.org/home');
                        exit();
                }
                }else{
                    header('Location: https://digitalplot.altervista.org/subscribe');
                    exit();
                }
            }else{
                header('Location: https://digitalplot.altervista.org/auth');
                exit();
            }
        }else{
            header('Location: https://digitalplot.altervista.org/home');
            exit(); 
        }
        
    }

    private static function checkFile($content): mixed{
        if (!empty($content) && $content['error'] === UPLOAD_ERR_OK && !empty($content['tmp_name'])) {
                $tmpName = $content['tmp_name'];

                // Verifica MIME
                $mime = mime_content_type($tmpName);
                $allowed = ['text/plain'];
                if (!in_array($mime, $allowed)) {
                    header('Location: https://digitalplot.altervista.org/error/2');
                    exit;
                }

                // Verifica dimensione (es. max 2MB)
                if ($content['size'] === 0) {
                    header('Location: https://digitalplot.altervista.org/error/3');
                    exit;
                }


                $txt = file_get_contents($tmpName);
                $html = nl2br(htmlspecialchars($txt));
                
                return $html;
            } else {
                header('Location: https://digitalplot.altervista.org/error/4');
                exit();
            }
    }

    
    public static function modifyArticle(int $idArticle): void{
         if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($user->getPrivilege() > 1){
                if (CUser::isSubbed()){
                    $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticle);
                    VArticle::newArticle(isLogged: true, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), modify: true, article: $article);
                } else {
                    header('Location: https://digitalplot.altervista.org/subscribe');
                    exit();
                }
            } else {
                header('Location: https://digitalplot.altervista.org/subscribe');
                exit();
            }
        }else{
            header('Location: https://digitalplot.altervista.org/auth');
            exit();
        }
    }

}