<?php
namespace Cyaxaress\Faq\Providers;

 use Cyaxaress\Faq\Models\Faq;
 use Cyaxaress\Faq\Policies\FaqPolicy;
 use Cyaxaress\RolePermissions\Models\Permission;
 use Illuminate\Support\Facades\Gate;
 use Illuminate\Support\ServiceProvider;

 class FaqServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/faqs_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Faqs');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        Gate::policy(Faq::class, FaqPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.faqs', [
            "icon" => "i-question",
            "title" => "سوالات متداول",
            "url" => route('faqs.index'),
            "permission" => Permission::PERMISSION_SHOW_FAQS
        ]);
    }
}
