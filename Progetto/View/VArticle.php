<?php

class VArticle
{

    /**
     * Method to display an article.
     * @param EUser $user The user viewing the article.
     * @param bool $isLogged Indicates if the user is logged in (default is false).
     * @param int $plotPoints The number of plot points the user has (default is 0).
     * @param mixed $proPic The user's profile picture data (default is null).
     * @param int $privilege The user's privilege level (default is BASIC).
     * @param EArticle $article The article to be displayed.
     * @param EUser $writer The writer of the article.
     * @param mixed $writerProPic The writer's profile picture data.
     * @return void
     */
    public static function showArticle(EUser $user, bool $isLogged = false, int $plotPoints = 0, mixed $proPic = null, int $privilege = BASIC, EArticle $article, EUser $writer, mixed $writerProPic): void
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> lettura.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('article', $article);
        $smarty->assign('reviews', $article->getReviews());
        $smarty->assign('writer', $writer);
        if ($user->getId() === $writer->getId()) {
            $smarty->assign('same', true);
            $smarty->assign('writerPropic', $proPic);
        } else {
            $smarty->assign('same', false);
            $smarty->assign('writerPropic', $writerProPic);
        }
        $smarty->display('lettura.tpl');
    }

    /**
     * Method to display the new article page.
     * @param bool $isLogged Indicates if the user is logged in (default is false).
     * @param int $plotPoints The number of plot points the user has (default is 0).
     * @param mixed $proPic The user's profile picture data (default is null).
     * @param int $privilege The user's privilege level (default is BASIC).
     * @param bool $modify The user's can modify its article
     * @param EArticle $article The article to be modified
     * @return void
     */
    public static function newArticle(bool $isLogged = false, int $plotPoints = 0, mixed $proPic = null, int $privilege = BASIC, bool $modify = false, ?Earticle $article = null): void
    {
        $smarty = StartSmarty::configuration();
        ULogSys::toLog("Display -> nuovo.tpl");
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('privilege', $privilege);
        $smarty->assign('plotPoints', $plotPoints);
        $smarty->assign('proPic', $proPic);
        $smarty->assign('article', $article);
        $smarty->assign('modify', $modify);
        if (isset($article)) {
            $smarty->assign('content', $article->getHtmlContent());
        }

        $smarty->display('nuovo.tpl');
    }
}
