<?php

namespace Arcane\Traits;

use ReflectionClass;

trait Event
{
    /**
     * [$before description]
     * @var [type]
     */
    private static $before;

    /**
     * [listen description]
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     * @return [type]         [description]
     */
    public function listen($method, $args)
    {        
        $actualMethod = '_'.$method;

        if ( ! method_exists($this, $actualMethod) ) {
            print('not existes');
            return false;
        }

        $ret = call_user_func_array(array($this, $actualMethod), $args);

        $ret .= $this->executeBefore($method);

        return $ret;
    }

    /**
     * [before description]
     * @param  [type] $hook     [description]
     * @param  [type] $obj      [description]
     * @param  [type] $function [description]
     * @return [type]           [description]
     */
    public static function before($hook, $obj, $method)
    {
        self::$before[$hook] = ['obj' => $obj, 'method' => $method];
    }

    /**
     * 
     * @return [type] [description]
     */
    public function executeBefore($hook)
    {
        if (empty(self::$before[$hook]) ) return false;

        $class  = '\\'. self::$before[$hook]['obj'];
        $method = self::$before[$hook]['method'];

        $obj = new  $class();

        $obj->$method();
    }
}
