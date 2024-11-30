<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use LaraZeus\Sky\Models\BlogPost;

class WebhookTest extends TestCase
{
    /**
     * Test the webhook successfully creates a new blog post.
     */
    public function test_webhook_creates_new_post()
    {
        // Get the super admin user
        $superAdmin = User::role('super_admin')->first();

        // Sample payload
        $payload = [
            'title' => 'Test Blog Post',
            'content' => 'This is the content of the blog post.',
            'meta_description' => 'This is the meta description.',
            'categories' => ['Laravel', 'PHP', 'Testing'],
            'featured_image' => 'https://example.com/image.jpg',
        ];

        // Send POST request to the webhook
        $response = $this->postJson(route('webhook.juice'), $payload);

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert the post is created in the database
        $this->assertDatabaseHas('posts', [
            'title' => json_encode(['en' => $payload['title']]), // Check JSON structure
            'content' => json_encode(['en' => $payload['content']]), // Check JSON structure
            'description' => json_encode(['en' => $payload['meta_description']]), // Check JSON structure
            'featured_image' => $payload['featured_image'],
            'user_id' => $superAdmin->id,
        ]);
    }

    /**
     * Test the webhook updates an existing blog post.
     */
    public function test_webhook_updates_existing_post()
    {
        // Get the super admin user
        $superAdmin = User::role('super_admin')->first();

        // Create an existing blog post
        $existingPost = BlogPost::create([
            'user_id' => $superAdmin->id,
            'title' => 'Test Blog Post',
            'slug' => 'test-blog-post-2',
            'content' => 'Old content',
            'description' => 'Old description',
            'featured_image' => 'https://example.com/old-image.jpg',
            'published_at' => now(),
        ]);

        $existingPost->syncTagsWithType(['Laravel', 'PHP', 'Testing'], 'category');

        // Payload to update the existing post
        $payload = [
            'title' => 'Test Blog Post',
            'content' => 'Updated content of the blog post.',
            'meta_description' => 'Updated meta description.',
            'categories' => ['Laravel', 'PHP', 'Updated Testing'],
            'featured_image' => 'https://example.com/new-image.jpg',
        ];

        // Send POST request to the webhook
        $response = $this->postJson(route('webhook.juice'), $payload);

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert the post is updated in the database
        $this->assertDatabaseHas('posts', [
            'title' => json_encode(['en' => $payload['title']]), // Check JSON structure
            'content' => json_encode(['en' => $payload['content']]), // Check JSON structure
            'description' => json_encode(['en' => $payload['meta_description']]), // Check JSON structure
            'featured_image' => $payload['featured_image'],
            'user_id' => $superAdmin->id,
        ]);
    }

    /**
     * Test the webhook handles invalid payloads.
     */
    public function test_webhook_handles_invalid_payload()
    {
        // Send an invalid payload (missing required fields)
        $payload = [
            'title' => 'Invalid Payload',
        ];

        $response = $this->postJson(route('webhook.juice'), $payload);

        // Assert response status is 400
        $response->assertStatus(400);

        // Assert no post is created in the database
        $this->assertDatabaseMissing('posts', [
            'title' => json_encode(['en' => $payload['title']]), // Check JSON structure
        ]);
    }
}
