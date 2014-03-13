<?php
/**
 * Created by JetBrains PhpStorm.
 * User: musavi.m
 * Date: 4/29/13
 * Time: 5:46 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ce\util;

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
        if (!isset($_SESSION['ce.msg'])) {
            Message::clearMessage();
        }
        if (is_null($rtl)) {
            if (self::$rtl) {
                $rtl = false;
            } else {
                $rtl = true;
            }
        }
        $_SESSION['ce.msg'][] = array(
            'text' => $text,
            'type' => $type,
            'link' => $link,
            'direction' => $rtl ? 'rtl' : 'ltr',
        );
    }

    public static function clearMessage()
    {
        if (self::$keep) {
            return;
        }
        $_SESSION['ce.msg'] = array();
    }

    public static function getMessages()
    {
        if (isset($_SESSION['ce.msg'])) {
            return $_SESSION['ce.msg'];
        } else {
            return array();
        }
    }

    public static function hasMessage()
    {
        if (!empty($_SESSION['ce.msg'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function keepMessages()
    {
        self::$keep = true;
    }

}