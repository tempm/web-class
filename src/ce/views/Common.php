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

class Common
{
    public static function init()
    {
        global $app;
        if (!is_null(User::getUser('admin'))) {
            $app->pass();
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
        global $app;
        $app->render('index.twig');
    }

    public static function login_post()
    {
        global $app;
        $user = User::authentication();
        if (!is_null($user)) {
            $app->redirect(ROOT_URL . '/');
        }
        $username = $app->request()->post('username');
        $password = $app->request()->post('password');
        $user = User::checkPassword($username, $password);
        if (is_null($user)) {
            // TODO error
            $app->redirect(ROOT_URL . '/');
        }
        User::login($user);
        $app->redirect(ROOT_URL . '/');
    }

    public static function logout_post()
    {
        global $app;
        User::logout();
        $app->redirect(ROOT_URL . '/');
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