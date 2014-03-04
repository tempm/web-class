<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 3/1/14
 * Time: 10:35 AM
 */
namespace ce\models;
class User
{
    public $id;
    public $username;
    public $password;

    function __construct($id, $username, $password)
    {
        $this->id = $id;
        $this->password = $password;
        $this->username = $username;
    }


    private static $users;

    public static function getUsers()
    {
        if (is_null(self::$users)) {
            self::$users = array(
                new User(1, 'ali', '123'),
                new User(2, 'ata', '321'),
                new User(3, 'root', 'root'),
            );
        }
        return self::$users;
    }

    public static function getUser($id)
    {
        $users = self::getUsers();
        foreach ($users as $user) {
            /* @var $user User */
            if ($user->id == $id) {
                return $user;
            }
        }
        return null;
    }

    public static function checkPassword($username, $password)
    {
        $users = self::getUsers();
        foreach ($users as $user) {
            /* @var $user User */
            if ($user->username == $username and $user->password == $password) {
                return $user;
            }
        }
        return null;
    }

    public static function authentication()
    {
        if (isset($_SESSION['user.id'])) {
            return self::getUser($_SESSION['user.id']);
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

    public function getPosts()
    {
        $posts = Post::getPosts();
        $output = array();
        /* @var $post Post */
        foreach ($posts as $post) {
            if ($post->user_id == $this->id) {
                $output[] = $post;
            }
        }
        return $output;
    }
}