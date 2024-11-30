<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use LaraZeus\Sky\Models\BlogPost;
use LaraZeus\Sky\Models\Tag;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Get the payload data
        $payload = $request->all();

        // Ensure required fields are present
        if (isset($payload['title'], $payload['content'])) {
            // Create or update the blog post
            $this->createOrUpdatePost($payload);
            return response()->json(['message' => 'Post processed successfully'], 200);
        }

        return response()->json(['message' => 'Invalid payload'], 400);
    }

    /**
     * Create or update a blog post from the webhook payload.
     */
    protected function createOrUpdatePost(array $data)
    {
        // Generate a slug from the title
        $slug = Str::slug($data['title'], '-');

        // Find the post using the slug
        $post = BlogPost::query()->where('slug', $slug)->first();

        // Get the first user with the "super_admin" role
        $user = User::role('super_admin')->first();

        // Process categories (tags)
        $categories = $data['categories'] ?? [];

        if ($post) {
            // Update the existing post
            $post->update([
                'user_id' => $user->id,
                'title' => $data['title'],
                'content' => $data['content'],
                'description' => $data['meta_description'] ?? $post->description,
                'featured_image' => $data['featured_image'] ?? $post->featured_image,
            ]);
        } else {
            // Create a new post
            $post = BlogPost::create([
                'user_id' => $user->id,
                'title' => $data['title'],
                'content' => $data['content'],
                'description' => $data['meta_description'] ?? '',
                'slug' => $slug,
                'featured_image' => $data['featured_image'] ?? null,
                'published_at' => now(),
            ]);

            // Attach tags to the post
            $post->attachTags($categories, 'category');
        }
    }
}
