<?php

return [
    /**
     * set the default path for the blog homepage.
     */
    'prefix' => 'blog',

    /**
     * the middleware you want to apply on all the blog routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    /**
     * URI prefix for each content type
     */
    'uri' => [
        'post' => 'post',
        'page' => 'page',
        // 'library' => 'library',
        'faq' => 'frequently-asked-questions',
    ],

    /**
     * you can overwrite any model and use your own
     * you can also configure the model per panel in your panel provider using:
     * ->skyModels([ ... ])
     */
    'models' => [
        'Faq' => \LaraZeus\Sky\Models\Faq::class,
        'Post' => \LaraZeus\Sky\Models\BlogPost::class,
        'Page' => \LaraZeus\Sky\Models\Page::class,
        'PostStatus' => \LaraZeus\Sky\Models\PostStatus::class,
        'Tag' => \LaraZeus\Sky\Models\Tag::class,
        'Library' => \LaraZeus\Sky\Models\Library::class,
        'Navigation' => \LaraZeus\Sky\Models\Navigation::class,
    ],

    'parsers' => [
        \LaraZeus\Sky\Classes\BoltParser::class,
    ],

    'recentPostsLimit' => 5,

    'searchResultHighlightCssClass' => 'highlight',

    'skipHighlightingTerms' => ['iframe'],

    'getSkipHighlightingTerms' => ['iframe'],

    'defaultFeaturedImage' => '/images/bg.jpg',

    /**
     * the default editor for pages and posts, Available:
     * \LaraZeus\Sky\Editors\TipTapEditor::class,
     * \LaraZeus\Sky\Editors\TinyEditor::class,
     * \LaraZeus\Sky\Editors\MarkdownEditor::class,
     * \LaraZeus\Sky\Editors\RichEditor::class,
     */
    'editor' => \LaraZeus\Sky\Editors\RichEditor::class,
];
