<?php
namespace Cyaxaress\Page\Providers;

 use Cyaxaress\Page\Models\Page;
 use Cyaxaress\Page\Policies\PagePolicy;
 use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/pages_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Pages');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        Gate::policy(Page::class, PagePolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.pages', [
            "icon" => "i-pages",
            "title" => "صفحه ها",
            "url" => route('pages.index'),
            "permission" => Permission::PERMISSION_SHOW_PAGES
        ]);
    }
}
