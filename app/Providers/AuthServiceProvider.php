<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
        \LaraZeus\Sky\Models\Faq::class => 'App\Policies\FaqPolicy',
        \LaraZeus\Sky\Models\BlogPost::class => 'App\Policies\BlogPostPolicy',
        \LaraZeus\Sky\Models\Page::class => 'App\Policies\PagePolicy',
        \App\Models\Event::class => 'App\Policies\EventPolicy',
        // \LaraZeus\Sky\Models\PostStatus::class => 'App\Policies\PostStatusPolicy',
        \LaraZeus\Sky\Models\Tag::class => 'App\Policies\TagPolicy',
        // \LaraZeus\Sky\Models\Library::class => 'App\Policies\LibraryPolicy',
        // \LaraZeus\Sky\Models\Navigation::class => 'App\Policies\NavigationPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
