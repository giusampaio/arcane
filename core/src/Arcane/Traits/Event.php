<?php

namespace Arcane\Traits;

use ReflectionClass;

trait Event
{
    /**
     * List of hooks to executed
     * @var array
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
            return false;
        }

        $before = $this->executeBefore($method);
        $main   = call_user_func_array(array($this, $actualMethod), $args);

        if (is_array($main)) {
            $main[] = $before; 
        } else {
            $main = $before . $main;
        }

        return $main;
    }

    /**
     * Add a function to executed before than other function
     * @param  string $hook     Function name to be hooked
     * @param  mixed  $obj      Class name to be executed
     * @param  string $function Function to be executed
     */
    public static function before($hook, $obj, $method)
    {
        if ( is_object($obj) ) {
            $obj = get_class($obj);
        }

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

        $obj = new $class();

        return $obj->$method();
    }
}
