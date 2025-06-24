<?php 

class CFollow{

    /**
     * This method add a follower to a user
     * @param int $idWriter the id of the writer to follow
     * @return bool return true if the follow operation went well 
     */
    public static function follow(?int $idWriter) : bool {
        if($idWriter === null || $idWriter <= 0){
            return false;
        }else{
            if(CUser::isLogged()){
                if(CUser::isSubbed()){
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $writer = FPersistentManager::getInstance()->retrieveObjById(EUser::class, $idWriter);
                    if (isset($writer)){
                        $follow = new EFollow($user, $writer);
                        $user->addFollowing($follow);
                        $writer->addFollower($follow);
                        FPersistentManager::getInstance()->saveInDb($follow);
                        FPersistentManager::getInstance()->saveInDb($user);
                        FPersistentManager::getInstance()->saveInDb($writer);
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    /**
     * This method remove a follower to a user
     * @param int $idWriter the id of the writer to follow
     * @return bool return true if the follow operation went well 
     */
    public static function unfollow(?int $idWriter){
        if($idWriter === null || $idWriter <= 0){
            return false;
        }else{
            if(CUser::isLogged()){
                if(CUser::isSubbed()){
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $writer = FPersistentManager::getInstance()->retrieveObjById(EUser::class, $idWriter);
                    $follow = $user->getFollowingById($idWriter);
                    if (isset($writer) and isset($follow)){
                        $follow = new EFollow($user, $writer);
                        $user->removeFollowing($follow);
                        $writer->removeFollower($follow);
                        FPersistentManager::getInstance()->delete($follow);
                        FPersistentManager::getInstance()->saveInDb($user);
                        FPersistentManager::getInstance()->saveInDb($writer);
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

}