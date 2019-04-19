<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 11:39
 */

namespace SP\Contract;


interface Db
{
    public function execute(string $sql);
}