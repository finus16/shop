<?php

namespace App\Facades;

use App\Services\UsersService;
use Illuminate\Support\Facades\Facade;

class Users extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UsersService::class;
    }
}
