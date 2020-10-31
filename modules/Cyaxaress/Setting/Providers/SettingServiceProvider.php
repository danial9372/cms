<?php
namespace Cyaxaress\Setting\Providers;

 use Cyaxaress\Setting\Models\Setting;
 use Cyaxaress\Setting\Policies\SettingPolicy;
 use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/settings_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Settings');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        Gate::policy(Setting::class, SettingPolicy::class);
        \DatabaseSeeder::$seeders[] = SettingTableSeeder::class;

    }

    public function boot()
    {
        config()->set('sidebar.items.settings', [
            "icon" => "i-conf",
            "title" => "تنظیم ها",
            "url" => route('settings.index'),
            "permission" => Permission::PERMISSION_SHOW_SETTINGS
        ]);
    }
}
