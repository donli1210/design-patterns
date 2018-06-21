<?php

/**
 * Singleton class
 *
 */
final class UserFactory
{
    /**
     * Call this method to get singleton
     *
     * @return UserFactory
     */
    public static function Instance()
    {
        // See http://php.net/language.variables.scope#language.variables.scope.static
        // static $inst is initialized only in first call
        static $inst = null;
        if ($inst === null) {
            $inst = new UserFactory();
        }
        return $inst;
    }

    /**
     * Private ctor so nobody else can instantiate it
     *
     */
    private function __construct()
    {

    }
}

$fact = UserFactory::Instance();
$fact2 = UserFactory::Instance();

if($fact===$fact2){

    echo 'Equal';

}else{

    echo 'Not equal.';

}