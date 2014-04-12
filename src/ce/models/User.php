<?php

namespace ce\models;

use ce\util\Authenticate;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends Model
{
    static function getEntityName()
    {
        return 'ce\models\User';
    }

    const TYPE_ADMIN = 'admin';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $type;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = Authenticate::hashPassword($password);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $username
     * @return User
     */
    public static function getUser($username)
    {
        /* @var $user User */
        $user = self::getRepository()->findOneBy(array('username' => $username));
        return $user;
    }

    public static function checkPassword($username, $password)
    {
        /* @var $user User */
        $user = self::getUser($username);
        if (is_null($user)) {
            return null;
        }
        if (!Authenticate::checkPassword($user->password, $password)) {
            return null;
        }
        return $user;
    }

    /**
     * @return null|User
     */
    public static function authentication()
    {
        if (isset($_SESSION['user.id'])) {
            return self::getRepository()->find($_SESSION['user.id']);
        }
        return null;
    }

    public static function login($user)
    {
        session_destroy();
        session_start();
        $_SESSION['user.id'] = $user->id;
    }

    public static function logout()
    {
        session_destroy();
    }


    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $posts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add posts
     *
     * @param \ce\models\Post $posts
     * @return User
     */
    public function addPost(\ce\models\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \ce\models\Post $posts
     */
    public function removePost(\ce\models\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $friendsWithMe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $myFriends;


    /**
     * Add friendsWithMe
     *
     * @param \ce\models\User $friendsWithMe
     * @return User
     */
    public function addFriendsWithMe(\ce\models\User $friendsWithMe)
    {
        $this->friendsWithMe[] = $friendsWithMe;

        return $this;
    }

    /**
     * Remove friendsWithMe
     *
     * @param \ce\models\User $friendsWithMe
     */
    public function removeFriendsWithMe(\ce\models\User $friendsWithMe)
    {
        $this->friendsWithMe->removeElement($friendsWithMe);
    }

    /**
     * Get friendsWithMe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * Add myFriends
     *
     * @param \ce\models\User $myFriends
     * @return User
     */
    public function addMyFriend(\ce\models\User $myFriends)
    {
        $this->myFriends[] = $myFriends;

        return $this;
    }

    /**
     * Remove myFriends
     *
     * @param \ce\models\User $myFriends
     */
    public function removeMyFriend(\ce\models\User $myFriends)
    {
        $this->myFriends->removeElement($myFriends);
    }

    /**
     * Get myFriends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyFriends()
    {
        return $this->myFriends;
    }
}
