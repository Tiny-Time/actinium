<?php

namespace LaraZeus\Sky\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Page extends Component
{
    public \LaraZeus\Sky\Models\Page $page;

    public function mount(string $slug): void
    {
        $this->page = config('zeus-sky.models.Page')::where('slug', $slug)->page()->firstOrFail();
    }

    public function render(): View
    {
        $this->setSeo();

        if ($this->page->status !== 'publish' && ! $this->page->require_password) {
            abort_if(! auth()->check(), 404);
            abort_if($this->page->user_id !== auth()->user()->id, 401);
        }

        if ($this->page->require_password && ! session()->has($this->page->slug . '-' . $this->page->password)) {
            return view(app('skyTheme') . '.partial.password-form')
                ->with('post', $this->page)
                ->layout(config('zeus.layout'));
        }

        return view(app('skyTheme') . '.page')
            ->with([
                'post' => $this->page,
                'children' => config('zeus-sky.models.Post')::with('parent')->where('parent_id', $this->page->id)->get(),
            ])
            ->layout(config('zeus.layout'));
    }

    public function setSeo(): void
    {
        $title = str($this->page->title)->limit(60, '...');
        $seoTitle = $title;

        // Ensure the SEO title is at least 30 characters
        if (strlen($title) < 30) {
            $seoTitle = "$title - Don't miss the details";
        }

        // Ensure the total SEO title does not exceed 65 characters
        $seoTitle = str($seoTitle . ' - ' . config('zeus.site_title', 'Laravel'))->limit(limit: 61, end: '...');

        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title($seoTitle)
            ->description(($this->page->description ?? '') . ' ' . config('zeus.site_description', 'Laravel') . ' ' . config('zeus.site_title'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        if (! $this->page->getMedia('posts')->isEmpty()) {
            seo()->image($this->page->getFirstMediaUrl('pages'));
        }
    }
}
