<?php

namespace App\Console\Commands;

use App\Models\Event;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console description for generating sitemap.
     *
     * @var string
     */
    protected $description = 'Generate sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        // Get all static routes (typically GET routes with no parameters)
        $staticRoutes = collect(Route::getRoutes())
            ->filter(function ($route) {
                return in_array('GET', $route->methods())
                    && strpos($route->uri(), '{') === false
                    && in_array('web', $route->gatherMiddleware()) // Only include routes using the 'web' middleware
                    && $route->uri() !== 'generate-sitemap' // Exclude generate-sitemap route
                    && $route->uri() !== 'downgrade-confirmation'; // Exclude downgrade-confirmation route
            });

        foreach ($staticRoutes as $route) {
            $sitemap->add(
                Url::create(url($route->uri()))
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        }

        // Add public events
        $publicEvents = Event::where('status', true)->where('public', true)->get();

        foreach ($publicEvents as $event) {
            $sitemap->add(
                Url::create(route('event.preview', $event->event_id))
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            );
        }

        // Save the sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');

        Log::info('Sitemap generated successfully!');
    }
}
