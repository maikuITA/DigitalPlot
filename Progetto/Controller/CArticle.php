<?php

class CArticle{

    /**
     * @param ?int $idArticolo
     * @return void
     * @throws Exception
     */
    public static function showArticle(?int $idArticolo = -1):void{
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
                CArticle::addListReadArticles($idArticolo);
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

    public static function addListReadArticles(?int $idArticolo){
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
                $readings = $user->getReaddenArticles();
                $count = 0;
                foreach ($readings as $article){
                    if ($article->getId() === $idArticolo){
                        $count++;
                    }
                }
                if ($count === 0){
                    $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticolo);
                    $reading = new EReading($user, $article);
                    FPersistentManager::getInstance()->saveInDb($reading);
                    $user->addReading($reading);
                    $idPlotCard = $user->getPlotCard()->getCod();
                    $user->getPlotCard()->addPoints(POINTS);
                    $newPoints = $user->getPlotCard()->getPoints();
                    FPersistentManager::getInstance()->updateObject(EPlotcard::class, $idPlotCard, 'points', $newPoints);
                }
            }
            else{
                header('Location: https://digitalplot.altervista.org/subscribe');
                exit();
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
    public static function dropArticle(?int $idArticle = -1): void{
        if($idArticle === null || $idArticle <= 0){
            header('Location: https://digitalplot.altervista.org/error/404');
            exit();
        }
        if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if($user->getPrivilege() > 1){
                $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticle);
                if($article->getWriter()->getId() === $user->getId() || $user->getPrivilege() === ADMIN ){
                    $drop_result = FPersistentManager::getInstance()->delete($article);
                    if ($drop_result){
                        ULogSys::toLog("Articolo eliminato");
                        ULogSys::toLog("");
                        header('Location: https://digitalplot.altervista.org/confirm/1');
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
                        header('Location: https://digitalplot.altervista.org/confirm/2');
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
                    CArticle::saveUpdateArticle($idArticle);
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

    public static function saveUpdateArticle(int $idArticle){
        if(CUser::isLogged()){
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if (UServer::getRequestMethod() === "POST"){
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
                $initialArticle = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticle);
                $dropResult = FPersistentManager::getInstance()->delete($initialArticle);
                $article = new EArticle($title,$description,$content,PENDING,$genre, $tipo, $date, $user);
                if ($dropResult){
                    ULogSys::toLog("MANNAGIA LA SACRA", true);
                    FPersistentManager::getInstance()->saveInDb($article);
                    header('Location: https://digitalplot.altervista.org/confirm/2');
                    exit();
                } else {
                    header('Location: https://digitalplot.altervista.org/error/404');
                    exit();
                }

            } else {
                header('Location: https://digitalplot.altervista.org/home');
                exit();
            }
        } else {
            header('Location: https://digitalplot.altervista.org/auth');
            exit();
        }
    }

    public static function newRewiew(?int $articleId = -1) : void {
        if(UServer::getRequestMethod() === 'POST' && $articleId !== NULL && $articleId > 0){
            if(CUser::isLogged()){
                if(CUser::isSubbed() || CUser::isAdmin()){
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $commento = UHTTPMethods::post('review');
                    $evaluation = UHTTPMethods::post('score');
                    $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $articleId);
                    if(isset($article)){
                        $review = new EReview($evaluation, $commento, date('Y-m-d'), $user, $article);
                        $user->addReview($review);
                        $article->addReview($review);
                        FPersistentManager::getInstance()->saveInDb($review);
                        FPersistentManager::getInstance()->saveInDb($user);
                        FPersistentManager::getInstance()->saveInDb($article);
                        header('Location: https://digitalplot.altervista.org/article/'.$articleId);
                        exit;
                    }else{
                        header('Location: https://digitalplot.altervista.org/error/404');
                    }
                }else{
                    header('Location: https://digitalplot.altervista.org/subscribe');
                }
            }else{
                header('Location: https://digitalplot.altervista.org/auth');
            }
        }else{
            header('Location: https://digitalplot.altervista.org/error/404');
        }
    }

    public static function dropReview(int $reviewId = -1){
        if($reviewId > 0 ){
            if(CUser::isLogged()){
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                $review = FPersistentManager::getInstance()->retrieveObjById(EReview::class, $reviewId);
                if($review->getSubscriber()->getId() === $user->getId() || CUser::isAdmin()){
                    $user->removeReview($review);
                    $article = $review->getArticle();
                    $article->removeReview($review);
                    FPersistentManager::getInstance()->delete($review);
                    FPersistentManager::getInstance()->saveInDb($user);
                    FPersistentManager::getInstance()->saveInDb($article);
                    header('Location: https://digitalplot.altervista.org/confirm/3');
                }else{
                    header('Location: https://digitalplot.altervista.org/error/404');
                }
            }else{
                header('Location: https://digitalplot.altervista.org/auth');
            }
        }else{
            header('Location: https://digitalplot.altervista.org/error/404');
        }
    }

}