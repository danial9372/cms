<?php
namespace Cyaxaress\Menu\Providers;

 use Cyaxaress\Menu\Models\Menu;
 use Cyaxaress\Menu\Policies\MenuPolicy;
 use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/menus_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Menus');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        Gate::policy(Menu::class, MenuPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.menus', [
            "icon" => "i-menus",
            "title" => "منو ها",
            "url" => route('menus.index'),
            "permission" => Permission::PERMISSION_SHOW_MENU
        ]);
    }
}
