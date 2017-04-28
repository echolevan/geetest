<?php namespace Levan\Geetest;

use Illuminate\Support\Facades\Facade;

class Geetest extends Facade
{
    /**
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'geetest';
    }

}