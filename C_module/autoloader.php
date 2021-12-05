<?php

function myloader($name) {
    include_once SRC . "/" . str_replace("\\", "/", $name) . ".php";
}

spl_autoload_register("myloader");