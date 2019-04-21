<?php

return [
    "/" => ["method" => "get","controller" => App\Http\HelloController::class,"action" => "hello"],
    "/test/test" => ["method" => "post","controller" => App\Http\HelloController::class,"action" => "hello"],
];
