<?php

namespace Tests\Feature;

use App\Models\PageContent;
use Database\Seeders\PageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_cms_page_can_be_opened(): void
    {
        $this->seed(PageContentSeeder::class);

        $response = $this->get(route('cms.edit'));

        $response->assertOk();
        $response->assertSee('Assestment Eyden M Fakhri A');
        $response->assertSee('Hero');
        $response->assertSee('Values Section');
    }

    public function test_admin_can_update_all_cms_content(): void
    {
        $this->seed(PageContentSeeder::class);

        $payload = PageContent::query()
            ->pluck('content_value', 'content_key')
            ->toArray();

        $payload['hero_title'] = 'Adventure starts when the road calls!';
        $payload['eyebrow'] = 'A fresh headline from CMS';
        $payload['location'] = 'Bali, Indonesia';
        $payload['main_image'] = '/assets/images/new-main.webp';

        $response = $this->put(route('cms.update'), [
            'contents' => $payload,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Content updated successfully.');

        $this->assertDatabaseHas('page_contents', [
            'content_key' => 'hero_title',
            'content_value' => 'Adventure starts when the road calls!',
        ]);

        $this->assertDatabaseHas('page_contents', [
            'content_key' => 'location',
            'content_value' => 'Bali, Indonesia',
        ]);

        $this->assertDatabaseHas('page_contents', [
            'content_key' => 'main_image',
            'content_value' => '/assets/images/new-main.webp',
        ]);
    }

    public function test_landing_page_receives_updated_cms_content(): void
    {
        $this->seed(PageContentSeeder::class);

        $payload = PageContent::query()
            ->pluck('content_value', 'content_key')
            ->toArray();

        $payload['hero_title'] = 'Adventure starts when the road calls!';
        $payload['eyebrow'] = 'A fresh headline from CMS';
        $payload['location'] = 'Bali, Indonesia';

        $this->put(route('cms.update'), [
            'contents' => $payload,
        ])->assertRedirect();

        $response = $this->get(route('landing'));

        $response->assertOk();
        $response->assertSee('Adventure starts when the road calls!');
        $response->assertSee('A fresh headline from CMS');
        $response->assertSee('Bali, Indonesia');
    }

    public function test_cms_update_requires_all_fields_to_be_filled(): void
    {
        $this->seed(PageContentSeeder::class);

        $payload = PageContent::query()
            ->pluck('content_value', 'content_key')
            ->toArray();

        $payload['hero_title'] = '';

        $response = $this->from(route('cms.edit'))->put(route('cms.update'), [
            'contents' => $payload,
        ]);

        $response->assertRedirect(route('cms.edit'));
        $response->assertSessionHasErrors('contents.hero_title');

        $this->assertDatabaseHas('page_contents', [
            'content_key' => 'hero_title',
            'content_value' => 'Life is short and the world is Wide! 🌴',
        ]);
    }
}
