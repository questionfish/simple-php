<?php

include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$container = new \SP\Container;
$container->bind(\SP\Application::class, \SP\Application::class);
$a = $container->make(\SP\Application::class);
$b = $container->make(\SP\Application::class);

$container->singleton(\SP\Container::class, \SP\Container::class);
$c = $container->make(\SP\Container::class);
$d = $container->make(\SP\Container::class);

var_dump($a === $b);
var_dump($c === $d);
