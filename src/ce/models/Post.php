<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 3/1/14
 * Time: 10:35 AM
 */
namespace ce\models;
class Post
{
    public $id;
    public $user_id;
    public $text;

    function __construct($id, $user_id, $text)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->text = $text;
    }

    private static $posts;

    public static function getPosts()
    {
        if (is_null(self::$posts)) {
            self::$posts = array(
                new Post(1, 1, 'salam'),
                new Post(2, 1, 'salam 123'),
                new Post(3, 2, 'salam skkkd '),
                new Post(4, 2, 'salam jfjfjfjfj'),
                new Post(5, 3, 'salam sdfasfdad'),
                new Post(6, 3, 'salam ooooooooooo'),
            );
        }
        return self::$posts;
    }

    public function getUser(){
        return User::getUser($this->user_id);
    }

}