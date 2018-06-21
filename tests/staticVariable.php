<?php

// See http://php.net/language.variables.scope#language.variables.scope.static
// $a is initialized only in first call of function and every time the test() function is called it will print the value of $a and increment it.

function test()
{
    static $a = 0;
    echo $a;
    $a++;
}

test();
test();