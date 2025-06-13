<?php

namespace Branzia\Tax;
use Illuminate\Support\Facades\File;
use Branzia\Blueprint\BranziaServiceProvider;

class TaxServiceProvider extends BranziaServiceProvider
{
     public function moduleName(): string
    {
        return 'Tax';
    }
    public function moduleRootPath():string{
        return dirname(__DIR__);
    }

    public function boot(): void
    {
        parent::boot();
    }

    public function register(): void
    {
        parent::register();
    }
}

