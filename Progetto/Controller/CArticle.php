<?php

class CArticle
{

    /**
     * Method to display an article
     * This method checks if the user is logged in and retrieves the article by its ID.
     * If the article exists, it checks if the user has enough readings left.
     * If the article is pending and the user is not a writer or admin, it redirects to the home page.
     * If the user has enough readings, it adds the article to the list of read articles
     * and displays the article view with the user's data, article details, and remaining readings.
     * If the user is not logged in, it redirects to the authentication page.
     * If the article does not exist or the user does not have enough readings, it redirects
     * @param ?int $idArticolo
     * @return void
     * @throws Exception
     */
    public static function showArticle(?int $idArticolo = -1): void
    {
        if ($idArticolo === null || $idArticolo <= 0) {
            header('Location: /errors/404');
            exit();
        }
        if (CUser::isLogged()) {
            $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticolo);
            if (!isset($article)) {
                header('Location: /errors/404');
                exit();
            }
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($article->getStatus() === PENDING && $user->getPrivilege() < WRITER) {
                header('Location: /home');
                exit();
            }
            if (!CUser::isSubbed()) {
                $numLetture = $user->countReadings();
                if ($numLetture >= MAXREADINGS) {
                    header('Location: /subscribe');
                    exit;
                }
            }
            CArticle::addListReadArticles($idArticolo);
            VArticle::showArticle(isLogged: true, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), article: $article, writer: $article->getWriter(), writerProPic: $article->getWriter()->getEncodedData());
        } else {
            header('Location: /auth');
            exit();
        }
    }

    /**
     * Method to add an article to the list of read articles
     * This method checks if the user is logged in and retrieves the article by its ID.
     * If the article exists, it checks if the user has enough readings left.
     * If the article exists, it checks if the user has not already read it.
     * If the article exists and the user has not already read it, it creates a new reading entry,
     * adds points to the user's plot card and saves the reading in the database.
     * If the user is not logged in or if the article does not exist, it redirects to an error page.
     * @param ?int $idArticolo
     * @return void
     */
    public static function addListReadArticles(?int $idArticolo): void
    {
        if ($idArticolo === null || $idArticolo <= 0) {
            header('Location: /errors/404');
            exit();
        }
        if (CUser::isLogged()) {
            $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticolo);
            if (!isset($article)) {
                header('Location: /errors/404');
                exit();
            }
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            $readings = $user->getReaddenArticles();
            $count = 0;
            foreach ($readings as $article) {
                if ($article->getId() === $idArticolo) {
                    $count++;
                }
            }
            if ($count === 0) {
                $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticolo);
                $reading = new EReading($user, $article);
                FPersistentManager::getInstance()->saveInDb($reading);
                $user->addReading($reading);
                $idPlotCard = $user->getPlotCard()->getCod();
                $user->getPlotCard()->addPoints(POINTS);
                $newPoints = $user->getPlotCard()->getPoints();
                FPersistentManager::getInstance()->updateObject(EPlotcard::class, $idPlotCard, 'points', $newPoints);
            }
        } else {
            header('Location: /auth');
            exit();
        }
    }

    /**
     * Method to display the new article page.
     * This method checks if the user is logged in and has the privilege to write articles.
     * If the user is authorized, it displays the new article page; otherwise, it redirects to the home page.
     * @return void
     */
    public static function newArticle(): void
    {
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($user->getPrivilege() === WRITER || $user->getPrivilege() === ADMIN) {
                VArticle::newArticle(isLogged: true, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege());
            } else {
                header('Location: /home');
                exit();
            }
        } else {
            header('Location: /auth');
            exit();
        }
    }

    /**
     * Allow you to drop an article from the profile view.
     * @param $idArticle
     * @return void
     */
    public static function dropArticle(?int $idArticle = -1): void
    {
        if ($idArticle === null || $idArticle <= 0) {
            header('Location: /errors/404');
            exit();
        }
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($user->getPrivilege() > 1) {
                $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticle);
                if ($article->getWriter()->getId() === $user->getId() || $user->getPrivilege() === ADMIN) {
                    $drop_result = FPersistentManager::getInstance()->delete($article);
                    if ($drop_result) {
                        ULogSys::toLog("Articolo eliminato correttamente");
                        ULogSys::toLog("");
                        header('Location: /confirm/1');
                        exit();
                    } else {
                        ULogSys::toLog("L'articolo non è stato eliminato correttamente");
                        ULogSys::toLog("");
                        header('Location: /errors/1');
                        exit();
                    }
                } else {
                    header('Location: /errors/1');
                    exit();
                }
            } else {
                header('Location: /home');
                exit();
            }
        } else {
            header('Location: /auth');
            exit();
        }
    }

    /**
     * Method to save a new article
     * This method checks if the request method is POST and if the user is logged in.
     * If the user is logged in and has the privilege to write articles, it retrieves the article data from the POST request,
     * creates a new article object, associates it with the user, and saves it in the database.
     * If the user is not logged in or does not have the required privilege, it redirects to the appropriate page.
     * @return void
     */
    public static function saveArticle(): void
    {
        if (UServer::getRequestMethod() === 'POST') {
            if (CUser::isLogged()) {
                if (CUser::isSubbed()) {
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    if ($user->getPrivilege() > 1) {
                        $title = UHTTPMethods::post('title');
                        $description = UHTTPMethods::post('description');
                        $tipo = UHTTPMethods::post('category');
                        $genre = UHTTPMethods::post('genre');
                        $date = date('Y-m-d');
                        $content = UHTTPMethods::files('articleFile');
                        if (UHTTPMethods::post('contenuto') !== "") {
                            $content = trim(UHTTPMethods::post('contenuto'));
                        } else {
                            $content = self::checkFile($content);
                        }
                        $article = new EArticle($title, $description, $content, PENDING, $genre, $tipo, $date, $user);
                        $user->addArticle($article);
                        FPersistentManager::getInstance()->saveInDb($article);
                        FPersistentManager::getInstance()->saveInDb($user);
                        ULogSys::toLog('Nuovo articolo salvato');
                        ULogSys::toLog("");
                        header('Location: /confirm/2');
                        exit;
                    } else {
                        header('Location: /home');
                        exit();
                    }
                } else {
                    header('Location: /subscribe');
                    exit();
                }
            } else {
                header('Location: /auth');
                exit();
            }
        } else {
            header('Location: /home');
            exit();
        }
    }

    /**
     * Method to check the uploaded file
     * This method checks if the uploaded file is valid, verifies its MIME type,
     * and returns the content of the file as HTML.
     * If the file is not valid or if there is an error, it redirects to an error page.
     * @param $content
     * @return mixed
     */
    private static function checkFile($content): mixed
    {
        if (!empty($content) && $content['error'] === UPLOAD_ERR_OK && !empty($content['tmp_name'])) {
            $tmpName = $content['tmp_name'];

            // Verifica MIME
            $mime = mime_content_type($tmpName);
            $allowed = ['text/plain'];
            if (!in_array($mime, $allowed)) {
                header('Location: /errors/2');
                exit;
            }

            $txt = file_get_contents($tmpName);
            $html = nl2br(htmlspecialchars($txt));

            return $html;
        } else {
            header('Location: /errors/4');
            exit();
        }
    }

    /**
     * Method to modify an article
     * This method checks if the user is logged in and has the privilege to modify articles.
     * If the user is authorized, it retrieves the article by its ID and displays the new article page for modification.
     * If the user is not logged in or does not have the required privilege, it redirects to the subscription page.
     * @param int $idArticle
     * @return void
     */
    public static function editArticle(int $idArticle): void
    {
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if ($user->getPrivilege() > 1) {
                if (CUser::isSubbed()) {
                    $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticle);
                    VArticle::newArticle(isLogged: true, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), modify: true, article: $article);
                    CArticle::saveUpdateArticle($idArticle);
                } else {
                    header('Location: /subscribe');
                    exit();
                }
            } else {
                header('Location: /home');
                exit();
            }
        } else {
            header('Location: /auth');
            exit();
        }
    }

    /**
     * Method to save the updated article.
     * This method checks if the user is logged in and retrieves the article by its ID.
     * If the request method is POST, it retrieves the updated article data from the POST request,
     * deletes the initial article, creates a new article object with the updated data,
     * and saves it in the database. If successful, it redirects to the confirmation page;
     * otherwise, it redirects to an error page.
     * @param int $idArticle
     * @return void
     */
    public static function saveUpdateArticle(int $idArticle): void
    {
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            if (UServer::getRequestMethod() === "POST") {
                $title = UHTTPMethods::post('title');
                $description = UHTTPMethods::post('description');
                $tipo = UHTTPMethods::post('category');
                $genre = UHTTPMethods::post('genre');
                $date = date('Y-m-d');
                $content = UHTTPMethods::files('articleFile');
                if (UHTTPMethods::post('contenuto') !== "") {
                    $content = trim(UHTTPMethods::post('contenuto'));
                } else {
                    $content = self::checkFile($content);
                }
                $initialArticle = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $idArticle);
                $initialArticle->setTitle($title);
                $initialArticle->setDescription($description);
                $initialArticle->setGenre($genre);
                $initialArticle->setCategory($tipo);
                $initialArticle->setReleaseDate($date);
                $initialArticle->setState(PENDING);
                $initialArticle->setContents($content);
                FPersistentManager::getInstance()->saveInDb($initialArticle);
                header('Location: /confirm/2');
            } else {
                header('Location: /home');
                exit();
            }
        } else {
            header('Location: /auth');
            exit();
        }
    }


    /**
     * Method to create a new review for an article
     * This method checks if the user is logged in and has the privilege to write reviews.
     * If the user is authorized, it retrieves the article by its ID, creates a new review object,
     * associates it with the user and the article, and saves it in the database.
     * If the user is not logged in or does not have the required privilege, it redirects to the appropriate page.
     * @param ?int $articleId
     * @return void
     */
    public static function newRewiew(?int $articleId = -1): void
    {
        if (UServer::getRequestMethod() === 'POST' && $articleId !== NULL && $articleId > 0) {
            if (CUser::isLogged()) {
                if (CUser::isSubbed() || CUser::isAdmin()) {
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $comment = UHTTPMethods::post('review');
                    $evaluation = UHTTPMethods::post('score');
                    $article = FPersistentManager::getInstance()->retrieveObjById(EArticle::class, $articleId);
                    if (isset($article)) {
                        $review = new EReview($evaluation, $comment, date('Y-m-d'), $user, $article);
                        $user->addReview($review);
                        $article->addReview($review);
                        FPersistentManager::getInstance()->saveInDb($review);
                        FPersistentManager::getInstance()->saveInDb($user);
                        FPersistentManager::getInstance()->saveInDb($article);
                        header('Location: /article/' . $articleId);
                        exit;
                    } else {
                        header('Location: /errors/404');
                    }
                } else {
                    header('Location: /subscribe');
                }
            } else {
                header('Location: /auth');
            }
        } else {
            header('Location: /errors/404');
        }
    }


    /**
     * Method to drop a review.
     * This method checks if the user is logged in and retrieves the review by its ID.
     * If the review exists and the user is either the subscriber of the review or an admin,
     * it removes the review from both the user and the article, deletes it from the database,
     * and redirects to a confirmation page. If the user is not logged in or does not have permission,
     * it redirects to an error page.
     * @param int $reviewId
     * @return void
     */
    public static function dropReview(int $reviewId = -1): void
    {
        if ($reviewId > 0) {
            if (CUser::isLogged()) {
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                $review = FPersistentManager::getInstance()->retrieveObjById(EReview::class, $reviewId);
                if ($review->getSubscriber()->getId() === $user->getId() || CUser::isAdmin()) {
                    $user->removeReview($review);
                    $article = $review->getArticle();
                    $article->removeReview($review);
                    FPersistentManager::getInstance()->delete($review);
                    FPersistentManager::getInstance()->saveInDb($user);
                    FPersistentManager::getInstance()->saveInDb($article);
                    header('Location: /confirm/3');
                } else {
                    header('Location: /errors/404');
                }
            } else {
                header('Location: /auth');
            }
        } else {
            header('Location: /errors/404');
        }
    }
}
