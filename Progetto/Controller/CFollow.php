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
                        $follow = new EFollow($user, $writer);
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
                    if (isset($writer) and isset($follow)){
                        $follow = new EFollow($user, $writer);
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

}