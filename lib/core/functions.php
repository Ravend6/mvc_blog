<?php

function old($name) {
    if (isset($_SESSION[$name])) {
        $res = $_SESSION[$name];
        unset($_SESSION[$name]);
        // session_destroy();

        return $res;
    }
}