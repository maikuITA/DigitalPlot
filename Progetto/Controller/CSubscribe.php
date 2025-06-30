<?php

class CSubscribe
{

    /**
     * Method to render the subscription view
     * This method checks if user is subbed and if so, redirects to the home page.
     * If not, it shows VSubscribe.
     * @return void
     */
    public static function subscribe(): void
    {
        if (CUser::isLogged()) {
            $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
            $subs = FPersistentManager::getInstance()->retrieveAllSubscriptions();
            if (CUser::isSubbed()) {
                header('Location: https://digitalplot.altervista.org/home');
                exit;
            } else {
                VSubscribe::render(true, $user->getPlotCard()->getPoints(), $user->getEncodedData(), $user->getPrivilege(), $subs);
            }
        } else {
            header('Location: https://digitalplot.altervista.org/auth');
            exit;
        }
    }
}
