<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 2/21/14
 * Time: 9:38 PM
 */

define('DEV_MODE', true);
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/private/db/db.sqlite',
);