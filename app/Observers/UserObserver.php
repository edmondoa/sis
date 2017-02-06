<?php namespace App\Observers;

use Orchestra\Tenanti\Observer;

class UserObserver extends Observer
{
    public function getDriverName()
    {
        return 'tenants';
    }
}