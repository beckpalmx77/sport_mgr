<?php

/**
 * Created by PhpStorm.
 * User: beckpalmx
 * Date: 22/6/2563
 * Time: 9:55
 */
class myclass
{
    private $name;
    private $age;

    function __construct( $name, $age ) {
        $this->name = $name;
        $this->age = $age;
    }

    function getName() {
        return $this->name;
    }

    function isAdult() {
        return $this->age >= 18?"an Adult":"Not an Adult";
    }

}