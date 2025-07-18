<?php

class CFollow
{

    /**
     * This method adds a follower to a user
     * It checks if the user is logged in and subscribed.
     * If the username of the writer is provided, it retrieves the user and writer objects.
     * If the writer exists, it creates a new EFollow object, adds it to both the user and writer,
     * and saves the follow relationship in the database.
     * If the user is not logged in or not subscribed, it returns an error message.
     * If the username is not provided, it returns an error message indicating that the username is
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
     * It checks if the user is logged in and subscribed.
     * If the username of the writer is provided, it retrieves the user and writer objects.
     * If the writer exists and the follow relationship is found, it removes the follow relationship
     * from both the user and writer, deletes it from the database, and saves the changes.
     * If the user is not logged in or not subscribed, it returns an error message.
     * If the username is not provided, it returns an error message indicating that the writer is
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
     * This method checks if the user is logged in and subscribed.
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

    /**
     * This method shows the followers  and the following of a user;
     * It checks if the user is logged in and subscribed.
     * If the user is logged in, it retrieves the user object and his followers/following.
     * @return void
     */
    public static function showFollowers(): void
    {
        if (CUser::isLogged()) {
            if (CUser::isSubbed()) {
                $user = FPersistentManager::getInstance()->retrieveObjById(EUser::class, USession::getSessionElement('user'));
                $followers = $user->getFollowers();
                VFollowers::showFollowers(user: $user, isLogged: true, plotPoints: $user->getPlotCard()->getPoints(), proPic: $user->getEncodedData(), privilege: $user->getPrivilege(), followers: $followers);
            } else {
                header('Location: /subscribe');
                exit;
            }
        } else {
            header('Location: /subscribe');
            exit;
        }
    }
}
