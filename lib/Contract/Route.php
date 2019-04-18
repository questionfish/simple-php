<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 19:40
 */

namespace SP\Contract;


interface Route
{
    /**
     * @param string $url
     * @param string $function
     * @return Route
     */
    public function any($url, $function);

    /**
     * @param Request $request
     * @return callable
     */
    public function dispatch(Request $request);
}