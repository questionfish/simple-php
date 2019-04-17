<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 11:52
 */

namespace SP;
use \SP\Contract\Application as BaseApp;

class Application extends Container implements BaseApp
{
    /**
     * @var string
     */
    protected $basePath;

    public function __construct($basePath = null)
    {
        parent::__construct();

        if($basePath){
            $this->setBasePath($basePath);
        }
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }
}