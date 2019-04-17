<?php

include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$app = new \SP\Application(dirname(__DIR__));

$app->bind(\SP\Contract\Request::class, \SP\Request::class);
$app->bind(\SP\Contract\Request::class, \SP\Request::class);

$req = app(\SP\Contract\Request::class)->buildFromGlobals();

var_dump($req);