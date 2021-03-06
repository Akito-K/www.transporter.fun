<?php

namespace MyFacade\Facades;

use Illuminate\Support\Facades\Facade;

class MyFormFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'myform';
    }
}