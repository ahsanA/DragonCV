<?php

//extract argument from clean url
function requestParam($index){
       /* 1. parse the URL */
    $param = explode("/",$_SERVER['REQUEST_URI']);
    if(isset($param[$index]))
        return $param[$index];
    else
        return false;


}
