<?php
use ce\models\User;

/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 2/21/14
 * Time: 9:30 PM
 */

session_start();
require_once 'site-config.php';
require_once 'db-config.php';
if (DEV_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

/********************************************/
/*              slim configs                */
/********************************************/


$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig()
));
$app->config('debug', DEV_MODE);
$app->config('cookies.httponly', true);

// $app->add(new \ce\util\Csrf()); // TODO create csrf
$app->hook('slim.after', 'ce\util\Message::clearMessage');

/********************************************/
/*                   urls                   */
/********************************************/

$app->hook('slim.before.router', function () use ($app) {
    $path = $app->request()->getPath();
    if (!preg_match("|/$|", $path)) {
        $app->redirect($path . '/');
    }
    $uri = $app->request()->getRootUri();
    if (preg_match("|index.php$|", $uri)) {
        $app->notFound();
    }
});

$ROOT_URL = $app->request()->getRootUri();
$ROOT_URL = preg_replace("|/index.php$|", "", $ROOT_URL);
$REQUEST_URL = $app->request()->getResourceUri();
define('ABS_PATH', dirname(__FILE__) . '/');
define('ROOT_URL', $ROOT_URL);

define('REQUEST_URL', $REQUEST_URL);

/********************************************/
/*              twig configs                */
/********************************************/

/* @var $view \Slim\Views\Twig */
$view = $app->view();
$env = $view->getEnvironment();

$env->addExtension(new \Slim\Views\TwigExtension());
$view->twigTemplateDirs = array('templates');


if (DEV_MODE) {
    $env->enableDebug();
} else {
    $env->disableDebug();
}

$env->addGlobal('_user', User::authentication());

$env->addGlobal('ROOT_URL', ROOT_URL);
$env->addGlobal('REQUEST_URL', REQUEST_URL);
$env->addGlobal('STATIC_URL', ROOT_URL . '/statics');
