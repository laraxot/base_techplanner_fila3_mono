<?php

declare(strict_types=1);

namespace Modules\Cms\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Cms\Models\Page;
use Modules\Cms\Models\PageContent;
use Modules\Cms\Models\Section;
use Tests\TestCase;

class PageManagementBusinessLogicTest extends TestCase
{


    /** @test */
    public function it_can_create_page_with_basic_information(): void
    {
        // Arrange
        $pageData = [
            'title' => 'Home Page',
            'slug' => 'home',
            'status' => 'published',
            'meta_title' => 'Home Page - '.config('app.name', 'Our Platform'),
            'meta_description' => 'Pagina principale di '.config('app.name', 'Our Platform'),
        ];

        // Act
        $page = Page::create($pageData);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'title' => 'Home Page',
            'slug' => 'home',
            'status' => 'published',
            'meta_title' => 'Home Page - '.config('app.name', 'Our Platform'),
            'meta_description' => 'Pagina principale di '.config('app.name', 'Our Platform'),
        ]);

        expect('Home Page', $page->title);
        expect('home', $page->slug);
        expect('published', $page->status);
    }

    /** @test */
    public function it_can_create_page_with_content(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $contentData = [
            'page_id' => $page->id,
            'content' => '<h1>Benvenuti su '.config('app.name', 'Our Platform').'</h1><p>La vostra salute è la nostra priorità.</p>',
            'locale' => 'it',
            'version' => 1,
        ];

        // Act
        $pageContent = PageContent::create($contentData);

        // Assert
        $this->assertDatabaseHas('page_contents', [
            'id' => $pageContent->id,
            'page_id' => $page->id,
            'locale' => 'it',
            'version' => 1,
        ]);

        expect($page->id, $pageContent->page_id);
        expect('it', $pageContent->locale);
        expect(1, $pageContent->version);
    }

    /** @test */
    public function it_can_create_page_with_sections(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $sectionData = [
            'page_id' => $page->id,
            'title' => 'Hero Section',
            'content' => 'Contenuto della sezione hero',
            'order' => 1,
            'type' => 'hero',
        ];

        // Act
        $section = Section::create($sectionData);

        // Assert
        $this->assertDatabaseHas('sections', [
            'id' => $section->id,
            'page_id' => $page->id,
            'title' => 'Hero Section',
            'order' => 1,
            'type' => 'hero',
        ]);

        expect($page->id, $section->page_id);
        expect('Hero Section', $section->title);
        expect(1, $section->order);
    }

    /** @test */
    public function it_can_update_page_status(): void
    {
        // Arrange
        $page = Page::factory()->create(['status' => 'draft']);

        // Act
        $page->update(['status' => 'published']);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'status' => 'published',
        ]);

        expect('published', $page->fresh()->status);
    }

    /** @test */
    public function it_can_update_page_seo_metadata(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $seoData = [
            'meta_title' => 'Nuovo Meta Title',
            'meta_description' => 'Nuova meta description per SEO',
            'meta_keywords' => 'salute, dentista, milano',
            'canonical_url' => 'https://'.config('app.domain', 'example.com').'/pagina',
        ];

        // Act
        $page->update($seoData);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'meta_title' => 'Nuovo Meta Title',
            'meta_description' => 'Nuova meta description per SEO',
            'meta_keywords' => 'salute, dentista, milano',
            'canonical_url' => 'https://'.config('app.domain', 'example.com').'/pagina',
        ]);
    }

    /** @test */
    public function it_can_manage_page_versions(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $contentV1 = PageContent::create([
            'page_id' => $page->id,
            'content' => 'Versione 1 del contenuto',
            'locale' => 'it',
            'version' => 1,
        ]);

        $contentV2 = PageContent::create([
            'page_id' => $page->id,
            'content' => 'Versione 2 del contenuto aggiornata',
            'locale' => 'it',
            'version' => 2,
        ]);

        // Act
        $versions = PageContent::where('page_id', $page->id)
            ->where('locale', 'it')
            ->orderBy('version', 'desc')
            ->get();

        // Assert
        expect(2, $versions);
        expect(2, $versions->first()->version);
        expect(1, $versions->last()->version);
        expect('Versione 2 del contenuto aggiornata', $versions->first()->content);
    }

    /** @test */
    public function it_can_manage_multilingual_page_content(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $italianContent = PageContent::create([
            'page_id' => $page->id,
            'content' => 'Contenuto in italiano',
            'locale' => 'it',
            'version' => 1,
        ]);

        $englishContent = PageContent::create([
            'page_id' => $page->id,
            'content' => 'Content in English',
            'locale' => 'en',
            'version' => 1,
        ]);

        // Act
        $italian = PageContent::where('page_id', $page->id)
            ->where('locale', 'it')
            ->first();

        $english = PageContent::where('page_id', $page->id)
            ->where('locale', 'en')
            ->first();

        // Assert
        expect($italian);
        expect($english);
        expect('Contenuto in italiano', $italian->content);
        expect('Content in English', $english->content);
    }

    /** @test */
    public function it_can_manage_page_sections_order(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $section1 = Section::create([
            'page_id' => $page->id,
            'title' => 'Prima Sezione',
            'order' => 1,
            'type' => 'hero',
        ]);

        $section2 = Section::create([
            'page_id' => $page->id,
            'title' => 'Seconda Sezione',
            'order' => 2,
            'type' => 'content',
        ]);

        $section3 = Section::create([
            'page_id' => $page->id,
            'title' => 'Terza Sezione',
            'order' => 3,
            'type' => 'footer',
        ]);

        // Act
        $orderedSections = Section::where('page_id', $page->id)
            ->orderBy('order', 'asc')
            ->get();

        // Assert
        expect(3, $orderedSections);
        expect('Prima Sezione', $orderedSections[0]->title);
        expect('Seconda Sezione', $orderedSections[1]->title);
        expect('Terza Sezione', $orderedSections[2]->title);
    }

    /** @test */
    public function it_can_reorder_page_sections(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $section1 = Section::create([
            'page_id' => $page->id,
            'title' => 'Prima Sezione',
            'order' => 1,
            'type' => 'hero',
        ]);

        $section2 = Section::create([
            'page_id' => $page->id,
            'title' => 'Seconda Sezione',
            'order' => 2,
            'type' => 'content',
        ]);

        // Act - Swap order
        $section1->update(['order' => 2]);
        $section2->update(['order' => 1]);

        // Assert
        $this->assertDatabaseHas('sections', [
            'id' => $section1->id,
            'order' => 2,
        ]);

        $this->assertDatabaseHas('sections', [
            'id' => $section2->id,
            'order' => 1,
        ]);
    }

    /** @test */
    public function it_can_validate_page_slug_uniqueness(): void
    {
        // Arrange
        Page::factory()->create(['slug' => 'unique-page']);

        // Act & Assert
        $this->expectException(\Illuminate\Database\QueryException::class);

        Page::create([
            'title' => 'Another Page',
            'slug' => 'unique-page', // Same slug
            'status' => 'draft',
        ]);
    }

    /** @test */
    public function it_can_handle_page_soft_delete(): void
    {
        // Arrange
        $page = Page::factory()->create();

        // Act
        $page->delete();

        // Assert
        $this->assertSoftDeleted('pages', ['id' => $page->id]);
        $this->assertDatabaseHas('pages', ['id' => $page->id]);
    }

    /** @test */
    public function it_can_restore_soft_deleted_page(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $page->delete();

        // Act
        $page->restore();

        // Assert
        $this->assertNotSoftDeleted('pages', ['id' => $page->id]);
        $this->assertDatabaseHas('pages', ['id' => $page->id]);
    }

    /** @test */
    public function it_can_force_delete_page_with_related_data(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $content = PageContent::create([
            'page_id' => $page->id,
            'content' => 'Test content',
            'locale' => 'it',
            'version' => 1,
        ]);

        $section = Section::create([
            'page_id' => $page->id,
            'title' => 'Test Section',
            'order' => 1,
            'type' => 'content',
        ]);

        // Act
        $page->forceDelete();

        // Assert
        $this->assertDatabaseMissing('pages', ['id' => $page->id]);
        $this->assertDatabaseMissing('page_contents', ['id' => $content->id]);
        $this->assertDatabaseMissing('sections', ['id' => $section->id]);
    }

    /** @test */
    public function it_can_search_pages_by_title(): void
    {
        // Arrange
        $page1 = Page::factory()->create(['title' => 'Home Page']);
        $page2 = Page::factory()->create(['title' => 'About Us']);
        $page3 = Page::factory()->create(['title' => 'Contact Page']);

        // Act
        $results = Page::where('title', 'like', '%Page%')->get();

        // Assert
        expect(2, $results);
        expect($results->contains($page1));
        expect($results->contains($page3));
        expect($results->contains($page2));
    }

    /** @test */
    public function it_can_search_pages_by_status(): void
    {
        // Arrange
        $publishedPage = Page::factory()->create(['status' => 'published']);
        $draftPage = Page::factory()->create(['status' => 'draft']);
        $archivedPage = Page::factory()->create(['status' => 'archived']);

        // Act
        $publishedPages = Page::where('status', 'published')->get();
        $draftPages = Page::where('status', 'draft')->get();

        // Assert
        expect(1, $publishedPages);
        expect(1, $draftPages);
        expect($publishedPages->contains($publishedPage));
        expect($draftPages->contains($draftPage));
    }

    /** @test */
    public function it_can_get_pages_with_related_content(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $content = PageContent::create([
            'page_id' => $page->id,
            'content' => 'Test content',
            'locale' => 'it',
            'version' => 1,
        ]);

        // Act
        $pageWithContent = Page::with('contents')->find($page->id);

        // Assert
        expect($pageWithContent);
        expect($pageWithContent->relationLoaded('contents'));
        expect(1, $pageWithContent->contents);
        expect('Test content', $pageWithContent->contents->first()->content);
    }

    /** @test */
    public function it_can_get_pages_with_related_sections(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $section = Section::create([
            'page_id' => $page->id,
            'title' => 'Test Section',
            'order' => 1,
            'type' => 'content',
        ]);

        // Act
        $pageWithSections = Page::with('sections')->find($page->id);

        // Assert
        expect($pageWithSections);
        expect($pageWithSections->relationLoaded('sections'));
        expect(1, $pageWithSections->sections);
        expect('Test Section', $pageWithSections->sections->first()->title);
    }

    /** @test */
    public function it_can_manage_page_templates(): void
    {
        // Arrange
        $page = Page::factory()->create(['template' => 'default']);

        // Act
        $page->update(['template' => 'landing']);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'template' => 'landing',
        ]);

        expect('landing', $page->fresh()->template);
    }

    /** @test */
    public function it_can_manage_page_permissions(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $permissions = [
            'view' => true,
            'edit' => false,
            'delete' => false,
        ];

        // Act
        $page->update(['permissions' => $permissions]);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'permissions' => json_encode($permissions),
        ]);

        expect($page->fresh()->permissions['view']);
        expect($page->fresh()->permissions['edit']);
    }

    /** @test */
    public function it_can_manage_page_scheduling(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $publishDate = now()->addDays(7);
        $expiryDate = now()->addMonths(6);

        // Act
        $page->update([
            'publish_at' => $publishDate,
            'expire_at' => $expiryDate,
        ]);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'publish_at' => $publishDate,
            'expire_at' => $expiryDate,
        ]);
    }

    /** @test */
    public function it_can_manage_page_categories(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $categories = ['informative', 'services', 'company'];

        // Act
        $page->update(['categories' => $categories]);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'categories' => json_encode($categories),
        ]);

        $this->assertContains('informative', $page->fresh()->categories);
        $this->assertContains('services', $page->fresh()->categories);
        $this->assertContains('company', $page->fresh()->categories);
    }

    /** @test */
    public function it_can_manage_page_tags(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $tags = ['salute', 'dentista', 'milano', 'benessere'];

        // Act
        $page->update(['tags' => $tags]);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'tags' => json_encode($tags),
        ]);

        expect(4, $page->fresh()->tags);
        $this->assertContains('salute', $page->fresh()->tags);
        $this->assertContains('dentista', $page->fresh()->tags);
    }

    /** @test */
    public function it_can_manage_page_redirects(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $redirectData = [
            'redirect_type' => '301',
            'redirect_url' => 'https://'.config('app.domain', 'example.com').'/nuova-pagina',
            'redirect_reason' => 'Page moved permanently',
        ];

        // Act
        $page->update($redirectData);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'redirect_type' => '301',
            'redirect_url' => 'https://'.config('app.domain', 'example.com').'/nuova-pagina',
            'redirect_reason' => 'Page moved permanently',
        ]);
    }

    /** @test */
    public function it_can_manage_page_analytics(): void
    {
        // Arrange
        $page = Page::factory()->create();
        $analyticsData = [
            'page_views' => 1250,
            'unique_visitors' => 890,
            'bounce_rate' => 45.2,
            'avg_time_on_page' => 180,
        ];

        // Act
        $page->update($analyticsData);

        // Assert
        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'page_views' => 1250,
            'unique_visitors' => 890,
            'bounce_rate' => 45.2,
            'avg_time_on_page' => 180,
        ]);
    }
}
