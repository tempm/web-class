<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 2/21/14
 * Time: 9:30 PM
 */

$app->get('/init/', 'ce\views\Common::init')->name('init');
$app->get('/', 'ce\views\Common::index')->name('index');
$app->post('/login/', 'ce\views\Common::login_post')->name('login-post');
$app->post('/logout/', 'ce\views\Common::logout_post')->name('logout-post');
$app->get('/test/', 'ce\views\Common::test')->name('test');

$app->post('/post/', 'ce\views\Posts::post_post')->name('post-post');