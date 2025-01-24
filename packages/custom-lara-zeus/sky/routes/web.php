<?php

use Illuminate\Support\Facades\Route;
use LaraZeus\Sky\Livewire\Faq;
use LaraZeus\Sky\Livewire\Library;
use LaraZeus\Sky\Livewire\LibraryItem;
use LaraZeus\Sky\Livewire\LibraryTag;
use LaraZeus\Sky\Livewire\Page;
use LaraZeus\Sky\Livewire\Post;
use LaraZeus\Sky\Livewire\Posts;
use LaraZeus\Sky\Livewire\Tags;
use LaraZeus\Sky\SkyPlugin;

$filament = app('filament');

Route::domain(config('zeus-sky.domain'))
    ->middleware(config('zeus-sky.middleware'))
    ->group(function () {
        if (array_key_exists('faq', config('zeus-sky.uri'))) {
            Route::get(config('zeus-sky.uri.faq'), Faq::class)
                ->name('faq');
        }

        if (array_key_exists('library', config('zeus-sky.uri'))) {
            Route::prefix(config('zeus-sky.uri.library'))
                ->group(function () {
                    Route::get('/', Library::class)->name('library');
                    Route::get('/tag/{slug}', LibraryTag::class)->name('library.tag');
                    Route::get('/{slug}', LibraryItem::class)->name('library.item');
                });
        }

        Route::prefix(config('zeus-sky.prefix'))
            ->group(function () {
                Route::get('/', Posts::class)->name('blogs');
                Route::get('{type}/{slug}', Tags::class)->name('tags');
            });

        Route::get(config('zeus-sky.uri.post') . '/{slug}', Post::class)->name('post');
        Route::get(config('zeus-sky.uri.page') . '/{slug}', Page::class)->name('page');
    });
