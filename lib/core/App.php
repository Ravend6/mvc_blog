<?php
namespace Lib\Core;

class App
{
    public function run($route)
    {
        foreach ($route->urls as $url) {
            if ($url['method'] == $_SERVER['REQUEST_METHOD']) {
                if ($url['url'] == $_SERVER["PATH_INFO"] or
                    $url['url'] . '/' == $_SERVER["PATH_INFO"] or
                    $url['url'] == $_SERVER["REQUEST_URI"]) {
                    foreach ($url as $key => $value) {
                        if ($key == 'action') {
                            return $this->parseAction($value);
                        }
                    }
                }
            }
        }

        header('Location: /404');
    }

    private function parseAction($action)
    {
        if (is_callable($action)) {
            echo call_user_func($action);
        } else {
            preg_match('/(?P<controller>\w+)@(?P<method>\w+)/', $action, $matches);
            $controller = 'App\Controllers\\' . $matches['controller'];
            $method = $matches['method'];
            $c = new $controller;
            echo $c->$method();
        }
    }
}