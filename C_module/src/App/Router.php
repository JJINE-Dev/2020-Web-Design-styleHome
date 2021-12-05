<?php

namespace App;

class Router 
{
    private static $GET = [];
    private static $POST = []; 
    public  static function route() 
    {
        $uri = $_SERVER['REQUEST_URI'];
        foreach(self::${$_SERVER['REQUEST_METHOD']} as $item) {
            if($uri == $item[0]) {
                $con = explode("@", $item[1]);

                $className = "Controller\\" . $con[0];
                $methodName = $con[1];

                $controller = new $className();
                $controller -> {$methodName}();

                return;
            }
        }      if(user()) {
            redirect('/', '로그인 된 사용자는 접근할 수 없습니다.', 'error');
        } else {
            redirect('/', '로그인을  한 후 이용해주세요.', 'error');
        }
    }

    public static function get($url, $action) {
        self::$GET[] = [$url, $action];
    }

    public static function post($url, $action) {
        self::$POST[] = [$url, $action];
    }

}