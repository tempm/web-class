<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 2/21/14
 * Time: 9:51 PM
 */

namespace ce\views;


use ce\models\Post;
use ce\models\User;
use ce\util\App;
use ce\util\Message;

class Posts
{
    public static function post_post()
    {
        global $app;
        $user = User::authentication();
        if (is_null($user)) {
            App::redirect('index');
        }
        $post = new Post();
        $text = $app->request()->post('text');
        if (is_null($text)) {
            $text = '';
        }
        $post->setUser($user);
        $post->setText($text);
        $post->setTime(new \DateTime());
        $post->persist();
        if (App::isAjax()) {
            App::render(null, array('ok' => true,'post'=>array(
                'text'=>$text,
                'user'=>$user->getUsername()
            )));
        } else {
            App::redirect('index');
        }
    }
}