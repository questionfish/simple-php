<?php
/**
 * User: mayunyun1@100tal.com
 * Date: 2019-04-17
 * Time: 14:34
 */

namespace SP;
use \SP\Contract\Container as BaseContainer;

class Container implements BaseContainer
{
    const BIND_TYPE_NORMAL = 'normal';
    const BIND_TYPE_SINGLETON = 'singleton';

    static protected $singleThis;

    protected $bind;

    protected $bindType;

    protected $instances;

    public function __construct()
    {
        static::$singleThis = $this;
    }

    public function bind($abstract, $concrete)
    {
        return $this->_bind($abstract, $concrete, self::BIND_TYPE_NORMAL);
    }

    public function singleton($abstract, $concrete)
    {
        return $this->_bind($abstract, $concrete, self::BIND_TYPE_SINGLETON);
    }

    private function _bind($abstract, $concrete, $type)
    {
        assert(interface_exists($abstract) || class_exists($concrete), '$abstract must be a classname');
        assert(class_exists($concrete), '$concrete must be a classname');

        if(!isset($this->bind[$abstract]) ||
            !isset($this->bindType[$abstract]) ||
            $this->bind[$abstract] !== $concrete ||
            $this->bindType[$abstract] !== $type) {

            $this->bind[$abstract] = $concrete;
            $this->bindType[$abstract] = $type;
        }
        return true;
    }

    public function make($abstract, $params = [])
    {
        assert(interface_exists($abstract) || class_exists($concrete), '$abstract must be a classname');

        if(!isset($this->bind[$abstract]) || !isset($this->bindType[$abstract])){
            return null;
        }

        $bindClassName = $this->bind[$abstract];
        switch ($this->bindType[$abstract]){
            case self::BIND_TYPE_SINGLETON:
                if(!isset($this->instances[$abstract])){
                    $this->instances[$abstract] = new $bindClassName(... $params);
                }
                return $this->instances[$abstract];
                break;
            case self::BIND_TYPE_NORMAL:
                return new $bindClassName(... $params);
                break;
        }
        return null;
    }

    /**
     * @return static
     */
    static function getInstance()
    {
        if(!isset(static::$singleThis)){
            static::$singleThis = new static();
        }
        return static::$singleThis;
    }
}