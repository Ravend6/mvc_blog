<?php

$c = 'PageController@getIndex';

preg_match('/(?P<controller>\w+)@(?P<method>\w+)/', $c, $matches);

echo $matches['method'] . PHP_EOL;
print_r($matches);
echo date('Y') . PHP_EOL;
