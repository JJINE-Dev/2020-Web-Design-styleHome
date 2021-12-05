<?php

namespace App;

class Session
{
    public function set($type, $data)
    {
        $_SESSION[$type] = $data;
    }

    public function has($type)
    {
        return isset($_SESSION[$type]);
    }

    public function remove($type)
    {
        unset($_SESSION[$type]);
    }

    public function get($type, $save = false)
    {
        if($this->has($type)){
            $data = $_SESSION[$type];
            if(!$save){
                $this->remove($type);
            }
            return $data;
        } else {
            return false;
        }
    }
}