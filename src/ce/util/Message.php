<?php
/**
 * Created by JetBrains PhpStorm.
 * User: musavi.m
 * Date: 4/29/13
 * Time: 5:46 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ce\utils;

use Twig_Environment;
use Twig_Loader_String;

class Message
{
    const ERROR = 'error';
    const  WARNING = 'warning';
    const INFO = 'info';
    const SUCCESS = 'success';

    private static $rtl = false;
    private static $keep = false;

    public static function addMessage($text, $type = 'info', $rtl = null, $link = null)
    {
        if (!isset($_SESSION['cert.msg'])) {
            Message::clearMessage();
        }
        if (is_null($rtl)) {
            if (self::$rtl) {
                $rtl = false;
            } else {
                $rtl = true;
            }
        }
        $_SESSION['cert.msg'][] = array(
            'text' => $text,
            'type' => $type,
            'link' => $link,
            'direction' => $rtl ? 'rtl' : 'ltr',
        );
    }

    public static function clearMessage()
    {
        if (Message::$keep) {
            return;
        }
        $_SESSION['cert.msg'] = array();
    }

    public static function getMessages()
    {
        if (isset($_SESSION['cert.msg'])) {
            return $_SESSION['cert.msg'];
        } else {
            return array();
        }
    }

    public static function hasMessage()
    {
        if (!empty($_SESSION['cert.msg'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function keepMessages()
    {
        Message::$keep = true;
    }


    public static function redirectAbsolute($url = null)
    {
        global $app;
        self::keepMessages();
        $app->redirect($url);
    }

    public static function redirectRelative($url = null)
    {
        global $app;
        self::keepMessages();
        $app->redirect(ROOT_URL.$url);
    }

    public static function redirect($urlName = null, $params = array())
    {
        global $app;
        self::keepMessages();
        $app->redirect($app->urlFor($urlName, $params));
    }


    public static function render($template = null, $obj = array())
    {
        global $app;
        if ($app->request()->isAjax() and is_null($template)) {
            $app->response()->header('Content-type', 'application/json');
            $obj['msgs'] = self::getMessages();
            echo json_encode($obj);
            $app->stop();
        } else {
            $app->view()->appendData(array(
                'messages' => self::getMessages()
            ));
            $app->render($template, $obj);
        }
    }

    public static function renderStr($template = '', $data = array())
    {
        $loader = new Twig_Loader_String();
        $twig = new Twig_Environment($loader);
        return $twig->render($template, $data);
    }

    public static function pass()
    {
        global $app;
        $app->pass();
    }

    public static function isAjax()
    {
        global $app;
        return $app->request()->isAjax();
    }

    public static function passAjax()
    {
        global $app;
        if ($app->request()->isAjax()) {
            $app->pass();
        }
    }

    public static function confirmAjax()
    {
        global $app;
        if (!$app->request()->isAjax()) {
            $app->pass();
        }
    }
}