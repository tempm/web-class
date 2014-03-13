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

class Common
{
    public static function init()
    {
        if (!is_null(User::getUser('admin'))) {
            App::pass();
        }
        $user = new User();
        $user->setMail('');
        $user->setUsername('admin');
        $user->setPassword('123');
        $user->setType(User::TYPE_ADMIN);
        $user->persist($user);
    }

    public static function index()
    {
        App::render('index.twig');
    }

    public static function login_post()
    {
        global $app;
        $user = User::authentication();
        if (!is_null($user)) {
            App::redirect('index');
        }
        $username = $app->request()->post('username');
        $password = $app->request()->post('password');
        $user = User::checkPassword($username, $password);
        if (is_null($user)) {
            Message::addMessage('Invalid user name', Message::ERROR);
            App::redirect('index');
        }
        User::login($user);
        App::redirect('index');
    }

    public static function logout_post()
    {
        User::logout();
        App::redirect('index');
    }

    public static function test()
    {
//        $user = User::getUser('admin');
//        $post = new Post();
//        $post->setText('<h1>Ha Ha Ha</h1>');
//        $post->setTime(new \DateTime());
//        $post->setUser($user);
//        $em->persist($post);
//        $em->flush();
    }
} 