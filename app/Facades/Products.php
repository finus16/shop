<?php

namespace App\Facades;

use App\Services\ProductsService;
use Illuminate\Support\Facades\Facade;

class Products extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ProductsService::class;
    }
}
