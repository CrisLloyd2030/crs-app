<?php

namespace App\Providers;

use App\Helpers\UserHelpers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ModuleModel;
use App\Models\Roles;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.navbars', function ($view) {
            if(UserHelpers::myRoleId() == Roles::SUPERADMIN) {
                $modules = ModuleModel::all();
                $view->with('modules_data', $modules);
            } else {
                $modules = [];
                $view->with('modules_data', $modules);
            }
        });
    }
}
