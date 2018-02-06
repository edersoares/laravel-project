<?php

namespace App\Contracts;

interface Resolver
{
    /**
     * Return the abstract implementation.
     *
     * @return string
     */
    public static function getAbstract();

    /**
     * Return the concrete instance.
     *
     * @return mixed
     */
    public static function getConcrete();
}