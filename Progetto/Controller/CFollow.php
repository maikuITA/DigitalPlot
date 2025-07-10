<?php

class CFollow
{

    /**
     * This method adds a follower to a user
     * @param string|null $usernameWriter the username of the writer to follow
     */
    public static function follow(?string $usernameWriter = null)
    {
        header('Content-Type: application/json');
        if ($usernameWriter === null) {
            echo json_encode(['success' => false, 'message' => 'username is missing']);
            exit;
        } else {
            if (CUser::isLogged()) {
                if (CUser::isSubbed()) {
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $writer = FPersistentManager::getInstance()->retrieveUserOnUsername($usernameWriter);
                    if (isset($writer)) {
                        $follow = new EFollow($writer, $user);
                        $user->addFollowing($follow);
                        $writer->addFollower($follow);
                        FPersistentManager::getInstance()->saveInDb($follow);
                        FPersistentManager::getInstance()->saveInDb($user);
                        FPersistentManager::getInstance()->saveInDb($writer);
                        ULogSys::toLog("Utente followato");
                        ULogSys::toLog("");
                        echo json_encode(['success' => true, 'message' => 'follow successful']);
                        exit;
                    } else {
                        echo json_encode(['success' => false, 'message' => 'writer not found']);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'user not subbed']);
                    exit;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'user not logged']);
                exit;
            }
        }
    }

    /**
     * This method removes a follower to a user
     * @param string|null $usernameWriter the username of the writer to follow
     */
    public static function unfollow(?string $usernameWriter = null)
    {
        header('Content-Type: application/json');
        if ($usernameWriter === null) {
            echo json_encode(['success' => false, 'message' => 'writer missing']);
            exit;
        } else {
            if (CUser::isLogged()) {
                if (CUser::isSubbed()) {
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $writer = FPersistentManager::getInstance()->retrieveUserOnUsername($usernameWriter);
                    $follow = $user->getFollowingById($writer->getId());
                    if (isset($writer) && isset($follow)) {
                        $user->removeFollowing($follow);
                        $writer->removeFollower($follow);
                        FPersistentManager::getInstance()->delete($follow);
                        FPersistentManager::getInstance()->saveInDb($user);
                        FPersistentManager::getInstance()->saveInDb($writer);
                        ULogSys::toLog("Utente unfollowato");
                        ULogSys::toLog("");
                        echo json_encode(['success' => true, 'message' => 'follow successful']);
                        exit;
                    } else {
                        echo json_encode(['success' => false, 'message' => 'writer missing']);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'user not subbed']);
                    exit;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'user not logged']);
                exit;
            }
        }
    }

    /**
     * Check if the user is a follower of the writer
     * @param string|null $usernameWriter username of the writer
     */
    public static function isFollow(?string $usernameWriter)
    {
        header('Content-Type: application/json');
        if ($usernameWriter === null) {
            echo json_encode(['success' => false, 'me' => false]);
            exit;
        } else {
            if (CUser::isLogged()) {
                if (CUser::isSubbed()) {
                    $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                    $writer = FPersistentManager::getInstance()->retrieveUserOnUsername($usernameWriter);
                    if ($user->getId() === $writer->getId()) {
                        echo json_encode(['success' => false, 'me' => true]);
                        exit;
                    }
                    $follow = $user->getFollowingById($writer->getId());
                    if (isset($writer) && isset($follow)) {
                        echo json_encode(['success' => true, 'me' => false]);
                        exit;
                    } else {
                        echo json_encode(['success' => false, 'me' => false]);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'me' => false]);
                    exit;
                }
            } else {
                echo json_encode(['success' => false, 'me' => false]);
                exit;
            }
        }
    }
}
