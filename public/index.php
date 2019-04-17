<?php
include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/**
 * reg
 */
$c = \SP\Container::getInstance();
$c->singleton(\SP\Contract\Application::class, \SP\Application::class);
$c->singleton(\SP\Contract\Request::class, \SP\Request::class);
$c->singleton(\SP\Contract\Response::class, \SP\Response::class);
$c->singleton(\SP\Contract\Route::class, \SP\Route::class);

/**
 * process
 */
$app = app(\SP\Contract\Application::class, [dirname(__DIR__)]);
$app->run();
