<?php 

class CFollow{

    /**
     * This method add a follower to a user
     * @param int $idWriter the id of the writer to follow
     * @return bool return true if the follow operation went well 
     */
    public static function follow(?string $usernameWriter) : bool {
        header('Content-Type: application/json');
        if($usernameWriter === null){
            echo json_encode(['success' => false, 'message' => 'manca username']);
            exit;
        }else{
            if(CUser::isLogged()){
                if(CUser::isSubbed()){
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $writer = FPersistentManager::getInstance()->retrieveUserOnUsername($usernameWriter);
                    if (isset($writer)){
                        $follow = new EFollow($writer, $user);
                        $user->addFollowing($follow);
                        $writer->addFollower($follow);
                        FPersistentManager::getInstance()->saveInDb($follow);
                        FPersistentManager::getInstance()->saveInDb($user);
                        FPersistentManager::getInstance()->saveInDb($writer);
                        echo json_encode(['success' => true, 'message' => 'follow successful']);
                        exit;
                    }else{
                        echo json_encode(['success' => false, 'message' => 'writer non caricato']);
                        exit;
                    }
                }else{
                    echo json_encode(['success' => false, 'message' => 'non iscritto']);
                    exit;
                }
            }else{
                echo json_encode(['success' => false, 'message' => 'non loggato']);
                exit;
            }
        }
    }

    /**
     * This method remove a follower to a user
     * @param int $idWriter the id of the writer to follow
     * @return bool return true if the follow operation went well 
     */
    public static function unfollow(?string $usernameWriter){
        header('Content-Type: application/json');
        if($usernameWriter === null ){
            echo json_encode(['success' => false, 'message' => 'writer missing']);
            exit;
        }else{
            if(CUser::isLogged()){
                if(CUser::isSubbed()){
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $writer = FPersistentManager::getInstance()->retrieveUserOnUsername($usernameWriter);
                    $follow = $user->getFollowingById($writer->getId());
                    if (isset($writer) && isset($follow)){
                        $user->removeFollowing($follow);
                        $writer->removeFollower($follow);
                        FPersistentManager::getInstance()->delete($follow);
                        FPersistentManager::getInstance()->saveInDb($user);
                        FPersistentManager::getInstance()->saveInDb($writer);
                        echo json_encode(['success' => true, 'message' => 'follow successful']);
                        exit;
                    }else{
                        echo json_encode(['success' => false, 'message' => 'writer missing']);
                        exit;
                    }
                }else{
                    echo json_encode(['success' => false, 'message' => 'writer missing']);
                    exit;
                }
            }else{
                echo json_encode(['success' => false, 'message' => 'writer missing']);
                exit;
            }
        }
    }

    /**
     * check if the user is a follower of the writer
     * @param string|null $usernameWriter username of the writer
     */
    public static function isFollow(?string $usernameWriter){
        header('Content-Type: application/json');
        if($usernameWriter === null ){
            ULogSys::toLog('DIO',true);
            echo json_encode(['success' => false, 'me' => false]);
            exit;
        }else{
            if(CUser::isLogged()){
                if(CUser::isSubbed()){
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $writer = FPersistentManager::getInstance()->retrieveUserOnUsername($usernameWriter);
                    if($user->getId()=== $writer->getId()){
                        ULogSys::toLog('DIO '. var_dump(json_encode(['success' => false, 'me' => true])),true);
                        echo json_encode(['success' => false, 'me' => true]);
                        exit;
                    }
                    $follow = $user->getFollowingById($writer->getId());
                    if (isset($writer) && isset($follow)){
                        ULogSys::toLog('DIO '. var_dump(json_encode(['success' => true, 'me' => false])),true);
                        echo json_encode(['success' => true, 'me' => false]);
                        exit;
                    }else{
                        echo json_encode(['success' => false, 'me' => false]);
                        exit;
                    }
                }else{
                    echo json_encode(['success' => false, 'me' => false]);
                    exit;
                }
            }else{
                echo json_encode(['success' => false, 'me' => false]);
                exit;
            }
        }
    }

}