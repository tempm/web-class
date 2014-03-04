<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 2/21/14
 * Time: 9:51 PM
 */

namespace ce\views;


use ce\models\User;

class Common
{
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
        $app->redirect(ROOT_URL.'/');
    }

    public static function test()
    {
        $user = User::authentication();
        var_dump($user);
    }
} 