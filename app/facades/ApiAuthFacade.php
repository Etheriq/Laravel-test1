<?php
namespace proj1\facades;

use Illuminate\Support\Facades\Facade;

class ApiAuthFacade extends Facade {

    protected static function getFacadeAccessor() { return 'apiauthfacade'; }
}
