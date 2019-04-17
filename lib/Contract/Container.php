<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 13:58
 */

namespace SP\Contract;

/**
 * 依赖注入容器
 *
 * @package SP\Contract
 */
interface Container
{
    public function bind($abstract, $concrete);

    public function singleton($abstract, $concrete);

    public function make($abstract, $params = []);
}