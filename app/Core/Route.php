<?php

namespace App\Core;

class Route
{

    private static array $routes = [];
    private static  $method_get = "GET";
    private static  $method_post = "POST";


    public static function get($path, $handler)
    {
        $path = trim($path, '/');
        self::$routes[self::$method_get][$path] = $handler;
    }

    public static function post($path, $handler)
    {
        $path = trim($path, '/');
        self::$routes[self::$method_post][$path] = $handler;
    }

    public static function run()
    {
        $url = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
        $request_method = strtoupper($_SERVER['REQUEST_METHOD']);

        if (key_exists($url,self::$routes[$request_method])) {
            $call_back = self::$routes[$request_method][$url];
            if (is_callable($call_back)) {
                return call_user_func_array($call_back, []);
            }else if(is_array($call_back)){
                $controller = $call_back[0];
                $method = $call_back[1];

                if (class_exists($controller) && method_exists($controller,$method)) {
                    return call_user_func_array([new $controller,$method], []);
                }else{
                    return "action not found!";
                }
            }
            else{
                return "action not found!";
            }
        }else{
            return "404";
        }
        
    }
}
